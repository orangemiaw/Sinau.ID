<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_config {
    private $db;
    private $table_name = "configs";

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
    }

    public function get_row($where = array()) {
        $query  = "SELECT created, updated, created_by, updated_by, faceai_server, faceai_login, faceai_login, faceai_password, paypal_sandbox_account, paypal_client_id, paypal_client_secret, paypal_live_payment, ovo_number";
        $query .= " FROM " . $this->table_name . " ";

	    if (count($where) > 0) {
            $queryWhere = $this->where($where);
            if($queryWhere) {
                $query .= $queryWhere;
            }
        }

        $query .= " LIMIT 1";
        
        $this->db->go($query);
        if($this->db->numRows()>0){
            return $this->db->fetchArray();
        }

        return false;
    }
}