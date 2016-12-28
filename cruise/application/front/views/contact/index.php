<?php echo $head; ?>
<?php echo $header; ?>
    
        <!--header end-->
    <!--content start-->
    <div class="inner_head">
        <div class="container">
            <div class="col-sm-6 head_left"><h2>Contact Us</h2></div>
        </div>
    </div>
    <div class="content" style="min-height: 560px">
        <div class="container">  
		
            <div class="contact_box">                
			
                <?php echo form_open('contact',array('name'=>'contact','id'=>'contact','method'=>'POST'));  ?>
				<?php if ($this->session->flashdata('success')) { ?>
					<div class="alert fade in alert-success">
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
                    <fieldset>
                        <input placeholder="Your name" name="contact_name" id="contact_name" type="text" tabindex="1"  autofocus>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Your Email Address" name="contact_email" id="contact_email" type="email" tabindex="2" >
                    </fieldset>
                    <fieldset>
                        <input placeholder="Your Phone Number (optional)" name="contact_phone" id="contact_phone" type="tel" tabindex="3" >
                    </fieldset>
                    <fieldset>
                        <textarea placeholder="Type your message here...." name="contact_message" id="contact_message" tabindex="5" ></textarea>
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
                    </fieldset>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>       
    <!--content end-->
<?php echo $footer; ?>
    </body>


<script type="text/javascript">

	jQuery.validator.addMethod("phone", function (phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 &&
              phone_number.match(/[0-9\-\(\)\s]+/);
    }, "Invalid Phone Number");
    //validation for edit email formate form
    $(document).ready(function () {

        $("#contact").validate({
            
            rules: {
				contact_name:{
                    required: true,
                },				
                contact_email:{
                    required: true,
                    email:true,
					remote: {
                                url: "<?php echo site_url() . 'contact/check_email' ?>",
                                type: "post",
                                data: {
                                    email: function () {
                                        return $("#contact_email").val();
                                    },                                    
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                },
                            },
                },
                contact_phone:{
                    phone: true,
                },                  
                contact_message:{
                    required: true,
                }                
            },
            messages:{
				contact_name: {
                    required: "Name is required",                    
                },                
                contact_email: {
                    required: "Email Address is required",                    
                    email: "Invalid Email Format",
					remote: "Your request already sent",
                },                
                contact_phone: {
                    phone: "Invalid Phone Number",                    
                },                
                contact_message: {
                    required: "Message is required",                    
                },                                
            },
        });        
    });        
</script>    

</html>