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

$title = "Update Participant";
include ROOT."app/theme/header.php";
include PATH_MODEL . 'model_regencie.php';
include PATH_MODEL . 'model_province.php';
include PATH_MODEL . 'model_participant.php';
include PATH_MODEL . 'model_participant_group.php';

$m_regencie 	= new model_regencie($db);
$m_province 	= new model_province($db);
$m_participant 	= new model_participant($db);
$m_group 	    = new model_participant_group($db);
$arr_data 		= $m_participant->get_row(array("participant_id" => $_GET['id']/1909));
if(!$arr_data) {
    $notice->addError("Data not found in our database !");
    header("location:".HTTP."?page=" . $_GET['update']);
    return;
}
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
    	<div class="col-md-7 col-sm-12">
			<form id="form-update" class="card shadow-base bd-0">
				<div class="card-body">
					<div class="row">
                        <div class="col-md-12 tx-center">
                            <div class="form-group">
                                <label class="form-control-label">Current Photo </label><br />
                                <img src="<?=$arr_data['profile_image'] ? HTTP . $arr_data['profile_image'] : HTTP . DEFAULT_PROFILE_IMAGE;?>" width="300" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Card ID Photo (KTP/SIM/KTM) </label>
                                <div class="custom-file">
                                    <input type="file" name="image_file" class="custom-file-input" id="customFile" placeholder="Choose file" autofocus>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Full Name </label>
                                <input class="form-control" type="text" name="txtFullName" placeholder="Full Name" value="<?=$arr_data['participant_name'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Login </label>
                                <input class="form-control" type="text" name="txtLogin" placeholder="Login" value="<?=$arr_data['participant_login'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Participant Group </label>
                                <select id="select-brand" name="cbGroup" class="form-control select-two" data-placeholder="-- Select --" >
                                    <option></option>
                                    <?php foreach ($arr_group as $value): ?>
                                        <option value="<?php print $value['participant_group_id'];?>" <?=set_select($value['participant_group_id'], $arr_data['participant_group_id']);?> >
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
                                <input class="form-control" type="email" name="txtEmail" placeholder="Email" value="<?=$arr_data['participant_email'];?>">
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
                                <input class="form-control" type="text" name="txtAddress" placeholder="Address" value="<?=$arr_data['address'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Province </label>
                                <select id="select-brand" name="cbProvince" class="form-control select-two" data-placeholder="-- Select --" >
                                    <option></option>
                                    <?php foreach ($arr_province as $value): ?>
                                        <option value="<?php print $value['province_id'];?>" <?=set_select($value['province_id'], $arr_data['province']);?> >
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
                                        <option value="<?php print $value['regencie_id'];?>" <?=set_select($value['regencie_id'], $arr_data['regencie']);?> >
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
                                <input class="form-control" type="text" name="txtPostalCode" placeholder="Postal Code" value="<?=$arr_data['postal_code'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Telephone </label>
                                <input class="form-control" type="text" name="txtTelephone" placeholder="Telephone" value="<?=$arr_data['telephone'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
						<div class="col-md-6">
							<div class="form-group mg-b-0">
								<label class="form-control-label">Status: <span class="tx-danger">*</span></label>
								<select class="form-control select-two" name="cbStatus" data-placeholder=" -- Pilih Status --" required>
									<option></option>
									<option value="<?=STATUS_ENABLE;?>" <?=set_select(STATUS_ENABLE, $arr_data['participant_status']);?>>Enable</option>
									<option value="<?=STATUS_DISABLE;?>" <?=set_select(STATUS_DISABLE, $arr_data['participant_status']);?>>Disable</option>
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