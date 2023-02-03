<?php
session_start();
include "./db.php";
$error = null;
if(isset($_SESSION['id'])){
    header('Location: http://iot.benax.rw/projects/854b1fa5b3856cdadd4351ef6bb6c81a/Glowify/index.html');
}
if(isset($input['submit'])){
        $username = $input['username'];
        $password = $input['password'];
        $hashed_password = hash('sha512', $password);
        $exist = "SELECT * FROM glowify-users where username = '$username' and password = '$hashed_password'";
        $result = mysqli_query($conn,$exist);
        if (mysqli_num_rows($result)>0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['userId'] = $row['id'];
                header('Location: http://iot.benax.rw/projects/854b1fa5b3856cdadd4351ef6bb6c81a/Glowify/index.html');
                break;
            }
        } else {
            $error = "Invalid email or password";
        }
}