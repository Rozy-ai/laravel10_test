<?php

namespace App\Models;
use App\Interfaces\PaymentProcessorInterface;

class StripeProcessor implements PaymentProcessorInterface
{
    public function processPayment($amount)
    {
        // Логика обработки платежа через PayPal
    }
}
