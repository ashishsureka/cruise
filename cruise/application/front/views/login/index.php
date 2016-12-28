<?php echo $head; ?>
<?php echo $header; ?>
    
        <!--header end-->
        <!--content start-->
        <div class="content">
            <section>
                <div class="container">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 text-center login_con">
                        <div class="login">
                            <h1>Log In</h1>                            
                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert fade in alert-success">
                                    <i class="icon-remove close" data-dismiss="alert"></i>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('error')) { ?>  
                                <div class="alert fade in alert-danger myalert" >
                                    <i class="icon-remove close" data-dismiss="alert"></i>
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php } ?>
                            
                            <div class="con_mail">
                                <?php echo form_open('login',array('name'=>'login_frm','id'=>'login_frm','method'=>'POST'));  ?>
                                <input type="email" name="email" placeholder="email@example.com"/>
                                <input type="password" name="password" placeholder="**********"/>                                
                                <button type="submit" class="btn fill_btn">Log In</button>
                                <?php echo form_close() ?>
                                <?php 
//                                $save_attr = array('id' => 'btn_save', 'name' => 'btn_save', 'value' => 'Log In', 'class' => 'btn fill_btn');
//                                echo form_submit($save_attr); 
                                ?>
                                <a href="#" data-toggle="modal" data-target="#forgotpass">Forgot your Password?</a>
                                    <div class="modal fade" id="forgotpass" role="dialog">
                                    <div class="modal-dialog" >

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"><img src="images/x.png" alt="close"/></button>
                                            <div class="modal-body" >
                                                <?php echo form_open('login/forgot',array('name'=>'forgot_frm','id'=>'forgot_frm','method'=>'POST'));  ?>
                                                <div class="login text-center">
                                                    <h1>Forgot Password</h1>
                                                    <h6>Please enter your email below and we will send you a new password.</h6>
                                                    <div class="con_mail">
                                                        <input type="email" name="forgot_email" id="forgot_email" placeholder="Email Address"/>
                                                        <button type="submit" class="btn fill_btn pull-right">Submit</button>
                                                    </div>
                                                </div>
                                                <?php echo form_close() ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </section>
            <!--content end-->
        </div>
        
<?php echo $footer; ?>
    </body>


<script type="text/javascript">
    //validation for edit email formate form
    $(document).ready(function () {

        $("#login_frm").validate({
            
            rules: {
              
                email:{
                    required: true,
                    email:true,
                },
                password:{
                    required: true,
                },                  
            },
            messages:{
                email: {
                    required: "Email is required",                    
                    email: "Invalid email format",
                },
                password: {
                    required: "Password is required",                    
                },                                
            },
        });
        
        $("#forgot_frm").validate({
            
            rules: {
              
                forgot_email:{
                    required: true,
                    email:true,
                },                
            },
            messages:{
                forgot_email: {
                    required: "Email is required",                    
                    email: "Invalid email format",
                },                
            },
        });

        $("#register_frm").validate({
            
            rules: {
              
                reg_email:{
                    required: true,
                    email:true,
                },
                reg_firstname:{
                    required: true,
                },  
                reg_lastname:{
                    required: true,
                },
                reg_password:{
                    required: true,
                }
                
            },
            messages:{
                reg_email: {
                    required: "Email is required",                    
                    email: "Invalid email format",
                },
                reg_firstname: {
                    required: "First name is required",                    
                },                
                reg_lastname: {
                    required: "Last name is required",                    
                },                
                reg_password: {
                    required: "Password is required",                    
                },                
                
            },
        });
        $('.modal').on('hidden.bs.modal', function () {
           location.reload(true);
       })
    });
    
    $( "#reg_submit" ).click(function() {
        $("#success").css("display","none");
        $("#unsuccess").css("display","none");
        var validated = $("#register_frm").valid();
        var reg_email = $("#reg_email").val();
        var reg_firstname = $("#reg_firstname").val();
        var reg_lastname = $("#reg_lastname").val();
        var reg_password = $("#reg_password").val();        
        if(validated)
        {
            $.ajax({
                url:"<?php echo base_url('login/register') ?>",
                type:"post",
                dataType:"html",
                data:{'reg_email':reg_email,'reg_firstname':reg_firstname,'reg_lastname':reg_lastname,'reg_password':reg_password,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){                    
                    if(data=='success')
                    {
                        $("#success").text('Please check your email for activation').css("display","block");
                    }
                    else
                    {
                        $("#unsuccess").text(data).css("display","block");
                    }
                }
             });
        }
      });
</script>    

</html>