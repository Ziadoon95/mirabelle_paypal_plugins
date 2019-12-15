<?php
namespace Sample;
//require "vendor/autoload.php";

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');




class PayPalClient
{
    
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use LiveEnvironment.
     */
    public static function environment()
    {    
        $clientId = getenv("CLIENT_ID") ?: "AQv7X0Z2ePVL2r4QWbrWbzdg3Brgp5TatF6utUEMe-usVCtnlwfFKCrQIGXjNdSFSIS0VG7lUIPsbeoP";
        $clientSecret = getenv("CLIENT_SECRET") ?: "EHlldnYgV-cvKK1oyTwkaACY-dSXPDrVGocF-AxddrS6HKM6PXmhlZop64I0ubI37sfXg4XA_hD-tzhX"; 
        return new SandboxEnvironment($clientId, $clientSecret);
    }
    
}

?>