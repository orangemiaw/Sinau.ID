<?php
$title = "Payment History";
include ROOT."app/theme/header.php";
require_once PATH_MODEL . 'model_payment.php';

$name   = isset($_GET['cbPayment']) ? $_GET['cbPayment'] : false;
$status = isset($_GET['cbStatus']) ? $_GET['cbStatus'] : false;

if($_SESSION['is_admin'] == false) {
    $where['participant_id'] = $_SESSION['id'];
}

if($name)
    $where['payment_method'] = $name;
if($status)
    $where['payment_status'] = $status;

$m_payment      = new model_payment($db);
$page_number    = is_numeric($_GET['hal']) ? $_GET['hal'] : 1;
$data_per_page  = 20;
$total_rows     = $m_payment->total_rows($where);
$arr_payment    = $m_payment->get_results($where, $page_number, $data_per_page);
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
                    <input type="hidden" name="page" value="payment">
                    <div class="row row-sm">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label">Payment Status :</label>
                                <input name="txtStatus" value="<?=!empty($_GET['txtStatus']) ? $_GET['txtStatus'] : '';?>" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label">Payment Method :</label>
                                <select name="cbPayment" class="form-control select2" data-placeholder="-- Pilih Status --">
                                    <option value="">All</option>
                                    <option value="<?=PAYPAL_PAYMENT_METHOD;?>" <?php echo set_select(PAYPAL_PAYMENT_METHOD, $_GET['cbPayment']); ?>>PayPal</option>
                                    <option value="<?=OVO_PAYMENT_METHOD;?>" <?php echo set_select(OVO_PAYMENT_METHOD, $_GET['cbPayment']); ?>>OVO</option>
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

            <?php if (!empty($arr_payment)): ?>

                <div class="bd bd-gray-300 rounded table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="col-align-middle">
                                <th>Updated<br>Created</th>
                                <th>Transaction ID</th>
                                <th>Invoice ID</th>
                                <th class="text-center">Payment Method</th>
                                <th>Payment Amount</th>
                                <th class="text-center">Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($arr_payment as $value): ?>
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
                                        <?php if ($value['payment_method'] == PAYPAL_PAYMENT_METHOD): ?>
                                            <a target="_blank" href="https://www.paypal.com/activity/payment/<?php print $value['transaction_id'];?>"><?php print $value['transaction_id'];?></a>
                                        <?php elseif ($value['payment_method'] == OVO_PAYMENT_METHOD): ?>
                                            <?php print $value['transaction_id'];?>
                                        <?php endif;?>
                                    </td>
                                    <td class="align-middle">
                                        #<?php print $value['invoice_id'];?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?php if ($value['payment_method'] == PAYPAL_PAYMENT_METHOD): ?>
                                            <span class="badge badge-info">PayPal</span>
                                        <?php elseif ($value['payment_method'] == OVO_PAYMENT_METHOD): ?>
                                            <span class="badge badge-danger">OVO</span>
                                        <?php endif;?>
                                    </td>
                                    <td class="align-middle">
                                        <?php print convert_to_rupiah($value['payment_amount'] * RATE_USD_TO_IDR);?>
                                    </td>
                                    <td class="align-middle tx-center">
                                        <?php if (strtoupper($value['payment_status']) == 'APPROVED'): ?>
                                            <span class="badge badge-success"><?php print strtoupper($value['payment_status']);?></span>
                                        <?php else: ?>
                                            <span class="badge badge-danger"><?php print strtoupper($value['payment_status']);?></span>
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
            function terminateConfirm(link){
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