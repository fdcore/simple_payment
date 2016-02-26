<?php

class UnitpayTest extends PHPUnit_Framework_TestCase
{

    function __construct(){
        include_once 'payments.php';
    }

    public function testInit()
    {
        $p = new Simple_payment(array(
            'paymant' => 'unitpay',
            'public_key' => 'unitpay',
            'secret_key' => 'unitpay',
        ));

        $class = $p->get_class();

        $this->assertEquals('Unitpay', get_class($class));
    }

    public function testCheck_valid_params()
    {
        try {
            $p = new Simple_payment(array(
                'paymant' => 'unitpay',
            ));

            $check = FALSE;
        } catch (Exception $e) {
             $check = TRUE;
        }

        $this->assertTrue($check);

        try {
            $p = new Simple_payment(array(
                'paymant' => 'unitpay',
                'public_key' => false,
            ));

            $check = FALSE;
        } catch (Exception $e) {
            $check = TRUE;
        }

        $this->assertTrue($check);
    }

    function testMakeUrl(){

        $p = new Simple_payment(array(
            'paymant' => 'unitpay',
            'public_key' => 'unitpay',
            'secret_key' => 'unitpay',
        ));

        $url = $p->make_url(100);

        $this->assertContains('unitpay.ru', $url);
    }
}
