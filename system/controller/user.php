<?php
class UserController {

    function __construct() {}

    public function login($params) {
        $model = new UserModel();
        if (isset($params['username']) && isset($params['password'])) {
            return $model->authenticate($params);
        }
        if (!isset($params['username']) && !isset($params['password'])) {
            return array('error' => 'You must provide a username and password to login.');
        }
        if (!isset($params['username'])) {
            return array('error' => 'You must provide a username to login.');
        }
        if (!isset($params['password'])) {
            return array('error' => 'You must provide a password to login.');
        }
    }
}