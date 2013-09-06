<?php
class Date {
    function __construct() { }

    public function convert_date($date, $format) {
        $day = substr($date, 3, 2);
        $month = substr($date, 0, 2);
        $year = substr($date, 6, 4);
        $months = array(
            array('January', 'Jan'),
            array('February', 'Feb'),
            array('March', 'Mar'),
            array('April', 'Apr'),
            array('May', 'May'),
            array('June', 'Jun'),
            array('July', 'Jul'),
            array('August', 'Aug'),
            array('September', 'Sep'),
            array('October', 'Oct'),
            array('November', 'Nov'),
            array('December', 'Dec')
        );
        switch ($format) {
            case 'full':
                // February 10, 2013
                $return = $months[--$month][0] . ' ' . $day . ', ' . $year;
                break;
            case 'short':
                $return = $months[--$month][1] . ' ' . $day . ', ' . $year;
                break;
            default:
        }
        return $return;
    }

    public function convert_date_reverse($date, $format) {
        $months = array(
            array('January', 'Jan'),
            array('February', 'Feb'),
            array('March', 'Mar'),
            array('April', 'Apr'),
            array('May', 'May'),
            array('June', 'Jun'),
            array('July', 'Jul'),
            array('August', 'Aug'),
            array('September', 'Sep'),
            array('October', 'Oct'),
            array('November', 'Nov'),
            array('December', 'Dec')
        );
        switch ($format) {
            case 'full':
                $date = explode(" ", $date);
                $month = $date[0];
                foreach ($months as $i => $m) {
                    if ($m[0] == $month) {
                        $month = $i + 1;
                        if ($month < 10) $month = '0' . $month;
                        break;
                    }
                }
                $day = substr($date[1], 0, -1);
                $year = $date[2];
                // 03.22.2013
                $return = $month . '.' . $day . '.' . $year;
                break;
            default:
        }
        return $return;
    }

    public function convert_from_military($time) {
        if ($time > 12) {
            $time -= 12;
            $time .= 'pm';
        }
        else if ($time < 12) $time .= 'am';
        else $time .= 'pm';
        return $time;
    }
}