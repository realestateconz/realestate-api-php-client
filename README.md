Creating API Signatures
=======================

GET Request
-------------
````
$client = new RealestateCoNz_Api_Client('PRIVATE_KEY', 'PUBLIC_KEY', 1);
$api_path = '/listings/';
$query_params = array('format' => 'full');
$api_signature = $client->createSignature($api_path, $query_params);
````

POST Request
-------------
````
$client = new RealestateCoNz_Api_Client('PRIVATE_KEY', 'PUBLIC_KEY', 1);
$api_path = '/listings/100000000/agent-enquiry/';
$query_params = array();
$post_values = array('email' => 'example@example.com', 'phone' => '000000000', 'text' => 'test', 'name' => 'Test');
$api_signature = $client->createSignature($api_path, $query_params, $post_values);
````
Note: all post requests must be sent with the following request header:

Content-Type: application/x-www-form-urlencoded


Unit Testing
-------------
````
php phpunit.php -c tests/
````