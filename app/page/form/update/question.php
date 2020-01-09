<?php
defined('SINAUID') OR exit('No direct script access allowed');

// Chcek role and block if not have access role
if (!isset($_SESSION['role']->{$_GET['update']}->update)) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=" . $_GET['update']);
    return;
}

if(!isset($_GET['id']) || empty($_GET['id'])) {
    $notice->addError("Parameter id can't be empty !");
    header("location:".HTTP."?page=" . $_GET['update']);
    return;
}

$title = "Update Question";
include ROOT."app/theme/header.php";
include PATH_MODEL . 'model_question.php';
include PATH_MODEL . 'model_question_type.php';

$m_question     = new model_question($db);
$m_type         = new model_question_type($db);
$arr_question   = $m_question->get_row(array("question_id" => $_GET['id']/1909));
if(!$arr_question) {
    $notice->addError("Data not found in our database !");
    header("location:".HTTP."?page=" . $_GET['detail']);
    return;
}
$arr_type  = $m_type->get_results(array(), 'all');

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
                                <label class="form-control-label">Question Image </label><br />
                                <img src="<?=$arr_question['question_image'] ? HTTP . $arr_question['question_image'] : HTTP . UNAVAILABLE_IMAGE;?>" width="300" />
                            </div>
                        </div>
                        <div class="col-md-12">
							<div class="form-group mg-b-0">
								<label class="form-control-label">Question Text: <span class="tx-danger">*</span></label>
								<input type="text" name="txtQuestion" class="form-control" value="<?=$arr_question['question_text'];?>" autofocus>
								<ul class="fields-message"></ul>
							</div>
						</div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Question Image </label>
                                <div class="custom-file">
                                    <input type="file" name="image_file" class="custom-file-input" id="customFile" placeholder="Choose file" autofocus>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Question Type <span class="tx-danger">*</span></label>
                                <select id="select-brand" name="cbGroup" class="form-control select-two" data-placeholder="-- Select --" >
                                    <option></option>
                                    <?php foreach ($arr_type as $value): ?>
                                        <option value="<?php print $value['question_type_id'];?>" <?=set_select_disable($value['question_type_id'], $arr_question['question_type_id']);?> >
                                            <?php print $value['question_type'] . ' (' . $value['question_group_name'] . ')';?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
						<div class="col-md-6">
							<div class="form-group mg-b-0">
								<label class="form-control-label">Status: <span class="tx-danger">*</span></label>
								<select class="form-control select-two" name="cbStatus" data-placeholder=" -- Pilih Status --" required>
									<option></option>
									<option value="<?=STATUS_ENABLE;?>" <?=set_select_disable(STATUS_ENABLE, $arr_question['question_status']);?>>Enable</option>
									<option value="<?=STATUS_DISABLE;?>" <?=set_select_disable(STATUS_DISABLE, $arr_question['question_status']);?>>Disable</option>
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
			<?php if (!empty($arr_question['updated']) && !empty($arr_question['updated_by']) && !empty($arr_question['created']) && !empty($arr_question['created_by'])): ?>
			<div class="card-body bg-transparent pd-0 bd-gray-200 mg-t-auto">
				<div class="row no-gutters tx-center">
					<?php if (!empty($arr_question['updated']) && !empty($arr_question['updated_by'])): ?>
					<div class="col pd-y-15">
						<p class="mg-b-5 tx-uppercase tx-12 tx-mont tx-semibold">Terakhir Diubah</p>
						<h4 class="tx-16 tx-bold mg-b-0 tx-inverse">
							<?=strtoupper($arr_question['updated_by']);?>
						</h4>
						<span class="tx-12 tx-primary tx-roboto">
							<?=timestamp_to_date($arr_question['updated']);?>
						</span>
					</div>
					<?php endif;?>


					<div class="col pd-y-15 bd-l bd-gray-200">
						<?php if (!empty($arr_question['created']) && !empty($arr_question['created_by'])): ?>
						<p class="mg-b-5 tx-uppercase tx-12 tx-mont tx-semibold">Dibuat</p>
						<h4 class="tx-16 tx-inverse tx-bold mg-b-0">
							<?=strtoupper($arr_question['created_by']);?>
						</h4>
						<span class="tx-12 tx-primary tx-roboto">
							<?=timestamp_to_date($arr_question['created']);?>
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
		var request 	= '?do=<?=$_GET['update'] . '&act=update&id=' . $_GET['id'];?>',
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