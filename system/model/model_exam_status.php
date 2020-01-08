<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_exam_status {
    private $db;
    private $table_name = "exam_status";

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
    }

    public function total_rows() {
        $this->db->go("SELECT * FROM " . $this->table_name);
        return $this->db->numRows();
    }

    public function get_results($where = array(), $page = 1, $show = 25, $order_val = 'ASC', $order_key = 'participant_id') {
        $query  = "SELECT e.participant_id, e.created, e.updated, e.created_by, e.updated_by, e.question_type_id, e.total_question, e.total_answered, e.total_correct, e.value, t.question_type";
        $query .= " FROM " . $this->table_name . " e ";
        $query .= " JOIN question_types t ON e.question_type_id = t.question_type_id ";

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
        $query  = "SELECT e.participant_id, e.created, e.updated, e.created_by, e.updated_by, e.question_type_id, e.total_question, e.total_answered, e.total_correct, e.value, t.question_type";
        $query .= " FROM " . $this->table_name . " e ";
        $query .= " JOIN question_types t ON e.question_type_id = t.question_type_id ";

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
        
		if (isset($where['participant_id'])) {
			$arr['e.participant_id'] = $where['participant_id'];
		}
        
		if (isset($where['question_type_id'])) {
			$arr['e.question_type_id'] = $where['question_type_id'];
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