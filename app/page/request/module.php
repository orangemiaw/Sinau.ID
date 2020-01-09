<?php

require_once PATH_MODEL . 'model_module.php';
require_once PATH_MODEL . 'model_module_type.php';
$m_module       = new model_module($db);
$m_type         = new model_module_type($db);
$action         = isset($_GET['act']) ? $_GET['act'] : '';
$id             = is_numeric($_GET['id']) ? $_GET['id']/1909 : '';
$text           = isset($_POST['txtModule']) ? $_POST['txtModule'] : '';
$type           = isset($_POST['cbGroup']) ? $_POST['cbGroup'] : '';
$status         = isset($_POST['cbStatus']) ? $_POST['cbStatus'] : STATUS_ENABLE;

switch($action) {
    case 'add':
        if(!empty($text) && !empty($type) && !empty($status)) {
            $arr_type = $m_type->get_row(array("module_type_id" => $type));
            if(!$arr_type) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Module type not found !');
				ajax_output('', 400, $callback);
                return;
            }

            if(!empty($_FILES["image_file"]["name"])) {
                $doUpload = $upload->go('image_file', PATH_IMAGE);
                if($doUpload['status'] == false) { 
                    $callback['noty'] = array('type' => 'error', 'text' => $doUpload['errors']);
                    ajax_output('', 400, $callback);
                    return;
                }

                $module_image = PATH_IMAGE . $doUpload['file'];
            }

            if(!empty($_FILES["module_file"]["name"])) {
                $doUploadFile = $upload->file('module_file', PATH_MODULE);
                if($doUploadFile['status'] == false) { 
                    $callback['noty'] = array('type' => 'error', 'text' => $doUploadFile['errors']);
                    ajax_output('', 400, $callback);
                    return;
                }

                $module_file = PATH_MODULE . $doUploadFile['file'];
            }

            $fields = array(
                "module_type_id"  => $type,
                "module_text"     => $text,
                "module_status"   => $status
            );

            if(!empty($module_image)) {
                $fields['module_image'] = $module_image;
            }

            if(!empty($module_image)) {
                $fields['module_file'] = $module_file;
            }

            $insert = $db->insert("modules", $fields);
      
            if(!$insert) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
				ajax_output('', 503, $callback);
                return;
            }
      
            $notice->addSuccess("module group created successfully !");
            ajax_output('', 200, array('location' => '?page=module'));
            return;
        }

        $callback['noty'] = array('type' => 'error', 'text' => 'Please, Insert correctly !');
        ajax_output('', 400, $callback);
        break;
    case 'update':
        if(!empty($text) && !empty($type) && !empty($status) && !empty($id)) {
            $arr_type = $m_type->get_row(array("module_type_id" => $type));
            if(!$arr_type) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Module type not found !');
				ajax_output('', 400, $callback);
                return;
            }

            if(!empty($_FILES["image_file"]["name"])) {
                $doUpload = $upload->go('image_file', PATH_IMAGE);
                if($doUpload['status'] == false) { 
                    $callback['noty'] = array('type' => 'error', 'text' => $doUpload['errors']);
                    ajax_output('', 400, $callback);
                    return;
                }

                $module_image = PATH_IMAGE . $doUpload['file'];
            }

            if(!empty($_FILES["module_file"]["name"])) {
                $doUploadFile = $upload->file('module_file', PATH_MODULE);
                if($doUploadFile['status'] == false) { 
                    $callback['noty'] = array('type' => 'error', 'text' => $doUploadFile['errors']);
                    ajax_output('', 400, $callback);
                    return;
                }

                $module_file = PATH_MODULE . $doUploadFile['file'];
            }

            $fields = array(
                "module_type_id"  => $type,
                "module_text"     => $text,
                "module_status"   => $status
            );

            if(!empty($module_image)) {
                $fields['module_image'] = $module_image;
            }

            if(!empty($module_image)) {
                $fields['module_file'] = $module_file;
            }

            $update = $db->update("modules", $fields, array('module_id' => $id));
      
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
            $db->delete("modules", array(
                "module_id" => $id
            ));
      
            $notice->addSuccess("Module deleted successfully !");
            header("location:".HTTP."?page=module");
            return;
        }

        $notice->addError("Parameter id needed !");
        header("location:".HTTP."?page=module");
        break;
    default:
        $notice->addError("No action found in your requested url !");
        ajax_output(array(), 400, array('location' => '?page=module'));
        break;
}

?>