<?php
if(isset($_GET['montant'] ,$_GET['firstName'],$_GET['lastName'],
$_GET['email']))
{
  $montant = $_GET['montant'];
  $firstName = $_GET['firstName'];
  $lastName = $_GET['lastName'];
  $email = $_GET['email'];
  
}else{
  echo"FILL UP THE PARAMS";
  die();
}
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api-key
$config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

// Uncomment below line to configure authorization using: partner-key
// $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', 'YOUR_API_KEY');

$apiInstance = new SendinBlue\Client\Api\SMTPApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail(); // \SendinBlue\Client\Model\SendSmtpEmail | Values to send a transactional email
$sendSmtpEmail['to'] = array(array(
    'email'=> $email, // à qui ?
     'name'=>$firstName, // à remplacer par le nom
    ));
$sendSmtpEmail['templateId'] = 2; //formulaire template à modifier 
$sendSmtpEmail['params'] = array(
 'name'=>'John',
 'surname'=>'Doe',
 'orderID'=>88,
 'nom'=>$lastName,
 'prenom'=>$firstName,
 'montant'=>$montant,
 "DATE" => "12/06/2019");
$sendSmtpEmail['headers'] = array('X-Mailin-custom'=>'custom_header_1:custom_value_1|custom_header_2:custom_value_2');

try {
    $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SMTPApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
}
?>