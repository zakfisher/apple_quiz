<?php
class Browser {

    function __construct() {}

    public function get_browser_info() {

        if (isset($_SERVER["HTTP_USER_AGENT"]) OR ($_SERVER["HTTP_USER_AGENT"] != "")) {
            $visitor_user_agent = $_SERVER["HTTP_USER_AGENT"];
        } else {
            $visitor_user_agent = "Unknown";
        }

        $bname = 'Unknown';
        $version = "0.0.0";

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/(.+)MSIE(.+)/', $visitor_user_agent) && !preg_match('/(.+)Opera(.+)/', $visitor_user_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/(.+)Firefox(.+)/', $visitor_user_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/(.+)Chrome(.+)/', $visitor_user_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/(.+)Safari(.+)/', $visitor_user_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera(.+)/', $visitor_user_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/(.+)Netscape(.+)/', $visitor_user_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        } elseif (preg_match('/(.+)Seamonkey(.+)/', $visitor_user_agent)) {
            $bname = 'Seamonkey';
            $ub = "Seamonkey";
        } elseif (preg_match('/(.+)Konqueror(.+)/', $visitor_user_agent)) {
            $bname = 'Konqueror';
            $ub = "Konqueror";
        } elseif (preg_match('/(.+)Navigator(.+)/', $visitor_user_agent)) {
            $bname = 'Navigator';
            $ub = "Navigator";
        } elseif (preg_match('/(.+)Mosaic(.+)/', $visitor_user_agent)) {
            $bname = 'Mosaic';
            $ub = "Mosaic";
        } elseif (preg_match('/(.+)Lynx(.+)/', $visitor_user_agent)) {
            $bname = 'Lynx';
            $ub = "Lynx";
        } elseif (preg_match('/(.+)Amaya(.+)/', $visitor_user_agent)) {
            $bname = 'Amaya';
            $ub = "Amaya";
        } elseif (preg_match('/(.+)Omniweb(.+)/', $visitor_user_agent)) {
            $bname = 'Omniweb';
            $ub = "Omniweb";
        } elseif (preg_match('/(.+)Avant(.+)/', $visitor_user_agent)) {
            $bname = 'Avant';
            $ub = "Avant";
        } elseif (preg_match('/(.+)Camino(.+)/', $visitor_user_agent)) {
            $bname = 'Camino';
            $ub = "Camino";
        } elseif (preg_match('/(.+)Flock(.+)/', $visitor_user_agent)) {
            $bname = 'Flock';
            $ub = "Flock";
        } elseif (preg_match('/(.+)AOL(.+)/', $visitor_user_agent)) {
            $bname = 'AOL';
            $ub = "AOL";
        } elseif (preg_match('/(.+)AIR(.+)/', $visitor_user_agent)) {
            $bname = 'AIR';
            $ub = "AIR";
        } elseif (preg_match('/(.+)Fluid(.+)/', $visitor_user_agent)) {
            $bname = 'Fluid';
            $ub = "Fluid";
        } else {
            $bname = 'Unknown';
            $ub = "Unknown";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $visitor_user_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($visitor_user_agent, "Version") < strripos($visitor_user_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        $platform = preg_match('/(.+)Macintosh(.+)/', $visitor_user_agent) ? 'mac' : '';
        $platform = preg_match('/(.+)Windows(.+)/', $visitor_user_agent) ? 'windows' : $platform;

        return array(
            'userAgent' => $visitor_user_agent,
            'full_name' => $bname,
            'short_name' => strtolower($ub),
            'version' => $version,
            'pattern' => $pattern,
            'platform' => $platform
        );
    }
}
