<?php

function useCurl()
{
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://localhost:8080/base',
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERAGENT => 'Demo TTF sample cURL Request',
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => array(
			'inputs' => '{"a":true,"b":true,"c":false,"d":100,"e":20,"f":10}'
		)
	));

	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}

var_dump(useCurl());
