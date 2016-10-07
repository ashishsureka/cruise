<?php echo $header ?>
<div class="banner inner_banner wow fadeInLeft animated page-head">	
    <img src="<?=  base_url('uploads/pages/main/'.$page_image)?>"/>
</div>
<h3 class="tittle">VIEW ON MAP</h3>

<div class="map">

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3044.212836529143!2d-76.89329868454928!3d40.27102207241205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c8c1158dc70847%3A0x14e1f6a40117cfe5!2s263+Reily+St%2C+Harrisburg%2C+PA+17102%2C+USA!5e0!3m2!1sen!2sin!4v1458388524825" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>



</div>

</div>

</div>

</div>

<!--contact-starts--> 

<div class="contact">

    <div class="container">

        <h3 class="tittle">Contact</h3>

        <div class="contact-form">            
            
            <div class="col-sm-6 contact-in">

                <h4> Contact</h4>

                <hr>

<!--					<p class="para1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.  </p>-->

                <div class="col-sm-12 more-address"> 

                    <div class="address-more">

                        <h4> Address</h4>
                        <?php $add=explode('|', $phone[3]['setting_value']);
                            foreach($add as $line){
                                echo "<p>$line</p>";
                            }
                        ?>
                        

                        <p><i class="fa fa-phone"></i> <?php echo $phone[5]['setting_value']?></p>

                        <p><i class="fa fa-envelope-o"></i> <?php echo $phone[4]['setting_value']?></p>

                    </div>



                    <div class="clearfix"> </div>

                </div>

                <div class="col-sm-12 more-address"> 

                    <div class="address-more">

                        <h4> Restaurant Hours</h4>
                        
                        <h3>Lunch </h3>
                        <?php $add=explode('|', $phone[6]['setting_value']);
                            foreach($add as $line){
                                echo "<p>$line</p>";
                            }
                        ?>
                        
                       



                        <h3>Dinner  </h3>

                        <?php $add=explode('|', $phone[7]['setting_value']);
                            foreach($add as $line){
                                echo "<p>$line</p>";
                            }
                        ?>
                       

                    </div>



                    <div class="clearfix"> </div>

                </div>

            </div>

            <div class="col-sm-6 contact-grid">
                

                 

                <div id="contact-error" style="display: none">
                        <i class="icon-remove close" data-dismiss="alert"></i>                        
                    </div>
    
                
       
                                                <input type="hidden" name="contactus_flash" value="1">
                
						<p class="your-para">Your Name:<span>*</span></p>

                                                <input type="text" value="" id="name-c" name="name-c" required >

						<p class="your-para">Your Mail:<span>*</span></p>

                                                <input type="email" value="" id="email-c" name="email-c" required >

						<p class="your-para">Phone:<span>*</span></p>

                                                <input type="text" id="phone-c" name="phone-c" pattern="[789][0-9]{9}" value="" required >

						<p class="your-para">Your Message:</p>

                                                <textarea id="message-c" name="message-c" required></textarea>

						<div class="send">

	<input type="hidden" name="redirect_url" value="contactus">
        <input type="button" id="contactus_submit" value="Send">
 
						</div>

					

				</div>

				



            <div class="clearfix"> </div>

        </div>



    </div>

</div>

<!--contact-ends--> 

<!-- footer -->
<?php echo $footer ?>