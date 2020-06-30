<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class InvestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        Log::debug('Bet Color: ' . $this->bet_color);
        Log::debug('Bet Number: ' . $this->bet_number);

        $this->merge([
            'bet_color' => $this->bet_color ? decrypt($this->bet_color) : '',
            'bet_number' => $this->bet_number ? decrypt($this->bet_number) : '',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => ['required', 'numeric', 'min:10'],
            'bets' => ['required', 'numeric', 'min:1', 'max:999'],
            'bet_number' => ['required_without:bet_color', 'numeric', 'min:0', 'max:9'],
            'bet_color' => ['required_without:bet_number', 'alpha', 'min:3', 'max:6', 'regex:/(violet)|(green)|(red)/m'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {

        $validator->after(function ($validator) {
            if ($this->checkCredits()) {
                $validator->errors()->add('amount', 'Not Enough Credits. Please Recharge!');
            }
        });
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // return response()->json(['errors' => $validator->errors()]);
        Log::debug('Failed Validation!');
        $errorResponse['errors'] = $validator->errors();
        Log::debug('Validation Errors: '.json_encode($errorResponse));
        throw new HttpResponseException(response()->json($errorResponse));
    }

    /**
     * Check User Credits
     *
     * @return bool
     */
    public function checkCredits()
    {
        $user = Auth::user();
        $amount = $this->amount * $this->bets;

        if ($amount > $user->credits)
        {
            return true;
        }

        return false;
    }
}