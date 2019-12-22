<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_admin {
    private $db;
    private $table_name = "admins";

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
    }

    public function total() {
        $this->db->go("SELECT * FROM " . $this->table_name . " WHERE admin_status = " . STATUS_ENABLE);
        return $this->db->numRows();
    }

    public function auth($login, $password) {
        $where = array(
			'admin_login'        => $this->db->q($login),
			'admin_password'     => $this->db->q(encrypt_password($password)),
			'admin_status'       => STATUS_ENABLE,
			'admin_group_status' => STATUS_ENABLE
        );

        $admin = $this->get_row($where);
        if($admin) {
			$fields = array(
				'admin_last_login'   => time(),
				'admin_last_ip'      => ip_address(),
				'admin_last_browser' => user_agent()
			);

			$this->db->update($this->table_name, $fields, array('admin_id' => $admin['admin_id']));
			return $admin;
        }

        return false;
    }

    public function get_results($where = array(), $page = 1, $show = 25, $order_val = 'ASC', $order_key = 'a.admin_id') {
        $query  = "SELECT a.admin_id, a.created, a.updated, a.created_by, a.updated_by, a.admin_name, a.admin_login, a.admin_email, a.admin_password, a.admin_last_login, a.admin_last_ip, a.admin_last_browser, a.admin_group_id, a.admin_forgot_code, a.admin_forgot_status, a.admin_status, g.admin_group_name, g.admin_group_role, g.admin_group_status";
        $query .= " FROM " . $this->table_name . " a ";
        $query .= " JOIN admin_group g ON a.admin_group_id = g.admin_group_id ";

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
        $query  = "SELECT a.admin_id, a.created, a.updated, a.created_by, a.updated_by, a.admin_name, a.admin_login, a.admin_email, a.admin_password, a.admin_last_login, a.admin_last_ip, a.admin_last_browser, a.admin_group_id, a.admin_forgot_code, a.admin_forgot_status, a.admin_status, g.admin_group_name, g.admin_group_role, g.admin_group_status";
        $query .= " FROM " . $this->table_name . " a ";
        $query .= " JOIN admin_group g ON a.admin_group_id = g.admin_group_id ";

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
        
		if (isset($where['admin_id'])) {
			$arr['a.admin_id'] = $where['admin_id'];
		}

		if (isset($where['admin_login'])) {
			$arr['a.admin_login'] = $where['admin_login'];
		}

		if (isset($where['admin_password'])) {
			$arr['a.admin_password'] = $where['admin_password'];
		}

		if (isset($where['admin_status'])) {
			$arr['a.admin_status'] = $where['admin_status'];
		}

		if (isset($where['admin_group_id'])) {
			$arr['a.admin_group_id'] = $where['admin_group_id'];
		}

		if (isset($where['admin_forgot_code'])) {
			$arr['a.admin_forgot_code'] = $where['admin_forgot_code'];
		}

		if (isset($where['admin_forgot_status'])) {
			$arr['a.admin_forgot_status'] = $where['admin_forgot_status'];
		}

		if (isset($where['admin_group_status'])) {
			$arr['g.admin_group_status'] = $where['admin_group_status'];
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