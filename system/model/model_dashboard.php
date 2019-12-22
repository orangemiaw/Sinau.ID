<?php

defined('SINAUID') OR exit('No direct script access allowed');

class model_dashboard {
    private $db;

    public function __construct($dbconnect) {
        $this->db = $dbconnect;
    }

    public function total_modules() {
        $this->db->go("SELECT * FROM module_group WHERE module_group_status = " . STATUS_ENABLE);
        return $this->db->numRows();
    }

    public function total_assessments() {
        $this->db->go("SELECT * FROM question_group WHERE question_group_status = " . STATUS_ENABLE);
        return $this->db->numRows();
    }

    public function total_participants() {
        $this->db->go("SELECT * FROM participants");
        return $this->db->numRows();
    }

    public function total_mentors() {
        $this->db->go("SELECT * FROM admins WHERE admin_status = " . STATUS_ENABLE);
        return $this->db->numRows();
    }

    public function total_earning() {
        $earning = 0;
        $this->db->go("SELECT * FROM payments WHERE payment_status = 'approved'");
        if($this->db->numRows()>0){
            while($row = $this->db->fetchArray()) {
                $earning = $earning + $row['payment_amount'];
            }
        }

        return $earning * RATE_USD_TO_IDR;
    }
}