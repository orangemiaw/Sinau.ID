<?php
defined('SINAUID') OR exit('No direct script access allowed');

// Chcek role and block if not have access role
if (!isset($_SESSION['role']->assessment->exam)) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=assessment");
    return;
}

if(!isset($_GET['id']) || empty($_GET['id'])) {
    $notice->addError("Parameter id can't be empty !");
    header("location:".HTTP."?page=assessment");
    return; 
}

include PATH_MODEL . 'model_question.php';
include PATH_MODEL . 'model_question_type.php';
include PATH_MODEL . 'model_answer.php';

$m_question     = new model_question($db);
$m_type         = new model_question_type($db);
$m_answer       = new model_answer($db);
$page_number    = is_numeric($_GET['hal']) ? $_GET['hal'] : 1;
$data_per_page  = 1;
$arr_question   = $m_question->get_results(array('question_type_id' => $_GET['id']/1909), $page_number, $data_per_page);
$arr_type       = $m_type->get_row(array('question_type_id' => $arr_question['question_type_id']));
$total_rows     = $arr_type['total'];

$title = "Online Exam " . $page_number . "/" . $arr_type['total'];

include ROOT."app/theme/header.php";

?>
<div class="br-mainpanel">
    <div class="br-pagetitle">
        <h4><?=isset($title) ? $title : 'Untitled';?></h4>
    </div>
    <div class="br-pagebody">

    <?=$GLOBALS['notice']->showSuccess();?>
    <?=$GLOBALS['notice']->showError();?>

<div class="row">
	<div class="col-md-7 col-sm-12">
        <form id="form-answer" class="card shadow-base bd-0">

            <div class="card-body">
                <div class="row">
                    <?php if (!empty($arr_question)): ?>
                        <?php foreach($arr_question as $value): ?>
                            <div class="col-lg-12">
                                <?=!empty($value['question_image']) ? print '<img src="' . HTTP . '/' . $value['question_image'] . '" width="300" />' : '';?><br /><br />
                                <b><?=$page_number;?>. <?=$value['question_text'];?></b><br /><br />
								<input type="hidden" name="txtQuestionId" id="txtQuestionId" value="<?=$value['question_id']*1909;?>">
                            </div>
                                
                            <?php
                                $arr_answer = $m_answer->get_results(array('question_id' => $value['question_id']), 1, 5);
                                foreach($arr_answer as $answer):
                            ?>
                                <div class="col-lg-12">
                                    <input type="radio" id="rbAnswer" name="rbAnswer" value="<?=$answer['answer_id'];?>"> <?=$answer['answer_text'];?><br/>
                                </div>
                                <?php endforeach;?>
                        <?php endforeach; ?>
                    <?php else: ?>
						<div class="col-lg-12">
	                        <b>No question found.</b>
						</div>
                    <?php endif;?>

                </div>
            </div>

            <div class="card-footer bd-color-gray-lighter text-right">
                <button type="submit" class="btn btn-primary tx-size-xs">Submit Answer & Next</button>
            </div>

            </form>

    </div>
	
	<div class="col-md-5 col-sm-12 mg-t-20 mg-md-t-0">
		<div class="card shadow-base bd-0">
			<div class="card-header bd-gray-200 mg-t-auto">
				<span>Online Webcam Exam Monitoring</span>
			</div>
			<div class="card-body pd-0">
				<div id="inputImage" class="col-md-12 tx-center pd-15">
                    <center>
                        <div id="my_camera"></div>
                    </center>
                    <br />
                    <p>Kejujuran itu seperti cermin. Sekali dia retak, pecah, maka jangan harap dia akan pulih seperti sedia kala. Jangan coba-coba bermain dengan cermin.</p>
				</div>
			</div>
		</div>

		<div id="elm-log-row" style="display:none;">
			<span class="col time"></span>
			<span class="col created-by"></span>
			<span class="col text-right ip-address"></span>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
<script language="JavaScript">
	Webcam.set({
		width: 320,
		height: 240,
		dest_width: 640,
		dest_height: 480,
		image_format: 'jpeg',
		jpeg_quality: 100
	});
	Webcam.attach( '#my_camera' );
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('#form-answer').on('submit', function(event){
		event.preventDefault();

		var request 	= '?do=<?=$_GET['page'] . '&act=answer&id=' . $_GET['id'] . '&txtQuestionNo=' . $page_number;?>',
			form    	= $(this),
			answer 		= $("input:radio[name=rbAnswer]:checked").val(),
			question_id = $("#txtQuestionId").val(),
			image_file 	= '';

        Webcam.snap( function(data_uri) {
            image_file = data_uri;
        });

		loading(form, 'show');		
        $.ajax({
            type: 'POST',
            url: request,
            data: 'rbAnswer=' + answer + '&txtImageBase64=' + image_file + '&txtQuestionId=' + question_id,
            contentType: 'application/x-www-form-urlencoded',
            cache: false,
            processData: false,
            success: function (result) {
                init_meta(result.meta);
                loading(form, 'hide');
            }
		});
		
	});

	$('.role-group-list').each(function(i, obj) {
		container = $(this).closest('div');
		if($(obj).find('input[type=checkbox]').not(':checked').length > 0) {
			container.find('.mark-all-ingroup').prop('checked', false);
		}else{
			container.find('.mark-all-ingroup').prop('checked', true);
		}
	});

	$('.role-group-list input[type=checkbox]').on('change', function() {
		container = $(this).closest('div');
		if(container.find('.role-group-list input[type=checkbox]:checked').length < container.find('.role-group-list input[type=checkbox]').length) {
			console.log(container.find('.mark-all-ingroup').prop('checked', false));
		}else{
			container.find('.mark-all-ingroup').prop('checked', true);
		}
	});


	$('input.mark-all-ingroup').on('change', function() {
		li = $(this).closest('div').find('li.list-group-item');
		//console.log(li.find('input[type=checkbox]:checked').length == li.find('input[type=checkbox]'));
		if( li.find('input[type=checkbox]:checked').length == li.find('input[type=checkbox]').length ) {
			li.find('input[type=checkbox]').prop('checked', false);
		} else {
			li.find('input[type=checkbox]').prop('checked', true);
		}
	});
		
	$("[type=file]").on("change", function() {
		// Name of file and placeholder
		var str = this.files[0].name;
		var file = str.substr(1, 36);
		var dflt = $(this).attr("placeholder");
		if ($(this).val() != "") {
			$(this).next().text(file);
		} else {
			$(this).next().text(dflt);
		}
	});
});
</script>

<footer class="br-footer">
    <div class="footer-left">
    </div>
    <div class="footer-right d-flex align-items-center">
    </div>
</footer>
</div>
</div>
<?php include ROOT."app/theme/footer.php";?>