<?php

$chemin= realpath(dirname(__FILE__) . '/../..');
//echo join(DIRECTORY_SEPARATOR, [$chemin, 'vendor\autoload.php']);
require_once join(DIRECTORY_SEPARATOR, [$chemin, 'vendor\autoload.php']);
require_once 'PayPalClient.php';

//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;


class RecupererPaiementPaypal
{

    protected $orderId;

    // 2. Set up your server to receive a call from the client
    /**
     *You can use this function to retrieve an order by passing order ID as an argument.
     *
     * @param string orderId
     *
     * @return string
     */
    public static function getOrder($orderId)
    {
        // 3. Call PayPal to get the transaction details
        $client = PayPalClient::client();
        $response = $client->execute(new OrdersGetRequest($orderId));
        //détails de la transaction
        $orderID= $response->result->id;
        //$email= $response->result->payer->email_address;
        $reference_id= $response->result->purchase_units[0]->reference_id;
        $name= $response->result->purchase_units[0]->shipping->name->full_name;
        $address_line_1= $response->result->purchase_units[0]->shipping->address->address_line_1;
        //$admin_area_2= $response->result->purchase_units[0]->shipping->address->admin_area_2;
        $postal_code= $response->result->purchase_units[0]->shipping->address->postal_code;
        $country_code= $response->result->purchase_units[0]->shipping->address->country_code;
        $montantTotal= $response->result->purchase_units[0]->payments->captures[0]->amount->value;
        $currency= $response->result->purchase_units[0]->payments->captures[0]->amount->currency_code;
        $fullAddress= $address_line_1.'-'.$postal_code.'-'.$country_code;

        $valeurRetrour= $orderID.'|'.$reference_id.'|'.'|'.$name.'|'.$fullAddress.'|'.$montantTotal.'_'.$currency;
        //echo $valeurRetrour;
        return $valeurRetrour;
        /**
         *Enable the following line to print complete response as JSON.
         */
        //print json_encode($response->result);
        /*print "Status Code: {$response->statusCode}\n";
        print "Status: {$response->result->status}\n";
        print "Order ID: {$response->result->id}\n";
        print "Intent: {$response->result->intent}\n";
        print "Links:\n";
        foreach($response->result->links as $link)
        {
            print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
        }
        // 4. Save the transaction in your database. Implement logic to save transaction to your database for future reference.
        print "Gross Amount: {$response->result->purchase_units[0]->amount->currency_code} {$response->result->purchase_units[0]->amount->value}\n";

        // To print the whole response body, uncomment the following line
        // echo json_encode($response->result, JSON_PRETTY_PRINT);*/
    }
}

/**
 *This driver function invokes the getOrder function to retrieve
 *sample order details.
 *
 *To get the correct order ID, this sample uses createOrder to create an order
 *and then uses the newly-created order ID with GetOrder.
 */
if (!count(debug_backtrace()))
{
    RecupererPaiementPaypal::getOrder($_SESSION['orderID'], true);
}
?>