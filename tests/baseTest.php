<?php

require('vendor/autoload.php');

class BaseTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8080'
        ]);
    }

    public function testPost_case1_BaseClient()
    {
            $bookId = uniqid();

            $response = $this->client->post('/base', [
               'query' => [
                'inputs' => '{"a":true,"b":true,"c":false,"d":100,"e":20,"f":10}'
                ]
            ]);

            $this->assertEquals(200, $response->getStatusCode());
            $data = json_decode($response->getBody(), true);
            $this->assertEquals(120, $data['Y']);
    }

    public function testPost_case2_BaseClient()
    {
            $bookId = uniqid();

            $response = $this->client->post('/base', [
               'query' => [
                'inputs' => '{"a":true,"b":true,"c":true,"d":100,"e":20,"f":10}'
                ]
            ]);

            $this->assertEquals(200, $response->getStatusCode());
            $data = json_decode($response->getBody(), true);
            $this->assertEquals(110, $data['Y']);
    }

    public function testPost_case3_BaseClient()
    {
            $bookId = uniqid();

            $response = $this->client->post('/base', [
               'query' => [
                'inputs' => '{"a":false,"b":true,"c":true,"d":100,"e":20,"f":10}'
                ]
            ]);

            $this->assertEquals(200, $response->getStatusCode());
            $data = json_decode($response->getBody(), true);
            $this->assertEquals(90, $data['Y']);
    }

    public function testPost_caseOther_BaseClient()
    {
            $bookId = uniqid();

            $response = $this->client->post('/base', [
               'query' => [
                //'inputs' => '{"a":false,"b":true,"c":false,"d":100,"e":20,"f":10}'
                //'inputs' => '{"a":false,"b":false,"c":true,"d":100,"e":20,"f":10}'
                //'inputs' => '{"a":true,"b":false,"c":false,"d":100,"e":20,"f":10}'
                'inputs' => '{"a":false,"b":false,"c":false,"d":100,"e":20,"f":10}'
                ]
            ]);

            $this->assertEquals(200, $response->getStatusCode());
            $data = json_decode($response->getBody(), true);
            $this->assertEquals(true, $data['error']);
    }
}