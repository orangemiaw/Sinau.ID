<?php

require_once PATH_MODEL . 'model_answer.php';
require_once PATH_MODEL . 'model_question.php';
$m_answer       = new model_answer($db);
$m_question     = new model_question($db);
$action         = isset($_GET['act']) ? $_GET['act'] : '';
$_question_id   = is_numeric($_GET['question_id']) ? $_GET['question_id']/1909 : '';
$_answer_id     = is_numeric($_GET['answer_id']) ? $_GET['answer_id']/1909 : '';
$text           = isset($_POST['txtAnswer']) ? $_POST['txtAnswer'] : '';
$question_id    = isset($_POST['cbGroup']) ? $_POST['cbGroup'] : '';
$answer_id      = isset($_POST['cbAnswer']) ? $_POST['cbAnswer'] : '';
$status         = isset($_POST['cbStatus']) ? $_POST['cbStatus'] : ANSWER_INCORRECT;

switch($action) {
    case 'add':
        if(!empty($text) && !empty($question_id) && !empty($answer_id) && !empty($status)) {
            $arr_question = $m_question->get_row(array("question_id" => $question_id));
            if(!$arr_question) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Question not found !');
				ajax_output('', 400, $callback);
                return;
            }

            if(!empty($_FILES["image_file"]["name"])) {
                $doUpload = $upload->go('image_file', PATH_ANSWERS);
                if($doUpload['status'] == false) { 
                    $callback['noty'] = array('type' => 'error', 'text' => $doUpload['errors']);
                    ajax_output('', 400, $callback);
                    return;
                }

                $answer_image = PATH_ANSWERS . $doUpload['file'];
            }

            $fields = array(
                "question_id"   => $question_id,
                "answer_id"     => $answer_id,
                "answer_text"   => $text,
                "status"        => $status
            );

            if(!empty($answer_image)) {
                $fields['answer_image'] = $answer_image;
            }

            $insert = $db->insert("answers", $fields);
      
            if(!$insert) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
				ajax_output('', 503, $callback);
                return;
            }
      
            $notice->addSuccess("Answer created successfully !");
            ajax_output('', 200, array('location' => '?page=answer'));
            return;
        }

        $callback['noty'] = array('type' => 'error', 'text' => 'Please, Insert correctly !');
        ajax_output('', 400, $callback);
        break;
    case 'update':
        if(!empty($text) && !empty($question_id) && !empty($answer_id) && !empty($status) && !empty($_question_id) && !empty($_answer_id)) {
            $arr_question = $m_question->get_row(array("question_id" => $question_id));
            if(!$arr_question) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Question not found !');
				ajax_output('', 400, $callback);
                return;
            }

            if(!empty($_FILES["image_file"]["name"])) {
                $doUpload = $upload->go('image_file', PATH_ANSWERS);
                if($doUpload['status'] == false) { 
                    $callback['noty'] = array('type' => 'error', 'text' => $doUpload['errors']);
                    ajax_output('', 400, $callback);
                    return;
                }

                $answer_image = PATH_ANSWERS . $doUpload['file'];
            }

            $fields = array(
                "question_id"   => $question_id,
                "answer_id"     => $answer_id,
                "answer_text"   => $text,
                "status"        => $status
            );

            if(!empty($answer_image)) {
                $fields['answer_image'] = $answer_image;
            }

            $update = $db->update("answers", $fields, array('question_id' => $_question_id, "answer_id" => $_answer_id));
      
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
        if(!empty($_question_id) && !empty($_answer_id)) {
            $db->delete("answers", array(
                "question_id"   => $_question_id,
                "answer_id"     => $_answer_id
            ));
      
            $notice->addSuccess("Answer deleted successfully !");
            header("location:".HTTP."?page=answer");
            return;
        }

        $notice->addError("Parameter id needed !");
        header("location:".HTTP."?page=answer");
        break;
    default:
        $notice->addError("No action found in your requested url !");
        ajax_output(array(), 400, array('location' => '?page=answer'));
        break;
}

?>