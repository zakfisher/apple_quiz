<?php
class MusicController {

    function __construct() {}

    public function getContent() {
        $dir = "/home1/worldoh4/public_html/_WOA/music/";
        $full_dir = "../../_WOA/music/";
        $latest = '';
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                $count = $totalcount = 0;
                while (($file = readdir($dh)) !== false) {
                    $subdir = $dir . $file;
                    if (is_dir($subdir)) {
                        if ($sdh = opendir($subdir)) {
                            $folder = explode("/", $subdir);
                            $folder = $folder[6] . "/";
                            while (($subfile = readdir($sdh)) !== false) {
                                if ($subfile != '.' && $subfile != '..' && $subfile != '_notes' && $file != '.' && $file != '..') {
                                    $totalcount++;
                                    $count++;
                                    $name = rawurlencode($subfile);
                                    $name = str_replace('%D0', '%20', $name);
                                    $name = str_replace('%D5', '%20', $name);
                                    $name = str_replace('%91', '%20', $name);
                                    $name = rawurldecode($name);
                                    $mp3 = array('name' => $name, 'url' => 'http://www.worldofanarchy.com/_WOA/music/' . $folder . rawurlencode($subfile), 'folder' => $folder);
                                    $mp3s[$folder][] = $mp3;
                                    $mp3s['all'][] = $mp3;

                                    // Get Latest
                                    $date = explode('.', $folder);
                                    $year = $date[2];
                                    $year = str_replace('/', '', $year);
                                    $month = $date[0];
                                    $day = $date[1];
                                    if (!is_numeric($year) && !is_numeric($month) && !is_numeric($day)) continue;
                                    if ($latest == '') {
                                        $latest = array('year' => $year, 'month' => $month, 'day' => $day);
                                        continue;
                                    }
                                    if ($year < $latest['year']) continue;
                                    if ($year > $latest['year']) {
                                        $latest = array('year' => $year, 'month' => $month, 'day' => $day);
                                        continue;
                                    }
                                    if ($year == $latest['year']) {
                                        if ($month < $latest['month']) continue;
                                        if ($month > $latest['month']) {
                                            $latest = array('year' => $year, 'month' => $month, 'day' => $day);
                                            continue;
                                        }
                                        if ($month == $latest['month']) {
                                            if ($day < $latest['day']) continue;
                                            if ($day > $latest['day']) {
                                                $latest = array('year' => $year, 'month' => $month, 'day' => $day);
                                                continue;
                                            }
                                        }
                                    }
                                }
                            }
                            closedir($sdh);
                        }
                    }
                }
                closedir($dh);
            }
        }
        ksort($mp3s);
        $latestDate = $latest['month'] . '.' . $latest['day'] . '.' . $latest['year'];
        $latest = $latestDate . '/';
        return array('mp3s' => $mp3s, 'latestDate' => $latestDate, 'latest' => $latest);
    }

}