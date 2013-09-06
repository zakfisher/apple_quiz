<?php
session_start();

/** Set Environment */
$uri = explode(".", $_SERVER['HTTP_HOST']);
define(ENV, ($uri[0] == 'dev') ? 'development' : 'production');
define(ROOT, $_SERVER['DOCUMENT_ROOT'] . '/');

/** Connect to Database */
require_once(ROOT . 'system/connect.php');

/** Libraries **/
require_once(ROOT . 'system/libraries/Savant3-3.0.1/Savant3.php');

/** Utilities **/
require_once(ROOT . 'system/utilities/browser.php');
require_once(ROOT . 'system/utilities/date.php');
require_once(ROOT . 'system/utilities/db.php');
require_once(ROOT . 'system/utilities/email.php');
require_once(ROOT . 'system/utilities/import.php');
require_once(ROOT . 'system/utilities/json.php');
require_once(ROOT . 'system/utilities/text.php');

/** Models **/
require_once(ROOT . 'system/model/user.php');

/** Controllers **/
require_once(ROOT . 'system/controller/user.php');

/** Launch **/
$tpl = new Savant3();

// Browser Settings
$browser = new Browser();
$tpl->browser = $browser->get_browser_info();

// Check for IE 8 and below
if ($tpl->browser['short_name'] == 'msie' AND $tpl->browser['version'] <= 8) {
    echo "Please upgrade your browser.";
    exit;
}