<?php echo $head; ?>
<?php echo $header; ?>
    
        <!--header end-->
        <!--content start-->
        <div class="content">
            <section>
                <div class="container">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 login_con">
                        <div class="login">
                            <h1 class="text-center" style="margin-top: 25px">Manage Profile</h1>                            
                            <button type="button" class="btn fill_btn" style="float: right;margin-top: 0" onclick="window.history.back()">Go Back</button><br><br>
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
                                <?php echo form_open_multipart('profile',array('name'=>'update_profile','id'=>'update_profile','method'=>'POST',' enctype'=>'multipart/form-data'));  ?>
                                <label>First Name</label>
                                <input type="text" name="fname" value="<?php if(isset($profile_detail[0]['user_first_name'])){ echo $profile_detail[0]['user_first_name']; } ?>" placeholder="First Name"/>
                                <label>Last Name</label>
                                <input type="text" name="lname" value="<?php if(isset($profile_detail[0]['user_last_name'])){ echo $profile_detail[0]['user_last_name']; } ?>" placeholder="Last Name"/>                                
                                <label>Email</label>
                                <input type="text" name="email" value="<?php if(isset($profile_detail[0]['user_email'])){ echo $profile_detail[0]['user_email']; } ?>" id="email" placeholder="Email"/>  
                                <label>Profile Image</label>
                                <input type="file" name="profile_image" placeholder="Profile Image" />
                                <input type="hidden" name="profile_image_hide" value="<?php if(isset($profile_detail[0]['user_profile_image'])){ echo $profile_detail[0]['user_profile_image']; } ?>">
                                <?php if(isset($profile_detail[0]['user_profile_image']) && $profile_detail[0]['user_profile_image']){ ?>
                                <br><img src="<?php echo base_url().$this->config->item('profile_thumb_image').$profile_detail[0]['user_profile_image'] ?>" width="50" height="50"><br><br>
                                <?php } ?>
                                <button type="submit" class="btn fill_btn" style="margin-top: 0; width: 48.5%">Submit</button>
                                <button type="button" class="btn fill_btn" style="margin-top: 0; width: 48.5%" onclick="window.location='<?php echo site_url() ?>'">Cancel</button><br><br><br>                               
                                <?php echo form_close() ?>                                
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

        $("#update_profile").validate({
            
            rules: {
              
                fname:{
                    required: true,
                },  
                lname:{
                    required: true,
                },
                email:{
                    required: true,
                    email:true,
                    remote: {
                        url: "<?php echo base_url() . 'profile/check_email' ?>",
                        type: "post",
                        data: {
                            email: function () {
                                return $("#email").val();
                            },                            
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        },
                    },
                },                
                
            },
            messages:{
                fname: {
                    required: "First name is required",                    
                },                
                lname: {
                    required: "Last name is required",                    
                },                
                email: {
                    required: "Email is required",                    
                    email: "Invalid email format",
                    remote:"Email is already exists",
                },                
                
            },
        });
        
    });
        
</script>    

</html>