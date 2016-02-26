<?php
/**
 *
 */
class Unitpay extends Payment
{
    const PAYMENT_URL = 'https://unitpay.ru/pay/';

    private $config = array(
        'currency' => 'RUB',
        'public_key' => '',
        'secret_key' => '',

    ); // array

    function __construct($config)
    {
        $this->config = array_merge($this->config, $config);

        // check required params
        if(!isset($this->config['public_key']) || !$this->config['public_key']) throw new Exception("Variable 'public_key' is Required");
        if(!isset($this->config['secret_key']) || !$this->config['secret_key']) throw new Exception("Variable 'secret_key' is Required");
        if(!isset($this->config['currency'])   || !$this->config['currency'])   $this->config['currency'] = 'RUB';

    }

    function make_url($sum = 0, $order_id = 0, $message = false){

        if(!$message) $message = "Order $order_id";

        $sum = abs(floatval($sum));

        if($sum == 0) throw new Exception("Invalid sum.");

        $sign = md5($order_id . $this->config['currency'] . $message . $sum . $this->config['secret_key']);

        $params = http_build_query(array(
            'sum'     => $sum,
            'account' => $order_id,
            'desc'    => $message,
            'currency'=> $this->config['currency'],
            'sign'    => $sign
        ));

        return self::PAYMENT_URL . $this->config['public_key'] . '?' . $params;
    }

    public function gateway(){


    }

}
