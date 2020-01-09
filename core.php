  
<?php
session_start();
set_time_limit(0);
error_reporting(0);
if(!defined('SINAUID')) {
	define('SINAUID', true);
}

include "system/core/class_db.php";
include "system/core/class_curl.php";
include "system/core/class_notice.php";
include "system/core/class_upload.php";
include "system/core/class_pagination.php";
include "system/core/class_security.php";
include "system/constrain.php";
include "system/helper.php";
require "vendor/autoload.php";

/** Load configuration file */
$conf = parse_ini_file( dirname( __FILE__ ) . '/.config' );

/** define global variable */
define('ROOT', dirname(__FILE__)."/");
define('HTTP', $conf['site_path']);
define('TITLE', $conf['site_title']);
define('DESC', $conf['site_description']);
define('JARGON', $conf['site_jargon']);
define('KEYWORD', $conf['site_keyword']);
define('RECAPTCHA_STATUS', $conf['activate_recaptcha']);
define('RECAPTCHA_SITE_KEY', $conf['google_site_key']);
define('RECAPTCHA_SECRET_KEY', $conf['google_secret_key']);

/** Load all class */
$db			= new db($conf['db_host'], $conf['db_name'], $conf['db_username'], $conf['db_password']);
$notice 	= new notice();
$upload 	= new upload();
$security 	= new security();

/** Security configuration */
$security->secureMe($conf["activate_firewall"]);

/** Load merchant */
// include "system/merchant/paypal.php";

?>