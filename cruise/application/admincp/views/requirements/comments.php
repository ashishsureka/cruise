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
                <a href="<?php echo base_url('modules'); ?>">                    
                    Module Management
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('requirements/index/'.  base64_encode($module_id)); ?>">                    
                    Requirements
                </a>
            </li>
            <li class="active"><?php echo $module_name; ?></li>
        </ol>
    </section>

                       
    
    <!-- Content Header (Page header) -->
                



    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12" >                                
                <?php 
           
            if($total_rows>0){
            if ($this->pagination->create_links()){
                $rec1=$offset+1;
                $rec2=$offset+$limit;
                if($rec2>$total_rows){
                    $rec2=$total_rows;
                }
                ?>
                    <div class="pull-left" style="margin-left: 50px;">
                      <?php  echo "Records $rec1 - $rec2 of $total_rows"; ?>
                    </div><?php 
            }else{ ?>
                <div class="pull-left" style="margin-left: 50px;">
                    <?php echo "Records 1 - $total_rows of $total_rows"; ?>
                </div>
                
            <?php }
            }
            ?>
                <div class=" pull-right">
                    <a href="<?php echo site_url('requirements/index/'.  base64_encode($module_id)); ?>" class="btn btn-primary pull-right">Back</a>
                </div>
                                
            </div>
        </div>

        <div class="row" >
            <div class="col-xs-12" >
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert fade in alert-success myalert">
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
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-xs-12">
                
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $section_title; ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-header">
                        <h5 class="box-title">Module Title : <?php echo $modules_name; ?></h5><br><br>
                        <h5 class="box-title">Requirement Title : <?php echo $gr_name; ?></h5>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="datalist" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <?php $segment2='comments'; ?>
                                    <th>
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(5) == 'prrc_comment' && $this->uri->segment(6) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/'.base64_encode($module_id).'/'.base64_encode($requirement_id).'/prrc_comment/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/'.base64_encode($module_id).'/'.base64_encode($requirement_id).'/prrc_comment/ASC/' . $offset); ?>" title=""> Comment
                                        </a>
                                        <?php echo ( $this->uri->segment(5) == 'prrc_comment' && $this->uri->segment(6) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(5) == 'prrc_comment' && $this->uri->segment(6) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 
                                    </th>                                                                        
                                    <th style="text-align: left;">
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(5) == 'insertdatetime' && $this->uri->segment(6) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/'.base64_encode($module_id).'/'.base64_encode($requirement_id).'/insertdatetime/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/'.base64_encode($module_id).'/'.base64_encode($requirement_id).'/insertdatetime/ASC/' . $offset); ?>" title=""> Comment Date
                                        </a>
                                        <?php echo ( $this->uri->segment(5) == 'insertdatetime' && $this->uri->segment(6) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(5) == 'insertdatetime' && $this->uri->segment(6) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 

                                    </th>                                                                        
                                    <th><a href="javascript:void(0)">Change Status</a></th>

                                </tr>
                            </thead>
                             <tbody>
                                <?php if (!empty($comment_list)) { ?>
                                <?php echo form_open('requirements/mdelete', array('method' => 'post', 'id' => 'search_frm')); ?>
                                    <?php foreach ($comment_list as $comment) { ?>
                                        <tr>
                                            <td><?php echo $comment['prrc_comment'] ?></td>                                            
                                            <td><?php echo date('d M Y',strtotime($comment['insertdatetime'])) ?></td>
                                            <td>
                                                <?php if($comment['prrc_status'] == 'enable') { ?>
                                                <a href="<?php echo site_url() . 'requirements/change_comment_status/' . base64_encode($comment['prrc_id']).'/'.base64_encode($comment['prrc_status']) ; ?>" id="edit_btn">
                                                    <button type="button" class="btn btn-success"><?php echo 'Enable' ?></button>                                                
                                                </a>
                                                <?php } elseif($comment['prrc_status'] == 'disable') { ?>
                                                <a href="<?php echo site_url() . 'requirements/change_comment_status/' . base64_encode($comment['prrc_id']).'/'.base64_encode($comment['prrc_status']) ; ?>" id="edit_btn">
                                                    <button type="button" class="btn btn-warning"><?php echo 'Disable' ?></button>                                                
                                                </a>                                               
                                                <?php } ?>
                                            </td>                                                                                                                                    
                                        </tr>
                                            
                                        
                                    <?php }?>
                                       
                                      
                                        <?php echo form_close(); 
                                } else {
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="9">
                                            No Data Found.
                                        </td>
                                    </tr>
<?php } ?>
                            </tbody>
                            <tfoot>
                               
                            </tfoot>
                        </table>
                        <div class="row">
                           
                            
                            
                                    <!-- /pagination -->
                                    <?php if ($this->pagination->create_links()) { 
                                        $tot_page=ceil($total_rows / $limit);
                                        $cur_page=ceil($offset/$limit)+1;?>

                                     <div class="col-sm-7">
                                         <div id="example2_info" class="dataTables_info" role="user_status" aria-live="polite">
                                             
                                             <?php
                                        echo "Displaying Page $cur_page of $tot_page !";
                                    ?>
                                         </div>
                                    </div>
                                    
                                    <div class="col-sm-5">
                                        <div id="example2_paginate" class="dataTables_paginate paging_simple_numbers">
                                            <?php echo $this->pagination->create_links(); ?> 
                                        </div>
                                    </div>

                        </div>
                                       
                                 
                                       
                                    <?php } ?>
                                  
                           
                        
                        
                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="frm_title">Delete Conformation</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>

<script type="text/javascript">

    $(document).ready(function () {
        $('#confirm-delete').on('show.bs.modal', function (e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
        });
        
        $('#search_frm').submit(function () {
            var value=$('#search_keyword').val();
            if(value=='')
                return false;
        });
        
        

        
        
        $('#checkedall').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $('.deletes').each(function() {
                    this.checked = true;
                });
            }
            else {
              $('.deletes').each(function() {
                    this.checked = false;
                });
            }
        });
        
        $('.deletes').click(function(event) {
            var flag=0;
            $('.deletes').each(function() {
                if(this.checked==false){
                   flag++;
                }
                });
                if(flag){
                    $('.checkedall').prop('checked', false);
                }
                else{
                    $('.checkedall').prop('checked', true);
                }
                 
           
        });
        
        
        
    });
    
    
    function requirement_detail(requirement_id){
        $('#requirement_detail_model_body').empty();        
        $.ajax({
           url:"<?php echo site_url().'requirements/requirement_detail' ?>",
           type:"post",
           dataType:"html",
           data:{'requirement_id':requirement_id,
                 '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
           success:function(data){
               //alert(data);
               $('#requirement_detail_model_body').append(data);               
           }
        });
    }            
</script>
<div class="modal fade" id="requirement_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="frm_title">Requirement Detail</h4>
            </div>
            <?php
            $form_attr = array('id' => 'requirement_detail_frm', 'class' => 'form-horizontal row-border', 'enctype' => 'multipart/form-data');
            echo form_open('', $form_attr);
            ?>
            <div class="modal-body" id="requirement_detail_model_body">                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>                 
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
