<?php 

require_once "app/vendor/autoload.php";
/*set your website title*/

define('WEBSITE_TITLE', ""); // Enter website name

/*root and asset paths*/

$path = str_replace("\\", "/",$_SERVER['REQUEST_SCHEME']."://" . $_SERVER['SERVER_NAME'] . __DIR__  . "/");
$path = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);

define('ROOT', str_replace("/app/core", "", $path));
define('ASSETS', str_replace("app/core", "public/assets", $path));

// Uncomment the lines below to set database variable using "vlucas/phpdotenv" lib

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();

/*set database variables*/

// define('DB_TYPE',$_ENV['DB_TYPE']);
// define('DB_NAME',$_ENV['DB_NAME']);
// define('DB_USER',$_ENV['DB_USER']);
// define('DB_PASS',$_ENV['DB_PASS']);
// define('DB_HOST',$_ENV['DB_HOST']);


/**
 * Set stripe API key if you have one
 * 
 * 
 * STRIPE API KEY
 * Set the stripe api key to use 
 * $_ENV['STRIPE_TEST_API_SECRET_KEY'] for Development and testing while 
 * $_ENV['STRIPE_LIVE_API_SECRET_KEY'] for live/production
 */



// define('STRIPE_API_KEY', $_ENV['STRIPE_TEST_API_SECRET_KEY']); 


/*set to true to allow error reporting
set to false when you upload online to stop error reporting*/
define('DEBUG',true);

if(DEBUG)
{
	ini_set("display_errors",1);
}else{
	ini_set("display_errors",0);
}