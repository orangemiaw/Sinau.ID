<?php
defined('SINAUID') OR exit('No direct script access allowed');

// Chcek role and block if not have access role
if (!isset($_SESSION['role']->{$_GET['add']}->add)) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=" . $_GET['add']);
    return;
}

$title = "Add Participant";
include ROOT."app/theme/header.php";
include PATH_MODEL . 'model_regencie.php';
include PATH_MODEL . 'model_province.php';
include PATH_MODEL . 'model_participant_group.php';

$m_regencie 	= new model_regencie($db);
$m_province 	= new model_province($db);
$m_group 	    = new model_participant_group($db);
$arr_regencie	= $m_regencie->get_results(array(), 'all');
$arr_province	= $m_province->get_results(array(), 'all');
$arr_group	    = $m_group->get_results(array(), 'all');

?>
<div class="br-mainpanel">
    <div class="br-pagetitle">
        <h4><?=isset($title) ? $title : 'Untitled';?></h4>
    </div>
    <div class="br-pagebody">

    <!-- Main content -->
	<div class="row">
		<div class="col-md-12">
			<form id="form-add" class="card shadow-base bd-0">
				<div class="card-body">
					<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Card ID Photo (KTP/SIM/KTM) </label>
                                <div class="custom-file">
                                    <input type="file" name="image_file" class="custom-file-input" id="customFile" placeholder="Choose file" required autofocus>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Full Name </label>
                                <input class="form-control" type="text" name="txtFullName" placeholder="Full Name">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Login </label>
                                <input class="form-control" type="text" name="txtLogin" placeholder="Login">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Participant Group </label>
                                <select id="select-brand" name="cbGroup" class="form-control select-two" data-placeholder="-- Select --" >
                                    <option></option>
                                    <?php foreach ($arr_group as $value): ?>
                                        <option value="<?php print $value['participant_group_id'];?>" >
                                            <?php print $value['participant_group_name'];?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Email </label>
                                <input class="form-control" type="email" name="txtEmail" placeholder="Email">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Password </label>
                                <input class="form-control" type="password" name="txtPassword" placeholder="Password">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Repeat Password </label>
                                <input class="form-control" type="password" name="txtRepeatPassword" placeholder="Repeat Password">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Address </label>
                                <input class="form-control" type="text" name="txtAddress" placeholder="Address">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Province </label>
                                <select id="select-brand" name="cbProvince" class="form-control select-two" data-placeholder="-- Select --" >
                                    <option></option>
                                    <?php foreach ($arr_province as $value): ?>
                                        <option value="<?php print $value['province_id'];?>" >
                                            <?php print $value['name'];?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Regencie </label>
                                <select id="select-brand" name="cbRegencie" class="form-control select-two" data-placeholder="-- Select --" >
                                    <option></option>
                                    <?php foreach ($arr_regencie as $value): ?>
                                        <option value="<?php print $value['regencie_id'];?>" >
                                            <?php print $value['name'];?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Postal Code </label>
                                <input class="form-control" type="text" name="txtPostalCode" placeholder="Postal Code">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Telephone </label>
                                <input class="form-control" type="text" name="txtTelephone" placeholder="Telephone">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
						<div class="col-md-6">
							<div class="form-group mg-b-0">
								<label class="form-control-label">Status: <span class="tx-danger">*</span></label>
								<select class="form-control select-two" name="cbStatus" data-placeholder=" -- Pilih Status --" required>
									<option></option>
									<option value="<?=STATUS_ENABLE;?>">Enable</option>
									<option value="<?=STATUS_DISABLE;?>">Disable</option>
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
	$('#form-add').on('submit', function(event){
		event.preventDefault();
		var request 	= '?do=<?=$_GET['add'] . '&act=add';?>',
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