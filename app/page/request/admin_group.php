<?php

require_once PATH_MODEL . 'model_admin_group.php';
$m_admin_group  = new model_admin_group($db);
$action         = isset($_GET['act']) ? $_GET['act'] : '';
$id             = is_numeric($_GET['id']) ? $_GET['id']/1909 : '';
$name           = isset($_POST['txtGroupName']) ? $_POST['txtGroupName'] : '';
$status         = isset($_POST['cbStatus']) ? $_POST['cbStatus'] : STATUS_ENABLE;
$role           = isset($_POST['cbxGroupRoles']) ? $_POST['cbxGroupRoles'] : '';

switch($action) {
    case 'add':
        if(!empty($name) && !empty($status) && !empty($role)) {
            $name_available = $m_admin_group->get_row(array("admin_group_name" => $name));
            if($name_available) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Group name already used !');
				ajax_output('', 400, $callback);
                return;
            }

            $fields = array(
                "admin_group_name"      => $name,
                "admin_group_role"      => json_encode($role),
                "admin_group_status"    => $status
            );

            $insert = $db->insert("admin_group", $fields);
      
            if(!$insert) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
				ajax_output('', 503, $callback);
                return;
            }
      
            $notice->addSuccess("Admin group created successfully !");
            ajax_output('', 200, array('location' => '?page=admin_group'));
            return;
        }

        $callback['noty'] = array('type' => 'error', 'text' => 'Please, Insert correctly !');
        ajax_output('', 400, $callback);
        break;
    case 'update':
        if(!empty($name) && !empty($status) && !empty($role) && !empty($id)) {
            $name_available = $m_admin_group->get_row(array("admin_group_name" => $name));
            if($name_available && $id != $name_available['admin_group_id']) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Group name already used !');
				ajax_output('', 400, $callback);
                return;
            }

            $fields = array(
                "admin_group_name"      => $name,
                "admin_group_role"      => json_encode($role),
                "admin_group_status"    => $status
            );

            $update = $db->update("admin_group", $fields, array('admin_group_id' => $id));
      
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
    case 'delete':
        if(!empty($id)) {
            $db->delete("admin_group", array(
                "admin_group_id" => $id
            ));
      
            $notice->addSuccess("Admin group deleted successfully !");
            header("location:".HTTP."?page=admin_group");
            return;
        }

        $notice->addError("Parameter id needed !");
        header("location:".HTTP."?page=admin_group");
        break;
    default:
        $notice->addError("No action found in your requested url !");
        ajax_output(array(), 400, array('location' => '?page=admin_group'));
        break;
}

?>