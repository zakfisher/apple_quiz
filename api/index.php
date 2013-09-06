<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/system/config.php');

//print md5('password');

$API = array(
    'user' => array(
        'login' => array('controller' => 'UserController', 'method' => 'login')
    )
);

$class = $API[$_GET['c']][$_GET['m']]['controller'];
$method = $API[$_GET['c']][$_GET['m']]['method'];

$params = isset($_POST) ? array($_POST) : array();

if (!empty($_GET['p'])) {
    $params = $_GET['p'];
    $params = explode(',', $params);
    $params = array($params);
}

if (method_exists($class, $method)) {
    $c = new $class();
    $json = call_user_func_array(array($class, $method), $params);
    header('Content-type: application/json');
    print json_encode($json);
    exit;
}