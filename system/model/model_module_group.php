<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_module_group {
    private $db;
    private $table_name = "module_group";

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
    }

    public function total_rows($where = array()) {
        $query  = "SELECT module_group_id, created, updated, created_by, updated_by, module_group_name, module_group_status";
        $query .= " FROM " . $this->table_name . " ";
        
	    if (count($where) > 0) {
            $queryWhere = $this->where($where);
            if($queryWhere) {
                $query .= $queryWhere;
            }
        }

        $this->db->go($query);
        return $this->db->numRows();
    }

    public function get_results($where = array(), $page = 1, $show = 25, $order_val = 'ASC', $order_key = 'module_group_name') {
        $query  = "SELECT module_group_id, created, updated, created_by, updated_by, module_group_name, module_group_status";
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
        $query  = "SELECT module_group_id, created, updated, created_by, updated_by, module_group_name, module_group_status";
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
        
		if (isset($where['module_group_id'])) {
			$arr['module_group_id'] = $where['module_group_id'];
		}

		if (isset($where['module_group_name'])) {
			$arr['LOWER(module_group_name)'] = strtolower($where['module_group_name']);
		}

		if (isset($where['module_group_status'])) {
			$arr['module_group_status'] = $where['module_group_status'];
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