<?php

namespace App\Models;
use App\Interfaces\PaymentProcessorInterface;

class PaymentService
   {
       protected $processor;

       public function __construct(PaymentProcessorInterface $processor)
       {
           $this->processor = $processor;
       }

       public function pay($amount)
       {
           return $this->processor->processPayment($amount);
       }
   }