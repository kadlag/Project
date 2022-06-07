<?php include('config/constants.php');?>
<html>
    <head>
        <title>Login - Vegetable-Fruits Order System</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body class="login-back">
        
    <div class="login">
        <h1 class="text-center login-name">Login</h1>
         <br> 


         <?php

        //  if(isset($_SESSION['login1']))
        //  {

        //     echo $_SESSION['login1'];
        //     unset($_SESSION['login1']);
        //  }

         
        //  if(isset($_SESSION['add1']))
        //    {
  
        //       echo $_SESSION['add1'];
        //       unset($_SESSION['add1']);
        //    }
           

        //  if(isset($_SESSION['no-login-message']))
        //  {
        //      echo $_SESSION['no-login-message'];
        //      unset($_SESSION['no-login-message']);

        //  }

         ?>
        
        <!-- Login form starts here -->


<form action="" method="POST" class="text-center">

  

     <br>
    <input class="input" type="text" name="username" placeholder="Username"><br> <br>



 <br>
    <input class="input" type="password" name="password"  placeholder="Password"><br> <br>


    <input type="submit" name="submit" value="Login"  class="btn-primary  btn-login">

    <br><br>
</form>
         <p class="text-center"> Not have an account? <a href="register.php"> Register Here</a></p>
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
    
    $sql="SELECT * FROM tbl_customer WHERE username='$username' AND password='$password'";

    //3.Execute the Query

    $res = mysqli_query($conn,$sql);


    //4.count rows to check whether the user exists or not

    $count=mysqli_num_rows($res);


    if($count==1)
    {
        //User available and Login Successs

        $_SESSION['login1']= "<div class='success'>Login Successful </div>";
        $_SESSION['user1']=$username;//to check wthether the user is logged in or not and logout will unset it

        //Redirect to the page/Dashboard
        header("location:".SITEURL);


    }

    else{
        //User not available and login fail

        
        $_SESSION['login1']= "<div class='error  text-center'> Username or Password did not match  </div>";

        //Redirect to the page/Dashboard
        header("location:".SITEURL."login-front.php");

    }

}
?>