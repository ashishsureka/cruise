<?php
echo $header;

foreach ($event_detail as $key => $event) {            
        }
?>
<div class="banner inner_banner wow fadeInLeft animated page-head">	
    <img src="<?=  base_url('uploads/pages/main/'.$page_image)?>"/>
</div>
<div class="checkout">
    <!--tabs-->
    <div class="tabs">
        <div class="container">
            <div class="col-sm-12 tabs-left">
                <h4>Event Form</h4>
 <?php echo form_open('checkout/eventadd',array('name'=>'event_add_form','id'=>'event_add_form','method'=>'POST'));  ?>
                <div class="col-sm-8 tab-grid-right">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="Tab1">
                            <div class="text1  con_de">
                                <h3 class="title">Event Details</h3>
                                <div class="col-sm-12 perdetail">
                                    <div class="col-sm-6 perinrdetail">
                                        <p>Event Name<span>*</span></p>
                                    </div>
                                    <div class="col-sm-6 perinrdetail">
                                        <input type="text" name="event_name" id="event_name" value="<?php if(isset($event_detail[0]['event_name'])){ echo $event_detail[0]['event_name']; } ?>" >

                                    </div>
                                </div>
                                <div class="col-sm-12 perdetail">
                                    <div class="col-sm-6 perinrdetail">
                                        <p>Date of Event<span>*</span></p>
                                    </div>
                                    <div class="col-sm-6 perinrdetail date">
                                        <input class="text-date dp-applied" id="datepicker" type="text" name="event_date" value="<?php if(isset($event_detail[0]['event_date'])){ echo $event_detail[0]['event_date']; } ?>">


                                    </div>
                                </div>
                                <div class="col-sm-12 perdetail">
                                    <div class="col-sm-6 perinrdetail">
                                        <p>Time of Event </p>
                                    </div>
                                    <div class="col-sm-6 perinrdetail">
                                        <select name="event_time" id="event_time">
                                            <?php if(isset($event_detail[0]['event_time'])){ ?>
                                                <option value="Tea Time" <?php if($event['event_time'] == 'Tea Time'){ echo 'seleceted="selected"'; } ?>>Tea Time</option>
                                                <option value="Breakfast" <?php if($event['event_time'] == 'Breakfast'){ echo 'seleceted="selected"'; } ?>>Breakfast</option>
                                                <option value="Lunch" <?php if($event['event_time'] == 'Lunch'){ echo 'seleceted="selected"'; } ?>>Lunch</option>
                                                <option value="Dinner" <?php if($event['event_time'] == 'Dinner'){ echo 'seleceted="selected"'; } ?>>Dinner</option>
                                            <?php } else { ?>
                                                <option value="Tea Time" >Tea Time</option>
                                                <option value="Breakfast" >Breakfast</option>
                                                <option value="Lunch" >Lunch</option>
                                                <option value="Dinner" >Dinner</option>
                                            <?php } ?>
                                        </select> 

                                    </div>
                                </div>
                                <div class="col-sm-12 perdetail">
                                    <div class="col-sm-6 perinrdetail">
                                        <p>Count of People (Adults)</p>
                                    </div>
                                    <div class="col-sm-6 perinrdetail">
                                        <input type="text" name="adult" id="adult" value="<?php if(isset($event_detail[0]['adult'])){ echo $event_detail[0]['adult']; } ?>">                                        
                                    </div>
                                </div>
                                <div class="col-sm-12 perdetail">
                                    <div class="col-sm-6 perinrdetail">
                                        <p>Count of People (Child)</p>
                                    </div>
                                    <div class="col-sm-6 perinrdetail">
                                        <input type="text" name="child" id="child" value="<?php if(isset($event_detail[0]['child'])){ echo $event_detail[0]['child']; } ?>">                                        
                                    </div>
                                </div>
                                <h3 class="title">Contact Details</h3>
                                <div class="col-sm-12 perdetail">
                                    <div class="col-sm-6 perinrdetail">
                                        <p>Contact Person 1<span>*</span></p>
                                    </div>
                                    <div class="col-sm-6 perinrdetail">
                                        <input type="text" name="con_per_1" id="con_per_1" value="<?php if(isset($event_detail[0]['con_per_1'])){ echo $event_detail[0]['con_per_1']; }elseif(isset($user_detail[0]['customername'])) { echo $user_detail[0]['customername']; }?>">

                                    </div>
                                </div>
                                <div class="col-sm-12 perdetail">
                                    <div class="col-sm-6 perinrdetail">
                                        <p>Contact Person 1 (cell)<span>*</span></p>
                                    </div>
                                    <div class="col-sm-6 perinrdetail call">
                                        <input type="text" name="con_mob_1" id="con_mob_1" value="<?php if(isset($event_detail[0]['con_mob_1'])){ echo $event_detail[0]['con_mob_1']; }elseif(isset($user_detail[0]['contact_no'])) { echo $user_detail[0]['contact_no']; }?>">

                                    </div>
                                </div>
                                <div class="col-sm-12 perdetail">
                                    <div class="col-sm-6 perinrdetail ">
                                        <p>Contact Person 1 (Email)<span>*</span></p>
                                    </div>
                                    <div class="col-sm-6 perinrdetail mail">
                                        <input type="text" name="con_email_1" id="con_email_1"  value="<?php if(isset($event_detail[0]['con_email_1'])){ echo $event_detail[0]['con_email_1']; }elseif(isset($user_detail[0]['email'])) { echo $user_detail[0]['email']; }?>">

                                    </div>
                                </div>
                                <div class="col-sm-12 perdetail">
                                    <div class="col-sm-6 perinrdetail">
                                        <p>Contact Person 2</p>
                                    </div>
                                    <div class="col-sm-6 perinrdetail">
                                        <input type="text" name="con_per_2" id="con_per_2" value="<?php if(isset($event_detail[0]['con_per_2'])){ echo $event_detail[0]['con_per_2']; } ?>">

                                    </div>
                                </div>
                                <div class="col-sm-12 perdetail">
                                    <div class="col-sm-6 perinrdetail">
                                        <p>Contact Person 2 (cell)</p>
                                    </div>
                                    <div class="col-sm-6 perinrdetail call">
                                        <input type="text" name="con_mob_2" id="con_mob_2" value="<?php if(isset($event_detail[0]['con_mob_2'])){ echo $event_detail[0]['con_mob_2']; } ?>">

                                    </div>
                                </div>
                                <div class="col-sm-12 perdetail">
                                    <div class="col-sm-6 perinrdetail ">
                                        <p>Contact Person 2 (Email)</p>
                                    </div>
                                    <div class="col-sm-6 perinrdetail mail">
                                        <input type="text" name="con_email_2" id="con_email_2" value="<?php if(isset($event_detail[0]['con_email_2'])){ echo $event_detail[0]['con_email_2']; } ?>" >

                                    </div>
                                </div>
                                <div class="col-sm-12 perdetail">
                                    <div class="col-sm-6 perinrdetail">
                                        <p><b>How you know about us (Reference)<span>*</span></b></p>
                                    </div>
                                    <div class="col-sm-6 perinrdetail">
                                        <select name="know_about" id="know_about" >
                                            <?php if(isset($event_detail[0]['event_time'])){ ?>
                                                <option value="TV" <?php if($event_detail[0]['know_about'] == 'TV'){ echo 'seleceted="selected"'; } ?>>TV</option>
                                                <option value="Print" <?php if($event_detail[0]['know_about'] == 'Print'){ echo 'seleceted="selected"'; } ?>>Print</option>
                                                <option value="Outdoor" <?php if($event_detail[0]['know_about'] == 'Outdoor'){ echo 'seleceted="selected"'; } ?>>Outdoor</option>
                                                <option value="From a Friend" <?php if($event_detail[0]['know_about'] == 'From a Friend'){ echo 'seleceted="selected"'; } ?>>From a Friend</option>
                                                <option value="Other.." <?php if($event_detail[0]['know_about'] == 'Other..'){ echo 'seleceted="selected"'; } ?>>Other..</option>
                                            <?php } else { ?>
                                                <option value="TV">TV</option>
                                                <option value="Print">Print</option>
                                                <option value="Outdoor">Outdoor</option>
                                                <option value="From a Friend">From a Friend</option>
                                                <option value="Other..">Other..</option>
                                            <?php } ?>                                                
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 perdetail">
                                    <div class="col-sm-6 perinrdetail">
                                        <p><b>Special Note</b></p>
                                    </div>
                                    <div class="col-sm-6 perinrdetail">
                                        <textarea name="special_note" id="special_note" ><?php if(isset($event_detail[0]['special_note'])){ echo $event_detail[0]['special_note']; } ?></textarea>
                                    </div>
                                </div>
                               
                                <div class="col-sm-12 tabbtn" >
                                    <div class="col-sm-6 perinrdetail">
                                        
                                    </div>
                                   
                                        <input class="sachinevent" type="submit" name="btn_save" value="Next">
                                        <input onclick="window.history.back();" class="sachinevent" type="button" name="btn_previous" value="Previous">
                                        <!--<a href="#">Confirm Order</a>-->
                                </div>
                                <div class="col-sm-12 perdetail" style="padding-bottom: 15px;font-size: 15px;">
                                    <p>Note: We are asking above information in order to serve you better. Please submit your event and food details and will get back to you with confirmation and payment options. Today you are paying nothing and please continue with the process.</p>
                                    
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
<?php echo form_close(); ?>               
                <div class="col-sm-1"></div>
                <?php echo catringmenu_cart_checkout('cateringmenu'); ?>
                <!--end of rightside_cart-->
            </div>

            <div class="clearfix"> </div>
        </div>
    </div>
    <!--//tabs-->
</div>
<!--end of check out-->

<?php echo $footer; ?>


    <!-- //copy -->
    <!-- for bootstrap working -->
    <!--<script src="js/bootstrap.js"></script>-->
    <!-- //for bootstrap working -->
    <!-- smooth scrolling -->
    <script type="text/javascript">
        $(document).ready(function() {
            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>
    <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
    <!-- //smooth scrolling -->

    <link rel="stylesheet" href="<?php echo base_url('css/jquery-ui.css') ?>" />
    <script src="<?php echo base_url('js/jquery-ui.js') ?>"></script>
    <script>
        var dateToday = new Date();
        $(function() {
              $( "#datepicker" ).datepicker({
                  minDate: dateToday,                  
              });
        });
    </script>     
    <script>
        var index = 0,
        messg = [
        "Hide Deatils", 
        "Show Deatils"

        ];

        $(".pushme").on("click", function() {
            $(this).text(function(index, text){
                index = $.inArray(text, messg);
                return messg[++index % messg.length];
            });
        });
    </script>
    <script type="text/javascript" language="javascript">// <![CDATA[
    function showHide() {
        var ele = document.getElementById("showHideDiv");
        if(ele.style.display == "block") {
              ele.style.display = "none";
        }
        else {
          ele.style.display = "block";
        }
    }
    </script>

<script type="text/javascript">
    //validation for edit email formate form
    $(document).ready(function () {


        $("#event_add_form").validate({
            
            rules: {
              
                event_name:{
                    required: true,
                },
                event_date:{
                    required: true,
                },
                event_time:{
                    required: true,
                },
                adult:{
                    number: true,
                },
                child:{
                    number: true,
                },
                con_per_1:{
                    required: true,
                },
                con_mob_1:{
                    required: true,
                    number: true,
                },
                con_email_1:{
                    required: true,
                    email:true,
                },
                
                
            },
            messages:{
                event_name:{
                    required:"Event name is required"
                },
                event_date:{
                    required:"Event date is required"
                },
                event_time:{
                    required:"Event name is required"
                },
                adult:{
                    number:"People Count Must be in Number"
                },
                child:{
                    number:"Child Count Must be in Number"
                },
                con_per_1:{
                    required:"Person1 name is required"
                },
                con_mob_1:{
                    required:"Person1 mobile is required",
                    number:"Invalid Mobile No Format"
                },
                con_email_1:{
                    required:"Person1 Email is required",
                    email:"Enter valid Email is required"
                },
                

            },
        });

    });
</script>