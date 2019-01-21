<?php

use PHPUnit\Framework\TestCase;
use Truevo\Truevo;

/**
*  Corresponding Class to test YourClass class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author yourname
*/
class TruevoTest extends TestCase
{

    /**
     * @var
     */
    public $truevo;

    public function setUp()
    {
        $user_login = '8a8294174fbc3f9e014fd13fa8541c8f';
        $user_password = 'mS4KW5xgNj';
        $entity_id = '8a8294174fbc3f9e014fd13fa83f1c8b';
        $this->truevo = new Truevo($user_login, $user_password, $entity_id);
    }

    public function testPaymentSeverToServer()
    {
        $this->truevo->sandbox_mode(true);

        $params = array(
            'amount' => '92.00',
            'currency' => 'EUR',
            'paymentBrand' => 'VISA',
            'paymentType' => 'DB',
            'card.number' => '4200000000000000',
            'card.holder' => 'Jane Jones',
            'card.expiryMonth' => '05',
            'card.expiryYear' => '2020',
            'card.cvv' => '123',
            'shopperResultUrl' => 'https://docs.swishme.eu/tutorials/server-to-server'
        );

        $data = $this->truevo->payment($params);

        $this->assertObjectHasAttribute('result', $data);

    }

    public function testPaymentCheckout()
    {
        $params = array(
            'amount' => '92.00',
            'currency' => 'EUR',
            'paymentType' => 'DB'
        );

        $data = $this->truevo->checkout($params);

        $this->assertObjectHasAttribute('result', $data);
    }
}
