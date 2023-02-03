<?php
$input = json_decode(file_get_contents('php://input'), TRUE);
function writeStatus($status) {
  $myfile = fopen("status.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $status);
    fclose($myfile);
}
if(!empty(json_encode($input["status"]))){
    
    writeStatus($input["status"]);
}
?>