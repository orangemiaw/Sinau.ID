<?php

require_once PATH_MODEL . 'model_module_type.php';
$m_module_type  = new model_module_type($db);
$action         = isset($_GET['act']) ? $_GET['act'] : '';
$id             = is_numeric($_GET['id']) ? $_GET['id']/1909 : '';
$name           = isset($_POST['txtName']) ? $_POST['txtName'] : '';
$total          = isset($_POST['txTotal']) ? $_POST['txTotal'] : 0;
$group          = isset($_POST['cbGroup']) ? $_POST['cbGroup'] : '';

switch($action) {
    case 'add':
        if(!empty($name) && !empty($status)) {
            $name_available = $m_module_type->get_row(array("module_type" => $name));
            if($name_available) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Type name already used !');
				ajax_output('', 400, $callback);
                return;
            }

            $fields = array(
                "module_type"     => $name,
                "total"             => $total,
                "module_group_id" => $group
            );

            $insert = $db->insert("module_types", $fields);
      
            if(!$insert) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
				ajax_output('', 503, $callback);
                return;
            }
      
            $notice->addSuccess("Module type created successfully !");
            ajax_output('', 200, array('location' => '?page=module_type'));
            return;
        }

        $callback['noty'] = array('type' => 'error', 'text' => 'Please, Insert correctly !');
        ajax_output('', 400, $callback);
        break;
    case 'update':
        if(!empty($name) && !empty($status) && !empty($id)) {
            $name_available = $m_module_type->get_row(array("module_type" => $name));
            if($name_available && $id != $name_available['module_type_id']) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Group name already used !');
				ajax_output('', 400, $callback);
                return;
            }

            $fields = array(
                "module_type"     => $name,
                "total"             => $total,
                "module_group_id" => $group
            );

            $update = $db->update("module_types", $fields, array('module_type_id' => $id));
      
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
            $db->delete("module_type", array(
                "module_type_id" => $id
            ));
      
            $notice->addSuccess("Module type deleted successfully !");
            header("location:".HTTP."?page=module_type");
            return;
        }

        $notice->addError("Parameter id needed !");
        header("location:".HTTP."?page=module_type");
        break;
    default:
        $notice->addError("No action found in your requested url !");
        ajax_output(array(), 400, array('location' => '?page=module_type'));
        break;
}

?>