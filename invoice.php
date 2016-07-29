<?php
  /*
  *
  * PAYMENT PHP SAMPLE
  * =================================================================
  * The login sends client_id and client_secret to get `access_token`.
  * You need to provide the client_id and client_secret give to you
  * after account creation.
  * =================================================================
  */
  require "FloPay.php";

  $floPay = new FloPay("your_client_id","your_client_secret");
  $accessToken = $floPay->getAccessToken();

  /*
  * If `access_token` is received, add items.
  */
  if($accessToken){
    /* Add items */
    $items = $_POST['items'];
    foreach ($items as $item) {
      /* Parameters       item_name,    qty ,                 price   remark(optional) */
      $floPay->addItem($item["'name'"], $item["'quantity'"] ,  1.00 , "20% discount" );
    }

    /* You can add several items to the items list.
       Note that no calculation would be made on our side.
       Please make sure every amount sent to our server is accurate */

    /* Set totalAmount, currency and returnURl. */
    $floPay->setTotalAmount(3.00);
    $floPay->setCurrency("GHS");
    $floPay->setReturnUrl("http://www.market.com");

    /* You can add other optional parameters */
    $floPay->setOptionalParameters(array(
      "description"    => "", //  String - A brief description of the invoice.
      "store_name"     => "", //	String - Name of store / shop making the payment.
      "store_logo"	   => "", //	String - Logo of store / shop. This logo is shown on the checkout page.
      "store_tagline"  =>	"", //  String - Store tagline.
      "store_address"	 => "", //  String - An address of the store that would be used on the receipt.
      "store_phone"	   => "", //  String - Store telephone number.
      "billing_address" =>"", //	String - The billing address is the address associated with your credit card – it is used to verify your credit card information.
      "delivery_address" => "",// String - Address where package or service would be delivered
    ));

    /* Generate invoice */
    $invoice = $floPay->getInvoice($accessToken);

    if($invoice){
      $floPay->startPayment($invoice);
    }
  }
?>
