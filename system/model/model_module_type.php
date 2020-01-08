<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_module_type {
    private $db;
    private $table_name = "module_types";

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
    }

    public function total_rows($where = array()) {
        $query  = "SELECT q.module_type_id, q.created, q.updated, q.created_by, q.updated_by, q.module_type, q.total, q.module_group_id, g.module_group_name";
        $query .= " FROM " . $this->table_name . " q ";
        $query .= " JOIN module_group g ON q.module_group_id = g.module_group_id ";
        
	    if (count($where) > 0) {
            $queryWhere = $this->where($where);
            if($queryWhere) {
                $query .= $queryWhere;
            }
        }

        $this->db->go($query);
        return $this->db->numRows();
    }

    public function get_results($where = array(), $page = 1, $show = 25, $order_val = 'ASC', $order_key = 'q.module_type_id') {
        $query  = "SELECT q.module_type_id, q.created, q.updated, q.created_by, q.updated_by, q.module_type, q.total, q.module_group_id, g.module_group_name";
        $query .= " FROM " . $this->table_name . " q ";
        $query .= " JOIN module_group g ON q.module_group_id = g.module_group_id ";

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
        $query  = "SELECT q.module_type_id, q.created, q.updated, q.created_by, q.updated_by, q.module_type, q.total, q.module_group_id, g.module_group_name";
        $query .= " FROM " . $this->table_name . " q ";
        $query .= " JOIN module_group g ON q.module_group_id = g.module_group_id ";

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
        
		if (isset($where['module_type_id'])) {
			$arr['q.module_type_id'] = $where['module_type_id'];
		}

		if (isset($where['module_type'])) {
			$arr['LOWER(q.module_type)'] = strtolower($where['module_type']);
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