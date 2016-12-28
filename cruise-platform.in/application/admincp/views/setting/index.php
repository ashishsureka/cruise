
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
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(3) == 'setting_name' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/setting_name/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/setting_name/ASC/' . $offset); ?>" title=""> Title
                                        </a>
                                        <?php echo ( $this->uri->segment(3) == 'setting_name' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'setting_name' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 
                                    </th>
                                     
                                    
                                     
                                    <th style="text-align: left;">
                                        <a href="Javascript:void(0)"> Value
                                        </a>
                                    </th>
                                     
                                    
                                    
                                    
                                    
                                   
                                                                       
                                    <th><a href="Javascript:void(0)">Action</a></th>

                                </tr>
                            </thead>
                             <tbody>
                                <?php if (!empty($setting_list)) { ?>
                                <?php echo form_open('setting/mdelete', array('method' => 'post', 'id' => 'search_frm')); ?>
                                    <?php
                                
                                    $i=0;
                                    foreach ($setting_list as $setting) { ?>
                                 <?php if($i != 11 && $i != 12) { ?>
                                        <tr>
                                          
                                            
                                            <td><?php echo $setting['setting_name'] ?></td>
                                            <td><?php echo $setting['setting_value'] ?></td>
                                            
                                            <td>
                                                
                                                <?php $settingid=($setting['setting_id']);  ?>
                                                <a href="#myModal" id="edit_btn" onchange="" onclick="edit_setting('<?php echo $settingid; ?>');" data-toggle="modal" alt="Update" title="Update">
                                                <i class="fa fa-pencil"></i>
                                        </a>
                                                
                                                

                                            </td>
                                        </tr>
                                            
                                <?php } $i++; ?>     
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
                                    <?php } ?>
                        </div>
                                       
                                 
                                       
                                    
                                  
                           
                        
                        
                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php echo $footer; ?>
<div id="myModal" class="modal fade">
<div class="modal-dialog">
    <form class="form_textarea" id="editform" method="post" action="setting/update">
        <div class="modal-content" id="model_data">
           
            
                        
         </div>
    
    </form>
</div>
</div>


<script type="text/javascript">


   $(document).ready(function(){ 
        $("#errorMsg").hide();
    });
    
   function edit_setting(id)
   {       
       var setting_id=id;
       $('#model_data').html('');
       $.ajax({
          url:"<?php echo base_url('setting/editform'); ?>",
          type:"POST",
          dataType:"html",
          data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>','setting_id':setting_id,},
          catch:false,
          success:function(data){
                    $('#model_data').append(data);     
                    ShowDeliveryTime();
            }
       });
   }
    
   
   function validate_submit(e)
   {
      if($.trim($('#setting_val').val())=='')
      {
            
            //alert('Value cannot be blank.');
            $('#setting_val').parent().addClass('has-error');   
            $('#errorMsg').css('margin-left','15px');
            $('#errorMsg').show();
            e.preventDefault();
      }
      else
      {
          if($('#setting_title').text()==='E-Mail')
          {
              var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
              if(!filter.test($('#setting_val').val()))
              {
                  $('#setting_val').parent().addClass('has-error');
                  $('#setting_val').focus();
                  $('#email_err').show();
                  e.preventDefault();
              }
          }
          if($('#setting_title').text()==='Bet Earning(in %)')
          {
              $('#setting_val').parent().addClass('has-error');
              if(isNaN($('#setting_val').val()))
              {
                   $('#setting_val').parent().addClass('has-error');
                  $('#setting_val').focus();
                  $('#numeric_err').show();
                  e.preventDefault();
              }
          }
          if($('#setting_title').text()==='Telephone No.')
          {
              $("#errorMsg").css("visibility","hidden");
              $('#setting_val').parent().addClass('has-error'); 
              
              if((isNaN($('#setting_val').val())))
              {
                  $("#errorMsg").hide();
                  $('#setting_val').parent().addClass('has-error');
                  $('#setting_val').focus();
                  $('#numeric_err').show();
                 
                  e.preventDefault();
              }else
              {
                   
              }
          }
      }
       
   }
   
function ShowDeliveryTime()
   {  
       var current_value = document.getElementById("setting_val").value;
       if(current_value == 'Yes')
       {
           $("#delivery_time").css("display", "block");
       }
       else
       {
           $("#delivery_time").css("display", "none");
       }
   }
   
</script>

