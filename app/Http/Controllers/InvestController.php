<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lobby;
use App\Order;
use App\Period;
use App\Services\Transact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class InvestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lobby = null)
    {
        //
        $lobbies = Lobby::all();

        $current = $lobby ? Lobby::whereSlug($lobby)->first() : $lobbies->first();

        $now = Carbon::now();
        $date = $now->format('Ymd');
        $id = (($now->format('H') * 20) + ($now->format('i') / 3)) + 1;
        $uid = $current->slug.'-'.$date.floor($id);

        $period = Period::where([
            'uid' => $uid,
            'active'=>1
        ])->first();

        return view('user.invest.index')->with([
            'user'=>auth()->user(),
            'lobbies'=>$lobbies,
            'current'=>$current,
            'period'=> $period,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lobby, $period, InvestRequest $request)
    {
        //
        $user = Auth::user();
        $lobby = decrypt($lobby);
        $lobby = Lobby::find($lobby);

        $period = decrypt($period);
        $period = Period::whereUid($period)->first();

        $validated = $request->validated();
        // Check Lobby
        if (!$lobby)
        {
            return response()->json([
                'success' => false,
                'code' => 404,
            ]);
        }

        // Check if the time has not elapsed
        $periodCheck = $this->checkPeriod($period);

        if (!$periodCheck)
        {
            return response()->json([
                'errors' => [
                    'time' => ['Opps, Time has elapsed!']
                ]
            ]);
        }


        $order = Order::whereType('invest')->first();

        $amount = $validated['amount'] * $validated['bets'];
        $data = [
            'amount' => $amount,
            'note' => 'Investment in Period: '.$period->uid,
            'status' => 'success',
            'payment_id' => null,
            'request_id' => $period->uid
        ];

        $transact = Transact::create($data, Auth::user(), $order);

        $user->periods()->attach($period->id, [
            'amount' => $amount,
            'transaction_id' => $transact->id,
            'invest_number' => $validated['bet_number'] ?? NULL,
            'invest_color' => $validated['bet_color'] ?? NULL
        ]);

        $wallet = Transact::wallet('sub', $amount, $user);

        return response()->json([
            'success' => true,
            'wallet' => $wallet
        ]);
    }


    /**
     * Check User Credits
     *
     * @return bool
     */
    public function checkPeriod(Period $period)
    {
        // Check Period
        $time = Carbon::create($period->start)->addMinutes(2)->addSecond(30);
        $now = Carbon::now();

        if ($now->greaterThan($time))
        {
            return false;
        }

        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
