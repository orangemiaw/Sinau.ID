<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_payment {
    private $db;
    private $table_name = "payments";

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
    }

    public function total_rows() {
        $this->db->go("SELECT * FROM " . $this->table_name);
        return $this->db->numRows();
    }

    public function get_results($where = array(), $page = 1, $show = 25, $order_val = 'DESC', $order_key = 'payment_id') {
        $query  = "SELECT payment_id, created, updated, created_by, updated_by, participant_id, transaction_id, invoice_id, payment_method, payment_amount, payment_status";
        $query .= " FROM " . $this->table_name . " ";

	    if (count($where) > 0) {
            $queryWhere = $this->where($where);
            if($queryWhere) {
                $query .= $queryWhere;
            }
        }

        $query .= " ORDER BY $order_key $order_val ";
		if ($page != 'all') {
			$offset = ($page - 1) * $show;
            $query .= " LIMIT $show OFFSET $offset";
		}
        
        $this->db->go($query);
        if($this->db->numRows()>0){
            while($row = $this->db->fetchArray()) {
                $results[] = $row;
            }

            return $results;
        }

        return false;
    }

    public function get_row($where = array()) {
        $query  = "SELECT payment_id, created, updated, created_by, updated_by, participant_id, transaction_id, invoice_id, payment_method, payment_amount, payment_status";
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

    private function where($where) {
        $arr = array();
        
		if (isset($where['payment_id'])) {
			$arr['payment_id'] = $where['payment_id'];
		}

		if (isset($where['payment_method'])) {
			$arr['LOWER(payment_method)'] = strtolower($where['payment_method']);
		}

		if (isset($where['payment_status'])) {
			$arr['LOWER(payment_status)'] = strtolower($where['payment_status']);
		}

        if (count($arr) > 0) {
            $query = " WHERE ";
            $i = 0;
            foreach($arr as $key => $value) {
                $query .= $key . " = '" . $this->db->q($value) . "'";
                if ($i < count($arr) - 1) {
                    $query.= " AND ";
                }
                $i++;
            }

            return $query;
        }

        return false;
    }
}