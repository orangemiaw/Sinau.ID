<?php
defined('SINAUID') OR exit('No direct script access allowed');

// Chcek role and block if not have access role
if (!isset($_SESSION['role']->{$_GET['detail']}->detail)) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=" . $_GET['detail']);
    return;
}

if(!isset($_GET['id']) || empty($_GET['id'])) {
    $notice->addError("Parameter id can't be empty !");
    header("location:".HTTP."?page=" . $_GET['detail']);
    return; 
}

$title = "Detail Module";
include ROOT."app/theme/header.php";
include PATH_MODEL . 'model_module.php';

$m_module   = new model_module($db);
$arr_module = $m_module->get_row(array("module_id" => $_GET['id']/1909));
if(!$arr_module) {
    $notice->addError("Data not found in our database !");
    header("location:".HTTP."?page=" . $_GET['detail']);
    return;
}

?>
<div class="br-mainpanel">
    <div class="br-pagetitle">
        <h4><?=isset($title) ? $title : 'Untitled';?></h4>
    </div>
    <div class="br-pagebody">

<div class="row">
	<div class="col-md-12 col-sm-12">

    <form id="form-detail" class="card shadow-base bd-0">

		<div class="card-body">
			<div class="row">
                <div class="col-md-12 tx-center">
                    <div class="form-group">
                        <label class="form-control-label">Question Image </label><br />
                        <img src="<?=$arr_data['module_image'] ? HTTP . $arr_data['module_image'] : HTTP . UNAVAILABLE_IMAGE;?>" width="300" />
                    </div>
                </div>
				<div class="col-md-12">
					<div class="form-group">
						<label class="form-control-label">Module: </label>
						<input type="text" value="<?=$arr_module['module_text'];?>" class="form-control" disabled="disabled">
						<ul class="fields-message"></ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">Module Group: </label>
						<input type="text" value="<?=$arr_module['module_group_name'];?>" class="form-control" disabled="disabled">
						<ul class="fields-message"></ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">Module Type: </label>
						<input type="text" value="<?=$arr_module['module_type'];?>" class="form-control" disabled="disabled">
						<ul class="fields-message"></ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">Module Image URL: </label>
						<input type="text" value="<?=!empty($arr_module['module_image']) ? HTTP . '/' . $arr_module['module_image'] : 'No Image';?>" class="form-control" disabled="disabled">
						<ul class="fields-message"></ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">Module File URL: </label>
						<input type="text" value="<?=!empty($arr_module['module_file']) ? HTTP . '/' . $arr_module['module_file'] : 'No File';?>" class="form-control" disabled="disabled">
						<ul class="fields-message"></ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">Status: </label>
						<select class="form-control select-two" disabled="disabled" data-placeholder=" -- Pilih Status -- ">
							<option></option>
							<option value="<?=STATUS_ENABLE;?>" <?php echo set_select(STATUS_ENABLE, $arr_module['module_status']); ?>>Enable</option>
							<option value="<?=STATUS_DISABLE;?>" <?php echo set_select(STATUS_DISABLE, $arr_module['module_status']); ?>>Disable</option>
						</select>
						<ul class="fields-message"></ul>
					</div>
				</div>
			</div>
		</div>

		</form>

	</div>
</div>

<footer class="br-footer">
    <div class="footer-left">
    </div>
    <div class="footer-right d-flex align-items-center">
    </div>
</footer>
</div>
</div>
<?php include ROOT."app/theme/footer.php";?>