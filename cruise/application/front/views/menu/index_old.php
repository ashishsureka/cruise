<?php
    echo $header;
?>
<!-- banner -->
<div class="banner inner_banner wow fadeInLeft animated page-head">	
    <img src="<?php echo base_url('uploads/pages/main/'.$page_image)?>"/>
</div>
<!-- //banner -->
       <!-- //menu -->
        <div class="menu2">
            <h4>AANGAN EXPRESS MENU</h4>
            <div class="container">
                <div class="row">


                    <div class="col-sm-3"id="leftcol2">
                        <ul class="side" id="sidebar">
                            <?php
                            if(count($category_list)>0){
                                foreach ($category_list as $category){ ?>
                                    <!--<li><a href='<?php echo "#".$category['categoryid']; ?>' class="scroll"> <?php echo $category['category_title']; ?></a></li>-->     
                             <?php  $catname =  url_title($category['category_title'], 'dash', true);  ?>      
                            <li><a href="<?=  base_url('menu#'.$catname)?>" class="scroll"> <?php echo $category['category_title']; ?></a></li>     
                            <?php
                                }
                            }
                            ?>
<!--                            <li><a href="http://aanganexpress.com/menu.html#appetizer" class="scroll"> Appetizers</a></li>
                            <li><a href="http://aanganexpress.com/menu.html#tandoor" class="scroll">From Clay Oven (Tandoor)</a></li>
                            <li><a href="http://aanganexpress.com/menu.html#lamb" class="scroll">Gosht-e- Pakwan (Lamb)</a></li>
                            <li><a href="http://aanganexpress.com/menu.html#chicken" class="scroll">Chicken </a></li>
                            <li><a href="http://aanganexpress.com/menu.html#veg" class="scroll">Tarkari Sabji (Vegetarian)</a></li>
                            <li><a href="http://aanganexpress.com/menu.html#rice" class="scroll">Basmati Chawal (Rice)</a></li>
                            <li><a href="http://aanganexpress.com/menu.html#roti" class="scroll">Desi Roti (Nan Bread)</a></li>-->

                        </ul>
                    </div>
                    <div class="col-sm-3" id="leftcol">
                        <ul class="side" id="sidebar">
                            <?php
                            if(count($category_list)>0){
                                foreach ($category_list as $category){ ?>
                                    <!--<li><a href='<?php echo "#".$category['categoryid']; ?>' class="scroll"> <?php echo $category['category_title']; ?></a></li>-->  
                                       <?php  $catname =  url_title($category['category_title'], 'dash', true);  ?>
                                    <li><a href="<?=  base_url('menu#'.$catname)?>" class="scroll"> <?php echo $category['category_title']; ?></a></li>     
                            <?php
                                }
                            }
                            ?>

                        </ul>

                    </div>
                    <div class="col-sm-6" id="content">
                        
                       <?php  
                       if(count($category_list)>0){
                                foreach ($category_list as $category){ ?>
                        <?php  $catname =  url_title($category['category_title'], 'dash', true);  ?>
                        <div class="col-sm-12"  id="<?php echo $catname; ?>">
                            <h3> <?php echo $category['category_title']; ?></h3>
                            <img src="<?php echo base_url('uploads/category/main/'.$category['category_image']); ?>"/>
                            <a  name="<?php echo $category['category_title']; ?>" id="<?php echo $category['categoryid']; ?>"></a>
                            <ul class="liststylenone" >
                                <?php echo menu_list($category['categoryid']); ?>

                               



                            </ul> 
                        </div>

                        
                        <?php
                                }
                        }
                        ?>
                        
                        



                    </div>
                  <div id="wait" style="display:none;position:absolute;bottom: 20%;left:83.5%;"><img src='<?php echo base_url('images/loader/ajax-loader1.gif'); ?>' /></div>
                    <div class="col-sm-3" id="rightcol">

                     <?php                       
                         echo menu_cart(1);
                    ?>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- menu end -->
        <!-- footer -->
<?php echo $footer; ?>
        

        <script>
        // Create a clone of the menu, right next to original.
            $('#leftcol').addClass('original').clone().insertAfter('#leftcol').addClass('cloned').css('position', 'fixed').css('top', '0').css('margin-top', '0').css('z-index', '500').removeClass('original').hide();

            scrollIntervalID = setInterval(stickIt, 10);


            function stickIt() {

                var orgElementPos = $('.original').offset();
                orgElementTop = orgElementPos.top;

                if ($(window).scrollTop() >= (orgElementTop)) {
        // scrolled past the original position; now only show the cloned, sticky element.

        // Cloned element should always have same left position and width as original element.     
                    orgElement = $('.original');
                    coordsOrgElement = orgElement.offset();
                    leftOrgElement = coordsOrgElement.left;
                    widthOrgElement = orgElement.css('width');
                    $('.cloned').css('left', leftOrgElement + 'px').css('top', 0).css('width', widthOrgElement).show();
                    $('.original').css('visibility', 'hidden');
                } else {
        // not scrolled past the menu; only show the original menu.
                    $('.cloned').hide();
                    $('.original').css('visibility', 'visible');
                }
            }
        </script>
        
        <!--script for cart adjustment-->
        <script type="text/javascript">
		$(function(){ // document ready
   if ($('#rightcol').length) { // make sure "#rightcol" element exists
      var el = $('#rightcol');
      var rightcolTop = $('#rightcol').offset().top; // returns number
      var rightcolHeight = $('#rightcol').height();

      $(window).scroll(function(){ // scroll event
          var limit = $('#footer').offset().top - rightcolHeight - 20;

          var windowTop = $(window).scrollTop(); // returns number

          if (rightcolTop < windowTop){
             el.css({ position: 'fixed', top: 0,right:45});
          }
          else {
             el.css('position','static');
          }

          if (limit < windowTop) {
          var diff = limit - windowTop;
          el.css({top: diff});
          }
        });
   }
});
	</script>
        
        <!-- script for menu -->
        <script type="text/javascript">
            $("span.menu").click(function () {
                $("ul.nav1").slideToggle(300, function () {
        // Animation complete.
                });
            });
        </script>

        <script type="text/javascript">
            jQuery(document).ready(function(){
    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
});
</script>
<script type="text/javascript">
            jQuery(document).ready(function(){
    // This button will increment the value
    $('#plus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".minus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
});
</script>


<script type="text/javascript">
//     $(".addcart").click(function(){

//used for add to cart
     $(document).on('click', '.addcart', function(){

     $(document).ajaxStart(function(){
        $("#rightcol").onclick = false;
        $("#wait").css("display", "block");
    });

         
        var id=$(this).attr('id');
        
         $.ajax({
                url: "<?php echo site_url('menu/addcart'); ?>",
                type: "post",
                dataType:"html",
                data: {'id': id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function (result) { 
                    //alert(result);
                    if(result != 'false'){
                        $('.cart_error').css("display", "none");
                        $('#rightcol').html('');
                        $('#rightcol').append(result);
                    } else {
                        $('.cart_error').css("display", "block");
                    }
                    
                    $(document).ajaxComplete(function(){
                        $("#wait").css("display", "none");
                        $("#rightcol").onclick = true;
                    });
                }
            });

    });
    
// used  for dish type spicy or not 
$(document).on('click', '.dish_type', function(){
       var id=$(this).attr('id');

         

         $.ajax({
                url: "<?php echo site_url('menu/change_type'); ?>",
                type: "post",
                dataType:"html",
                data: {'id': id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function (result) {
                    $('#rightcol').html('');
                    $('#rightcol').append(result);
                }
            });

    });
    
$(document).on('change', '.qty', function(evt){ 
       var id=$(this).attr('id');       
       var value=this.value;
       //var value=String.fromCharCode(evt.keyCode);
       
         $.ajax({
                url: "<?php echo site_url('menu/changeqty'); ?>",
                type: "post",
                dataType:"html",
                data: {'id': id,'value':value,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function (result) {
                    $('#rightcol').html('');
                    $('#rightcol').append(result);
                }
            });
    }); 
    
    //used for change qty
$(document).on('click', '.changeqty', function(){
       var id=$(this).attr('id');
       var value=$(this).text();
  
         

         $.ajax({
                url: "<?php echo site_url('menu/changeqty'); ?>",
                type: "post",
                dataType:"html",
                data: {'id': id,'value':value,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function (result) {
                    $('#rightcol').html('');
                    $('#rightcol').append(result);
                }
            });

    });
    //use for delete product
$(document).on('click', '.deleteitem', function(){
       var id=$(this).attr('id');
      
      
         
         $.ajax({
                url: "<?php echo site_url('menu/deleteitem'); ?>",
                type: "post",
                dataType:"html",
                data: {'id': id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function (result) {
//                    alert(result);
//                    exit();
                    $('#rightcol').html('');
                    $('#rightcol').append(result);
                }
            });

    });
</script>
