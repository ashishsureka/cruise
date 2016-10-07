<?php echo $header; ?>
<div class="banner inner_banner wow fadeInLeft animated page-head">	
    <img src="<?php echo  base_url('uploads/pages/main/'.$page_image)?>"/>
</div>
<!-- //menu -->
<div class="menu3">
    <h4>AANGAN EXPRESS CATERING MENU</h4>
    <div class="container">
	<div class="row">
            


<div class="col-sm-3"id="leftcol3">
    <ul class="side" id="sidebar">
        <?php
        if(count($category_list)>0){
            foreach ($category_list as $category){ ?>
          <!--<li><a href='<?php echo "#".$category['categoryid']; ?>' class="scroll"> <?php echo $category['category_title']; ?></a></li>-->     
                             <?php  $catname =  url_title($category['category_title'], 'dash', true);  ?>      
                            <li><a href="<?php echo  base_url('cateringmenu#'.$catname)?>" class="scroll"> <?php echo $category['category_title']; ?></a></li>     
                            <?php
            }
        }
        ?>
        

        
        
    </ul>
</div>
<div class="col-sm-3" id="leftcol4">
    <ul class="side" id="sidebar" >
        <?php
        if(count($category_list)>0){
            foreach ($category_list as $category){ ?>
                  <!--<li><a href='<?php echo "#".$category['categoryid']; ?>' class="scroll"> <?php echo $category['category_title']; ?></a></li>-->  
                                       <?php  $catname =  url_title($category['category_title'], 'dash', true);  ?>
        <li><a href="<?php echo  base_url('cateringmenu#'.$catname)?>" class="scroll"> <?php echo $category['category_title']; ?></a></li>     
                        <?php
            }
        }
        ?>
        
        
        

        
    </ul>
    
</div>
            <div class="col-sm-6" id="content2">
                <?php  
                if(count($category_list)>0){
                         foreach ($category_list as $category){ ?>
                  <?php  $catname =  url_title($category['category_title'], 'dash', true);  ?>
                    <div class="col-sm-12"  id="<?php echo $catname; ?>">
                   <h3> <?php echo $category['category_title']; ?></h3>
                            <img src="<?php echo base_url('uploads/category/main/'.$category['category_image']); ?>"/>
                            <a class="linone" name="<?php echo $category['category_title']; ?>" id="<?php echo $category['categoryid']; ?>"></a>
                            
                    <!--listing of menu-->
                    <ul class="liststylenone">
                        <li>
                            <div class="col-sm-12 innermenu2">

                                <h2>Large</h2>
                                <h2>Medium</h2>
                                <h2>Small&nbsp;&nbsp;</h2>
                            </div>

                        </li>
                        <?php echo menu_list($category['categoryid'],TRUE); ?>
                        
                       
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
            <div class="col-sm-3" id="rightcol2" style="display: none">

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
<!-- //footer -->
<script>
                // Create a clone of the menu, right next to original.
$('#leftcol4').addClass('original').clone().insertAfter('#leftcol4').addClass('cloned').css('position','fixed').css('top','0').css('margin-top','0').css('z-index','999').removeClass('original').hide();

scrollIntervalID = setInterval(stickIt,100);


function stickIt() {

  var orgElementPos = $('.original').offset();
  orgElementTop = orgElementPos.top;               

  if ($(window).scrollTop() >= (orgElementTop)) {
    // scrolled past the original position; now only show the cloned, rightcol element.

    // Cloned element should always have same left position and width as original element.     
    orgElement = $('.original');
    coordsOrgElement = orgElement.offset();
    leftOrgElement = coordsOrgElement.left;  
    widthOrgElement = orgElement.css('width');
    $('.cloned').css('left',leftOrgElement+'px').css('top',0).css('width',widthOrgElement).show();
    $('.original').css('visibility','hidden');
  } else {
    // not scrolled past the menu; only show the original menu.
    $('.cloned').hide();
    $('.original').css('visibility','visible');
  }
}
</script>

        <script>
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
</body>
</html>
<script>    
//    $(".click_circle").click(function(){//
        $(document).on('click', '.click_circle', function(){
        var idstring=$(this).attr('id');
        var idarray=idstring.split("_"); 
        var id=idarray[1];
        var dish=idarray[0];        
        $(".bcircle_"+id).hide();
        $(".circle_"+id).show();
        $("#"+idstring).hide();
        $("#b"+idstring).show();
       
        $("#catringdish_"+id).val(dish);
    
      
    });
    
    
    //for add product into cart 
    $(document).on('click', '.addcart', function(){

    $(document).ajaxStart(function(){        
        $("#wait").css("display", "block");
    });    

         
        var id=$(this).attr('id');
        var dish=$("#catringdish_"+id).val();
        
//        alert(id);
//        exit();

         $.ajax({
                url: "<?php echo site_url('cateringmenu/addcart'); ?>",
                type: "post",
                dataType:"html",
                data: {'id': id,'dish':dish,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function (result) {
                    if(result != 'false'){
                        $('.cart_error').css("display", "none");
                        $('#rightcol').html('');
                        $('#rightcol').append(result);
			if($('#rightcol2').css('display') == 'block') {
                        $('#rightcol2').html('');
                        $('#rightcol2').append(result);
                    }
                    } else {
                        $('.cart_error').css("display", "block");
                    }
                    $(document).ajaxComplete(function(){
                        $("#wait").css("display", "none");  
                        
                        
                        var el = $('#rightcol');      
                        var rightcolHeight = $('#rightcol').height();

                        $(window).scroll(function(){ // scroll event
                            var limit = $('#footer').offset().top - rightcolHeight - 20;

                            var windowTop = $(window).scrollTop(); // returns number


                            if (limit < windowTop) {
                            var diff = limit - windowTop;
                            el.css({top: diff});
                            }
                          });
                    });
                }
            });

    });
    
    // used  for dish type spicy or not 
$(document).on('click', '.dish_type', function(){
       var id=$(this).attr('id');


         

         $.ajax({
                url: "<?php echo site_url('cateringmenu/change_type'); ?>",
                type: "post",
                dataType:"html",
                data: {'id': id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function (result) {
                    $('#rightcol').html('');
                    $('#rightcol').append(result);
                    if($('#rightcol2').css('display') == 'block') {
                        $('#rightcol2').html('');
                        $('#rightcol2').append(result);
                    }
                }
            });

    });
    
$(document).on('change', '.qty', function(evt){ 
       var id=$(this).attr('id');       
       var value=this.value;
       //var value=String.fromCharCode(evt.keyCode);
       
         $.ajax({
                url: "<?php echo site_url('cateringmenu/changeqty'); ?>",
                type: "post",
                dataType:"html",
                data: {'id': id,'value':value,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function (result) {                    
                    $('#rightcol').html('');
                    $('#rightcol').append(result);
		if($('#rightcol2').css('display') == 'block') {
                        $('#rightcol2').html('');
                        $('#rightcol2').append(result);
                    }
                }
            });
    });     
    
    //used for change qty
$(document).on('click', '.changeqty', function(){
       var id=$(this).attr('id');
       var value=$(this).text();
  
         

         $.ajax({
                url: "<?php echo site_url('cateringmenu/changeqty'); ?>",
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
                url: "<?php echo site_url('cateringmenu/deleteitem'); ?>",
                type: "post",
                dataType:"html",
                data: {'id': id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                },
                success: function (result) {
                    $('#rightcol').html('');
                    $('#rightcol').append(result);
			if($('#rightcol2').css('display') == 'block') {
                        $('#rightcol2').html('');
                        $('#rightcol2').append(result);
                    }
                }
            });

    });
    
   
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
   else if ($('#rightcol2').length) { // make sure "#rightcol" element exists
      var el = $('#rightcol2');
      var rightcolTop = $('#rightcol2').offset().top; // returns number
      var rightcolHeight = $('#rightcol2').height();

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