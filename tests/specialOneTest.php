<?php

require('vendor/autoload.php');

class SpecialOneTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8080'
        ]);
    }

    public function testPost_SpecialOneClient()
    {
            $bookId = uniqid();

            $response = $this->client->post('/specialone', [
               'query' => [
                'inputs' => '{"a":true,"b":true,"c":true,"d":100,"e":20,"f":10}'
                ]
            ]);

            $this->assertEquals(200, $response->getStatusCode());
            $data = json_decode($response->getBody(), true);
            $this->assertEquals(220, $data['Y']);
    }

}