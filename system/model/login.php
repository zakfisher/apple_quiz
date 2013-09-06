<?php
class Admin_Model {

    function __construct() {}

    public function authenticate() {
        return 'yeeee';
    }

    public function test($filter) {
        $db = new DB();
        $results = $db->select_from($filter, 'contact_form');
        return $results;
    }
}