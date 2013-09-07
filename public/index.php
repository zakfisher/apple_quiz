<?php
require_once('../system/config.php');

//$tpl->music = MusicController::getContent();

$tpl->page = 'Login';

$tpl->display('templates/header.tpl.php');
$tpl->display('templates/navigation.tpl.php');
$tpl->display('templates/login.tpl.php');
$tpl->display('templates/footer.tpl.php');
