<?php

require_once PATH_MODEL . 'model_module_group.php';
$m_module_group = new model_module_group($db);
$action         = isset($_GET['act']) ? $_GET['act'] : '';
$id             = is_numeric($_GET['id']) ? $_GET['id']/1909 : '';
$name           = isset($_POST['txtGroupName']) ? $_POST['txtGroupName'] : '';
$status         = isset($_POST['cbStatus']) ? $_POST['cbStatus'] : STATUS_ENABLE;

switch($action) {
    case 'add':
        if(!empty($name) && !empty($status)) {
            $name_available = $m_module_group->get_row(array("module_group_name" => $name));
            if($name_available) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Group name already used !');
				ajax_output('', 400, $callback);
                return;
            }

            $fields = array(
                "module_group_name"      => $name,
                "module_group_status"    => $status
            );

            $insert = $db->insert("module_group", $fields);
      
            if(!$insert) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
				ajax_output('', 503, $callback);
                return;
            }
      
            $notice->addSuccess("Module group created successfully !");
            ajax_output('', 200, array('location' => '?page=module_group'));
            return;
        }

        $callback['noty'] = array('type' => 'error', 'text' => 'Please, Insert correctly !');
        ajax_output('', 400, $callback);
        break;
    case 'update':
        if(!empty($name) && !empty($status) && !empty($id)) {
            $name_available = $m_module_group->get_row(array("module_group_name" => $name));
            if($name_available && $id != $name_available['module_group_id']) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Group name already used !');
				ajax_output('', 400, $callback);
                return;
            }

            $fields = array(
                "module_group_name"      => $name,
                "module_group_status"    => $status
            );

            $update = $db->update("module_group", $fields, array('module_group_id' => $id));
      
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
            $db->delete("module_group", array(
                "module_group_id" => $id
            ));
      
            $notice->addSuccess("Module group deleted successfully !");
            header("location:".HTTP."?page=module_group");
            return;
        }

        $notice->addError("Parameter id needed !");
        header("location:".HTTP."?page=module_group");
        break;
    default:
        $notice->addError("No action found in your requested url !");
        ajax_output(array(), 400, array('location' => '?page=module_group'));
        break;
}

?>