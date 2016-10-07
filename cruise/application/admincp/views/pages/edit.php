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
                        $form_attr = array('id' => 'add_pages_frm','enctype' => 'multipart/form-data');
                        echo form_open_multipart('pages/edit', $form_attr);
                        ?>
                    <input type="hidden" name="page_id" id="id" value="<?php echo $pages_detail[0]['page_id']; ?>" />
                        <div class="box-body">
                           
                                                        
                            <div class="form-group col-sm-10">
                                <label for="inputEmail3" name="page_title" id="page_title" class="col-sm-2 control-label">Page Title*</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="page_title" id="page_title" value="<?php echo $pages_detail['0']['page_title'] ?>">
                                    
                                    
                                </div>
                            </div>
                            
                            <div class="form-group col-sm-10">
                                <label for="inputEmail3" name="page_title" id="page_title" class="col-sm-2 control-label">Metatag Title *</label>
                                <div class="col-sm-6">
                                    <textarea id="metatag_title" class="form-control"  cols="20"  rows="2" name="metatag_title"><?php echo $pages_detail[0]['page_meta_title']; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group col-sm-10">
                                <label for="inputEmail3" name="page_title" id="page_title" class="col-sm-2 control-label">Metatag Keywords *</label>
                                <div class="col-sm-6">
                                    <textarea id="metatag_keywords" class="form-control"  cols="20" rows="2" name="metatag_keywords"><?php echo $pages_detail[0]['page_meta_keywords']; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group col-sm-10">
                                <label for="inputEmail3" name="page_title" id="page_title" class="col-sm-2 control-label">Metatag Description *</label>
                                <div class="col-sm-6">
                                    <textarea id="metatag_desc" class="form-control"  cols="20" rows="2" name="metatag_description"><?php echo $pages_detail[0]['page_meta_descriptions']; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group col-sm-10">
                                <label for="inputEmail3" name="page_title" id="page_title" class="col-sm-2 control-label">Description *</label>
                                <div class="col-sm-6">
                                    <?php echo form_textarea(array('name' =>'page_description','id'=>'page_description','class'=>"ckeditor",'value'=>$pages_detail[0]['page_description'])); ?><br>
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


        $("#add_pages_frm").validate({
            
            rules: {
                page_title: {
                    required: true,
                },
                metatag_title: {
                    required: true,
                },
                metatag_keywords: {
                    required: true,
                },
                shortdescription: {
                    required: true,
                },
                page_description: {
                    required: true,
                },
                metatag_desc: {
                    required: true,
                }
            },
            messages:
                    {
                    page_title: {
                        required: "Page Title is required",
                    },
                    metatag_title: {
                        required: "Metatag Title is required",
                    },
                    metatag_keywords: {
                        required: "Metatag Keywords is required",
                    },
                    shortdescription: {
                        required: "Short Description is required",
                    },
                    page_description: {
                        required: "Page Description is required",
                    },
                    metatag_desc: {
                        required: "Metatag Description is required",
                    }
            },
        });

    });
    
    
  var roxyFileman = '<?php echo base_url().'../uploads/upload.php'; ?>' ; 

   CKEDITOR.replace( 'page_description',{
                                filebrowserBrowseUrl : roxyFileman,
                                filebrowserUploadUrl : roxyFileman,
                                filebrowserImageBrowseUrl : roxyFileman+'?type=image',
                                filebrowserImageUploadUrl : roxyFileman,
                                extraAllowedContent:  'img[alt,border,width,height,align,vspace,hspace,!src];' ,
                                removeDialogTabs: 'link:upload;image:upload'}); 

CKEDITOR.config.allowedContent = true;

CKEDITOR.on('instanceReady', function(ev) {

    // Ends self closing tags the HTML4 way, like <br>.
    ev.editor.dataProcessor.htmlFilter.addRules({
        elements: {
            $: function(element) {
                // Output dimensions of images as width and height
                if (element.name == 'img') {
                    var style = element.attributes.style;

                    if (style) {
                        // Get the width from the style.
                        var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
                            width = match && match[1];

                        // Get the height from the style.
                        match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
                        var height = match && match[1];

                        // Get the float from the style.
                        match = /(?:^|\s)float\s*:\s*(\w+)/i.exec(style);
                        var float = match && match[1];

                        if (width) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
                            element.attributes.width = width;
                        }

                        if (height) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
                            element.attributes.height = height;
                        }
                        if (float) {
                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)float\s*:\s*(\w+)/i, '');
                            element.attributes.align = float;
                        }

                    }
                }

                if (!element.attributes.style) delete element.attributes.style;

                return element;
            }
        }
    });
});  
    
    
</script>