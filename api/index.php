<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/system/config.php');

$controllerMap = array(
    'music' => 'MusicController'
);

$class = $controllerMap[$_GET['c']];
$method = $_GET['m'];

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