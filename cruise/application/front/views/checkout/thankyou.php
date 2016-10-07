<?php
    echo $header;
?>
<!-- banner -->
<div class="banner inner_banner wow fadeInLeft animated page-head">	
    <img src="<?php echo base_url('uploads/pages/main/' . $page_image) ?>"/>
</div>
<!-- //banner -->
<!--blog-starts--> 
<div class="thanku">
    <div class="container">
        <div class="col-sm-12 thanx_div">
            <div class="col-sm-6 thanx_page" style="border-right: 1px solid #ddd">
                <h3>Thank You for your Order!</h3>
                <p>Your Order has been placed and being processed. You can track this Order through <a href="<?php echo base_url('myaccount/index') ?>">My Order</a> page.</p>
                <h1><i class="fa fa-check" aria-hidden="true"></i><b> $<?php echo $order_detail[0]['total_amount'] ?> </b> paid through Cash on delivery </h1>
            </div>
               <div class="col-sm-6 thanx_page">
                   <h4><?php echo $customer_detail[0]['customername'] ?> <span><?php echo $customer_detail[0]['contact_no'] ?></span></h4>
                   <?php if($address_detail) { ?>
                   <?php if(isset($address_detail[0]['daddress_2'])) { $address2 = $address_detail[0]['daddress_2'];} ?>
                   <h6 class="address"><?php echo $address_detail[0]['daddress_1'].",".$address2.",".$address_detail[0]['dcity'].",".$address_detail[0]['dstate'] ?></h6>
                   <?php } ?>
                   <?php if(!isset($event_detail[0]['event_date'])) { 
                            if($order_detail[0]['delivery'] == 'pickup') { ?>
                                    <h5>Your Order will be ready for pickup by <?php echo date('h:i a',  strtotime($order_detail[0]['pickup_time'])) ?></h5>
                               <?php } elseif($order_detail[0]['delivery'] == 'delivery') { ?>
                                    <h5>Your Order will be delivered by <?php echo date('h:i a',  strtotime($order_detail[0]['delivery_time'])) ?></h5>
                        <?php } } ?>
                   
            </div>
        </div>
        <div class="col-sm-12 order_summery">
            <h3>Your Order Summary<!--<span>1 item</span> --></h3>
            <div class="order_item row">
                <h5 class="pull-left">Order ID <span><?php echo $order_detail[0]['order_no'] ?></span> </h5>
                <?php if(isset($event_detail[0]['event_date'])) { ?>
                <h5 class="pull-right">Event Date <span><?php  echo date('d-m-Y',  strtotime($event_detail[0]['event_date']));  ?></span> </h5>
                <?php } ?>
            </div>
<!--            <div class="col-sm-2 pro_img">
                <img src="images/samosa.png"/>
            </div>-->
<?php foreach ($order_item_details as $order_item) { ?>
<div class="col-sm-12">
            <div class="col-sm-6 pro_content">
                <h5><?php echo $order_item['menu_title'] ?><?php echo (isset($order_item['dish']) && $order_item['dish'] != 'null') ? '('.$order_item['dish'].')' : ''; 
                                                                 echo (isset($order_item['type']) && $order_item['type'] != 'null') ? '('.$order_item['type'].')' : ''; ?></h5>
                <h6>Qty:<?php echo $order_item['qty'] ?></h6>
            </div>
            
            <div class="col-sm-6 delivery_tm">
                <h5>$ <?php echo $order_item['total'] ?></h5>
            </div>
</div>
<?php } ?>
        </div>
    </div>
</div>
<!--blog-ends--> 
<?php echo $footer; ?>
