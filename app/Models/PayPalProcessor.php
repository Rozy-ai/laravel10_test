<?php

namespace App\Models;
use App\Interfaces\PaymentProcessorInterface;

class PayPalProcessor implements PaymentProcessorInterface
{
    public function processPayment($amount)
    {
        // Логика обработки платежа через PayPal
    }
}
