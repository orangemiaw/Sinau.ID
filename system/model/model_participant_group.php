<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_participant_group {
    private $db;
    private $table_name = "participant_group";

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
    }

    public function total_rows() {
        $this->db->go("SELECT * FROM " . $this->table_name);
        return $this->db->numRows();
    }

    public function get_results($where = array(), $page = 1, $show = 25, $order_val = 'ASC', $order_key = 'participant_group_name') {
        $query  = "SELECT participant_group_id, created, updated, created_by, updated_by, participant_group_name, participant_group_role, participant_group_price, participant_group_status";
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
        $query  = "SELECT participant_group_id, created, updated, created_by, updated_by, participant_group_name, participant_group_role, participant_group_price, participant_group_status";
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
        
		if (isset($where['participant_group_id'])) {
			$arr['participant_group_id'] = $where['participant_group_id'];
		}

		if (isset($where['participant_group_name'])) {
			$arr['LOWER(participant_group_name)'] = strtolower($where['participant_group_name']);
		}

		if (isset($where['participant_group_status'])) {
			$arr['participant_group_status'] = $where['participant_group_status'];
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