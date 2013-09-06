<?php
class Import {
    function __construct() { }

    public function csv($file, $table) {
        $db = new DB();
        if (file_exists($file)) {
            $rows = explode("\n", file_get_contents($file));
            $columns = explode(',', $rows[0]);
            unset($rows[0]);
            foreach($rows as $row) {
                $record = array();
                $row = explode(',', $row);
                foreach ($row as $j => $cell) {
                    $record[strtolower($columns[$j])] = $cell;
                }
                $db->insert_into($table, $record);
            }
        }
    }
}