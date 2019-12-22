<?php

require_once PATH_MODEL . 'model_question_group.php';
$m_question_group  = new model_question_group($db);
$action         = isset($_GET['act']) ? $_GET['act'] : '';
$id             = is_numeric($_GET['id']) ? $_GET['id']/1909 : '';
$name           = isset($_POST['txtGroupName']) ? $_POST['txtGroupName'] : '';
$status         = isset($_POST['cbStatus']) ? $_POST['cbStatus'] : STATUS_ENABLE;

switch($action) {
    case 'add':
        if(!empty($name) && !empty($status)) {
            $name_available = $m_question_group->get_row(array("question_group_name" => $name));
            if($name_available) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Group name already used !');
				ajax_output('', 400, $callback);
                return;
            }

            $fields = array(
                "question_group_name"      => $name,
                "question_group_status"    => $status
            );

            $insert = $db->insert("question_group", $fields);
      
            if(!$insert) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
				ajax_output('', 503, $callback);
                return;
            }
      
            $notice->addSuccess("Participant group created successfully !");
            ajax_output('', 200, array('location' => '?page=question_group'));
            return;
        }

        $callback['noty'] = array('type' => 'error', 'text' => 'Please, Insert correctly !');
        ajax_output('', 400, $callback);
        break;
    case 'update':
        if(!empty($name) && !empty($status) && !empty($id)) {
            $name_available = $m_question_group->get_row(array("question_group_name" => $name));
            if($name_available && $id != $name_available['question_group_id']) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Group name already used !');
				ajax_output('', 400, $callback);
                return;
            }

            $fields = array(
                "question_group_name"      => $name,
                "question_group_status"    => $status
            );

            $update = $db->update("question_group", $fields, array('question_group_id' => $id));
      
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
            $db->delete("question_group", array(
                "question_group_id" => $id
            ));
      
            $notice->addSuccess("Participant group deleted successfully !");
            header("location:".HTTP."?page=question_group");
            return;
        }

        $notice->addError("Parameter id needed !");
        header("location:".HTTP."?page=question_group");
        break;
    default:
        $notice->addError("No action found in your requested url !");
        ajax_output(array(), 400, array('location' => '?page=question_group'));
        break;
}

?>