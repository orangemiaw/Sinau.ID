<?php
defined('SINAUID') OR exit('No direct script access allowed');

// Chcek role and block if not have access role
if (!isset($_SESSION['role']->{$_GET['add']}->add)) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=" . $_GET['add']);
    return;
}

$title = "Add Admin Group";
include ROOT."app/theme/header.php";
include 'system/admin_rules.php';
$arr_available_role = $config;

?>
<div class="br-mainpanel">
    <div class="br-pagetitle">
        <h4><?=isset($title) ? $title : 'Untitled';?></h4>
    </div>
    <div class="br-pagebody">

    <!-- Main content -->
<div class="row">
	<div class="col-md-12">
    <form id="form-admin-group-update" class="card shadow-base bd-0">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group mg-b-0">
						<label class="form-control-label">Group Name: <span class="tx-danger">*</span></label>
						<input type="text" name="txtGroupName" class="form-control" required autofocus>
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
											<input type="checkbox" name="cbxGroupRoles[<?=$controller;?>][<?=$method['key'];?>]"  value="1">
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
</div>


<script type="text/javascript">
$(document).ready(function() {
	$('#form-admin-group-update').on('submit', function(event){
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