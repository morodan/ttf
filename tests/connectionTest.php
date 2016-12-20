<?php

require('vendor/autoload.php');

class ConnectionTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8080'
        ]);
    }


    public function testConnection_BaseObject()
    {
        $response = $this->client->get('/test');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertEquals(true, $data['success']);
    }

}