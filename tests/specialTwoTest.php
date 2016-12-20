<?php

require('vendor/autoload.php');

class SpecialTwoTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8080'
        ]);
    }

    public function testPost_case1_SpecialTwoClient()
    {
            $bookId = uniqid();

            $response = $this->client->post('/specialtwo', [
               'query' => [
                'inputs' => '{"a":true,"b":true,"c":false,"d":100,"e":20,"f":10}'
                ]
            ]);

            $this->assertEquals(200, $response->getStatusCode());
            $data = json_decode($response->getBody(), true);
            $this->assertEquals(90, $data['Y']);
    }

    public function testPost_case2_SpecialTwoClient()
    {
            $bookId = uniqid();

            $response = $this->client->post('/specialtwo', [
               'query' => [
                'inputs' => '{"a":true,"b":false,"c":true,"d":100,"e":20,"f":10}'
                ]
            ]);

            $this->assertEquals(200, $response->getStatusCode());
            $data = json_decode($response->getBody(), true);
            $this->assertEquals(130, $data['Y']);
    }

}