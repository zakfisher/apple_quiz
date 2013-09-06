<?php
class Email {

    function __construct() {}

    public function send($to, $from, $subject, $msg) {
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ' . $from . ' <noreply@sh.com>' . "\r\n";

        mail($to, $subject, $msg, $headers) or print 'fail';
    }

}