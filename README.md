## Getting Started ##

The easiest way to work with the realestate.co.nz api client is when it's installed as a
Composer package inside your project. 

If you're not familiar with Composer, please see <http://getcomposer.org/>.

1. Add realestateconz/api-client to your application's composer.json.

        {
            ...
            "require": {
                "realestateconz/api-client": "dev-master"
            },
            ...
        }

2. Run `composer install`.

3. If you haven't already, add the Composer autoload to your project's
   initialization file. (example)

        require 'vendor/autoload.php';

## Creating API Signatures ##
### GET Request ###
````
$client = new RealestateCoNz_Api_Client('PRIVATE_KEY', 'PUBLIC_KEY', 1);
$api_path = '/listings/';
$query_params = array('format' => 'full');
$api_signature = $client->createSignature($api_path, $query_params);
````

### POST Request ###
````
$client = new RealestateCoNz_Api_Client('PRIVATE_KEY', 'PUBLIC_KEY', 1);
$api_path = '/listings/100000000/agent-enquiry/';
$query_params = array();
$post_values = array('email' => 'example@example.com', 'phone' => '000000000', 'text' => 'test', 'name' => 'Test');
$api_signature = $client->createSignature($api_path, $query_params, $post_values);
````
Note: all post requests must be sent with the following request header:

Content-Type: application/x-www-form-urlencoded
