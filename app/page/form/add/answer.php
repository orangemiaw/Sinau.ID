<?php
defined('SINAUID') OR exit('No direct script access allowed');

// Chcek role and block if not have access role
if (!isset($_SESSION['role']->{$_GET['add']}->add)) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=" . $_GET['add']);
    return;
}

$title = "Add Answer";
include ROOT."app/theme/header.php";
include PATH_MODEL . 'model_question.php';

$m_question    = new model_question($db);
$arr_question  = $m_question->get_results(array(), 'all');

?>
<div class="br-mainpanel">
    <div class="br-pagetitle">
        <h4><?=isset($title) ? $title : 'Untitled';?></h4>
    </div>
    <div class="br-pagebody">

    <!-- Main content -->
	<div class="row">
		<div class="col-md-12">
			<form id="form-update" class="card shadow-base bd-0">
				<div class="card-body">
					<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Question </label>
                                <select id="select-brand" name="cbGroup" class="form-control select-two" data-placeholder="-- Select --" >
                                    <option></option>
                                    <?php foreach ($arr_question as $value): ?>
                                        <option value="<?php print $value['question_id'];?>" >
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
								<input type="text" name="txtAnswer" class="form-control" required autofocus>
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
									<option value="1">A</option>
									<option value="2">B</option>
									<option value="3">C</option>
									<option value="4">D</option>
									<option value="5">E</option>
								</select>
								<ul class="fields-message"></ul>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group mg-b-0">
								<label class="form-control-label">Status: <span class="tx-danger">*</span></label>
								<select class="form-control select-two" name="cbStatus" data-placeholder=" -- Pilih Status --" required>
									<option></option>
									<option value="<?=ANSWER_CORRECT;?>">Correct</option>
									<option value="<?=ANSWER_INCORRECT;?>">Incorrect</option>
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
	</div>


<script type="text/javascript">
$(document).ready(function() {
	$('#form-update').on('submit', function(event){
		event.preventDefault();
		var request 	= '<?=$_GET['add'] . '&act=add';?>',
			form 		= $(this);

		loading(form, 'show');
		ajax_post(request, form.serialize(), function(result) {

			init_meta(result.meta);
			loading(form, 'hide');
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