<?php

namespace Sample;
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
require __DIR__ . '/vendor/autoload.php';

if(isset($_POST['orderID']))
{
  $orderId =$_POST['orderID'];
  
  //1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.


  // After Step 
  //à activer aprés
  require __DIR__ . '/init.php';
  //send donation details to client 
  $client = PayPalClient::client();
  $response = $client->execute(new OrdersGetRequest($_POST['orderID']));

  
 // echo json_encode($returnArray);
 $montant = $response->result->purchase_units[0]->amount->value;
 $firstname = $response->result->payer->name->given_name;
 $name = $response->result->payer->name->surname;
 $ad1 =$response->result->purchase_units[0]->shipping->address->address_line_1;
 $email = $response->result->payer->email_address;
 $ad2 = $response->result->purchase_units[0]->shipping->address->address_line_2;
 $codepostal = $response->result->purchase_units[0]->shipping->address->postal_code;
 $ville = $response->result->purchase_units[0]->shipping->address->admin_area_2;

 $donation_status =$response->result->status;
//numero de telephone par defaut
 if($gsm=="460000000")
  {
    $gsm ="   -";
  }

 echo"<pre>";
 echo $gsm;
 echo $montant."<br>";
 echo $ville."<br>";
 echo $orderId."<br>";
 echo $name."<br>";
 echo $firstname."<br>";
 echo $ad1."<br>";
 echo $ad2."<br>";
 echo $codepostal."<br>";
 echo $donation_status;
 echo"</pre>";

     global $wpdb;
  
    $table_name = $wpdb->prefix . "donneur";
    $res =$wpdb->insert( 
      $table_name, 
      array( 
        'fname' => "$firstname", 
        'lname' => "$name", 
        'donation_id' => $orderId, 
        'email' => "$email", 
        'ad1' => "$ad1", 
        'codepostal' => $codepostal ,
        'city' => "$ville" ,
        'montant' => $montant,
        'gsm' => $gsm
      ), 
      array( 
        '%s', 
        '%s', 
        '%s', 
        '%s', 
        '%s', 
        '%d',
        '%s',
        '%d',
        '%s'
      ) 
    );
    //var_dump($res);
 

  class GetOrder
  {

    public static function getOrder($orderId)
    {

      // 3. Call PayPal to get the transaction details
      $client = PayPalClient::client();
      $response = $client->execute(new OrdersGetRequest($orderId));

    }
  }

  if (!count(debug_backtrace()))
  {

  GetOrder::getOrder($orderId , true);
    die();
  }else{
    //echo "error" ;
    die();
  }


}/*else{
   header("Location: ./index.php");
  die();
}
 */
