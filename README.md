

* Creating api signatures


$client = new RealestateCoNz_Client('PRIVATE_KEY', 'PUBLIC_KEY', 1);

$api_path = '/listings/';
$query_params = array('format' => 'full');
$api_signature = $client->createSignature($api_path, $query_params);




