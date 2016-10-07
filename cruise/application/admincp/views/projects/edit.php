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
                        $form_attr = array('id' => 'add_prj_frm','enctype' => 'multipart/form-data');
                        echo form_open_multipart('projects/edit', $form_attr);
                        ?>
                    <input type="hidden" name="project_id" id="project_id" value="<?php echo $project_detail[0]['prj_id']; ?>" />
                        <div class="box-body">
                            <div class="form-group col-sm-10">
                                <label class="col-sm-2 control-label">Project Title</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="project_title" id="project_title" placeholder="Project Title" maxlength="120" value="<?php if(isset($project_detail[0]['prj_title'])){ echo $project_detail[0]['prj_title'] ; } ?>">
                                </div>
                            </div>
                            
                            <div class="form-group col-sm-10">
                                <label class="col-sm-2 control-label">Project Description</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="project_description" id="project_description" rows="6" placeholder="Project Description" maxlength="500"><?php if(isset($project_detail[0]['prj_description'])){ echo $project_detail[0]['prj_description'] ; } ?></textarea>                                    
                                </div>
                            </div>
                            <?php if(isset($project_detail[0]['prj_createdby']) && $project_detail[0]['prj_createdby'] == 'admin'){ ?>
                            <div class="form-group col-sm-10">
                                <label class="col-sm-2 control-label">Project Owner</label>
                                <div class="col-sm-6">
                                    <select name="project_user" id="project_user" class="form-control" >
                                        <option value=""> -- Select User -- </option>
                                        <?php foreach ($users_list as $user){
                                            if(isset($project_detail[0]['user_id']) && $project_detail[0]['user_id'] == $user['user_id']){
                                                $selected = "selected='selected'";
                                            } else {
                                                $selected = "";
                                            }
                                            echo '<option value="'.$user['user_id'].'" '.$selected.'>'.$user['user_first_name']." ".$user['user_last_name'].'</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <?php } else { ?>     
                            <input type="hidden" name="project_user" value="<?php if(isset($project_detail[0]['user_id'])){ echo $project_detail[0]['user_id']; } ?>">
                            <?php } ?>
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


        $("#add_prj_frm").validate({
            
            rules: {
              
                project_title:{
                    required: true,
                },
                project_description:{
                    required: true,
                },                 
                project_user:{
                    required: true,
                }
            },
            messages:{
                project_title: {
                    required: "Project Title is required",                    
                },
                project_description: {
                    required: "Project Description is required",                    
                },                
                project_user: {
                    required: "Project Owner is required",                    
                },                
            },
        });

    });
</script>