<?php
defined('SINAUID') OR exit('No direct script access allowed');

// Chcek role and block if not have access role
if (!isset($_SESSION['role']->account_profile->detail)) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=dashboard");
    return;
}

$title = "Personal Info";
include ROOT."app/theme/header.php";

if($_SESSION['is_admin']) {
    include PATH_MODEL . 'model_admin.php';
    $m_admin = new model_admin($db);
    $arr_data = $m_admin->get_row(array("admin_id" => $_SESSION['id']));
} else {
    include PATH_MODEL . 'model_participant.php';
    $m_participant = new model_participant($db);
    $arr_data = $m_participant->get_row(array("participant_id" => $_SESSION['id']));
}

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
            <?php if(isset($_SESSION['is_admin'])):?>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">Full Name </label>
							<input class="form-control" type="text" value="<?=$arr_data['admin_name'];?>" readonly>
							<ul class="fields-message"></ul>
						</div>
                    </div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">Group Name </label>
							<input class="form-control" type="text" value="<?=$arr_data['admin_group_name'];?>" readonly>
							<ul class="fields-message"></ul>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">Login </label>
							<input class="form-control" type="text" value="<?=$arr_data['admin_login'];?>" readonly>
							<ul class="fields-message"></ul>
						</div>
                    </div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">Email </label>
							<input class="form-control" type="text" value="<?=$arr_data['admin_email'];?>" readonly>
							<ul class="fields-message"></ul>
						</div>
                    </div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">Last Login </label>
							<input class="form-control" type="text" value="<?=timestamp_to_date($arr_data['admin_last_login']);?>" readonly>
							<ul class="fields-message"></ul>
						</div>
                    </div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">Last IP </label>
							<input class="form-control" type="text" value="<?=$arr_data['admin_last_ip'];?>" readonly>
							<ul class="fields-message"></ul>
						</div>
                    </div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">Last Browser </label>
                            <textarea class="form-control" type="text" cols="40" readonly><?=$arr_data['admin_last_browser'];?></textarea>
							<ul class="fields-message"></ul>
						</div>
                    </div>
                </div>
            <?php else:?>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">Card ID Photo </label>
                            <div class="custom-file">
                                <input type="file" name="image_file" class="custom-file-input" id="customFile" placeholder="Choose file" required autofocus>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
							<ul class="fields-message"></ul>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">Full Name </label>
							<input class="form-control" type="text" name="txtFullName" value="<?=$arr_data['participant_name'];?>">
							<ul class="fields-message"></ul>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">Address </label>
							<input class="form-control" type="text" name="txtAddress" value="<?=$arr_data['address'];?>">
							<ul class="fields-message"></ul>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">Regencie </label>
							<select id="select-brand" name="cbUserGroup" class="form-control select-two" data-placeholder="-- Select --" >
								<option></option>
								<?php foreach ($arr_user_group as $value): ?>
									<option value="<?php print $value->user_group_id;?>" >
										<?php print $value->user_group_name;?>
									</option>
								<?php endforeach;?>
							</select>

							<input class="form-control" type="text" name="txtRegencie" value="<?=$arr_data['regencie'];?>">
							<ul class="fields-message"></ul>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">Province </label>
							<input class="form-control" type="text" name="txtProvince" value="<?=$arr_data['province'];?>">
							<ul class="fields-message"></ul>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">Postal Code </label>
							<input class="form-control" type="text" name="txtPostalCode" value="<?=$arr_data['postal_code'];?>">
							<ul class="fields-message"></ul>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">Telephone </label>
							<input class="form-control" type="text" name="txtTelephone" value="<?=$arr_data['telephone'];?>">
							<ul class="fields-message"></ul>
						</div>
					</div>
				</div>
            <?php endif;?>
			</div>
		<div class="card-footer bd-color-gray-lighter text-right">
			<button type="submit" class="btn btn-primary tx-size-xs ">Submit</button>
		</div>

		</form>

	</div>

	<div class="col-md-5 col-sm-12 mg-t-20 mg-md-t-0">

		<div class="card shadow-base bd-0 mg-b-20">
			<?php if (!empty($arr_data['updated']) && !empty($arr_data['updated_by']) && !empty($arr_data['created']) && !empty($arr_data['created_by'])): ?>
			<div class="card-body bg-transparent pd-0 bd-gray-200 mg-t-auto">
				<div class="row no-gutters tx-center">
					<?php if (!empty($arr_data['updated']) && !empty($arr_data['updated_by'])): ?>
					<div class="col pd-y-15">
						<p class="mg-b-5 tx-uppercase tx-12 tx-mont tx-semibold">Terakhir Diubah</p>
						<h4 class="tx-16 tx-bold mg-b-0 tx-inverse">
							<?=strtoupper($arr_data['updated_by']);?>
						</h4>
						<span class="tx-12 tx-primary tx-roboto">
							<?=timestamp_to_date($arr_data['updated']);?>
						</span>
					</div>
					<?php endif;?>


					<div class="col pd-y-15 bd-l bd-gray-200">
						<?php if (!empty($arr_data['created']) && !empty($arr_data['created_by'])): ?>
						<p class="mg-b-5 tx-uppercase tx-12 tx-mont tx-semibold">Dibuat</p>
						<h4 class="tx-16 tx-inverse tx-bold mg-b-0">
							<?=strtoupper($arr_data['created_by']);?>
						</h4>
						<span class="tx-12 tx-primary tx-roboto">
							<?=timestamp_to_date($arr_data['created']);?>
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
		var request 	= '<?=$_GET['page'] . '&act=update&id=' . $_SESSION['id']*1909;?>',
			form 		= $(this);

		loading(form, 'show');
		ajax_post(request, form.serialize(), function(result) {

			init_meta(result.meta);
			get_action_log();
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