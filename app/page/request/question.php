<?php

require_once PATH_MODEL . 'model_question.php';
require_once PATH_MODEL . 'model_question_type.php';
$m_question     = new model_question($db);
$m_type         = new model_question_type($db);
$action         = isset($_GET['act']) ? $_GET['act'] : '';
$id             = is_numeric($_GET['id']) ? $_GET['id']/1909 : '';
$text           = isset($_POST['txtQuestion']) ? $_POST['txtQuestion'] : '';
$type           = isset($_POST['cbGroup']) ? $_POST['cbGroup'] : '';
$status         = isset($_POST['cbStatus']) ? $_POST['cbStatus'] : STATUS_ENABLE;

switch($action) {
    case 'add':
        if(!empty($text) && !empty($type) && !empty($status)) {
            $arr_type = $m_type->get_row(array("question_type_id" => $type));
            if(!$arr_type) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Question type not found !');
				ajax_output('', 400, $callback);
                return;
            }

            if(!empty($_FILES["image_file"]["name"])) {
                $doUpload = $upload->go('image_file', PATH_QUESTION);
                if($doUpload['status'] == false) { 
                    $callback['noty'] = array('type' => 'error', 'text' => $doUpload['errors']);
                    ajax_output('', 400, $callback);
                    return;
                }

                $question_image = PATH_QUESTION . $doUpload['file'];
            }

            $fields = array(
                "question_type_id"  => $type,
                "question_text"     => $text,
                "question_status"   => $status
            );

            if(!empty($question_image)) {
                $fields['question_image'] = $question_image;
            }

            $insert = $db->insert("questions", $fields);
      
            if(!$insert) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
				ajax_output('', 503, $callback);
                return;
            }
      
            $notice->addSuccess("Question group created successfully !");
            ajax_output('', 200, array('location' => '?page=question'));
            return;
        }

        $callback['noty'] = array('type' => 'error', 'text' => 'Please, Insert correctly !');
        ajax_output('', 400, $callback);
        break;
    case 'update':
        if(!empty($text) && !empty($type) && !empty($status) && !empty($id)) {
            $arr_type = $m_type->get_row(array("question_type_id" => $type));
            if(!$arr_type) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Question type not found !');
				ajax_output('', 400, $callback);
                return;
            }

            if(!empty($_FILES["image_file"]["name"])) {
                $doUpload = $upload->go('image_file', PATH_QUESTION);
                if($doUpload['status'] == false) { 
                    $callback['noty'] = array('type' => 'error', 'text' => $doUpload['errors']);
                    ajax_output('', 400, $callback);
                    return;
                }

                $question_image = PATH_QUESTION . $doUpload['file'];
            }

            $fields = array(
                "question_type_id"  => $type,
                "question_text"     => $text,
                "question_status"   => $status
            );

            if(!empty($question_image)) {
                $fields['question_image'] = $question_image;
            }

            $update = $db->update("questions", $fields, array('question_id' => $id));
      
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
            $db->delete("questions", array(
                "question_id" => $id
            ));
      
            $notice->addSuccess("Question deleted successfully !");
            header("location:".HTTP."?page=question");
            return;
        }

        $notice->addError("Parameter id needed !");
        header("location:".HTTP."?page=question");
        break;
    default:
        $notice->addError("No action found in your requested url !");
        ajax_output(array(), 400, array('location' => '?page=question'));
        break;
}

?>