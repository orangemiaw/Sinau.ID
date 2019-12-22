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

$title = "Update Admin Group";
include ROOT."app/theme/header.php";
include PATH_MODEL . 'model_admin_group.php';
include 'system/admin_rules.php';

$arr_available_role = $config;
$m_admin_group      = new model_admin_group($db);
$arr_admin_group    = $m_admin_group->get_row(array("admin_group_id" => $_GET['id']/1909));
$arr_role           = json_decode($arr_admin_group['admin_group_role']);

?>
<div class="br-mainpanel">
    <div class="br-pagetitle">
        <h4><?=isset($title) ? $title : 'Untitled';?></h4>
    </div>
    <div class="br-pagebody">

<div class="row">
	<div class="col-md-7 col-sm-12">

    <form id="form-admin-group-update" class="card shadow-base bd-0">

		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">Group Name: <span class="tx-danger">*</span></label>
						<input type="text" name="txtGroupName" value="<?=$arr_admin_group['admin_group_name'];?>" class="form-control" required>
						<ul class="fields-message"></ul>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">Status: <span class="tx-danger">*</span></label>
						<select class="form-control select-two" name="cbStatus" data-placeholder=" -- Pilih Status -- " required="required">
							<option></option>
							<option value="<?=STATUS_ENABLE;?>" <?php echo set_select(STATUS_ENABLE, $arr_admin_group['admin_group_status']); ?>>Enable</option>
							<option value="<?=STATUS_DISABLE;?>" <?php echo set_select(STATUS_DISABLE, $arr_admin_group['admin_group_status']); ?>>Disable</option>
						</select>
						<ul class="fields-message"></ul>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group mg-t-20">
						<div class="row">

							<?php foreach ($arr_available_role as $controller => $value): ?>

							<div class="col-md-4">
								<h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-20"></h6>
								<label class="ckbox ckbox-danger">
									<input type="checkbox" class="mark-all-ingroup"><span class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-20"><?=$value['name'];?></span>
								</label>

								<ul class="role-group-list list-group list-group-striped">
									<?php foreach ($value['methods'] as $method): ?>
									<li class="list-group-item rounded-top-0">
										<label class="ckbox mg-b-0">
											<input type="checkbox" name="cbxGroupRoles[<?=$controller;?>][<?php print $method['key'];?>]"  value="1" <?php echo set_checkbox($arr_role->{$controller}->{$method['key']}); ?> >
											<span><strong class="tx-inverse tx-medium"><?=$method['name'];?></strong></span>
										</label>
									</li>
									<?php endforeach;?>
								</ul>
							</div>

							<?php endforeach;?>

						</div>
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
			<?php if (!empty($arr_admin_group['updated']) && !empty($arr_admin_group['updated_by']) && !empty($arr_admin_group['created']) && !empty($arr_admin_group['created_by'])): ?>
			<div class="card-body bg-transparent pd-0 bd-gray-200 mg-t-auto">
				<div class="row no-gutters tx-center">
					<?php if (!empty($arr_admin_group['updated']) && !empty($arr_admin_group['updated_by'])): ?>
					<div class="col pd-y-15">
						<p class="mg-b-5 tx-uppercase tx-12 tx-mont tx-semibold">Terakhir Diubah</p>
						<h4 class="tx-16 tx-bold mg-b-0 tx-inverse">
							<?=strtoupper($arr_admin_group['updated_by']);?>
						</h4>
						<span class="tx-12 tx-primary tx-roboto">
							<?=timestamp_to_date($arr_admin_group['updated']);?>
						</span>
					</div>
					<?php endif;?>


					<div class="col pd-y-15 bd-l bd-gray-200">
						<?php if (!empty($arr_admin_group['created']) && !empty($arr_admin_group['created_by'])): ?>
						<p class="mg-b-5 tx-uppercase tx-12 tx-mont tx-semibold">Dibuat</p>
						<h4 class="tx-16 tx-inverse tx-bold mg-b-0">
							<?=strtoupper($arr_admin_group['created_by']);?>
						</h4>
						<span class="tx-12 tx-primary tx-roboto">
							<?=timestamp_to_date($arr_admin_group['created']);?>
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

	$('#form-admin-group-update').on('submit', function(event){
		event.preventDefault();
		var request 	= '<?=$_GET['update'] . '&act=update&id=' . $_GET['id'];?>',
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