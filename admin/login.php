<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>Login - Vegetable-Fruits Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body class="login-back">
        
    <div class="login">
        <h1 class="text-center">Login</h1>
         <br> <br>


         <?php

         if(isset($_SESSION['login']))
         {

            echo $_SESSION['login'];
            unset($_SESSION['login']);
         }
         
         if(isset($_SESSION['no-login-message']))
         {
             echo $_SESSION['no-login-message'];
             unset($_SESSION['no-login-message']);

         }

          ?>

        <br>
        <!-- Login form starts here -->

    <form action="" method="POST" class="text-center">


    <input class="input"type="text" name="username" placeholder="Username"><br> <br>

    Password: <br>
    <input class="input" type="password" name="password"  placeholder=" Password"><br> <br>


    <input type="submit" name="submit" value="Login"  class="btn-primary btn-login">

    <br><br>
</form>
        <!-- Login form ends here -->
      <!-- <p  class="text-center">Created By- <a href="www.sakshikadlag.com"> Sakshi Kadlag</a></p> -->
    </div>
    </body>
</html>


<?php

//check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    //Process for login

    //1.Get the data from login form

   // $username=$_POST['username'];
  // $password=md5($_POST['password']);
    $username=mysqli_real_escape_string($conn,$_POST['username']);
   
    $raw_password=md5($_POST['password']);
    $password=mysqli_real_escape_string($conn,$raw_password);


    //2.sql to check whether the user with username and password exists or not
    
    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3.Execute the Query

    $res = mysqli_query($conn,$sql);


    //4.count rows to check whether the user exists or not

    $count=mysqli_num_rows($res);


    if($count==1)
    {
        //User available and Login Successs

        $_SESSION['login']= "<div class='success'>Login Successful </div>";
        $_SESSION['user']=$username;//to check wthether the user is logged in or not and logout will unset it

        //Redirect to the page/Dashboard
        header("location:".SITEURL.'admin/');


    }

    else{
        //User not available and login fail

        
        $_SESSION['login']= "<div class='error  text-center'> Username or Password did not match  </div>";

        //Redirect to the page/Dashboard
        header("location:".SITEURL.'admin/login.php');

    }

}
?>