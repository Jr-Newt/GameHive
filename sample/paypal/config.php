<?php 
/* 
 * PayPal and database configuration 
 */ 
  
// PayPal configuration 
define('PAYPAL_ID', 'sb-euo47g5987838@business.example.com'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
 
define('PAYPAL_RETURN_URL', 'http://localhost/GAME HIVE/Gamehive/sample/paypal/success.php'); 
define('PAYPAL_CANCEL_URL', 'http://localhost/GAME HIVE/Gamehive/sample/paypal/cancel.php'); 
define('PAYPAL_NOTIFY_URL', 'http://localhost/GAME HIVE/Gamehive/sample/paypal/ipn.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
 
// Database configuration 
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'paypal'); 
 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");