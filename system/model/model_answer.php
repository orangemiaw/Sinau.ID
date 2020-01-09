<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_answer {
    private $db;
    private $table_name = "answers";

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
    }

    public function total_rows($where = array()) {
        $query  = "SELECT a.question_id, a.created, a.updated, a.created_by, a.updated_by, a.answer_id, a.answer_text, a.answer_image, a.status, q.question_text";
        $query .= " FROM " . $this->table_name . " a ";
        $query .= " JOIN questions q ON a.question_id = q.question_id ";
        
	    if (count($where) > 0) {
            $queryWhere = $this->where($where);
            if($queryWhere) {
                $query .= $queryWhere;
            }
        }

        $this->db->go($query);
        return $this->db->numRows();
    }

    public function get_results($where = array(), $page = 1, $show = 25, $order_val = 'ASC', $order_key = 'a.question_id') {
        $query  = "SELECT a.question_id, a.created, a.updated, a.created_by, a.updated_by, a.answer_id, a.answer_text, a.answer_image, a.status, q.question_text";
        $query .= " FROM " . $this->table_name . " a ";
        $query .= " JOIN questions q ON a.question_id = q.question_id ";

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
        $query  = "SELECT a.question_id, a.created, a.updated, a.created_by, a.updated_by, a.answer_id, a.answer_text, a.answer_image, a.status, q.question_text";
        $query .= " FROM " . $this->table_name . " a ";
        $query .= " JOIN questions q ON a.question_id = q.question_id ";

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
			$arr['a.question_id'] = $where['question_id'];
		}
        
		if (isset($where['answer_id'])) {
			$arr['a.answer_id'] = $where['answer_id'];
		}

		if (isset($where['answer_text'])) {
			$arr['LOWER(a.answer_text)'] = strtolower($where['answer_text']);
		}

		if (isset($where['status'])) {
			$arr['a.status'] = $where['status'];
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