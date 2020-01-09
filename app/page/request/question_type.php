<?php

require_once PATH_MODEL . 'model_question_type.php';
$m_question_type  = new model_question_type($db);
$action         = isset($_GET['act']) ? $_GET['act'] : '';
$id             = is_numeric($_GET['id']) ? $_GET['id']/1909 : '';
$name           = isset($_POST['txtName']) ? $_POST['txtName'] : '';
$total          = isset($_POST['txTotal']) ? $_POST['txTotal'] : 0;
$group          = isset($_POST['cbGroup']) ? $_POST['cbGroup'] : '';

switch($action) {
    case 'add':
        if(!empty($name) && !empty($total) && !empty($group)) {
            $name_available = $m_question_type->get_row(array("question_type" => $name));
            if($name_available) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Type name already used !');
				ajax_output('', 400, $callback);
                return;
            }

            $fields = array(
                "question_type"     => $name,
                "total"             => $total,
                "question_group_id" => $group
            );

            $insert = $db->insert("question_types", $fields);
      
            if(!$insert) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
				ajax_output('', 503, $callback);
                return;
            }
      
            $notice->addSuccess("Question type created successfully !");
            ajax_output('', 200, array('location' => '?page=question_type'));
            return;
        }

        $callback['noty'] = array('type' => 'error', 'text' => 'Please, Insert correctly !');
        ajax_output('', 400, $callback);
        break;
    case 'update':
        if(!empty($name) && !empty($total) && !empty($group) && !empty($id)) {
            $name_available = $m_question_type->get_row(array("question_type" => $name));
            if($name_available && $id != $name_available['question_type_id']) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Group name already used !');
				ajax_output('', 400, $callback);
                return;
            }

            $fields = array(
                "question_type"     => $name,
                "total"             => $total,
                "question_group_id" => $group
            );

            $update = $db->update("question_types", $fields, array('question_type_id' => $id));
      
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
            $db->delete("question_type", array(
                "question_type_id" => $id
            ));
      
            $notice->addSuccess("Question type deleted successfully !");
            header("location:".HTTP."?page=question_type");
            return;
        }

        $notice->addError("Parameter id needed !");
        header("location:".HTTP."?page=question_type");
        break;
    default:
        $notice->addError("No action found in your requested url !");
        ajax_output(array(), 400, array('location' => '?page=question_type'));
        break;
}

?>