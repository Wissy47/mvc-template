<?php

class Users
{
    // All method about users

    private $table = "users";

    public function get_all_user()
    {
        $DB = Database::getInstance();
		$query = "SELECT * FROM ".$this->table;
		$arr = [];
		$row = $DB->db_read($query, $arr);
        return $row;
    }
}
