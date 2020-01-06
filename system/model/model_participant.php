<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_participant {
    private $db;
    private $table_name = "participants";

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
    }

    public function auth($login, $password) {
        $where = array(
			'participant_login'        => $this->db->q($login),
			'participant_password'     => $this->db->q(encrypt_password($password)),
			'participant_status'       => STATUS_ENABLE,
			'participant_group_status' => STATUS_ENABLE
        );

        $participant = $this->get_row($where);
        if($participant) {
			$fields = array(
				'participant_last_login'   => time(),
				'participant_last_ip'      => ip_address(),
				'participant_last_browser' => user_agent()
			);

			$this->db->update($this->table_name, $fields, array('participant_id' => $participant['participant_id']));
			return $participant;
        }

        return false;
    }

    public function get_results($where = array(), $page = 1, $show = 25, $order_val = 'ASC', $order_key = 'p.participant_id') {
        $query  = "SELECT p.participant_id, p.created, p.updated, p.created_by, p.updated_by, p.participant_name, p.participant_login, p.participant_email, p.participant_password, p.participant_last_login, p.participant_last_ip, p.participant_last_browser, p.participant_group_id, p.profile_image, p.address, p.regencie, p.province, p.postal_code, p.telephone, p.participant_forgot_code, p.participant_forgot_status, p.participant_status, g.participant_group_name, g.participant_group_role, g.participant_group_status";
        $query .= " FROM " . $this->table_name . " p ";
        $query .= " JOIN participant_group g ON p.participant_group_id = g.participant_group_id ";

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
        $query  = "SELECT p.participant_id, p.created, p.updated, p.created_by, p.updated_by, p.participant_name, p.participant_login, p.participant_email, p.participant_password, p.participant_last_login, p.participant_last_ip, p.participant_last_browser, p.participant_group_id, p.profile_image, p.address, p.regencie, p.province, p.postal_code, p.telephone, p.participant_forgot_code, p.participant_forgot_status, p.participant_status, g.participant_group_name, g.participant_group_role, g.participant_group_status";
        $query .= " FROM " . $this->table_name . " p ";
        $query .= " JOIN participant_group g ON p.participant_group_id = g.participant_group_id ";

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
			$arr['p.participant_id'] = $where['participant_id'];
		}

		if (isset($where['participant_login'])) {
			$arr['p.participant_login'] = $where['participant_login'];
		}

		if (isset($where['participant_password'])) {
			$arr['p.participant_password'] = $where['participant_password'];
		}

		if (isset($where['participant_status'])) {
			$arr['p.participant_status'] = $where['participant_status'];
		}

		if (isset($where['participant_group_id'])) {
			$arr['p.participant_group_id'] = $where['participant_group_id'];
		}

		if (isset($where['participant_forgot_code'])) {
			$arr['p.participant_forgot_code'] = $where['participant_forgot_code'];
		}

		if (isset($where['participant_email'])) {
			$arr['p.participant_email'] = $where['participant_email'];
		}

		if (isset($where['participant_forgot_status'])) {
			$arr['p.participant_forgot_status'] = $where['participant_forgot_status'];
		}

		if (isset($where['participant_group_status'])) {
			$arr['g.participant_group_status'] = $where['participant_group_status'];
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