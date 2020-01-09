<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_change_log {
    private $db;
    private $table_name = "change_logs";

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
    }

    public function total_rows($where = array()) {
        $query  = "SELECT log_id, created, created_by, controller, action, querystring, post, url, ip, current_data, new_data, db_query, browser, method";
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

    public function get_results($where = array(), $page = 1, $show = 25, $order_val = 'DESC', $order_key = 'log_id') {
        $query  = "SELECT log_id, created, created_by, controller, action, querystring, post, url, ip, current_data, new_data, db_query, browser, method";
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
        $query  = "SELECT log_id, created, created_by, controller, action, querystring, post, url, ip, current_data, new_data, db_query, browser, method";
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

		if (isset($where['url'])) {
			$arr['url'] = $where['url'];
		}
        
		if (isset($where['url_like'])) {
			$arr['url LIKE'] = $where['url_like'];
		}

		if (isset($where['created_by'])) {
			$arr['created_by'] = $where['created_by'];
		}

		if (isset($where['date_form'])) {
			$arr['created >= '] = $where['date_form'];
		}

		if (isset($where['date_to'])) {
			$arr['created <= '] = $where['date_to'];
		}

		if (isset($where['controller'])) {
			$arr['controller'] = $where['controller'];
		}

		if (isset($where['action'])) {
			$arr['action'] = $where['action'];
		}

		if (isset($where['method'])) {
			$arr['method'] = $where['method'];
		}

        if (count($arr) > 0) {
            $query = " WHERE ";
            $i = 0;
            foreach($arr as $key => $value) {
                if(preg_match("/LIKE/i", $key)) {
                    $query .= $key . " '%" . $this->db->q($value) . "%'";
                } else {
                    $query .= $key . " = '" . $this->db->q($value) . "'";
                }
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