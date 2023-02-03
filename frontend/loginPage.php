<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="./login.css" rel="stylesheet">
    <style>
        *,
        *:before,
        *:after{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body{
            background-color: #080710;
        }
        .background{
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%,-50%);
            left: 50%;
            top: 50%;
        }
        .background .shape{
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }
        .shape:first-child{
            background: linear-gradient(
                #1845ad,
                #23a2f6
            );
            left: -80px;
            top: -80px;
        }
        .shape:last-child{
            background: linear-gradient(
                to right,
                #ff512f,
                #f09819
            );
            right: -30px;
            bottom: -80px;
        }
        form{
            height: 520px;
            width: 400px;
            background-color: rgba(255,255,255,0.13);
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 0 0 40px rgba(8,7,16,0.6);
            padding: 50px 35px;
        }
        form *{
            font-family: 'Poppins',sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }
        form h3{
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }
        
        label{
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }
        input{
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255,255,255,0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }
        ::placeholder{
            color: #e5e5e5;
        }
        button{
            margin-top: 50px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }
        .social{
          margin-top: 30px;
          display: flex;
        }
        .social div{
          background: red;
          width: 150px;
          border-radius: 3px;
          padding: 5px 10px 10px 5px;
          background-color: rgba(255,255,255,0.27);
          color: #eaf0fb;
          text-align: center;
        }
        .social div:hover{
          background-color: rgba(255,255,255,0.47);
        }
        .social .fb{
          margin-left: 25px;
        }
        .social i{
          margin-right: 4px;
        }
#error_msg{
    color: red;
    position: relative;
    top: 6px;
    text-align: center;
}
    </style>
</head>
<body>
    
    <?php
session_start();
$servername = "localhost";
$username = "benax_iot_root";
$password = "Td(FAdeZ9xp3";
$db = "benax_iot";
$conn =  mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
  echo "Connection failed: ";
}else{
//   echo "connected";
}
$error = null;
if(isset($_POST['submit'])){
    
    $error = null;
    
        $username = $_POST['username'];
        $password = $_POST['password'];
        $exist = "SELECT * FROM glowify_users where username='$username' and password = '$password'";
        
        $result = mysqli_query($conn,$exist);
    
        if (mysqli_num_rows($result)>0) {
            while ($row = mysqli_fetch_assoc($result)) {
          
                $_SESSION['id'] = $row['id'];
                echo $row['id'];
                echo("<script>localStorage.setItem('loggedIn', true); window.location.href='http://iot.benax.rw/projects/854b1fa5b3856cdadd4351ef6bb6c81a/Glowify/index.html'</script>");
                break;
            }
        } else {
            $error = "Invalid email or password";
        }
}
    ?>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="#" method="POST">
        <h3>Login Here</h3>
        <label for="username">Username</label>
        <input name="username" type="text" placeholder="Email or Phone" id="username">
        <label for="password">Password</label>
        <input name="password" type="password" placeholder="Password" id="password">
        
        <div id="error_msg"><?= $error  ?></div>
        <button name="submit" type="submit">Log In</button>
        <div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>
    </form>
    
   
</body>
</html>