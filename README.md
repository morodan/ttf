#Demo API
Here is a demo algorithm which is implemented in a SOLID manner and expose the results in a simple REST api. 

Implementation is based on Slim Framework and for unit testing I used PHPUnit and Guzzle.

I tested the algo only under PHP 7.0.8, but it's should work properly under other PHP version greater than 5.3.

##Requirements

- install PHP (latest version)
- install [`cURL`](https://curl.haxx.se/)
- install [`Postman`](https://chrome.google.com/webstore/detail/postman/) on your Chrome browser, or [`HttpRequester`](https://addons.mozilla.org/ro/firefox/addon/httprequester/) on Firefox 
- install [`Composer`](https://getcomposer.org/) if you don't have it
- install [`PHPUnit`](https://phpunit.de/getting-started.html) if you want to run tests
- install [`Guzzle`](http://guzzle.readthedocs.io/en/latest/overview.html#installation)

*Note: Please use google to find details about installation for requested tools. For issues with requirements, please contact me.*


##The theory
###Inputs
We have the following variables: 
`A: bool`

`B: bool`

`C: bool`

`D: int`

`E: int`

`F: int`

###Outputs
The outputs are defined as: 

`X: enum[S,R,T]`

`Y: real/float/decimal`

###Mappings
The assignment consists of a 'base mapping', and two specialized mappings that override / extend the base mapping.

####Base
`A && B && !C => X = S`

`A && B && C => X = R`

`!A && B && C => X =T`

`[other] => [error]`


`X = S => Y = D + (D * E / 100)`

`X = R => Y = D + (D * (E - F) / 100)`

`X = T => Y = D - (D * F / 100)`

####Specialized 1
`X = R => Y = 2D + (D * E / 100)`

####Specialized 2
`A && B && !C => X = T`

`A && !B && C => X = S`

`X = S => Y = F + D + (D * E / 100)`

##How to run the application
1. Open terminal, go to application folder
2. start the web server with the command `php -S localhost:8080`
3. Open Postman or HttpRequester to see the application resposes
4. Or you can use curl to check the application. Here is a example code for this:
```php
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
```
5. Save the code bellow to a file named `curl.php` or whatever
6. on another terminal run the command: `php curl.php`
7. if everything are ok you will see: `string(24) "{"success":true,"X":"S","Y":120}"`

##How to test the application
- open a terminal
- in the current folder run the command: `phpunit tests`
- you will see the tests results.

