<?php
// PayPal configuration 

define('PAYPAL_ID', 'continuingedventures@gmail.com'); 
define('PAYPAL_SANDBOX', FALSE); //TRUE or FALSE 
 
define('PAYPAL_RETURN_URL', 'https://ceuservices.com/success.php');  
define('PAYPAL_CANCEL_URL', 'https://ceuservices.com/cancel.php'); 
define('PAYPAL_NOTIFY_URL', 'http://localhost/about/ipn'); 
define('PAYPAL_CURRENCY', 'USD'); 

define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'ceu'); 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == FALSE)?"https://www.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");





// define('PAYPAL_ID', 'sb-wbt7s18076716@business.example.com'); 
// define('PAYPAL_SANDBOX', FALSE); //TRUE or FALSE 
// define('PAYPAL_RETURN_URL', 'https://ceuservices.com/success.php');  
// define('PAYPAL_CANCEL_URL', 'https://ceuservices.com/cancel.php'); 
// define('PAYPAL_NOTIFY_URL', 'http://localhost/about/ipn'); 
// define('PAYPAL_CURRENCY', 'USD'); 
// // Database configuration 
// define('DB_HOST', 'localhost'); 
// define('DB_USERNAME', 'root'); 
// define('DB_PASSWORD', ''); 
// define('DB_NAME', 'ceu'); 
// // Change not required 
// define('PAYPAL_URL', (PAYPAL_SANDBOX == FALSE)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");

?>