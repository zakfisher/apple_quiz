<?php
class UserModel {

    function __construct() {}

    public function authenticate($params) {
        $database = new db();
        $response =  $database->select_from_where_and(array('user_id'), 'users', 'username', $params['username'], 'password', md5($params['password']));
        if (empty($response)) {
            $response = array('error' => 'Username / password not found.');
        }
        else {
            $response['success'] = 'Successfully logged in!';
        }
        return $response;
    }

    public function test($filter) {
        $db = new DB();
        $results = $db->select_from($filter, 'contact_form');
        return $results;
    }
}