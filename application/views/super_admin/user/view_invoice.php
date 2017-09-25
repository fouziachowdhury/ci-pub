<div class="row">
    

    <div class="col-md-12">
        <div class="col-xs-12">
        <div class="invoice-title">
            <h2>Invoice of <?php echo $invoice_details[0]['member_name'];?></h2>
            <!--<h2>Invoice Code <?php echo $invoice_details[0]['invoice_code'];?></h2>-->
        </div>
        <hr>
        
        <div class="row">
            <div class="col-xs-6">
                <address>
                    <strong>Payment Method:</strong><br>
                    <?php echo $invoice_details[0]['name'];?><br>
                    <?php echo $invoice_details[0]['email'];?>
                </address>
            </div>
            <div class="col-xs-6 text-right">
                <address>
                    <strong>Invoice Date:</strong><br>
                    <?php $timestamp = strtotime($invoice_details[0]['date']);
                          echo date('d-m-Y', $timestamp);?><br><br>
                </address>
            </div>
        </div>
    </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Invoice summary</strong></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <td><strong>Add Type</strong></td>
                                <td class="text-center"><strong>Service Name</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                <td class="text-right"><strong>Totals</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            <?php $sum = 0; foreach ($invoice_details as $inv_details){?>
                            <tr>
                                <td><?php echo $inv_details['package_name'];?></td>
                                <td class="text-center"><?php echo $inv_details['option_name'];?></td>
                                <td class="text-center"><?php echo $inv_details['option_price'];?></td>
                                <td class="text-right"><?php echo $inv_details['option_price'];?></td>
                            </tr>
                            
                            <?php $sum = $sum + $inv_details['option_price'];}?>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Total</strong></td>
                                <td class="no-line text-right"><?php echo $sum;?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
