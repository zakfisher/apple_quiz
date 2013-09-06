<?php
class JSON {
    function __construct() { }

    function print_json($data) {
        header('Content-type: application/json');
        print json_encode($data);
    }

    function print_array($array) {
        print "<pre>";
        print_r($array);
        print "</pre>";
    }
}