
<div class="footer" id="footer">	
    <div class="container">		
        <div class="footer-grids">				
            <div class="col-sm-3 footer-grid">				
                <h4>GET IN TOUCH
                </h4>				
                <ul>
                    <?php
                    $add = explode('|', $phone[3]['setting_value']);
                    foreach ($add as $line) {
                        echo "<li>$line</li>";
                    }
                    ?>

                    <hr>                                        
                    <li>Tel:<?php echo $phone[5]['setting_value'] ?></p>
                    </li>				



                    <li>Email: 
                        <a href="mailto:"<?php echo $phone[4]['setting_value'] ?>><?php echo $phone[4]['setting_value'] ?>
                        </a>
                    </li>				
                </ul>			
            </div>						
            <div class="col-sm-3 footer-grid">                            
                <h4>RESTAURANT HOURS
                </h4>                            
                <H5>Lunch
                </H5>                            
                <ul>	
                    <?php
                    $add = explode('|', $phone[6]['setting_value']);
                    foreach ($add as $line) {
                        echo "<li>$line</li>";
                    }
                    ?>

                </ul>                            
                <hr>                            
                <H5>Dinner
                </H5>                            
                <ul>
                    <?php
                    $add = explode('|', $phone[7]['setting_value']);
                    foreach ($add as $line) {
                        echo "<li>$line</li>";
                    }
                    ?>

                </ul>
            </div>			
            <div class="col-sm-3 footer-grid">			
                <h4>QUICK INQUIRY
                </h4>              

                
                 
                <div id="footer-contact-error" style="display: none">
                        <i class="icon-remove close" data-dismiss="alert"></i>                        
                    </div>
                <form>
                

                <input type="hidden" name="footer_flash" value="1">

                <input type="text" value="" placeholder="Full Name*" id="footer-name-c" name="name-c" required >

                <input type="email" value="" placeholder="Email*" id="footer-email-c" name="email-c" required >

                <input type="text" placeholder="Phone*" id="footer-phone-c" name="phone-c" pattern="[789][0-9]{9}" value="" required >

                <textarea id="footer-message-c" name="message-c" placeholder="Message" required></textarea>

                <input type="hidden" name="redirect_url" value="<?php echo $this->uri->segment(1) ?>">

                <input type="button" id="footer_contactus_submit" value="SUBMIT">
                
                </form>
            </div>
            <div class="col-sm-3 footer-grid">                        
                <h4> LOCATION
                </h4>                        
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3044.212836529143!2d-76.89329868454928!3d40.27102207241205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c8c1158dc70847%3A0x14e1f6a40117cfe5!2s263+Reily+St%2C+Harrisburg%2C+PA+17102%2C+USA!5e0!3m2!1sen!2sin!4v1458388524825" width="600" height="450" frameborder="0" style="border:0" allowfullscreen>
                </iframe>                    
            </div>			
            <div class="clearfix">
            </div>		
        </div>	
    </div>
</div>
<!-- //footer -->
<div class="strip1">
</div>
<!-- copy -->
<div class="copy-right">	
    <div class="container">            
        <div class="row">                
            <div class="col-sm-4">
            </div>                
            <div class="col-sm-4">                    
                <p> &copy;2016 Aangan Rasraj LLC. All rights reserved  
                </p>                
            </div>           		 
            <div class="col-sm-4">                
                <h6> <a href="http://www.winspirewebsolution.com/" target="_blank"> Developed By : Winspire Web Solution </a>
                </h6>	
            </div>                 
        </div>
    </div>
</div>
<!-- //copy -->
<!-- for bootstrap working -->	
<script src="<?= base_url('js/bootstrap.js'); ?>">
</script>
<!-- //for bootstrap working -->
<!-- smooth scrolling -->	
<script type="text/javascript">
    $(document).ready(function () {
        $().UItoTop({
            easingType: 'easeOutQuart'}
        );
    }
    );
</script>	
<a href="javascript:void(0)" id="toTop" style="display: block;"> 
    <span id="toTopHover" style="opacity: 1;"> 
    </span>
</a>       
<!-- //smooth scrolling -->
<script>
    $(document).ready(function () {
        $('img.img1').click(function () {
            window.location.href = this.id + '.html';
        });
    });
</script>
 <!-- script for menu -->
        <script type="text/javascript">
            $("span.menu").click(function () {
                $("ul.nav1").slideToggle(300, function () {
        // Animation complete.
                });
            });
        </script>

</body>
</html>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body ">


                <ul class="nav nav-tabs">
                    <li id="active_login" class="active"><a href="#login" data-toggle="tab">Login</a></li>

                    <li id="active_create"><a href="#create" data-toggle="tab">Create Account</a></li>
                </ul>
                <ul class="nav nav-tabs">
                    <li id="active_forgot" class="active"  style="display: none; width: 100%"><a href="#forgot" data-toggle="tab">Forgot Password</a></li>

                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active in" id="login">
                        <div class="login2">
                            <div class="inset">
                                <!--erroe msg-->
                                <div class="alert fade in alert-danger myalert" id="err_msg" style="display:none;">
                                    <!--<i class="icon-remove close" data-dismiss="alert"></i>-->

                                </div>
                                <!-----start-main---->
                                <form>
                                    <div>
                                        <span><label>Email Address</label></span>
                                        <span><input type="text" class="textbox" name="email"  id="active"></span>
                                    </div>
                                    <div>
                                        <span><label>Password</label></span>
                                        <span><input type="password" class="password" name="password" id="password" ></span>
                                    </div>
                                    <div class="sign">
                                        <div class="submit">
                                            <input type="button" onclick="login()" id="loginbutton"  value="LOGIN" >
                                        </div>
                                        <span class="forget-pass">
                                            <a href="#forgot" id="forgot_click" class="log_popup"  data-toggle="tab">Forgot Password?</a>
                                        </span>
                                        <div class="clear"> </div>
                                    </div>
                                </form>
                            </div>
                        </div>           
                    </div>
                    <div class="tab-pane fade" id="create">
                        <div class="signup-main">
                            <!--for msg display after registration-->
                            <div class="alert fade in alert-success" id="err_msg_register" style="display:none;">

                            </div>
                            <!--                                                        <div class="alert fade in alert-danger myalert" id="err_msg_register" style="display:none;">
                                                                                        <i class="icon-remove close" data-dismiss="alert"></i>
                                                                                       
                                                                                    </div>-->
                            <form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!--<label class="error" for="gallery">gallery image is required</label>-->
                                        <input type="text" name="first_name" id="first_name"  placeholder="First Name"/>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="last_name" id="last_name" placeholder="Last Name"  />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="text" name="email" id="email" placeholder="Email Id"/>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="password" placeholder="Password" name="rpassword" id="rpassword"  />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="rconf_password" id="rconf_password" placeholder="Confirm Password" />
                                    </div>
                                </div>




                                <div class="submit">
                                    <input type="button" onclick="register()" value="REGISTER" >
                                </div>

                                <p>Already have an account?  <a href="#login" data-toggle="tab" class="log_popup" id="login_click_at_regi">Login Here</a></p>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="forgot">
                        <div class="signup-main">
                            <!--for msg display after registration-->
                            <div class="alert fade in alert-success" id="err_msg_forgot" style="display:none;">

                            </div>
                            
                            <form>
                                <div>
                                        <span><label>Email Address</label></span>
                                        <span><input type="text" name="forgot_email" id="forgot_email" class="active" placeholder="Please Enter Your Registered Email"/></span>
                                    </div>
                                
                                
                                <div class="submit">
                                    <input type="button" onclick="forgot()" value="SUBMIT" >
                                </div>

                                <p>Already have an account?  <a href="#login" data-toggle="tab" class="log_popup" id="login_click_at_regi">Login Here</a></p>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div> 
    <!--end of modal of login sachin-->
</div>
<div class="modal fade" id="forgot_pass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="login2">
        <div class="inset">
            <!--erroe msg-->
            <div class="alert fade in alert-danger myalert" id="err_msg" style="display:none;">
                <!--<i class="icon-remove close" data-dismiss="alert"></i>-->
            </div>
            <!-----start-main---->
            <form>
                <div>
                    <span><label>Email Address</label></span>
                    <span><input type="text" class="textbox" name="forgot_email"  id="active"></span>
                </div>                
                <div class="sign">
                    <div class="submit">
                        <input type="button" onclick="login()" id="loginbutton"  value="LOGIN" >
                    </div>
                    <span class="forget-pass">
                        <a href="#">Forgot Password?</a>
                    </span>
                    <div class="clear"> </div>
                </div>
            </form>
        </div>
    </div>           
</div>

<!--image for loader-->


<script type="text/javascript">

    $(document).on('focus', '#active,#password', function () {
        $('#err_msg').css("display", "none");

    });//script for login and register popup
    $(document).on('click', '.log_popup', function () {

        var id = $(this).prop('id');

        if (id == 'login_click' || id == 'login_click_at_regi') {
            $('#login').addClass('active in').removeClass('fade');
            $('#forgot').removeClass('active in').addClass('fade');
            $('#create').addClass('fade').removeClass('active in');
            $('#active_forgot').css('display','none');
            $('#active_login').css('display','block').addClass('active');
            $('#active_create').css('display','block').removeClass('active');

        }

        if (id == 'register_click') {
            $('#login').removeClass('active in').addClass('fade');
            $('#forgot').removeClass('active in').addClass('fade');
            $('#create').removeClass('fade').addClass('active in');
            $('#active_forgot').css('display','none');
            $('#active_login').css('display','block').removeClass('active');
            $('#active_create').css('display','block').addClass('active');
        }
        
        if (id == 'forgot_click') {            
            
            $('#login').removeClass('active in').addClass('fade');
            $('#create').removeClass('active in').addClass('fade');
            $('#forgot').removeClass('fade').addClass('active in');
            $('#active_login').css('display','none');
            $('#active_create').css('display','none');
            $('#active_forgot').css('display','block');
            
        }

    });


    function login() {
//       loginbutton 
        var email = $('#active').val();
        var password = $('#password').val();
        if (email == '') {
            $('#err_msg').css("display", "block");
            $('#err_msg').text("Please enter emial");
            return false;
        }


        $.ajax({
            url: "<?php echo base_url('login/authenticate'); ?>",
            type: "post",
            data: {'email': email, 'password': password,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
            },
            success: function (result) {
                //alert(result);
                if ('Disable' == result) {
                    $('#err_msg').css("display", "block");
                    $('#err_msg').text("Your account is disable by admin. Please contact admin for more detail.");
                } else if (result == 'Wrong') {
                    $('#err_msg').css("display", "block");
                    $('#err_msg').text("Username or password is wrong. Please try again!");
                } else {
                    var baseurl = "<?php print base_url(); ?>";
                    //window.history.back();
                    $('#err_msg').css("display", "none");
                    window.location.href = baseurl + "login/session/" + result;
//                       alert("successcode here");
                }
            }
        });

    }
    $(document).on('focus', '#first_name,#email', function () {
        $(this).css("border", "2px solid #609ec3");

    });


    function register() {

        var email = $('#email').val();
        var password = $('#rpassword').val();
        var confpassword = $('#rconf_password').val();
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var err = 0;
       var check_mob_no = /^[0-9]{1,10}$/;

//    first for validation

        if (first_name == '') {
            $('#first_name').css("border", "2px solid red");
            err++;
        }
        if (last_name == '') {
            $('#last_name').css("border", "2px solid red");
            err++;

        }

        if (password == '') {
            $('#rpassword').css("border", "2px solid red");
            err++;
        }
        if (confpassword == '') {
            $('#rconf_password').css("border", "2px solid red");
            err++;
        } else if (password != confpassword) {
            $('#rpassword').css("border", "2px solid red");
            $('#rconf_password').css("border", "2px solid red");
            err++;
        }

        if (email == '') {
            $('#email').css("border", "2px solid red");
            err++;
        } else {//check for unique ness and format
            //first check format
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(email))
            {
                $('#email').css("border", "2px solid red");
                err++;
            } else {

//                check unique ness
                $.ajax({
                    url: "<?php echo base_url('login/check_email'); ?>",
                    type: "post",
                    data: {'email': email, 'password': password, 'first_name': first_name,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                    },
                    success: function (result) {
                        if (result == "false") {
                            $('#email').css("border", "2px solid red");
                            err++;

                        }
                        else
                        {
                            if (err) {
                                return false;
                            } else {//goes for register
                                $.ajax({
                                    url: "<?php echo base_url('login/add'); ?>",
                                    type: "post",
                                    data: {'email': email, 'first_name': first_name, 'last_name': last_name, 'last_name': last_name, 'password': password,
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                    },
                                    success: function (result) {
                                        //alert(result);
                                        if (result == 'true') {
                                            //alert('hi');
                                            window.location.reload();
                                            
                                        } else {
                                            $('#err_msg_register').css("display", "block");
                                            $('#err_msg_register').text("Something is wrong Please try again!");
                                        }

                                    }
                                });
                            }
                        }

                    }
                });
            }
        }



    }


    function forgot() {

        var forgot_email = $('#forgot_email').val();
        
        var err = 0;       

//    first for validation

        if (forgot_email == '') {
            $('#forgot_email').css("border", "2px solid red");
            err++;
        } else {//check for unique ness and format
            //first check format
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(forgot_email))
            {
                $('#forgot_email').css("border", "2px solid red");
                err++;
            } else {
            
                $.ajax({
                    url: "<?php echo base_url('login/fetch_email'); ?>",
                    type: "post",
                    data: {'email': forgot_email,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                    },
                    success: function (result) {                        
                        if (result == "false") {
                            $('#forgot_email').css("border", "2px solid red");
                            err++;

                        }
                        else
                        {                            
                            if (err) {
                                return false;
                            } else {
                                $.ajax({
                                    url: "<?php echo base_url('login/forgot'); ?>",
                                    type: "post",
                                    data: {'email': forgot_email,
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                    },
                                    success: function (result) {
                                        //alert(result);
                                        if (result == 'true') {                                            
                                            $('#err_msg_forgot').css("display", "block");
                                            $('#err_msg_forgot').text("Your New Password is successfully sent to your email id !!!");
                                            
                                        } else {
                                            $('#err_msg_forgot').css("display", "block");
                                            $('#err_msg_forgot').text("Something is wrong Please try again!");
                                        }
                                    }
                                });
                            }
                        }

                    }
                });
            }
        }



    }

$(document).on('click', '.cart_delete', function(){
       var id=$(this).attr('id');
     // alert(id);
      
         
         $.ajax({
                url: "<?php echo site_url('menu/deleteitem'); ?>",
                type: "post",
                dataType:"html",
                data: {'id': id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function (result) {
                    var item_price = $("#actual_"+id).text();
                    var item_price_main = item_price.split('$');
                    var total_price = $("#total_right").text();
                    var total_price_main = total_price.split('$');
                    var total = parseFloat(total_price_main[1]) - parseFloat(item_price_main[1]);
                    $('#cart_box_'+id).fadeOut(300, function(){ $('#cart_box_'+id).remove();})
                    if(total>0)
                    {
                    var final_total ='$'+total;
                   $("#total_right").text(final_total);
               }
               else
               {
                   $("#total").hide();
                   $("#chkbutton").hide();
                   $("#carttext").text("No item found in cart.");
               }
           }
            });

    });

$(document).on('click', '#cart_checkout', function(){
var checkout_price = $("#cart_total_text").text();
var checkout_total = checkout_price.split('$');
if(checkout_total[1] < 10){    
    $('.cart_total_error').css("display", "block");
    return false;
} else {
    $('.cart_total_error').css("display", "none");
    }

});

$(document).on('click', '#chkbutton', function(){
    
var checkout_price = $("#total_right").text();
var checkout_total = checkout_price.split('$');

if(checkout_total[1] < 10){        
    $('.header_checkout_error').css("display", "block");
    return false;
} else {
    $('.header_checkout_error').css("display", "none");
    }

});

$(document).ready(function() {
    
    $("#contactus_submit").click(function(){
       var name=$('#name-c').val();
       var email=$('#email-c').val();
       var phone=$('#phone-c').val();
       var message=$('#message-c').val();
         
         $.ajax({
                url: "<?php echo site_url('contactus/mail'); ?>",
                type: "post",
                dataType:"html",
                data: {'name-c': name,'email-c': email,'name-c': name,'phone-c': phone,'message-c': message,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function (result) {
                    if(result == 'true'){
                        $('#contact-error').text('Thanks for contacting us and will get back to you soon!').addClass('alert fade in alert-success myalert').css('display','block');
                    } else {
                        $('#contact-error').text('Error Occurred. Try Again!').addClass('alert fade in alert-danger myalert').css('display','block');
                    }
           }
            });

    });
    
    $("#footer_contactus_submit").click(function(){
       var name=$('#footer-name-c').val();
       var email=$('#footer-email-c').val();
       var phone=$('#footer-phone-c').val();
       var message=$('#footer-message-c').val();
                  
         $.ajax({
                url: "<?php echo site_url('contactus/mail'); ?>",
                type: "post",
                dataType:"html",
                data: {'name-c': name,'email-c': email,'name-c': name,'phone-c': phone,'message-c': message,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function (result) {
                    if(result == 'true'){
                        $('#footer-contact-error').text('Thanks for contacting us and will get back to you soon!').addClass('alert fade in alert-success myalert').css('display','block');
                    } else {
                        $('#footer-contact-error').text('Error Occurred. Try Again!').addClass('alert fade in alert-danger myalert').css('display','block');
                    }
           }
            });

    });
    });


</script>
