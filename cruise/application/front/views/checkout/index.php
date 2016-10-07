<?php
    echo $header;
?>
<head>
    <script language="JavaScript">
javascript:window.history.forward(1);

</script>
</head>
<div class="banner inner_banner wow fadeInLeft animated page-head">	
    <img src="<?php echo  base_url('uploads/pages/main/'.$page_image)?>"/>
</div>
 <?php echo form_open('checkout/orderadd',array('name'=>'order_add_form','id'=>'order_frm'));  ?>
<input type="hidden" name="issession" id="issession" value="<?php echo $islogin ?>">
<div class="cart_check">
            <div class="container">
                <div id="wrapper">
                    <br>
                    <div class="step">
                        <a href="#bar1"><span class='baricon'>1</span></a>

                        <span id="bar1" class='progress_bar'></span>
                        <a href="#bar2"><span class='baricon'>2</span></a>
                        <span id="bar2" class='progress_bar'></span>
                        <a href="#"><span class='baricon'>3</span></a>
                        <span id="bar3" class='progress_bar'></span>
                        <a href="#"><span class='baricon'>4</span></a>
                    </div>
                    <div class="row stepdetail">
                        <ul>
                            <li><p>Provide Email</p></li>
                            <li><p>Provide address</p></li>
                            <li><p>Confirm Order</p></li>
                            <li><p>Your's Done!</p></li>
                        </ul>
                    </div>
                    <div class="row">

                        <div class="col-sm-9 stepform">

                            <div id="account_details" class="col-sm-12 account_d">

                                <div style="cursor:default;" class="content_row col-sm-12">                          
                                    <span id="steponetext" class="title_icon">1</span> <span class="content_row_title">ACCOUNT INFO</span></div>
                                <div class="col-sm-8 acco_de">

                                    <h4 class='form_head'>Account Details</h4>
                                    <!--erroe msg-->
                                    <div class="alert fade in alert-danger myalert" id="err_msg" style="display:none;">

                                    </div>
                                    <p>Email Address<span>*</span></p>
                                    <input type="text" name="emailcheck"  id="emailcheck" placeholder='Email Address'>
                                    <p>Password<span>*</span></p>
                                    <input type="password" name="passwordcheck"  id="passwordcheck" placeholder='Password'>
                                    <br>
                                    <div class="button_next">
                                        <input type="button" value="Next" onclick="login_checktime();">
                                        <!--<input type="button" value="Next" onclick="login()">-->
                                        <!--<input type="button" value="Next" onclick="show_next('account_details', 'user_details', 'bar1');">-->
                                    </div>    
                                </div>
                                <div class="col-sm-4 sign_upbtn">
                                    <p>Have not an Account? Click on Sign Up</p>
                                    
                                    <a id="register_click" class="stepsignup log_popup" data-target="#myModal" data-toggle="modal" type="button" href="javascrip:void(0)">Sign Up</a>

                                    
                                    
                                    
                                    <!--<input type="button" value="Sign Up">-->
                                    
                                </div>
                                <div style="cursor:default;" class="content_row2 col-sm-12">                            
                                    <span id="steponetext" class="title_icon2">2</span> <span class="content_row_title">PICKUP AND DELIVERY</span></div>
                                <div style="cursor:default;" class="content_row2 col-sm-12">                         
                                    <span id="steponetext" class="title_icon2">3</span> <span class="content_row_title">PAYMENT</span></div>
                            

                            </div>

               

                            <div id="user_details" class="col-sm-12 contact_de">
                                <div style="cursor:default;" class="content_row3 col-sm-12">                            

                                    <div class="left_con"><span id="steponetext" class="title_icon3"><i class="fa fa-check" aria-hidden="true"></i></span> <span class="content_row_title">ACCOUNT INFO</span></div>
                                    <div class="right_con"><i class="fa fa-user" aria-hidden="true"></i> <span class="content_row_title"><?php if(isset($loged_in_customer)){ echo $loged_in_customer[0]['customername']; } ?></span></div>
                                </div>
                                <div style="cursor:default;" class="content_row col-sm-12">                            
                                    <span id="steponetext" class="title_icon">2</span> <span class="content_row_title">PICKUP AND DELIVERY</span></div>
                                <div class="col-sm-12 con_de">

                                    <h4 class='form_head'>Address detail</h4>
                                    <p>Name<span>*</span></p>
                                    <div class="row">                                        
                                         <?php if(isset($user_detail[0]['customername'])) {?>
                                        <?php $fullname = explode(" ", $user_detail[0]['customername']) ?>
                                        <div class="col-sm-5 con_inr_de"><input type="text" id="chk_first_name" name="first_name" placeholder='First Name' value="<?php echo $fullname[0] ?>"></div>
                                        <div class="col-sm-5 con_inr_de"> <input type="text" id="chk_last_name" name="last_name" placeholder='Last Name' value="<?php echo $fullname[1] ?>"></div>
                                         <?php } else { ?>
                                        <div class="col-sm-5 con_inr_de"><input type="text" id="chk_first_name" name="first_name" placeholder='First Name' value=""></div>
                                        <div class="col-sm-5 con_inr_de"> <input type="text" id="chk_last_name" name="last_name" placeholder='Last Name' value=""></div>
                                         <?php } ?>
                                    </div>

                                    <p>Cell Number<span>*</span></p>
                                    <input type="text" id="contact_no" name="contact_no" placeholder='e.g. 9874561231' value="<?php if(count($user_detail) > 0) { echo $user_detail[0]['contact_no']; } ?>"><br>
                                    <input type="radio" checked="checked" class="delivery" id="pickuper"  name="delivery" value="pickup">Pickup
                                    <?php if($setting[8]['setting_value'] == 'Yes') { 
                                        $lunch = explode('|', $setting[11]['setting_value']);
                                        $dinner = explode('|', $setting['12']['setting_value']);
                                        $current = time();
                                        $lunch_start = strtotime(date('Y-m-d').$lunch[0]);
                                        $lunch_end = strtotime(date('Y-m-d').$lunch[1]);
                                        $dinner_start = strtotime(date('Y-m-d').$dinner[0]);
                                        $dinner_end = strtotime(date('Y-m-d').$dinner[1]);  
                                        
                                    if(($current >= $lunch_start && $current <= $lunch_end) || ($current >= $dinner_start && $current <= $dinner_end)) {
                                        if($this->cart->total() > $setting[13]['setting_value']) {
                                        ?>
                                    <input type="radio" class="delivery" id="deliver" name="delivery" value="delivery">Delivery<br>                                    
                                    <?php } } } ?>
                                    <br>
                                    <?php if($this->session->userdata('eventid')) { ?>
                                    <label>Date : <?php echo date('m-d-Y',  strtotime($event_detail[0]['event_date'])) ?></label>
                                    <?php } else { ?>
                                    <label>Date : <?php echo date('m-d-Y') ?></label>
                                    <?php } ?>
                                    <?php 
                                        $dt = new DateTime();                  
                                        $dt->modify("+45 minutes");                                        
                                        $h = $dt->format('g');
                                        $I = intval($dt->format('i'));
                                        $I = $I - ($I % 15);
                                        $a = $dt->format('a');                                                                             
                                        ?>
                                    
                                    <p id="time_format">Pick Time <span>*</span></p>                                                                        
                                    <div id="pickup" class="col-sm-12" >
                                                                                                                                                                
                                        <div class="col-sm-6 con_inr_de">
                                            <select id="time" name="time"  onmousedown="//if(this.options.length>8){this.size=8;}" >
                                                <?php                                                 
                                                if($a == 'am') {                                            
                                                    //$start_hour=intval(substr($setting[9]['setting_value'], 0, 2));                                            
                                                    $start_hour=11;                                            
                                                    if($h > $start_hour ) {
                                                        $start_hour = $h;
                                                    }
                                                    $end_hour=11;   
                                                    
                                                    for($i=$start_hour;$i<=$end_hour;$i++){ 
                                                        for($j=0;$j<=59;$j++){ 
//                                                            if($i!=0){
//                                                                
//                                                            } else {
//                                                                
//                                                            }
                                                                    echo '<option value="'.sprintf("%02d", $i).':'.sprintf("%02d", $j).' am'.'">'.sprintf("%02d", $i).' : '.sprintf("%02d", $j).' am'.'</option>';
                                                            $j=$j+14;
                                                        }                                                        
                                                    } 
                                                    
                                                    //$end_hour=intval(substr($setting[10]['setting_value'], 0, 2));
                                                    $end_hour=9;
                                                    for($i=0;$i<=$end_hour;$i++){ 
                                                        for($j=0;$j<=59;$j++){   
                                                            if($i>11){
                                                                $x= $i % 12;
                                                            } else {
                                                                $x = $i;
                                                            }
                                                            if($x!=0){
                                                                echo '<option value="'.sprintf("%02d", $x).':'.sprintf("%02d", $j).' pm'.'">'.sprintf("%02d", $x).' : '.sprintf("%02d", $j).' pm'.'</option>';
                                                            } else {
                                                                echo '<option value="'.sprintf("%02d", 12).':'.sprintf("%02d", $j).' pm'.'">'.sprintf("%02d", 12).' : '.sprintf("%02d", $j).' pm'.'</option>';
                                                            }
                                                                    
                                                            if($i==9){ $j = $j + 59; } else { $j=$j+14; }
                                                            
                                                        }                                                        
                                                    } 
                                                    
                                                } elseif($a == 'pm') {
                                                    $start_hour=0;
                                                    $start_minute=0;
                                                    //$end_hour=intval(substr($setting[10]['setting_value'], 0, 2));       
                                                    $end_hour=9;       
                                                    if($h < $end_hour ) {
                                                        $start_hour = $h;
                                                    }
                                                    
                                                    for($i=$start_hour;$i<=$end_hour;$i++){ 
                                                        for($j=0;$j<=59;$j++){   
                                                            if($i>11){
                                                                $x= $i % 12;
                                                            } else {
                                                                $x = $i;
                                                            }
                                                            if($x!=0){
                                                                echo '<option value="'.sprintf("%02d", $x).':'.sprintf("%02d", $j).' pm'.'">'.sprintf("%02d", $x).' : '.sprintf("%02d", $j).' pm'.'</option>';
                                                            } else {
                                                                echo '<option value="'.sprintf("%02d", 12).':'.sprintf("%02d", $j).' pm'.'">'.sprintf("%02d", 12).' : '.sprintf("%02d", $j).' pm'.'</option>';
                                                            }
                                                                    
                                                            if($i==9){ $j = $j + 59; } else { $j=$j+14; }
                                                        }                                                        
                                                    } 
                                                }
                                                ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <br><br>                                    
                                    <div id="delivery_address" style="display: none">
                                        
                                    <p id="time_format">Delivery Time <span>*</span></p>                                                                        
                                    <div id="delivery_time_format" class="row" >
                                                                                                                                                                
                                        <div class="col-sm-6 con_inr_de">
                                            <select id="deliverytime" name="deliverytime"  onmousedown="//if(this.options.length>8){this.size=8;}" >
                                                <?php                                                 
                                                if($a == 'am') {                                            
                                                    //$start_hour=intval(substr($setting[9]['setting_value'], 0, 2));                                            
                                                    $start_hour=11;                                            
                                                    if($h > $start_hour ) {
                                                        $start_hour = $h;
                                                    }
                                                    $end_hour=11;   
//                                                            if($i!=0){
//                                                                
//                                                            } else {
//                                                                
//                                                            }                                                    
                                                    for($i=$start_hour;$i<=$end_hour;$i++){ 
                                                        for($j=0;$j<=59;$j++){                                                                                                         
                                                                    echo '<option value="'.sprintf("%02d", $i).':'.sprintf("%02d", $j).' am'.'">'.sprintf("%02d", $i).' : '.sprintf("%02d", $j).' am'.'</option>';
                                                            $j=$j+14;
                                                        }                                                        
                                                    } 
                                                    
                                                    //$end_hour=intval(substr($setting[10]['setting_value'], 0, 2));
                                                    $end_hour=9;
                                                    for($i=0;$i<=$end_hour;$i++){ 
                                                        for($j=0;$j<=59;$j++){   
                                                            if($i>11){
                                                                $x= $i % 12;
                                                            } else {
                                                                $x = $i;
                                                            }
                                                            if($x!=0){
                                                                echo '<option value="'.sprintf("%02d", $x).':'.sprintf("%02d", $j).' pm'.'">'.sprintf("%02d", $x).' : '.sprintf("%02d", $j).' pm'.'</option>';
                                                            } else {                                                                
                                                                echo '<option value="'.sprintf("%02d", 12).':'.sprintf("%02d", $j).' pm'.'">'.sprintf("%02d", 12).' : '.sprintf("%02d", $j).' pm'.'</option>';
                                                            }
                                                                    
                                                            if($i==9){ $j = $j + 59; } else { $j=$j+14; }
                                                            
                                                        }                                                        
                                                    } 
                                                    
                                                } elseif($a == 'pm') {
                                                    $start_hour=0;
                                                    $start_minute=0;
                                                    //$end_hour=intval(substr($setting[10]['setting_value'], 0, 2));       
                                                    $end_hour=9;       
                                                    if($h < $end_hour ) {
                                                        $start_hour = $h;
                                                    }
                                                    
                                                    for($i=$start_hour;$i<=$end_hour;$i++){ 
                                                        for($j=0;$j<=59;$j++){   
                                                            if($i>11){
                                                                $x= $i % 12;
                                                            } else {
                                                                $x = $i;
                                                            }
                                                            if($x!=0){
                                                                echo '<option value="'.sprintf("%02d", $x).':'.sprintf("%02d", $j).' pm'.'">'.sprintf("%02d", $x).' : '.sprintf("%02d", $j).' pm'.'</option>';
                                                            } else {
                                                                
                                                                echo '<option value="'.sprintf("%02d", 12).':'.sprintf("%02d", $j).' pm'.'">'.sprintf("%02d", 12).' : '.sprintf("%02d", $j).' pm'.'</option>';
                                                            }
                                                                    
                                                            if($i==9){ $j = $j + 59; } else { $j=$j+14; }
                                                        }                                                        
                                                    } 
                                                }
                                                ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <?php if(isset($address_list[0]['daddress_1']) ){ ?>
                                    <p>Address <span>*</span></p>
                                    <div class="row">
                                    <div class="col-sm-12 con_inr_de" >
                                        <select id="address" name="address" onchange="getaddress()" >
                                                <option value="">Select Address</option>
                                                <?php foreach($address_list as $address) { 
                                                    if($address['daddress_1']) { ?>
                                                <option value="<?php echo $address['addressid'] ?>"><?php echo $address['daddress_1'].",".$address['daddress_2'].",".$address['dcity'].",".$address['dstate'] ?></option>
                                                    <?php } } ?>                                                
                                            </select>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <p>Delivery Address <span>*</span></p>
                                    <div class="row">
                                        
                                        <div class="col-sm-6 con_inr_de">
                                            <?php if(count($default_address) > 0) { ?>
                                            <input type="text" id="daddress_1" name="daddress_1" placeholder='Street Address 1' value="<?php echo $default_address[0]['daddress_1'] ?>">
                                            <input type="text" id="daddress_2" name="daddress_2" placeholder='Street Address 2' value="<?php echo $default_address[0]['daddress_2'] ?>">
                                            <input type="text" id="dcity" name="dcity" placeholder='City' value="<?php echo $default_address[0]['dcity'] ?>">
                                            <input type="text" id="dstate" name="dstate" placeholder='State' value="<?php echo $default_address[0]['dstate'] ?>">   
                                            <input type="text" id="post_code" name="post_code" placeholder='Zip Code' value="<?php echo $default_address[0]['post_code'] ?>">
                                            <?php } else { ?>
                                            <input type="text" id="daddress_1" name="daddress_1" placeholder='Street Address 1' value="">
                                            <input type="text" id="daddress_2" name="daddress_2" placeholder='Street Address 2' value="">
                                            <input type="text" id="dcity" name="dcity" placeholder='City' value="">
                                            <input type="text" id="dstate" name="dstate" placeholder='State' value="">   
                                            <input type="text" id="post_code" name="post_code" placeholder='Zip Code' value="">
                                            <?php } ?>
                                        </div>
                                        
                                    </div>
                                    </div>
                                    
                                 
                                    <div class="button_next">
                                        
                                        <input type="button" value="Next" onclick="user_address();">
                                        <!--<input type="button" value="Deliver to this Address" onclick="show_next('user_details', 'qualification', 'bar2');">-->
                                    </div>    
                                </div>


                                <div style="cursor:default;" class="content_row2 col-sm-12">                            
                                    <span id="steponetext" class="title_icon2">3</span> <span class="content_row_title">CONFIRM ORDER</span></div>


                            </div>

                            <div id="qualification" class="col-sm-12 payment">
                                <div style="cursor:default;" class="content_row3 col-sm-12">                            

                                    <div class="left_con"><span id="steponetext" class="title_icon3"><i class="fa fa-check" aria-hidden="true"></i></span> <span class="content_row_title">ACCOUNT INFO</span></div>
                                    <div class="right_con"><i class="fa fa-user" aria-hidden="true"></i> <span class="content_row_title"><?php if(count($loged_in_customer) > 0){ echo $loged_in_customer[0]['customername']; } ?></span></div>
                                </div>
                                <div style="cursor:default;" class="content_row3 col-sm-12">                            

                                    <div class="left_con"><span id="steponetext" class="title_icon3"><i class="fa fa-check" aria-hidden="true"></i></span> <span class="content_row_title">PICKUP AND DELIVERY</span></div>
                                    <div class="right_con find_fa_icon"><i class="fa fa-map-marker" aria-hidden="true"></i><span id="tablocation" class="content_row_title tablocation">AHMEDABAD : 382350</span></div>
                                </div>
                                <div style="cursor:default;" class="content_row col-sm-12">                            
                                    <span id="steponetext" class="title_icon">3</span> <span class="content_row_title">CONFIRM ORDER</span></div>
                                   
                                <div class="col-sm-12 con_de">
                                    
                                    <h4 class='form_head'>Cash On Delivery</h4>
                                    <p>After you place order, we may call you on the number provided by you <b id="con_mobile"></b> to confirm the order. </p>
                                    <div class="register-captcha-grid">
                                        <img src="<?php echo base_url('checkout/captcha') ?>" id="captcha" /><br/>


                                        <!-- CHANGE TEXT LINK -->
                                        <a onclick="
                                                document.getElementById('captcha').src = '<?php echo base_url('checkout/captcha') ?>?' + Math.random();
                                                document.getElementById('captcha_form').focus();"  style="cursor:pointer;"
                                           id="change-image">Not readable? Change text.</a><br><br>


                                        <input type="text" name="captcha" id="captcha_form" autocomplete="off" />
                                    </div>
                                    <br>
                                    <div class="button_next">
                                        <input type="button" value="Previous" onclick="show_prev('user_details', 'bar2');">
                                        <input type="button" id="confirm_order" value="Confirm Order">
                                        <!--<input type="button" value="Payment" onclick="show_next('qualification', 'your_done', 'bar3');">-->
                                    </div>    
                                </div>
                            </div>
                            <div id="your_done" class="col-sm-12 done">
                                <div style="cursor:default;" class="content_row3 col-sm-12">                            

                                    <div class="left_con"><span id="steponetext" class="title_icon3"><i class="fa fa-check" aria-hidden="true"></i></span> <span class="content_row_title">ACCOUNT INFO</span></div>
                                    <div class="right_con"><i class="fa fa-user" aria-hidden="true"></i> <span class="content_row_title"><?php if(count($loged_in_customer) > 0){ echo $loged_in_customer[0]['customername']; } ?></span></div>
                                </div>
                                <div style="cursor:default;" class="content_row3 col-sm-12">                            

                                    <div class="left_con"><span id="steponetext" class="title_icon3"><i class="fa fa-check" aria-hidden="true"></i></span> <span class="content_row_title">PICKUP AND DELIVERY</span></div>
                                    <div class="right_con"><i class="fa fa-map-marker" aria-hidden="true"></i><span id="tablocation1" class="content_row_title tablocation"></span></div>
                                </div>
                                <div style="cursor:default;" class="content_row3 col-sm-12">                            

                                    <div class="left_con"><span id="steponetext" class="title_icon3"><i class="fa fa-check" aria-hidden="true"></i></span> <span class="content_row_title">PAYMENT</span></div>
                                    <div class="right_con"><i class="fa fa-money" aria-hidden="true"></i><span class="content_row_title pay_amt"></span></div>
                                </div>

                                <div class="col-sm-12 complete">

                                    <h4 class='form_head'>Congratulation!</h4>
                                    <p>Thank You For Visit Our Site.. </p>

                                    <br>
                                    <div class="button_next">
                                        <input type="submit" name="main_submit" value="Submit">
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                       <?php echo catringmenu_cart_checkout(); ?>

                    </div>
                </div>
            </div>
        </div>

<?php echo $footer; ?>
        <!-- for bootstrap working -->
        
        <!-- //for bootstrap working -->
        <!-- smooth scrolling -->
        <script type="text/javascript">
        $(document).ready(function () {
            /*
             var defaults = {
             containerID: 'toTop', // fading element id
             containerHoverID: 'toTopHover', // fading element hover id
             scrollSpeed: 1200,
             easingType: 'linear' 
             };
             */
            $().UItoTop({easingType: 'easeOutQuart'});
        });
        </script>
        <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
        <!-- //smooth scrolling -->

        <link rel="stylesheet" href="<?php echo base_url('css/jquery-ui.css') ?>" />
    <script src="<?php echo base_url('js/jquery-ui.js') ?>"></script>
        <script>
$(function () {
$("#datepicker").datepicker();
});
        </script>   
 <script type="text/javascript" language="javascript">// <![CDATA[

            
            function showHide() {
    var ele = document.getElementById("showHideDiv");
  
        if(ele.style.display == "block") {
            ele.style.display = "none";
      }
    else {
        ele.style.display = "block";
    }
}
// ]]></script>
        
        <script>
        	var index = 0,
    messg = [
        "Hide Deatils", 
        "Show Deatils"
       
    ];

$(".pushme").on("click", function() {
    $(this).text(function(index, text){
        index = $.inArray(text, messg);
        return messg[++index % messg.length];
    });
});
    </script>
    

        <script>
            function show_next(id, nextid, bar)
            {
                var ele = document.getElementById(id).getElementsByTagName("input");
                var error = 0;
                for (var i = 0; i < ele.length; i++)
                {
                    if (ele[i].type == "text" && ele[i].value == "")
                    {
                        error++;
                    }
                }

                if (error == 0)
                {
                    document.getElementById("account_details").style.display = "none";
                    document.getElementById("user_details").style.display = "none";
                    document.getElementById("qualification").style.display = "none";
                    document.getElementById("your_done").style.display = "none";
                    $("#" + nextid).fadeIn();
                    document.getElementById(bar).style.backgroundColor = "#CF3B37";
                } else{
                      document.getElementById("account_details").style.display = "none";
                    document.getElementById("user_details").style.display = "none";
                    document.getElementById("qualification").style.display = "none";
                    document.getElementById("your_done").style.display = "none";
                    $("#" + nextid).fadeIn();
                    document.getElementById(bar).style.backgroundColor = "#CF3B37";
                }
//                else
//                {
//                    alert("Fill All The details");
//                }
            }

            function show_prev(previd, bar)
            {
                document.getElementById("account_details").style.display = "none";
                document.getElementById("user_details").style.display = "none";
                document.getElementById("qualification").style.display = "none";
                document.getElementById("your_done").style.display = "none";
                $("#" + previd).fadeIn();
                document.getElementById(bar).style.backgroundColor = "#D8D8D8";
            }
        </script>
       
    
<!--added by sachin-->
<script type="text/javascript">
        $(document).ready(function() {
            var address1 = $('#daddress_1').val();
            var address2 = $('#daddress_2').val();
            var city = $('#dcity').val();
            var state = $('#dstate').val();
            if(address1 != '') {
                $('#daddress_1').attr("disabled", "disabled");
                $('#daddress_2').attr("disabled", "disabled");
                $('#dcity').attr("disabled", "disabled");
                $('#dstate').attr("disabled", "disabled");
                $('#post_code').attr("disabled", "disabled");
                
            }
            
            if($('#issession').val()=='yes'){
                 show_next('account_details', 'user_details', 'bar1');
            }
         });
        </script>
<script type="text/javascript">
        
        function login_checktime(){
//       loginbutton 
        var email=$('#emailcheck').val();
        var password=$('#passwordcheck').val();
        
        if($('#issession').val()=='yes'){
            show_next('account_details', 'user_details', 'bar1');
        }else{

            if(email==''){
                 $('#err_msg').css("display","block");
                           $('#err_msg').text("Please enter emial"); 
                           return false;
            }


            $.ajax({
                   url: "<?php echo site_url('login/authenticate'); ?>",
                   type: "post",
                   data: {'email': email,'password':password,
                       '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                   },
                   success: function (result) {
                       if('Disable'==result){
                            $('#err_msg').css("display","block");
                           $('#err_msg').text("Your account is disable by admin. Please contact admin for more detail.");
                       }else if(result=='Wrong'){
                            $('#err_msg').css("display","block");
                           $('#err_msg').text("Username or password is wrong. Please try again!");
                       }else{
                           var baseurl = "<?php print base_url(); ?>";

                           $('#err_msg').css("display","none");
                           window.location.href = baseurl+"login/session/"+result;
    //                       alert("successcode here");
                       }
                   }
            });

        }
    }
        
    function user_address(){
//        var customer_name=$('#title').val()+' '+ $('#chk_first_name').val()+' '+ $('#chk_last_name').val();
var err=0;
if(!document.getElementById('pickuper').checked){
  
        var contact_no=$('#contact_no').val();
        var post_code=$('#post_code').val();
        var title=$('#title').val();
        var chk_first_name=$('#chk_first_name').val();
        var chk_last_name=$('#chk_last_name').val();        
       
        var daddress_1=$('#daddress_1').val();   
        var daddress_2=$('#daddress_2').val();   
        var dcity=$('#dcity').val();
        var dstate=$('#dstate').val();
       
        
        var check_mob_no=/^[0-9]{1,15}$/;
    
//    first for validation
        
        if(chk_first_name==''){
            $('#chk_first_name').css("border" , "2px solid red");
            err++;
        }
        if(chk_last_name==''){
            $('#chk_last_name').css("border" , "2px solid red");
            err++;
            
        }
        
        if(contact_no==''){
            $('#contact_no').css("border" , "2px solid red");
            err++;
        }else if(!check_mob_no.test(contact_no)){
            $('#contact_no').css("border" , "2px solid red");
            err++;
        }
        
        if(post_code==''){
            $('#post_code').css("border" , "2px solid red");
            err++;
        }        
        
        if(daddress_1==''){
            $('#daddress_1').css("border" , "2px solid red");
            err++;
        }
        
//        if(daddress_2==''){
//            $('#daddress_2').css("border" , "2px solid red");
//            err++;
//        }
        
        if(dcity==''){
            $('#dcity').css("border" , "2px solid red");
            err++;
        }
        if(dstate==''){
            $('#dstate').css("border" , "2px solid red");
            err++;
        }
        
        
        } else {
            
            var contact_no=$('#contact_no').val();
            
            if(contact_no==''){
            $('#contact_no').css("border" , "2px solid red");
            err++;            
            }
            
        }
        
        
        
        
        if(err){            
            return false;
        }else{ //goes for register
            //
            show_next('user_details', 'qualification', 'bar2');
            
            if(document.getElementById('pickuper').checked){
                
                var time = $('#time').val();
                
                $('.tablocation').text("Pickup Time - " + time);
                                
                    
                    $('.find_fa_icon').find($(".fa")).removeClass('fa fa-map-marker').addClass('fa fa-calendar');

            } else {
                $('.tablocation').text(dcity + " : " +post_code);
                $('.find_fa_icon').find($(".fa")).removeClass('fa fa-calendar').addClass('fa fa-map-marker');
            }
            
            $('#con_mobile').text(contact_no);
            $('.pay_amt').text($('#cart_total').text());
 
        } 

    }

//              for coppay_amty address

            $('.copy_address').click(function(event) {
             // alert("hi");
                if(this.checked==true){

                    $('#daddress_1').val($('#baddress_1').val());
                    $('#daddress_2').val($('#baddress_2').val());
                    $('#dcity').val($('#bcity').val());
                    $('#dstate').val($('#bstate').val());
                    
                 
                    $('#daddress_1').attr("disabled", "disabled");
                    $('#daddress_2').attr("disabled", "disabled");
                    $('#dcity').attr("disabled", "disabled");
                    $('#dstate').attr("disabled", "disabled");
                    
                    
                }else{
                    $('#daddress_1').attr("disabled", "disabled");
                    $('#daddress_2').attr("disabled", "disabled");
                    $('#dcity').attr("disabled", "disabled");
                    $('#dstate').attr("disabled", "disabled");
                }
              
                 
           
        });
        $('.delivery').click(function(event) {
            var delivery= $("input[name='delivery']:checked").val();
            
            if(delivery=='pickup' ){
                $('#pickup').css("display" , "block");
                $('#time_format').css("display" , "block");
                $('#delivery_address').css("display" , "none");
           }else{
               $('#pickup').css("display" , "none");
               $('#time_format').css("display" , "none");
               $('#delivery_address').css("display" , "block");
           }
        });
        
        function payment(){ //step 3 payment button click time call
           
               show_next('qualification', 'your_done', 'bar3');
           
        }
        
    function getaddress(){
        
        var addressid = $('#address').val();       
        $.ajax({
           url:"<?php echo site_url().'checkout/getaddress' ?>",
           type:"post",
           dataType:"html",
           data:{'addressid':addressid,
                 '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
           success:function(data){
               //alert(data);
               var data = data.split("||");  
               //alert(data[1]);
               if(data != '') {                   
                    $('#contact_no').val(data[0]).attr("disabled", "disabled");
                    $('#daddress_1').val(data[1]).attr("disabled", "disabled");
                    $('#daddress_2').val(data[2]).attr("disabled", "disabled");
                    $('#dcity').val(data[3]).attr("disabled", "disabled");
                    $('#dstate').val(data[4]).attr("disabled", "disabled");
                    $('#post_code').val(data[5]).attr("disabled", "disabled");
               } else {                   
                    $('#contact_no').val('').removeAttr("disabled");;
                    $('#daddress_1').val('').removeAttr("disabled");;
                    $('#daddress_2').val('').removeAttr("disabled");;
                    $('#dcity').val('').removeAttr("disabled");;
                    $('#dstate').val('').removeAttr("disabled");;
                    $('#post_code').val('').removeAttr("disabled");;
               }
           }
        });
    }     
        
$( "#confirm_order" ).click(function() {
var capcha = $('#captcha_form').val();
    $.ajax({
           url:"<?php echo site_url().'checkout/validate_capcha' ?>",
           type:"post",
           dataType:"html",
           data:{'capcha':capcha,
                 '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
           success:function(data){
               //alert(data);
               if(data == 'true') {     
                   document.getElementById("order_frm").submit();
                    
                } else {
                    $('#captcha_form').css("border" , "2px solid red");
                    return false; 
                }
           }
        });
});        
        
    $('form input').on('keypress', function(e) {
        return e.which !== 13;
    });
    
    
    
var TodayDate = new Date();
var d = TodayDate.getDay();
var m = TodayDate.getMonth();
var y = TodayDate.getFullYear();
if(d == 0){
    $("#pickup *").prop('disabled','disabled');
    $("#delivery_address *").prop('disabled','disabled');
}

function getHourDownList() {

    var time_type = document.getElementById('time_type').value;
    var start_hour;
    var end_hour;
    var options ;    
    var i;
    var current_hour = <?php echo $h; ?>;
    var current_type = '<?php echo $a; ?>';
    
    
        if(time_type == 'am'){            
            start_hour = <?php echo intval(substr($setting[9]['setting_value'], 0, 2)); ?>;
            start_hour = start_hour % 12 || 12;
            end_hour = 11;
            if(time_type == current_type && current_hour > start_hour){        
                start_hour = current_hour;
            }
            for(i=start_hour;i<=end_hour;i++)
            {
                if(i<=9)
                {
                    if(i==current_hour && time_type == current_type){
                        options+="<option value=0"+i+" selected='selected'>0" + i + "</option>";
                    }else{
                        options+="<option value=0"+i+">0" + i + "</option>";
                    }                    
                }
                else
                {
                    if(i==current_hour && time_type == current_type){
                        options+="<option value="+i+" selected='selected'>" + i + "</option>";
                    }else{
                        options+="<option value="+i+">" + i + "</option>";
                    }                    
                }
            }
        } else if(time_type == 'pm') {            
            start_hour = 0;
            end_hour = <?php echo intval(substr($setting[10]['setting_value'], 0, 2)); ?>;
            end_hour = end_hour % 12 || 12;
            if(time_type == current_type && current_hour < end_hour){        
                start_hour = current_hour;
            }
            for(i=start_hour;i<=end_hour;i++)
            {
                if(i<=9)
                {
                    if(i==current_hour && time_type == current_type){
                        options+="<option value=0"+i+" selected='selected'>0" + i + "</option>";
                    }else{
                        options+="<option value=0"+i+">0" + i + "</option>";
                    }         
                }
                else
                {
                    if(i==current_hour && time_type == current_type){
                        options+="<option value="+i+" selected='selected'>" + i + "</option>";
                    }else{
                        options+="<option value="+i+">" + i + "</option>";
                    }
                }
                

            }
        }
            
    

    
    $("#hour").empty();
    $("#hour").append(options);
}
function getMinuteDownList() {

    var time_type = document.getElementById('time_type').value;
    var hour = document.getElementById('hour').value;
    var start_hour;
    var end_hour;
    var options ;    
    var i;
    var current_hour = <?php echo $h; ?>;
    var current_minute = <?php echo $I; ?>;
    var current_type = '<?php echo $a; ?>';
    
    if(time_type == current_type && hour == current_hour){            
            
        for(i=current_minute;i<=59;i++)
        { 
            if(i<=9)
            {                    
                    options+="<option value=0"+i+">0" + i + "</option>";                                        
            }
            else
            {                    
                    options+="<option value="+i+">" + i + "</option>";                 
            }
            i=i+14;                
        }
    } else {
        
        for(i=0;i<=59;i++)
        { 
            if(i<=9)
            {                    
                    options+="<option value=0"+i+">0" + i + "</option>";                                        
            }
            else
            {                    
                    options+="<option value="+i+">" + i + "</option>";                 
            }
            i=i+14;                
        }
    }
        

    $("#minute").empty();
    $("#minute").append(options);
}
</script>