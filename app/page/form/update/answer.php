<?php
defined('SINAUID') OR exit('No direct script access allowed');

// Chcek role and block if not have access role
if (!isset($_SESSION['role']->{$_GET['update']}->update)) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=" . $_GET['update']);
    return;
}

if(!isset($_GET['question_id']) || empty($_GET['question_id']) || !isset($_GET['answer_id']) || empty($_GET['answer_id'])) {
    $notice->addError("Parameter id can't be empty !");
    header("location:".HTTP."?page=" . $_GET['update']);
    return; 
}

$title = "Update Answer";
include ROOT."app/theme/header.php";
include PATH_MODEL . 'model_answer.php';
include PATH_MODEL . 'model_question.php';

$m_answer   = new model_answer($db);
$m_question = new model_question($db);
$arr_answer = $m_answer->get_row(array("question_id" => $_GET['question_id']/1909, "answer_id" => $_GET['answer_id']/1909));
if(!$arr_answer) {
    $notice->addError("Data not found in our database !");
    header("location:".HTTP."?page=" . $_GET['update']);
    return;
}

$arr_question  = $m_question->get_results(array(), 'all');

?>
<div class="br-mainpanel">
    <div class="br-pagetitle">
        <h4><?=isset($title) ? $title : 'Untitled';?></h4>
    </div>
    <div class="br-pagebody">

<div class="row">
	<div class="col-md-7 col-sm-12">

    <form id="form-update" class="card shadow-base bd-0">

		<div class="card-body">
			<div class="row">
                        <div class="col-md-12 tx-center">
                            <div class="form-group">
                                <label class="form-control-label">Answer Image </label><br />
                                <img src="<?=$arr_answer['answer_image'] ? HTTP . $arr_answer['answer_image'] : HTTP . UNAVAILABLE_IMAGE;?>" width="300" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Question </label>
                                <select id="select-brand" name="cbGroup" class="form-control select-two" data-placeholder="-- Select --" >
                                    <option></option>
                                    <?php foreach ($arr_question as $value): ?>
                                        <option value="<?php print $value['question_id'];?>" <?=set_select($value['question_id'], $arr_answer['question_id']);?>>
                                            <?php print $value['question_type'] . ' - ' . $value['question_text'];?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
						<div class="col-md-12">
							<div class="form-group mg-b-0">
								<label class="form-control-label">Answer Text <span class="tx-danger">*</span></label>
								<input type="text" name="txtAnswer" class="form-control" value="<?=$arr_answer['answer_text'];?>" required autofocus>
								<ul class="fields-message"></ul>
							</div>
						</div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Answer Image </label>
                                <div class="custom-file">
                                    <input type="file" name="image_file" class="custom-file-input" id="customFile" placeholder="Choose file" autofocus>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
						<div class="col-md-6">
							<div class="form-group mg-b-0">
								<label class="form-control-label">Answer Code: <span class="tx-danger">*</span></label>
								<select class="form-control select-two" name="cbAnswer" data-placeholder=" -- Pilih Status --" required>
									<option></option>
									<option value="1" <?=set_select("1", $arr_answer['answer_id']);?>>A</option>
									<option value="2" <?=set_select("2", $arr_answer['answer_id']);?>>B</option>
									<option value="3" <?=set_select("3", $arr_answer['answer_id']);?>>C</option>
									<option value="4" <?=set_select("4", $arr_answer['answer_id']);?>>D</option>
									<option value="5" <?=set_select("5", $arr_answer['answer_id']);?>>E</option>
								</select>
								<ul class="fields-message"></ul>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group mg-b-0">
								<label class="form-control-label">Status: <span class="tx-danger">*</span></label>
								<select class="form-control select-two" name="cbStatus" data-placeholder=" -- Pilih Status --" required>
									<option></option>
									<option value="<?=ANSWER_CORRECT;?>" <?=set_select(ANSWER_CORRECT, $arr_answer['status']);?>>Correct</option>
									<option value="<?=ANSWER_INCORRECT;?>" <?=set_select(ANSWER_INCORRECT, $arr_answer['status']);?>>Incorrect</option>
								</select>
								<ul class="fields-message"></ul>
							</div>
						</div>

			</div>
		</div>
		<div class="card-footer bd-color-gray-lighter text-right">
			<button type="submit" class="btn btn-primary tx-size-xs ">Submit</button>
		</div>

		</form>

	</div>

	<div class="col-md-5 col-sm-12 mg-t-20 mg-md-t-0">

		<div class="card shadow-base bd-0 mg-b-20">
			<?php if (!empty($arr_answer['updated']) && !empty($arr_answer['updated_by']) && !empty($arr_answer['created']) && !empty($arr_answer['created_by'])): ?>
			<div class="card-body bg-transparent pd-0 bd-gray-200 mg-t-auto">
				<div class="row no-gutters tx-center">
					<?php if (!empty($arr_answer['updated']) && !empty($arr_answer['updated_by'])): ?>
					<div class="col pd-y-15">
						<p class="mg-b-5 tx-uppercase tx-12 tx-mont tx-semibold">Terakhir Diubah</p>
						<h4 class="tx-16 tx-bold mg-b-0 tx-inverse">
							<?=strtoupper($arr_answer['updated_by']);?>
						</h4>
						<span class="tx-12 tx-primary tx-roboto">
							<?=timestamp_to_date($arr_answer['updated']);?>
						</span>
					</div>
					<?php endif;?>


					<div class="col pd-y-15 bd-l bd-gray-200">
						<?php if (!empty($arr_answer['created']) && !empty($arr_answer['created_by'])): ?>
						<p class="mg-b-5 tx-uppercase tx-12 tx-mont tx-semibold">Dibuat</p>
						<h4 class="tx-16 tx-inverse tx-bold mg-b-0">
							<?=strtoupper($arr_answer['created_by']);?>
						</h4>
						<span class="tx-12 tx-primary tx-roboto">
							<?=timestamp_to_date($arr_answer['created']);?>
						</span>
					</div>
					<?php endif;?>
				</div>
			</div>
			<?php endif;?>
		</div>

        <?php include ROOT."app/theme/change_log.php";?>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	get_action_log();

	$('#form-update').on('submit', function(event){
		event.preventDefault();
		var request 	= '?do=<?=$_GET['update'] . '&act=update&question_id=' . $_GET['question_id'] . '&answer_id=' . $_GET['answer_id'];?>',
			form 		= $(this),
            data    	= new FormData(this);

		loading(form, 'show');
        $.ajax({
            type: 'POST',
            url: request,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                init_meta(result.meta);
				get_action_log();
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