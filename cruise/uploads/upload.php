<?php


 $time=  time();
 move_uploaded_file($_FILES["upload"]["tmp_name"],
 $filename="ckimages/".$time .".jpg");
 echo "Stored in: " .$_SERVER['HTTP_HOST']."".str_replace($_SERVER["DOCUMENT_ROOT"],'', str_replace('\\','/',__FILE__ ) ). "/../ckimages/".$time .".jpg";



// Required: anonymous function reference number as explained above.
$funcNum = $_GET['CKEditorFuncNum'] ;
// Optional: instance name (might be used to load a specific configuration file or anything else).
$CKEditor = $_GET['CKEditor'] ;
// Optional: might be used to provide localized messages.
$langCode = $_GET['langCode'] ;

// Check the $_FILES array and save the file. Assign the correct path to a variable ($url).
$url = "http://".$_SERVER['HTTP_HOST']."".str_replace($_SERVER["DOCUMENT_ROOT"],'', str_replace('\\','/',__FILE__ ) ). "/../ckimages/".$time .".jpg";
// Usually you will only assign something here if the file could not be uploaded.
$message = '';
 
echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";

?>


