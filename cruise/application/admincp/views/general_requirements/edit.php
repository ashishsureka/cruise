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
            <li>
                <a href="<?php echo base_url('projects'); ?>">                    
                    Project Management
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
                        $form_attr = array('id' => 'add_req_frm','enctype' => 'multipart/form-data');
                        echo form_open_multipart('general_requirements/edit/', $form_attr);
                        ?>
                    <input type="hidden" name="project_id" id="project_id" value="<?php if(isset($requirement_detail[0]['prj_id'])){ echo $requirement_detail[0]['prj_id']; } ?>" />
                    <input type="hidden" name="requirement_id" id="requirement_id" value="<?php if(isset($requirement_detail[0]['prr_id'])){ echo $requirement_detail[0]['prr_id']; } ?>" />
                        <div class="box-body">
                            <div class="form-group col-sm-10">
                                <label class="col-sm-2 control-label">Requirement Title</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="requirement_title" id="requirement_title" placeholder="Requirement Title" maxlength="120" value="<?php if(isset($requirement_detail[0]['prr_title'])){ echo $requirement_detail[0]['prr_title']; } ?>">
                                </div>
                            </div>
                            
                            <div class="form-group col-sm-10">
                                <label class="col-sm-2 control-label">Requirement Description</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="requirement_desc" id="requirement_desc" placeholder="Requirement Description" rows="5" maxlength="500"><?php if(isset($requirement_detail[0]['prr_description'])){ echo $requirement_detail[0]['prr_description']; } ?></textarea>
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


        $("#add_req_frm").validate({
            
            rules: {
              
                requirement_title:{
                    required: true,
                },
                requirement_desc:{
                    required: true,
                },                
            },
            messages:{
                requirement_title:{
                    required:"Title is required"
                },
                requirement_desc:{
                    required:"Description is required"
                },
                

            },
        });

    });
</script>