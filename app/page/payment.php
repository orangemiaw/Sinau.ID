<?php
$title = "Payment";
include ROOT."app/theme/header.php";
require_once PATH_MODEL . 'model_payment.php';

$name   = isset($_GET['txtName']) ? $_GET['txtName'] : false;
$status = isset($_GET['cbStatus']) ? $_GET['cbStatus'] : false;

if($name)
    $where['payment_name'] = $name;
if($status)
    $where['payment_status'] = $status;

$m_payment   = new model_payment($db);
$page_number            = is_numeric($_GET['hal']) ? $_GET['hal'] : 1;
$data_per_page          = 20;
$total_rows             = $m_payment->total_rows();
$arr_payment  = $m_payment->get_results($where, $page_number, $data_per_page);
?>

    <div class="br-mainpanel">
		<div class="br-pagetitle">
			<h4><?=isset($title) ? $title : 'Untitled';?></h4>
		</div>
		<div class="br-pagebody">

        <!-- Main content -->

        <?=$GLOBALS['notice']->showSuccess();?>
        <?=$GLOBALS['notice']->showError();?>

        

            

            <?php if (!empty($arr_payment)): ?>

                <div class="bd bd-gray-300 rounded table-responsive">
                    <table class="table">
                        <thead>
                           <tr>
                                <th class="min-w align-middle">Created<br>Updated</th>
                                <th class="align-middle text-center">Transaction</th>
                                <th class="text-center align-middle">Invoice</th>
                                <th class="text-center align-middle">Status</th>
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
                                <td class="align-middle text-center">
                                    <strong><?=($value['transaction_id']);?></strong>
                                </td>
                                <td class="align-middle text-center">
                                    <strong><?=($value['invoice_id']);?></strong>
                                </td>
                                <td class="align-middle text-center">
                                    <strong><?=($value['payment_status']);?></strong>
                                </td>
                                
                            </tr>

                            <?php endforeach;?>

                        </tbody>
                    </table>
                </div>


                <?php if($total_rows > $data_per_page): ?>
                    <div class="ht-80  d-flex align-items-center justify-content-center ">
                        <nav aria-label="Page navigation" style='list-style-type: none'>
                            <?php
                            $pagination = new pagination($data_per_page);
                            $pagination->pagination($total_rows, HTTP . "?page=" . $_GET['page']);
                            ?>
                        </nav>
                    </div>
                <?php endif;?>

            <?php else: ?>

            <div class="mg-t-30">
                <h3 class="text-center">No record found.</h3><br>
            </div>

            <?php endif;?>

        </div>


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