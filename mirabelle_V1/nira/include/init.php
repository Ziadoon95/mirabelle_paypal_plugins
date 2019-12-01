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
        /**
         * offline
         *        $clientId = getenv("CLIENT_ID") ?: "ARQoWoat5XCZbYmeufNJ7JwMKG01yUNA5-SYYN1iztvGWKOs39h9mWcHlr4S7Ob6F7Liq7NnZS93yli0";
         *  $clientSecret = getenv("CLIENT_SECRET") ?: "EGcAIv_ADQKiW1J5rNYKhX_EC_8x02mT4hjjdU1DZLuTsV4gemYqdmDg6A-eLnBG8B9vZ91c3nCpCbVe";
         * live
         * 
         */
        //$clientId = getenv("CLIENT_ID") ?: "Acelu128P8hZZhd7rW09keb0ha5hlVUVrLr3ZwC46rISG5nY2WVmolaeT_vbXcgaGGydLcL-hLAr-w_J";
        //$clientSecret = getenv("CLIENT_SECRET") ?: "ENrcHdusM2VrvcunJjV8Z2NyEF_tdf0ebrYQqmjxU63VuIZ0sORVqzyZSELIoQ8JgnteZqGMk5v0E-ay";
        $clientId = getenv("CLIENT_ID") ?: "ARQoWoat5XCZbYmeufNJ7JwMKG01yUNA5-SYYN1iztvGWKOs39h9mWcHlr4S7Ob6F7Liq7NnZS93yli0";
        $clientSecret = getenv("CLIENT_SECRET") ?: "EGcAIv_ADQKiW1J5rNYKhX_EC_8x02mT4hjjdU1DZLuTsV4gemYqdmDg6A-eLnBG8B9vZ91c3nCpCbVe"; 
        return new SandboxEnvironment($clientId, $clientSecret);
    }
    
}

?>