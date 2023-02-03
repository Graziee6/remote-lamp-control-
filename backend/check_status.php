<?php
    // function to read the status value from the file
    function readStatus() {
      $status = file_get_contents('status.txt');
      if($status == "on"){
          return true;
      }else{
          return false;
      }
    }
    readStatus() ? print "on" : print "off";
    
?>