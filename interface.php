<?php

interface iPayment {
    public function gateway();
    public function make_payment($sum=0, $order_id=0, $message=false);
    public function make_url($sum=0, $order_id=0, $message=false);
}

/**
 *  Default basic Class for payment system.
 */
class Payment implements iPayment
{

    function __construct()
    {
        # code...
    }

    public function gateway(){}
        
    public function make_payment($sum=0, $order_id=0, $message=false){

        $url = $this->make_url($sum, $order_id, $message);

        header("Location: $url");
    }

    public function make_url($sum=0, $order_id=0, $message=false){}
}
