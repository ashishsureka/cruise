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
				<a href="<?php echo site_url('help/add'); ?>" class="btn btn-primary pull-right">Add Help</a>
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
                    
                    <div class="box-body">
                        <table id="datalist" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <?php if($this->uri->segment(2)=='' || $this->uri->segment(2)=='index'){
                                        $segment2='index';
                                     } else {
                                         $segment2='search';
                                     } ?>                                    
                                    
                                    <th style="text-align: left;">
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(3) == 'help_title' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/help_title/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/help_title/ASC/' . $offset); ?>" title=""> Help Title
                                        </a>
                                        <?php echo ( $this->uri->segment(3) == 'help_title' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'help_title' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 
                                    </th>
                                    <th style="text-align: left;">
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(3) == 'help_status' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/help_status/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/help_status/ASC/' . $offset); ?>" title=""> Status
                                        </a>
                                        <?php echo ( $this->uri->segment(3) == 'help_status' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'help_status' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 
                                    </th>                                    
                                    <th><a href="Javascript:void(0)">Action</a></th>

                                </tr>
                            </thead>
                             <tbody>
                                <?php if (!empty($help_list)) { ?>
                                <?php echo form_open('help/mdelete', array('method' => 'post', 'id' => 'search_frm')); ?>
                                    <?php foreach ($help_list as $help) { ?>
                                        <tr>                                            
                                            <td><?php echo $help['help_title'] ?></td>
											<?php $helpid=base64_encode($help['help_id']); ?>                                                
                                            <td>
                                                <?php if($help['help_status'] == 'enable') { ?>
                                                <a href="<?php echo site_url() . 'help/change_status/' . $helpid.'/'.base64_encode($help['help_status']) ; ?>" id="edit_btn">
                                                    <button type="button" class="btn btn-success"><?php echo 'Enable' ?></button>                                                
                                                </a>
                                                <?php } elseif($help['help_status'] == 'disable') { ?>
                                                <a href="<?php echo site_url() . 'help/change_status/' . $helpid.'/'.base64_encode($help['help_status']) ; ?>" id="edit_btn">
                                                    <button type="button" class="btn btn-warning"><?php echo 'Disable' ?></button>                                                
                                                </a>                                               
                                                <?php } ?>
                                            </td>                                                                                                                                        
											<td>
												<a href="#help_detail"  onclick="help_detail(<?php echo $help['help_id'] ?>)" data-toggle="modal" alt="View" title="View"><i class="fa fa-eye"></i></a>                                                
                                                <a href="<?php echo base_url() . 'help/edit/' . $helpid; ?>" id="edit_btn" alt="Update" title="Update">
                                                    <i class="fa fa-pencil"></i>
                                                </a>											
												<a data-href="<?php echo site_url('help/delete/'.$helpid) ?>"  id="delete_btn" data-toggle="modal" data-target="#confirm-delete" href="#" alt="Delete" title="Delete" ><i class="fa fa-trash"></i></a>
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
                                         <div id="example2_info" class="dataTables_info" role="status" aria-live="polite">
                                             
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
                Are you sure you want to delete this help record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>
<div id="myModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content" id="model_data"></div>
</div>
</div>


<script type="text/javascript">
       
   function help_detail(help_id){
        $('#help_detail_model_body').empty();        
        $.ajax({
           url:"<?php echo site_url().'help/view_detail' ?>",
           type:"post",
           dataType:"html",
           data:{'help_id':help_id,
                 '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
           success:function(data){               
               $('#help_detail_model_body').append(data);               
           }
        });
    }            
        
</script>
<div class="modal fade" id="help_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="frm_title">Help Detail</h4>
            </div>
            <?php
            $form_attr = array('id' => 'help_detail_frm', 'class' => 'form-horizontal row-border', 'enctype' => 'multipart/form-data');
            echo form_open('', $form_attr);
            ?>
            <div class="modal-body" id="help_detail_model_body">                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>                 
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
