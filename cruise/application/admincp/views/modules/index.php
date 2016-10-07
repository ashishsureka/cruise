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

                       
    
    <!-- Content Header (Page header) -->
                



    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12" >
                <div class="box-tools pull-left">
                    <?php echo form_open('modules/search', array('method' => 'post', 'id' => 'search_frm')); ?>
                    <div class="has-feedback">
                        <input type="text" class="form-control input-sm" value="<?php echo $search_keyword; ?>" placeholder="Search" name="search_keyword" id="search_keyword" />
                        <span  id="search_btn" class="glyphicon glyphicon-search form-control-feedback"></span>
                        
                    </div>
                    <!--<div class="has-feedback col-sm-2"><a href="#"><i class="fa fa-search"></i></a></div>-->
                    <?php echo form_close(); ?>
                    <?php if($this->session->userdata('module_search_keyword')){ ?>
                    <a href="<?php echo site_url('modules/clear_search') ?>">Clear Search</a>
                    <?php } ?>
                </div>
                
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
<!--                <div class=" pull-right">
                    <a href="<?php echo site_url('modules/add'); ?>" class="btn btn-primary pull-right">Add Module</a>
                </div>                                -->
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
                    
                    <div class="box-body">
                        <table id="datalist" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <?php if($this->uri->segment(2)=='' || $this->uri->segment(2)=='index'){
                                        $segment2='index';
                                     } else {
                                         $segment2='search';
                                     } ?>
                                    <th>
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(3) == 'prm_title' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/prm_title/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/prm_title/ASC/' . $offset); ?>" title=""> Module Title
                                        </a>
                                        <?php echo ( $this->uri->segment(3) == 'prm_title' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'prm_title' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 
                                    </th>
                                    <th>
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(3) == 'prj_title' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/prj_title/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/prj_title/ASC/' . $offset); ?>" title=""> Project Title
                                        </a>
                                        <?php echo ( $this->uri->segment(3) == 'prj_title' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'prj_title' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 
                                    </th>
                                    <th><a href="Javascript:void(0)">Requirement</a></th>
                                    <th style="text-align: left;">
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(3) == 'prm_status' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/prm_status/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/prm_status/ASC/' . $offset); ?>" title=""> Status
                                        </a>
                                        <?php echo ( $this->uri->segment(3) == 'prm_status' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'prm_status' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 

                                    </th>                                    
                                    <th><a href="Javascript:void(0)">Action</a></th>
                                    
                                   
                                                                       
                                    

                                </tr>
                            </thead>
                             <tbody>
                                <?php if (!empty($module_list)) { ?>
                                <?php echo form_open('modules/mdelete', array('method' => 'post', 'id' => 'search_frm')); ?>
                                    <?php foreach ($module_list as $module) { ?>
                                        <tr>
                                            <td><?php echo $module['prm_title'] ?></td>                                            
                                            <td><?php echo $module['prj_title'] ?></td>                                            
                                            <td><a href="<?php echo site_url() . 'requirements/index/' . base64_encode($module['prm_id']) ?>" class="btn btn-danger">View Requirements</a></td>                                            
                                            <td>
                                                <?php if($module['prm_status'] == 'enable') { ?>
                                                <a href="<?php echo site_url() . 'modules/change_status/' . base64_encode($module['prm_id']).'/'.base64_encode($module['prm_status']) ; ?>" id="edit_btn">
                                                    <button type="button" class="btn btn-success"><?php echo 'Enable' ?></button>                                                
                                                </a>
                                                <?php } elseif($module['prm_status'] == 'disable') { ?>
                                                <a href="<?php echo site_url() . 'modules/change_status/' . base64_encode($module['prm_id']).'/'.base64_encode($module['prm_status']) ; ?>" id="edit_btn">
                                                    <button type="button" class="btn btn-warning"><?php echo 'Disable' ?></button>                                                
                                                </a>                                               
                                                <?php } ?>
                                            </td>                                                                                        
                                            <td>
                                                <a href="#module_detail"  onclick="module_detail(<?php echo $module['prm_id'] ?>)" data-toggle="modal" alt="View" title="View"><i class="fa fa-eye"></i></a>
                                                <a href="<?php echo site_url('modules/edit/'.  base64_encode($module['prm_id'])) ?>" alt="Update" title="Update" ><i class="fa fa-pencil"></i></a>
                                                <a data-href="<?php echo site_url('modules/delete/'.  base64_encode($module['prm_id'])) ?>"  id="delete_btn" data-toggle="modal" data-target="#confirm-delete" href="#" alt="Delete" title="Delete" ><i class="fa fa-trash"></i></a>
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
    
    
    function module_detail(prm_id){
        $('#module_detail_model_body').empty();        
        $.ajax({
           url:"<?php echo site_url().'modules/module_detail' ?>",
           type:"post",
           dataType:"html",
           data:{'prm_id':prm_id,
                 '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
           success:function(data){
               //alert(data);
               $('#module_detail_model_body').append(data);               
           }
        });
    }            
</script>
<div class="modal fade" id="module_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="frm_title">Module Detail</h4>
            </div>
            <?php
            $form_attr = array('id' => 'module_detail_frm', 'class' => 'form-horizontal row-border', 'enctype' => 'multipart/form-data');
            echo form_open('', $form_attr);
            ?>
            <div class="modal-body" id="module_detail_model_body">                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>                 
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
