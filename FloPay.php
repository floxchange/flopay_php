<?php
/**
 * FloPay php class for checkout
 * @author nFortics Ghana
 * @copyright 2016
 */
class FloPay
{
  private $clientId;
  private $clientSecret;
  private $items = array();
  private $totalAmount = 0.00;
  private $returnUrl = "";
  private $currency = "";
  private $optionalParameters = array(
    "description"    => "", //  String - A brief description of the invoice.
    "store_name"     => "", //	String - Name of store / shop making the payment.
    "store_logo"	   => "", //	String - Logo of store / shop. This logo is shown on the checkout page.
    "store_tagline"  =>	"", //  String - Store tagline.
    "store_address"	 => "", //  String - An address of the store that would be used on the receipt.
    "store_phone"	   => "", //  String - Store telephone number.
    "billing_address" =>"", //	String - The billing address is the address associated with your credit card – it is used to verify your credit card information.
    "delivery_address" => "",// String - Address where package or service would be delivered
  );

  function __construct($clientId, $clientSecret){
    $this->clientId = $clientId;
    $this->clientSecret = $clientSecret;
  }

  /**
  * @uses to create an access token
  * @param null
  * @return string access_token
  */
  function getAccessToken(){
    $requestBody = array("client_id" => $this->clientId,
                          "client_secret" => $this->clientSecret,
                          "grant_type" => "client_credentials");

    $responseData = $this->postRequest($requestBody,'login.json');

    // Save access token for next transaction
    return isset($responseData["access_token"]) ? $responseData["access_token"] : false;
  }


  /**
  * @uses Used to add a new item to the invoice
  * @param name String - Name of item
  * @param price Double - Price of item
  * @param qty Integer - Item quantity ~ (qty > 0)
  * @param remarks String (optional) - Extra description of item
  * @return boolean
  */
  public function addItem($name = "Item",$qty = 1, $price = 0.0, $remark = ""){
    $items = array("name" => $name,
                   "qty" => $qty,
                   "price" => $price,
                   "remark" => $remark);

    return array_push($this->items, $items);
  }

  /**
  * @uses The function sends items to the server to generate an invoice
  * @param accessToken string
  * @return invoiceUid string | boolean
  */
  public function getInvoice($access_token = ""){
    $requestBody = array(
                          'items' => $this->items,
                          'total' => $this->totalAmount,
                          'return_url' => $this->returnUrl,
                          'currency' => $this->currency
                        );

    $requestBody = array_merge($requestBody, $this->optionalParameters);

    $responseData = $this->postRequest($requestBody,'invoice.json?access_token='.$access_token);

    return isset($responseData["response"]["invoice_uid"]) ? $responseData["response"]["invoice_uid"] : false;
  }

  /**
  * @uses set total amount to be paid by customer
  * @param double totalAmount
  * @return null
  */
  public function setTotalAmount($totalAmount = 0){
    $this->totalAmount = $totalAmount;
  }

  /**
  * @uses set return url to redirect customer
  * @param string url
  * @return null
  */
  public function setReturnUrl($returnUrl = ""){
    $this->returnUrl = $returnUrl;
  }

  /**
  * @uses set currency
  * @param string currency
  * @return null
  */
  public function setCurrency($currency = ""){
    $this->currency = $currency;
  }

  /**
  * @uses to set optional parameters
  * @param array
  * @return null
  */
  public function setOptionalParameters($options){
    $this->optionalParameters = $options;
  }

  /**
  * @uses redirects user to a new window to initiate payment
  * @param invoice uid
  * @return null
  */
  public function startPayment($invoice){
    echo '
     <script>
      var child = window.open("https://www.floxchange.com/checkout?invoice='.$invoice.'","FloPay", "location=no,menubar=no,status=no,toolbar=no");
      var timer = setInterval(checkChild, 1000);

      function checkChild() {
          if (child.closed) {
              history.back();
              clearInterval(timer);
          }
      }
     </script>';

  }

  /**
  * @uses gives base url
  * @param null
  * @return string
  */
  private function getUrl($uri){
    return 'https://api.floxchange.com/api/v1/'.$uri;
  }

  /**
  * @uses function for performing Curl Post requests
  * @param requestBody array
  * @param uri string
  * @return responseBody json
  */
  private function postRequest($requestBody,$uri){
    // Setup cURL
    $ch = curl_init($this->getUrl($uri));

    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($requestBody)
    ));

    // Send the request
    $response = curl_exec($ch);

    // Check for errors
    if($response === FALSE){
        die(curl_error($ch));
    }

    // Decode the response
    return json_decode($response, TRUE);
  }
}
