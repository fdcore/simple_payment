<?php

if(!defined('PAYMENTS_PATH')) {

    define("PAYMENTS_PATH", str_replace('\\', '/',  __DIR__) . '/');

}

include_once PAYMENTS_PATH . '/interface.php';

class Simple_payment{

    private $payment = null;

    function __construct($config=array()){

        $class = ucfirst($config['paymant']);

        if(!class_exists($class)){
            include_once PAYMENTS_PATH . 'payments/' . strtolower($class) . '.php';
        }

        $this->payment = new $class($config);
    }

    function get_class(){
        return $this->payment;
    }

    function gateway(){
        $this->payment->gateway();
    }

    function make_payment($sum=0, $order_id=0, $message=false){
        $this->payment->make_payment($sum, $order_id, $message);
    }

    function make_url($sum=0, $order_id=0, $message=false){
        return $this->payment->make_url($sum, $order_id, $message);
    }

}
