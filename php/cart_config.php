<?php
error_reporting( error_reporting() & ~E_NOTICE );
/*
 * PayPal and database configuration
 */

// PayPal configuration
define('PAYPAL_ID', 'sb-0mkh85896400@business.example.com');
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE

define('PAYPAL_RETURN_URL', 'http://localhost/gamehive/php/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/gamehive/php/cancel.php');
define('PAYPAL_NOTIFY_URL', 'http://localhost/gamehive/php/ipn.php');
define('PAYPAL_CURRENCY', 'USD');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'gamehive');

// Change not required
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
