<?php

require_once PATH_MODEL . 'model_admin.php';
require_once PATH_MODEL . 'model_admin_group.php';
$m_admin        = new model_admin($db);
$m_group        = new model_admin_group($db);
$action         = isset($_GET['act']) ? $_GET['act'] : '';
$id             = is_numeric($_GET['id']) ? $_GET['id']/1909 : '';
$name           = isset($_POST['txtFullName']) ? $_POST['txtFullName'] : '';
$login          = isset($_POST['txtLogin']) ? $_POST['txtLogin'] : '';
$email          = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : '';
$group          = isset($_POST['cbGroup']) ? $_POST['cbGroup'] : '';
$password       = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : '';
$password2      = isset($_POST['txtRepeatPassword']) ? $_POST['txtRepeatPassword'] : '';
$status         = isset($_POST['cbStatus']) ? $_POST['cbStatus'] : '';

switch($action) {
    case 'add':
        if(!empty($name) && !empty($login) && !empty($email) && !empty($group) && !empty($password) && !empty($password2) && !empty($status)) {
            $name_available = $m_admin->get_row(array("admin_login" => $login));
            if($name_available) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Login username already used !');
				ajax_output('', 400, $callback);
                return;
            }

            $group_available = $m_group->get_row(array("admin_group_id" => $group));
            if(!$group_available) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Admin group not found !');
				ajax_output('', 400, $callback);
                return;
            }

            if($password != $password2) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Password not match !');
                ajax_output('', 400, $callback);
                return;
            }
            
            if(strlen($password) < 6) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Password must more than 6 character !');
                ajax_output('', 400, $callback);
                return;
            }

            $fields = array(
                "admin_name"      => $name,
                "admin_email"     => $email,
                "admin_login"     => $login,
                "admin_password"  => encrypt_password($password),
                "admin_group_id"  => $group,
                "admin_status"    => $status
            );

            $insert = $db->insert("admins", $fields);
      
            if(!$insert) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
				ajax_output('', 503, $callback);
                return;
            }
      
            $notice->addSuccess("admin created successfully !");
            ajax_output('', 200, array('location' => '?page=admin'));
            return;
        }

        $callback['noty'] = array('type' => 'error', 'text' => 'Please, Insert correctly !');
        ajax_output('', 400, $callback);
        break;
    case 'update':
        if(!empty($name) && !empty($login) && !empty($email) && !empty($group) && !empty($status)) {
            $name_available = $m_admin->get_row(array("admin_login" => $login));
            if($name_available) {
                $name_owned = $m_admin->get_row(array("admin_login" => $login, "admin_id" => $id));
                if(!$name_owned) {
                    $callback['noty'] = array('type' => 'error', 'text' => 'Login username already used !');
                    ajax_output('', 400, $callback);
                    return;
                }
            }

            $group_available = $m_group->get_row(array("admin_group_id" => $group));
            if(!$group_available) {
                $callback['noty'] = array('type' => 'error', 'text' => 'admin group not found !');
				ajax_output('', 400, $callback);
                return;
            }

            if(!empty($password) && !empty($password2)) {
                if($password != $password2) {
                    $callback['noty'] = array('type' => 'error', 'text' => 'Password not match !');
                    ajax_output('', 400, $callback);
                    return;
                }
                
                if(strlen($password) < 6) {
                    $callback['noty'] = array('type' => 'error', 'text' => 'Password must more than 6 character !');
                    ajax_output('', 400, $callback);
                    return;
                }

                $encrypt_password = encrypt_password($password);
            }

            $fields = array(
                "admin_name"      => $name,
                "admin_email"     => $email,
                "admin_login"     => $login,
                "admin_group_id"  => $group,
                "admin_status"    => $status
            );

            if(!empty($encrypt_password)) {
                $fields['admin_password'] = $encrypt_password;
            }

            $update = $db->update("admins", $fields, array('admin_id' => $id));

            if(!$update) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
                ajax_output('', 503, $callback);
                return;
            }
      
            $callback['noty'] = array('type' => 'success', 'text' => 'Updated');
            ajax_output('', 200, $callback);
            return;
        }

        $callback['noty'] = array('type' => 'error', 'text' => 'Please, Insert correctly !');
        ajax_output('', 400, $callback);
        break;
    case 'terminate':
        if(!empty($id)) {
            $fields = array(
                "admin_status" => STATUS_TERMINATE
            );

            $update = $db->update("admins", $fields, array('admin_id' => $id));

            if(!$update) {
                $notice->addError("Query failed !");
                header("location:".HTTP."?page=admin");
                return;
            }

            $notice->addSuccess("admin terminated successfully !");
            header("location:".HTTP."?page=admin");
            break;
        }

        $notice->addError("Parameter id needed !");
        header("location:".HTTP."?page=admin");
        break;
    default:
        $notice->addError("No action found in your requested url !");
        ajax_output(array(), 400, array('location' => '?page=admin'));
        break;
}

?>