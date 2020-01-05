<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_question {
    private $db;
    private $table_name = "questions";

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
    }

    public function total_rows() {
        $this->db->go("SELECT * FROM " . $this->table_name);
        return $this->db->numRows();
    }

    public function get_results($where = array(), $page = 1, $show = 25, $order_val = 'ASC', $order_key = 'q.question_id') {
        $query  = "SELECT q.question_id, q.created, q.updated, q.created_by, q.updated_by, q.question_type_id, q.question_text, q.question_image, t.question_type, t.question_group_id, t.total, g.question_group_name";
        $query .= " FROM " . $this->table_name . " q ";
        $query .= " JOIN question_types t ON q.question_type_id = t.question_type_id ";
        $query .= " JOIN question_group g ON t.question_group_id = g.question_group_id ";

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
        $query  = "SELECT q.question_id, q.created, q.updated, q.created_by, q.updated_by, q.question_type_id, q.question_text, q.question_image, t.question_type, t.question_group_id, t.total, g.question_group_name";
        $query .= " FROM " . $this->table_name . " q ";
        $query .= " JOIN question_types t ON q.question_type_id = t.question_type_id ";
        $query .= " JOIN question_group g ON t.question_group_id = g.question_group_id ";

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
        
		if (isset($where['question_id'])) {
			$arr['q.question_id'] = $where['question_id'];
		}

		if (isset($where['question_type'])) {
			$arr['LOWER(t.question_type)'] = strtolower($where['question_type']);
		}

		if (isset($where['question_text'])) {
			$arr['LOWER(q.question_text)'] = strtolower($where['question_text']);
		}

		if (isset($where['question_status'])) {
			$arr['q.question_status'] = $where['question_status'];
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