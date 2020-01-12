<?php

include PATH_MODEL . 'model_participant.php';
include PATH_MODEL . 'model_question.php';
include PATH_MODEL . 'model_question_type.php';
include PATH_MODEL . 'model_answer.php';
include PATH_MODEL . 'model_exam.php';
include PATH_MODEL . 'model_exam_status.php';
include PATH_MODEL . 'model_config.php';
include PATH_MODEL . 'model_face_recognition.php';

$m_participant      = new model_participant($db);
$m_question         = new model_question($db);
$m_question_type    = new model_question_type($db);
$m_answer           = new model_answer($db);
$m_exam             = new model_exam($db);
$m_exam_status      = new model_exam_status($db);
$m_config           = new model_config($db);
$m_fr               = new model_face_recognition();

$question_type_id   = is_numeric($_GET['id']) ? $_GET['id']/1909 : '';
$action             = isset($_GET['act']) ? $_GET['act'] : '';
$question_no        = isset($_GET['txtQuestionNo']) ? $_GET['txtQuestionNo'] : '';
$question_id        = isset($_POST['txtQuestionId']) ? $_POST['txtQuestionId']/1909 : '';
$answer             = isset($_POST['rbAnswer']) ? $_POST['rbAnswer'] : '';
$capture            = isset($_POST['txtImageBase64']) ? $_POST['txtImageBase64'] : '';

if($action == 'answer') {
    if(empty($answer) || $answer == 'undefined') {
        $notice->addError("Answer can not be empty. Try again .. ");
        ajax_output(array(), 400, array('location' => '?page=exam&id=' . $question_type_id*1909 . '&hal=' . $question_no));
    }

    // Save base64 capture image first
    $capture = str_replace('data:image/jpeg;base64,', '', $capture);
	$capture = str_replace(' ', '+', $capture);
	$data = base64_decode($capture);
	$file = PATH_CAPTURE . uniqid() . '.jpg';
	$success = file_put_contents($file, $data);
    
    $arr_participant = $m_participant->get_row(array("participant_id" => $_SESSION['id']));
    $arr_config = $m_config->get_row();
    $detect = $m_fr->proccess($arr_config['faceai_server'], $arr_config['faceai_login'], $arr_config['faceai_password'], image_base64($arr_participant['profile_image']), image_base64($file));

    var_dump($detect);
    die();

    $json = json_decode($detect);

    if(!$detect) {
        $notice->addError("Face detection connection time out. Try again ! ");
        ajax_output(array(), 400, array('location' => '?page=exam&id=' . $question_type_id*1909 . '&hal=' . $question_no));
    } elseif($json->meta->code != 200) {
        $notice->addError("Face detection error ! " . $json->meta->message);
        ajax_output(array(), 400, array('location' => '?page=exam&id=' . $question_type_id*1909 . '&hal=' . $question_no));
    } elseif(!empty($json->data)) {
        $arr_type       = $m_question_type->get_row(array('question_type_id' => $question_type_id));
        $total_question = $arr_type['total'];
        if($question_no < $total_question) {
            $redirection = '?page=exam&id=' . $question_type_id*1909 . '&hal=' . ($question_no+1);
        } else {
            $redirection = '?page=assessment';
        }

        $arr_exam = $m_exam->get_row(array('participant_id' => $_SESSION['id'], 'question_id' => $question_id));
        if($arr_exam) {
            $notice->addError("You already answered this question before.");
            ajax_output(array(), 400, array('location' => $redirection));
        } else {
            if($json->data->compare[0]->is_match == false) {
                $answer_status = ANSWER_CHEATING;
                $notice->addError("You detected cheating, beacouse your face not same with your uploaded Card ID. Your current answer change to wrong answer.");
            } elseif($json->data->compare[0]->face_found > 1) {
                $answer_status = ANSWER_CHEATING;
                $notice->addError("You detected cheating, becaouse asking for help from others. Your current answer change to wrong answer.");
            } else {
                $arr_answer    = $m_answer->get_row(array('question_id' => $question_id, 'answer_id' => $answer));
                $answer_status = $answer['satatus'];
            }

            $exam_fields = array(
                'participant_id'  => $_SESSION['id'],
                'question_number' => $question_no,
                'question_id'     => $question_id,
                'answer_id'       => $answer,
                'status'          => $answer_status,
                'time'            => time()
            );

            $exam_insert = $db->insert("exams", $exam_fields);
      
            if(!$exam_insert) {
                $notice->addError("Query failed.");
                ajax_output(array(), 400, array('location' => $redirection));
            }

            // Calculate grade
            $total_correct  = $m_exam->get_status($_SESSION['id'], ANSWER_INCORRECT);
            $total_answered = count($m_exam->get_results(array('participant_id' => $_SESSION['id'])));
            $grade = (100 / $total_question) * $total_correct;

            $arr_exam_status = $m_exam_status->get_row(array('participant_id' => $_SESSION['id'], 'question_type_id' => $question_type_id));
            if(!$arr_exam_status) {
                $exam_status_fields = array(
                    'participant_id'    => $_SESSION['id'],
                    'question_type_id'  => $question_type_id,
                    'total_question'    => $total_question,
                    'total_answered'    => $total_answered,
                    'total_correct'     => $total_correct,
                    'value'             => $grade
                );

                $exam_status_insert = $db->insert("exam_status", $exam_status_fields);
      
                if(!$exam_status_insert) {
                    $notice->addError("Query failed.");
                    ajax_output(array(), 400, array('location' => $redirection));
                }
            } else {
                $exam_status_fields = array(
                    'participant_id'    => $_SESSION['id'],
                    'question_type_id'  => $question_type_id,
                    'total_question'    => $total_question,
                    'total_answered'    => $total_answered,
                    'total_correct'     => $total_correct,
                    'value'             => $grade
                );

                $exam_status_update = $db->update("exam_status", $exam_status_fields, array('participant_id' => $_SESSION['id'], 'question_type_id' => $question_type_id));
      
                if(!$exam_status_update) {
                    $notice->addError("Query failed.");
                    ajax_output(array(), 400, array('location' => $redirection));
                }
            }
      

            if($question_no < $total_question) {
                $notice->addSuccess("Your answer has been successfully recorded.");
            } else {
                $notice->addSuccess("All question has been aswered successfully.");
            }
            ajax_output(array(), 200, array('location' => $redirection));
        }
    } else {
        $notice->addError("Something when wrong. Try again .. ");
        ajax_output(array(), 400, array('location' => '?page=exam&id=' . $question_type_id*1909 . '&hal=' . $question_no));
    }
} else {
    $notice->addError("No action found in your requested url !");
    ajax_output(array(), 400, array('location' => '?page=assessment'));
}