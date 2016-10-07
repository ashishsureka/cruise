<?php
echo $header;
echo $leftmenu;
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo $module_name; ?>
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url('dashboard'); ?>">
                    <i class="fa fa-dashboard"></i>
                    Home
                </a>
            </li>
            <li class="active"><?php echo $module_name; ?></li>
        </ol>
    </section>

                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert fade in alert-success">
                                <i class="icon-remove close" data-dismiss="alert"></i>
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('error')) { ?>  
                            <div class="alert fade in alert-danger" >
                                <i class="icon-remove close" data-dismiss="alert"></i>
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php } ?>


    <!-- Main content -->
    <section class="content">
        <div class="row">
           
            <div class="col-md-12">
               
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $section_title; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                     <?php
                        $form_attr = array('id' => 'add_user_frm','enctype' => 'multipart/form-data');
                        echo form_open_multipart('user/edit', $form_attr);
                        ?>
                    <input type="hidden" name="userid" id="userid" value="<?php echo $user_detail[0]['user_id']; ?>" />
                        <div class="box-body">
                            <div class="form-group col-sm-10">
                                <label class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" value="<?php echo $user_detail[0]['user_first_name']; ?>">
                                </div>
                            </div>
                            
                            <div class="form-group col-sm-10">
                                <label class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" value="<?php echo $user_detail[0]['user_last_name']; ?>">
                                </div>
                            </div>
                                                                                 
                            <div class="form-group col-sm-10">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $user_detail[0]['user_email']; ?>">
                                </div>
                            </div>                            
                           
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <?php
                            $save_attr = array('id' => 'btn_save', 'name' => 'btn_save', 'value' => 'Save', 'class' => 'btn btn-primary');
                            echo form_submit($save_attr);
                            ?>    
                            <button type="button" onclick="window.history.back();" class="btn btn-default">Back</button>
                            <!--<button type="submit" class="btn btn-info pull-right">Sign in</button>-->
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box -->
              
              
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php echo $footer ?>

<script type="text/javascript">
    //validation for edit email formate form
    $(document).ready(function () {


        $("#add_user_frm").validate({
            
            rules: {
              
                contact_no:{
                    required: true,
                },
                address:{
                    required: true,
                },
                 email: {
                    required: true,
                    email:true,
                    remote: {
                        url: "<?php echo base_url() . 'user/check_email' ?>",
                        type: "post",
                        data: {
                            email: function () {
                                return $("#email").val();
                            },
                            userid: function () {
                                return $("#userid").val();
                            },
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        },
                    },
                },
                username: {
                    required: true,
                    remote: {
                        url: "<?php echo base_url() . 'user/check_username' ?>",
                        type: "post",
                        data: {
                            username: function () {
                                return $("#username").val();
                            },
                            userid: function () {
                                return $("#userid").val();
                            },
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        },
                    },
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 16
                },
                conf_password:{
                    equalTo:"#password",
                    required:true
                }
            },
            messages:{
                contact_no:{
                    required:"Contact No is required"
                },
                address:{
                    required:"Address is required"
                },
                email: {
                    required: "Email is required",
                    email: "Enter valid email",
                    remote:"Email already exists"
                },
                username: {
                    required: "User name is required",
                    remote:"User name is already exists"
                },
                password: {
                    required: "Password is required",
                    minlength: "Password must be 6-16 characters long",
                    maxlength: "Password must be 6-16 characters long"
                },
                conf_password:{
                    required:"Confirm Password is required",
                    equalTo:"Password and confirm password must match"
                }

            },
        });

    });
</script>