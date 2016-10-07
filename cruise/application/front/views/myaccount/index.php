<?php
echo $header;
?>

<!-- banner -->
<div class="banner inner_banner wow fadeInLeft animated page-head">	
    <img src="<?php echo base_url('uploads/pages/main/' . $page_image) ?>"/>
</div>
<!-- //account -->
<div class="my_acount">
    <div class="col-sm-12 my_ac">
        <div class="col-sm-3 ac_list" id="my_ac">
            <div class="name">
                <h4><i class="fa fa-user" aria-hidden="true"></i>My Account</h4>
            </div>
            <ul  class="nav nav-tabs">
                <li><a href="#accountab" data-toggle="tab"><i class="fa fa-circle" aria-hidden="true"></i>Account Dashboard</a></li>
                <li><a href="#information" data-toggle="tab"><i class="fa fa-circle" aria-hidden="true"></i>Account Information</a></li>
                <li><a href="#orders" data-toggle="tab"><i class="fa fa-circle" aria-hidden="true"></i>My Orders</a></li>                
                <li><a href="<?php echo base_url('login/logout'); ?>"><i class="fa fa-circle" aria-hidden="true"></i>Logout</a></li>
            </ul>
        </div>
        <div class="col-sm-9 my_ac_detail">
            <div class="tab-content">
                <div 
                    <?php if(!$this->uri->segment(3) && $this->uri->segment(2)!='cancel_order') {
                            echo 'class="tab-pane active"';                        
                        } else {
                            echo 'class="tab-pane"';
                        } ?> id="accountab">
                    <div class="dashboard">
                        <div class="my_dashboard">
                            <h4>My Dashboard</h4>
                        </div>
                        <div class="dash_con">
                            <h2>Hello,<?php  echo $loged_in_customer[0]['customername'] ?>!</h2>
                            <!--<p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>-->
                        </div>
                        <div class="recent">
                            <h4>Recent Orders</h4>
                            <h5><a href="#orders" data-toggle="tab">View All</a></h5>
                        </div>
                        <table id="my-orders-table" class="data-table">
                            <colgroup><col width="1">
                                <col width="1">
                                <col width="1">
                                <col width="1">
                                <col width="1">
                                <col width="1">
                            </colgroup><thead>
                                <tr class="first last">
                                    <th>Sr No #</th>
                                    <th>Order No</th>                                                                        
                                    <th><span class="nobr">Order Total</span></th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <!--//Record history-->     
                            <tbody>
                                <?php $i=0; ?>
                                <?php foreach($recent_order_list as $order_list) { ?>
                                    <tr class="first odd">
                                    <td><span class="cell-label">Sr No. </span><?php echo ++$i ?></td>
                                    <td><span class="cell-label">Order No </span><?php echo $order_list['order_no'] ?></td>
                                    <td><span class="cell-label">Order Total</span><span class="price">$ <?php echo $order_list['total_amount'] ?></span></td>
                                    <td><span class="cell-label">Date</span><span class="nobr"><?php echo date('d-m-Y' ,strtotime($order_list['order_date_time'])) ?></span></td>
                                    <td><span class="cell-label">Status</span><em><?php echo $order_list['status'] ?></em></td>
                                    <td class="a-center last">
                                        <span class="nobr">                                            
                                            <a id="edit_btn" data-toggle="modal" onclick="order_detail('<?php echo $order_list['orderid'] ?>')" data-target="#order_detail" href="#">View Order</a>
                                            <span class="separator">|</span> 
                                            <a class="link-reorder" href="<?php echo base_url('myaccount/reorder/'.$order_list['orderid']); ?>">Reorder</a> 
                                            <?php if($order_list['status'] == 'pending' || $order_list['status'] == 'confirm') { ?>
                                            <span class="separator">|</span> <a class="link-reorder" href="<?php echo base_url('myaccount/cancel_order/'.$order_list['orderid']); ?>">Cancel</a>
                                            <?php } ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php } ?>                                                                
                            </tbody>
                        </table>
                        <div class="box-account box-info">
                            <div class="box-head">
                                <h2>Account Information</h2>
                            </div>
                            <div class="col-sm-12 box_info">
                                <div class="col-sm-12 box_information">

                                    <div class="box-title">
                                        <h3>Contact Information</h3>
                                        <a href="#information" data-toggle="tab">Edit</a>
                                    </div>
                                    <div class="box-content">
                                        <p>
                                            <?php  echo $loged_in_customer[0]['customername'] ?><br>
                                            <?php  echo $loged_in_customer[0]['email'] ?><br>                                            
                                        </p>
                                    </div>

                                </div>

                            </div>
                            <div class="col-sm-12 box_info">

                                <div class="box-title">
                                    <h4>Address Book</h4>
<!--                                    <a href="#">Manage Addresses</a>-->
                                </div>
                                <div class="box-content">
                                    <?php foreach ($address_list as $address) { ?>
                                    <div class="col-sm-4 box_information">
                                        <div class="box-title2">                                            
                                            <h4>Shipping Address</h4></div>
                                        <address>         
                                            <input type="radio" name="default" id="default" onclick="set_default(<?php echo $address['addressid'] ?>)"
                                                   <?php 
                                                   if(isset($address_default[0]['addressid'])){
                                                   if($address['addressid'] == $address_default[0]['addressid']) {
                                                       echo 'checked="checked"';
                                                   } } ?>>
                                            <?php echo $address['daddress_1'] ?><br>
                                            <?php echo $address['daddress_2'] ?><br>


                                            <?php echo $address['dcity'] ?>,  <?php echo $address['post_code'] ?><br>
                                            <?php echo $address['dstate'] ?><br>
                                            T: <?php echo $address['contact_no'] ?>                                            
                                            <br>
                                            <a id="edit_addr_btn" data-toggle="modal" onclick="edit_address('<?php echo $address['addressid'] ?>')" data-target="#edit_address" href="#">Edit Address</a>
                                            <a href="#"></a>
                                        </address>
                                    </div>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    </div>	
                </div>
                <div class="tab-pane" id="information">
                    <div class="account_info">
            <?php
            $form_attr = array('id' => 'update_profile_frm', 'class' => 'form-horizontal row-border');
            echo form_open('myaccount/update_profile', $form_attr);
            ?>                        
                        <div class="my_acount_info">
                            <h4>Edit Account Information</h4>
                        </div>
                        <div class="accou_info_con">
                            <h2>Account Information</h2>

                        </div>
                        <?php $fullname = explode(" ", $user_detail[0]['customername']);
                        if(!isset($fullname[2])){
                            $firstname = $fullname[0];
                            $lastname = $fullname[1];
                        } else {
                            $firstname = $fullname[0];
                            $middlename = $fullname[1];
                            $lastname = $fullname[2];
                        }
                        
                        
                        ?>
                        
                        <div class="acco_con">
                            <div class="col-sm-3 acco_content">
                                <label class="required" for="firstname">First Name<span>*</span></label>
                                <div class="input-box">
                                    <input type="text" class="input-text required-entry" maxlength="255" title="First Name" value="<?php echo $firstname ?>" name="firstname" id="firstname">
                                </div>
                            </div>                           
                            <div class="col-sm-3 acco_content">
                                <label class="required" for="lastname">Last Name<span>*</span></label>
                                <div class="input-box">
                                    <input type="text" class="input-text required-entry" maxlength="255" title="Last Name" value="<?php echo $lastname ?>" name="lastname" id="lastname">
                                </div>
                            </div>
                            <div class="col-sm-12 acco_content">
                                <label class="required" for="email">Email Address<span>*</span></label>
                                <div class="input-box">
                                    <input type="text" class="input-text email required-entry validate-email" title="Email Address" value="<?php echo $user_detail[0]['email'] ?>" id="email"  name="email" >
                                </div>
                            </div>
                            <div class="col-sm-4 acco_content2">
                                <input type="checkbox" class="checkbox" title="Change Password" onclick="setPasswordForm(this.checked)" value="1" id="change_password" name="change_password">
                                <label for="change_password">Change Password</label>
                            </div>
                        </div>
                            <div class="col-sm-8">
                                </div>
                        <div id="change_password_div" style="display: none">
                                <div class="col-sm-6 acco_content">
                                    <label class="required">Old Password<span>*</span></label>
                                    <div class="input-box">
                                        <input type="password" class="input-text required-entry" name="old_password"  id="old_password" title="Old Password" placeholder="Old Password" >
                                    </div>
                                </div>
                                <div class="col-sm-6 acco_content">
                                    <label class="required">New Password<span>*</span></label>
                                    <div class="input-box">
                                        <input type="password" class="input-text required-entry" name="new_password"  id="new_password" title="New Password" placeholder="New Password" >
                                    </div>
                                </div>
                                <div class="col-sm-6 acco_content">
                                    <label class="required">Confirm Password<span>*</span></label>
                                    <div class="input-box">
                                        <input type="password" class="input-text required-entry" name="confirm_password"  id="confirm_password" title="Confirm Password" placeholder="Confirm Password" >
                                    </div>
                                </div>
                        </div>
                          
                        <div class="buttons-set">
                            <p class="required"><span>*</span> Required Fields</p>                            
                            <button class="button" title="Save" type="submit"><span><span>Save</span></span></button>
                        </div>
            <?php echo form_close() ?>                        
                    </div>

                </div>
                <div 
                    <?php if($this->uri->segment(3)!='' && $this->uri->segment(2)!='cancel_order') {
                            echo 'class="tab-pane active"';                                  
                        } else {
                            echo 'class="tab-pane"';                            
                        } ?>
                    id="orders">

                    <div class="my_orders">
                        <div class="my_order_info">
                            <h4>My Orders</h4>
                        </div>
                        
                        <table id="my-orders-table" class="data-table">
                            <colgroup><col width="1">
                                <col width="1">
                                <col width="1">
                                <col width="1">
                                <col width="1">
                                <col width="1">
                            </colgroup><thead>
                                <tr class="first last" >
                                    <th>Sr No #</th>
                                    <th>Order No</th>                                                                        
                                    <th><span class="nobr">Order Total</span></th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php if($this->uri->segment(3)){$i = $this->uri->segment(3); }else {$i=0;}  ?>
                                
                                <?php foreach($order_lists as $order) { ?>
                                    <tr class="first odd">
                                    <td><span class="cell-label">Sr #</span><?php echo ++$i ?></td>
                                    <td><span class="cell-label">Order No </span><?php echo $order['order_no'] ?></td>                                    
                                    <td><span class="cell-label">Order Total</span><span class="price">$ <?php echo $order['total_amount'] ?></span></td>
                                    <td><span class="cell-label">Date</span><span class="nobr"><?php echo date('d-m-Y' ,strtotime($order['order_date_time'])) ?></span></td>
                                    <td><span class="cell-label">Status</span><em><?php echo $order['status'] ?></em></td>
                                    <td class="a-center last">
                                        <span class="nobr">                                            
                                            <a id="edit_btn" data-toggle="modal" onclick="order_detail('<?php echo $order['orderid'] ?>')" data-target="#order_detail" href="#">View Order</a>
                                            <span class="separator">|</span> 
                                            <a class="link-reorder" href="<?php echo base_url('myaccount/reorder/'.$order['orderid']); ?>">Reorder</a>
                                            <?php if($order['status'] == 'pending' || $order['status'] == 'confirm') { ?>
                                            <span class="separator">|</span> <a class="link-reorder" href="<?php echo base_url('myaccount/cancel_order/'.$order['orderid']); ?>">Cancel</a>
                                            <?php } ?>
                                            
                                        </span>
                                    </td>
                                </tr>
                                <?php } ?>  
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="table-footer">

                                <div class="col-md-12">
                                    <!-- /pagination -->
                                    <?php if ($this->pagination->create_links()) { ?>
                                        <div class="pagination pull-right"> <?php echo $this->pagination->create_links(); ?> </div>
<?php } ?>
                                    <!-- /pagination -->
                                </div>
                            </div>
                        </div>                                                
                    </div>
                </div>
                <div 
                    <?php if($this->uri->segment(2)=='cancel_order') {
                            echo 'class="tab-pane active"';                        
                        } else {
                            echo 'class="tab-pane"';
                        } ?>
                    id="cancel">
<?php echo form_open('myaccount/cancel_order',array('name'=>'cancel_order_form','id'=>'cancel_order_form','method'=>'POST'));  ?>
                    <div class="my_orders">
                        <div class="my_order_info">
                            <h4>My Orders</h4>
                        </div>
                        
                        <table id="my-orders-table" class="data-table">
                            <colgroup><col width="1">
                                <col width="1">
                                <col width="1">
                                <col width="1">
                                <col width="1">
                                <col width="1">
                                <col width="1">
                            </colgroup><thead>
                                <tr class="first last">
                                    <th>Select Item</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>                                    
                                    
                                    
                                </tr>
                            </thead>
                            <?php// print_r($order_item_details); die(); ?>
                            <tbody>
                                <?php foreach($order_item_details as $order_item_detail) { ?>
                                    <tr class="first odd">
                                        <td><input type="checkbox" name="delete_item[]" id="delete_item" value="<?php echo $order_item_detail['order_item_id'] ?>"></td>
                                        <td><span class="cell-label"></span><?php echo $order_item_detail['menu_title'] ?></td>
                                        <td><span class="cell-label"></span><?php echo $order_item_detail['qty'] ?></td>
                                        <td><span class="cell-label"></span>$ <?php echo $order_item_detail['total'] ?></td>
                                        
                                    </tr>
                                    <input type="hidden" name="orderid" value="<?php echo $order_item_details[0]['orderid'] ?>"
                                <?php } ?>  
                                    <tr>
                                        
                                        <a id="delete_btn" data-toggle="modal" href="#">
                                                    <button type="button" class="btn btn-primary" ><i class="icon-trash"></i> Cancel Items</button>

                                                </a>
                                    </tr>
                            </tbody>
                            <tfoot>
                                
                            </tfoot>
                        </table>                                                                        
                    </div>
<?php echo form_close(); ?>                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>                
            </div>
            <div class="modal-body">
                Are you sure you want to cancel order of selected item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <a href="#" id="delete_id" class="btn btn-danger danger">Cancel Item</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="empty-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>                
            </div>
            <div class="modal-body">
                Please Select at list one item !!! 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                
            </div>
        </div>
    </div>
</div>
<!-- account end -->
<?php echo $footer; ?>

<script>
    $(document).ready(function () {


        $("#update_profile_frm").validate({
            
            rules: {
              
              
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                old_password:{				
                                maxlength:30,
				remote:{
                                    url:"<?php echo base_url().'myaccount/check_old_pass' ?>",
                                    type:"post",
                                    data: {
                                    old_pass: function() {
                                        return $("#old_password").val();
                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                                    },
                                  },
			},
                new_password: {
                    required: true,                     
                    maxlength:16,
                    minlength:6
                },
                 confirm_password: {
                    required: true,
                    equalTo:'#new_password',
                },                                      
                 
            },
            messages:
                    {
                    
                        firstname: {
                            required: "First Name is required",
                        },
                        lastname: {
                            required: "Last Name is required",
                        },
                        email: {
                            required: "Email is required",
                            email: "Invalide Email Format",
                        },
                        old_password:{                            
                            remote:"Invalid Old Password",
                        },                        
                         new_password: {                                                                                            
                            minlength:"Password is between 6-16 characters long"
                        },
                         confirm_password: {                            
                            equalTo:"New Password and Confirm New Password Must match"
                        },                                                 
                    
                    },
                    
        });
        
        $("#edit_address_frm").validate({
            
            rules: {
              
              
                daddress_1: {
                    required: true,
                },                
                dcity: {
                    required: true,
                },
                dstate: {
                    required: true,
                },
                post_code: {
                    required: true,         
                    number: true,
                },                              
                 
            },
            messages:
                    {
                    
                        daddress_1: {
                            required: "Street Address 1 is required",
                        },                        
                        dcity: {
                            required: "City is required",
                        },
                        dstate: {
                            required: "State is required",
                        },
                        post_code: {
                            required: "Post Code is required",
                            number: "Post Code Must be Numeric",
                        },                                                      
                    
                    },
                    
        });
        

    });    
    </script>
<script type="text/javascript">
//var item = document.getElementById("delete_item").value;
//alert (item);

    $('#delete_btn').click(function() {        
        if($('#delete_item').prop('checked') == true) {
            alert('Are you sure you want to cancel selected item?');
            $( "#cancel_order_form" ).submit();
        } else {            
            alert('Please Select at list one item to cancel !!!');
        }
    })

</script>
<!-- //for bootstrap working -->
<!-- smooth scrolling -->
<script type="text/javascript">
    $(document).ready(function () {

        $().UItoTop({easingType: 'easeOutQuart'});
    });
</script>
<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->

<script>
// Create a clone of the menu, right next to original.
    $('#leftcol').addClass('original').clone().insertAfter('#leftcol').addClass('cloned').css('position', 'fixed').css('top', '0').css('margin-top', '0').css('z-index', '500').removeClass('original').hide();

    scrollIntervalID = setInterval(stickIt, 10);


    function stickIt() {

        var orgElementPos = $('.original').offset();
        orgElementTop = orgElementPos.top;

        if ($(window).scrollTop() >= (orgElementTop)) {
// scrolled past the original position; now only show the cloned, sticky element.

// Cloned element should always have same left position and width as original element.     
            orgElement = $('.original');
            coordsOrgElement = orgElement.offset();
            leftOrgElement = coordsOrgElement.left;
            widthOrgElement = orgElement.css('width');
            $('.cloned').css('left', leftOrgElement + 'px').css('top', 0).css('width', widthOrgElement).show();
            $('.original').css('visibility', 'hidden');
        } else {
// not scrolled past the menu; only show the original menu.
            $('.cloned').hide();
            $('.original').css('visibility', 'visible');
        }
    }
</script>

<!--script for cart adjustment-->

<!-- script for menu -->
<script type="text/javascript">
    $("span.menu").click(function () {
        $("ul.nav1").slideToggle(300, function () {
// Animation complete.
        });
    });
</script>

<script type="text/javascript">
    jQuery(document).ready(function () {
// This button will increment the value
        $('.qtyplus').click(function (e) {
// Stop acting like a button
            e.preventDefault();
// Get the field name
            fieldName = $(this).attr('field');
// Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
// If is not undefined
            if (!isNaN(currentVal)) {
// Increment
                $('input[name=' + fieldName + ']').val(currentVal + 1);
            } else {
// Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
        });
// This button will decrement the value till 0
        $(".qtyminus").click(function (e) {
// Stop acting like a button
            e.preventDefault();
// Get the field name
            fieldName = $(this).attr('field');
// Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
// If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
// Decrement one
                $('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
// Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
// This button will increment the value
        $('#plus').click(function (e) {
// Stop acting like a button
            e.preventDefault();
// Get the field name
            fieldName = $(this).attr('field');
// Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
// If is not undefined
            if (!isNaN(currentVal)) {
// Increment
                $('input[name=' + fieldName + ']').val(currentVal + 1);
            } else {
// Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
        });
// This button will decrement the value till 0
        $(".#minus").click(function (e) {
// Stop acting like a button
            e.preventDefault();
// Get the field name
            fieldName = $(this).attr('field');
// Get its current value
            var currentVal = parseInt($('input[name=' + fieldName + ']').val());
// If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
// Decrement one
                $('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
// Otherwise put a 0 there
                $('input[name=' + fieldName + ']').val(0);
            }
        });
    });
</script>

<script>
    function order_detail(orderid){
        $('#order_detail_model_body').empty();
        //alert(orderid);
        $.ajax({
           url:"<?php echo site_url().'myaccount/view_order' ?>",
           type:"post",
           dataType:"html",
           data:{'orderid':orderid,
                 '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
           success:function(data){
               //alert(data);
               $('#order_detail_model_body').append(data);               
           }
        });
    }    
    
    function edit_address(id){
        //alert(id);
        $.ajax({
           url:"<?php echo site_url().'myaccount/get_address' ?>",
           type:"post",
           dataType:"html",
           data:{'id':id,
                 '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
           success:function(data){
               //alert(data);
               var data = data.split("||");  
               //alert(data[1]);
               $('#address_id').val(data[0]);
               $('#daddress_1').val(data[1]);
               $('#daddress_2').val(data[2]);
               $('#dcity').val(data[3]);
               $('#dstate').val(data[4]);
               $('#post_code').val(data[5]);
           }
        });
    }
    
    function set_default(addressid){        
        //alert(orderid);
        $.ajax({
           url:"<?php echo site_url().'myaccount/set_default_addr' ?>",
           type:"post",
           dataType:"html",
           data:{'addressid':addressid,
                 '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
           success:function(data){
               //alert(data);
               if(data == 'true'){
                    window.location.reload(true);   
                }    
           }
        });
    }        
    
$( "#delete_id" ).click(function() {
$( "#cancel_order_form" ).submit();
});

$('#change_password').click(function() {
        if ($(this).is(':checked')) {
            document.getElementById('change_password_div').style.display = "block";
        } else {
            document.getElementById('change_password_div').style.display = "none";
        }
    });



</script>    
<div class="modal fade" id="order_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="frm_title">Order Details</h4>
            </div>            
            <div class="modal-body" id="order_detail_model_body">                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>                 
            </div>            
        </div>
    </div>
</div>
<div class="modal fade" id="order_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="frm_title">Order Details</h4>
            </div>
            <?php
            $form_attr = array('id' => 'change_password_frm', 'class' => 'form-horizontal row-border', 'enctype' => 'multipart/form-data');
            echo form_open('myaccount/change_password', $form_attr);
            ?>
            <div class="modal-body" id="change_password_model_body">                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <?php
                $save_attr = array('id' => 'btn_save', 'name' => 'btn_save', 'value' => 'Save', 'class' => 'btn btn-primary');
                echo form_submit($save_attr);
                ?>   
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_address" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="frm_title">Edit Address</h4>
            </div>
            <?php
            $form_attr = array('id' => 'edit_address_frm', 'class' => 'form-horizontal row-border', 'enctype' => 'multipart/form-data');
            echo form_open('myaccount/update_address', $form_attr);
            ?>
            <div class="modal-body" id="edit_address_model_body">

                <table>
                    <thead>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <label>Street Address 1</label>
                        </tr>
                        <tr>
                            <input type="text" id="daddress_1" name="daddress_1" class="form-control" placeholder='Street Address 1'>
                        </tr>
                        <div></div>
                        <tr>
                            <label>Street Address 2</label>
                        </tr>
                        <tr>
                            <input type="text" id="daddress_2" name="daddress_2" class="form-control" placeholder='Street Address 2'>
                        </tr>
                        <div></div>
                        <tr>
                            <label>City</label>
                        </tr>
                        <tr>
                            <input type="text" id="dcity" name="dcity" class="form-control" placeholder='City'>
                        </tr>
                        <div></div>
                        <tr>
                            <label>State</label>
                        </tr>
                        <tr>
                            <input type="text" id="dstate" name="dstate" class="form-control" placeholder='State'>
                        </tr>
                        <div></div>
                        <tr>
                            <label>PIN Code</label>
                        </tr>
                        <tr>
                            <input type="text" id="post_code" name="post_code" class="form-control" placeholder='PIN Code'>
                        </tr>
                        <input type="hidden" name="address_id" id="address_id" value="" />
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <?php
                $save_attr = array('id' => 'btn_save', 'name' => 'btn_save', 'value' => 'Save', 'class' => 'btn btn-primary');
                echo form_submit($save_attr);
                ?>   
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
