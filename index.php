<?php
include_once ('config.inc.php');

require 'Slim/Slim.php';
require 'mapping/Base.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/test', 'testConnection');

$app->post('/base', 'base');
$app->post('/specialone', 'special_one');
$app->post('/specialtwo', 'special_two');

function base(){
    $app = \Slim\Slim::getInstance();
    $request = $app->request();
    $results = json_decode($app->request->params('inputs'));
    $base = new Base([$results->a, $results->b, $results->c, $results->d, $results->e, $results->f]);

    $app->response->setStatus(200);
    $callback = $base->calculate();
    $app->response->body(json_encode($callback));
}

function special_one(){

    require 'mapping/SpecializedOne.php';
    $app = \Slim\Slim::getInstance();
    $request = $app->request();
    $results = json_decode($request->params('inputs'));
    $special_one = new SpecializedOne([$results->a, $results->b, $results->c, $results->d, $results->e, $results->f]);

    $app->response->setStatus(200);
    $callback = $special_one->calculate();
    $app->response->body(json_encode($callback));
}

function special_two(){

    require 'mapping/SpecializedTwo.php';
    $app = \Slim\Slim::getInstance();
    $request = $app->request();
    $results = json_decode($request->get('inputs'));
    $special_two = new SpecializedTwo([$results->a, $results->b, $results->c, $results->d, $results->e, $results->f]);

    $app->response->setStatus(200);
    $callback = $special_two->calculate();
    $app->response->body(json_encode($callback));
}





$app->run();

class TestClass {
    function __construct()
    {
    }

    function testConnection(){
        $app = \Slim\Slim::getInstance();
        $app->response->setStatus(200);
        $callback = ['success'=>true, 'msg'=>'all ok'];
        $app->response->body(json_encode($callback));
    }
}


function testConnection() {
    $tst = new TestClass();
    $tst->testConnection();
}


