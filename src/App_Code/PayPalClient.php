<?php

namespace Sample;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
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
        $clientId = getenv("CLIENT_ID") ?: "AfBvEdEMvEHTu070ijj7MN3X5Yqfuxs3ANeNW_C2ERfa9zPIvhlLtOW1HBpclRHvrqFjsY64yI-15hQL";
        $clientSecret = getenv("CLIENT_SECRET") ?: "EEUZeBVxUsBJwpSwFFBCzZywK66upkk0hNeEhnrF7c_QFwJMuLaHrLRiH5kLKcuytOp53fVlnQIbzaaE";
        return new SandboxEnvironment($clientId, $clientSecret);
    }
}