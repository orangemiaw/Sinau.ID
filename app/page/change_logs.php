<?php
$title = "Change Log";
include ROOT."app/theme/header.php";
require_once PATH_MODEL . 'model_change_log.php';

$name   = isset($_GET['txtName']) ? $_GET['txtName'] : false;
$status = isset($_GET['cbStatus']) ? $_GET['cbStatus'] : false;

if($name)
    $where['change_log_name'] = $name;
if($status)
    $where['change_log_status'] = $status;

$m_change_log   = new model_change_log($db);
$page_number    = is_numeric($_GET['hal']) ? $_GET['hal'] : 1;
$data_per_page  = 20;
$total_rows     = $m_change_log->total_rows($where);
$arr_change_log = $m_change_log->get_results($where, $page_number, $data_per_page);
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
                            <label class="form-control-label">Created By</label>
                            <input class="form-control" type="text" name="txtCreatedBy" value="<?=!empty($_GET['txtCreatedBy']) ? $_GET['txtCreatedBy'] : '';?>" placeholder="Created By">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-control-label">Page</label>
                            <input class="form-control" type="text" name="txtPage" value="<?=!empty($_GET['txtPage']) ? $_GET['txtPage'] : '';?>" placeholder="Page">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-control-label">Action</label>
                            <input class="form-control" type="text" name="txtAction" value="<?=!empty($_GET['txtAction']) ? $_GET['txtAction'] : '';?>" placeholder="Action">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-control-label">IP Address</label>
                            <input class="form-control" type="text" name="txtIP" value="<?=!empty($_GET['txtIP']) ? $_GET['txtIP'] : '';?>" placeholder="IP Address">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-control-label">From Date</label>
                            <div class="input-group">
                                <input name="txtDateFrom" autocomplete="off" type="text" class="form-control fc-datepicker" value="<?=!empty($_GET['txtDateFrom']) ? $_GET['txtDateFrom'] : '';?>" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-control-label">To Date</label>
                            <div class="input-group">
                                <input name="txtDateTo" autocomplete="off" type="text" class="form-control fc-datepicker" value="<?=!empty($_GET['txtDateTo']) ? $_GET['txtDateTo'] : '';?>" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                    </div>
                </div>

			<div class="row">
				<div class="col-lg-12">
					<div class="d-flex mg-xs-t-0 btn-action-table">
						<button type="submit" class="btn btn-primary btn-oblong mg-r-5" >
							<div><i class="fa fa-search"></i> Search </div>
						</button>
						<a href="<?=HTTP . '?page=' . $_GET['page'];?>" class="btn btn-secondary btn-icon rounded-circle" data-toggle="tooltip" data-placement="right" title="Clear Filter">
							<div><i class="ion ion-md-trash"></i></div>
						</a>
					</div>
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

        <?php if (!empty($arr_change_log)): ?>

            <div class="bd bd-gray-300 rounded table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="align-middle">Date</th>
                            <th class="align-middle">Created By</th>
                            <th class="align-middle">Page</th>
                            <th class="align-middle">Action</th>
                            <th class="align-middle">IP Address</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($arr_change_log as $value): ?>
                        <tr>
                            <td class="align-middle">
                                <?php print timestamp_to_date($value['created']);?>
                            </td>
                            <td class="align-middle">
                                <?php print $value['created_by'];?>
                            </td>
                            <td class="align-middle">
                                <?php print $value['controller'];?>
                            </td>
                            <td class="align-middle">
                                <?php print $value['action'];?>
                            </td>
                            <td class="align-middle">
                                <?php print $value['ip'];?>
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
                            <ul class="pagination pagination-primary pagination-circle mg-b-0">
                                <?php
                                $pagination = new pagination($data_per_page);
                                $pagination->pagination($total_rows, HTTP . "?page=" . $_GET['page']);
                                ?>
                            </ul>
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

        <script>
            $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true
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