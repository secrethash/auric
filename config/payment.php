<?php

return [


    /***************************************************
     * Default Payment Gateway
     *
     * Select a default Payment Gateway
     ***************************************************/
    "gateway" => env("PAYMENT_GATEWAY"),


    /***************************************************
     * Payment Gateway's API Details
     *
     * Key => API Key
     * Secret => API Secret
     ***************************************************/
    "razorpay" => [
        "key" => env("RAZORPAY_KEY"),
        "secret" => env("RAZORPAY_SECRET"),
    ],
    "stripe" => [
        "key" => env("STRIPE_KEY"),
        "secret" => env("STRIPE_SECRET"),
    ],
];
