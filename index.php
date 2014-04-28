<?php
  
  include ("jpeg_cleaner_class.php");
  
  $handler = new jpeg_cleaner();
                                            
  $handler->set_filename("not_cleaned.jpg");
  $handler->set_destination("cleaned.jpg");
  
  if($handler->clean() == TRUE){
      
      echo "correct cleaned!";
      
  } else {

      echo "not correct cleaned!";

  }
  
?>
