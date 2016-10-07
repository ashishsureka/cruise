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
                        $form_attr = array('id' => 'add_module_frm','enctype' => 'multipart/form-data');
                        echo form_open_multipart('modules/add', $form_attr);
                        ?>
                         <div class="box-body">
                             
                            <div class="form-group col-sm-10">
                                <label class="col-sm-2 control-label">Project Name</label>
                                <div class="col-sm-6">
                                    <select name="project_id" id="project_id" class="form-control" >
                                        <option value=""> -- Select Project -- </option>
                                        <?php foreach ($projects_list as $project){
                                            echo '<option value="'.$project['prj_id'].'">'.$project['prj_title'].'</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                             
                            <div class="form-group col-sm-10">
                                <label class="col-sm-2 control-label">Module Title</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="module_title" id="module_title" placeholder="Module Title" maxlength="120">
                                </div>
                            </div>
                            
                            <div class="form-group col-sm-10">
                                <label class="col-sm-2 control-label">Module Description</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="module_description" id="module_description" rows="6" placeholder="Module Description" maxlength="500"></textarea>                                    
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
<?php echo $footer; ?>

<script type="text/javascript">
    //validation for edit email formate form
    $(document).ready(function () {


        $("#add_module_frm").validate({
            
            rules: {
                project_id:{
                    required: true,
                },
                module_title:{
                    required: true,
                },
                module_description:{
                    required: true,
                },                 
                
            },
            messages:{
                project_id: {
                    required: "Project Name is required",                    
                },
                module_title: {
                    required: "Module Title is required",                    
                },
                module_description: {
                    required: "Module Description is required",                    
                },               
                
            },
        });

    });
</script>