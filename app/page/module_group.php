<?php
$title = "Module Group";
include ROOT."app/theme/header.php";
require_once PATH_MODEL . 'model_module_group.php';

$name   = isset($_GET['txtName']) ? $_GET['txtName'] : false;
$status = isset($_GET['cbStatus']) ? $_GET['cbStatus'] : false;

if($name)
    $where['module_group_name'] = $name;
if($status)
    $where['module_group_status'] = $status;

$m_module_group     = new model_module_group($db);
$page_number        = is_numeric($_GET['hal']) ? $_GET['hal'] : 1;
$data_per_page      = 20;
$total_rows         = $m_module_group->total_rows($where);
$arr_module_group   = $m_module_group->get_results($where, $page_number, $data_per_page);
?>
    <div class="br-mainpanel">
		<div class="br-pagetitle">
			<h4><?=isset($title) ? $title : 'Untitled';?></h4>
		</div>
		<div class="br-pagebody">

        <!-- Main content -->
        <?=$GLOBALS['notice']->showSuccess();?>
        <?=$GLOBALS['notice']->showError();?>

        <div class="card bd-0 shadow-base pd-15">
            <div class="bg-gray-300 bd pd-15 mg-b-15">
                <strong style="color:#343a40;">Menu Filter</strong>
            </div>
            <div class="bg-gray-300 bd pd-15 mg-b-15 rounded">
                <form method="GET" action="<?=HTTP;?>">
                    <input type="hidden" name="page" value="module_group">
                    <div class="row row-sm">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label">Group Name</label>
                                <input type="text" name="txtName" class="form-control" placeholder="Group Name" value="<?=!empty($_GET['txtName']) ? $_GET['txtName'] : '';?>">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label">Status</label>
                                <select name="cbStatus" class="form-control select2" data-placeholder="-- Pilih Status --">
                                    <option value="">All</option>
                                    <option value="<?=STATUS_ENABLE;?>" <?php echo set_select(STATUS_ENABLE, $_GET['cbStatus']); ?>>Enabled</option>
                                    <option value="<?=STATUS_DISABLE;?>" <?php echo set_select(STATUS_DISABLE, $_GET['cbStatus']); ?>>Disabled</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-block btn-primary mg-t-30">
                                <i class="ion ion-md-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="card-block mg-b-15">

                <?php if (isset($_SESSION['role']->{$_GET['page']}->add)): ?>
                    <a href="<?=HTTP.'?add=module_group';?>" class="btn btn-primary">
                        <i class="ion ion-md-add-circle-outline"></i> ADD
                    </a>
                <?php endif;?>

            </div>

            <?php if (!empty($arr_module_group)): ?>

                <div class="bd bd-gray-300 rounded table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="min-w align-middle">Created<br>Updated</th>
                                <th class="align-middle">Group Name</th>
                                <th class="text-center align-middle">Status</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($arr_module_group as $value): ?>
                            <tr>
                                <td class="min-w">

                                    <?php if ($value['created'] != $value['updated']): ?>

                                        <strong><?=strtoupper($value['updated_by']);?></strong>
                                        <br>
                                        <?=timestamp_to_date($value['updated']);?>
                                        <hr>

                                    <?php endif;?>

                                    <strong><?=strtoupper($value['created_by']);?></strong>
                                    <br>
                                    <?=timestamp_to_date($value['created']);?>

                                </td>
                                <td class="align-middle">
                                    <strong><?=strtoupper($value['module_group_name']);?></strong>
                                </td>
                                <td class="align-middle text-center">
                                    <?php if ($value['module_group_status'] == STATUS_ENABLE): ?>
                                        <span class="badge badge-success">Enable</span>
                                    <?php elseif ($value['module_group_status'] == STATUS_DISABLE): ?>
                                        <span class="badge badge-info">Disable</span>
                                    <?php endif;?>
                                </td>
                                <td class="min-w text-center align-middle">
                                    <?php if (isset($_SESSION['role']->{$_GET['page']}->update)): ?>
                                        <a href="<?=HTTP . '?update=module_group&id=' . $value['module_group_id']*1909;?>" class="btn btn-outline-primary btn-icon rounded-circle" data-toggle="tooltip" data-placement="bottom" title="Ubah">
                                            <div class="tx-20"><i class="icon ion-md-create"></i></div>
                                        </a>
                                    <?php endif;?>

                                    <?php if (isset($_SESSION['role']->{$_GET['page']}->detail)): ?>
                                        <a href="<?=HTTP . '?detail=module_group&id=' . $value['module_group_id']*1909;?>" class="btn btn-outline-info btn-icon rounded-circle" data-toggle="tooltip" data-placement="bottom" title="Detail">
                                            <div class="tx-20"><i class="icon ion-md-camera"></i></div>
                                        </a>
                                    <?php endif;?>
                                    
									<?php if (isset($_SESSION['role']->{$_GET['page']}->delete) && $value['module_group_name'] != 'Super Admin'): ?>
									<a href="javascript:;" onclick="deleteConfirm('<?=HTTP . '?do=module_group&act=delete&id=' . $value['module_group_id']*1909;?>');" class="btn btn-outline-danger btn-icon rounded-circle" data-toggle="tooltip" data-placement="bottom" title="Delete">
										<div class="tx-20"><i class="ion ion-md-trash"></i></div>
									</a>
									<?php endif;?>
                                </td>
                            </tr>

                            <?php endforeach;?>

                        </tbody>
                    </table>
                </div>


                <?php if($total_rows > $data_per_page): ?>
                    <div class="ht-80 d-flex align-items-center justify-content-center">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-primary pagination-circle mg-b-0">
                                <?php
                                $pagination = new pagination($data_per_page);
                                $pagination->pagination($total_rows, HTTP . "?page=" . $_GET['page']);
                                ?>
                            </ul>
                        </nav>
                    </div>
                <?php endif;?>

            <?php else: ?>

            <div class="mg-t-30">
                <h3 class="text-center">No record found.</h3><br>
            </div>

            <?php endif;?>

        </div>

        <script>
            function deleteConfirm(link){
                Swal({
                    title: 'Are you sure?',
                    text: "You will not be able to return this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete this!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.value) {
                        location.href = link;
                    }
                })
            }
        </script>

        <!-- End of main content -->

			<footer class="br-footer">
				<div class="footer-left">
				</div>
				<div class="footer-right d-flex align-items-center">
				</div>
			</footer>
		</div>
    </div>
<?php include ROOT."app/theme/footer.php";?>