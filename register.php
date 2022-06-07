<?php include('config/constants.php');?>
<html>
    <head>
        <title>Login - Vegetable-Fruits Order System</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body class="registration-back">
        
    <div class="login-register">
        <h1 class="text-center  login-reg-name">Registration Form</h1>
         


         
           <?php
         if(isset($_SESSION['add1']))
           {
  
              echo $_SESSION['add1'];
              unset($_SESSION['add1']);
           }
           ?>
        <br><br>
        <!-- Login form starts here -->


<form action="#" method="POST" class="text-center">

    
    <input  class="input" type="text" name="full_name" placeholder="Enter Name"><br> <br>

   
    <input  class="input" type="text" name="username" placeholder="Enter Username"><br> <br>


    
    <input class="input" type="email" name="email" placeholder="Enter Email"><br> <br>


    
    <input  class="input" type="password" name="password"  placeholder="Enter Password"><br> <br>


    <input type="submit" name="submit" value="Submit"  class="btn-primary  btn-login">

    <br><br>
</form>
         <!-- <p class="text-center"> Not have an account? <a href="register.php"> Register Here</a></p> -->
        <!-- Login form ends here -->
        <!-- <p  class="text-center">Created By- <a href="www.sakshikadlag.com"> Sakshi Kadlag</a></p> -->
        <p class="text-center"> Already Registered? <a href="login-front.php">  Login</a></p>
    </div>



    
    </body>
</html>

<?php

//check whether the submit button is clicked or not

// if(isset($_POST['submit']))
// {
//     $_SESSION['registration']= "<div class='login-success  text-center'>Registration Successful </div>";
    
//     //Redirect to the page/front
//     header("location:"."http://localhost/veg-fruits-order/register.php");


// }


?>




<?php
//Process the value from Form and Save it in Database
//check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
//Button Clicked
// echo "Button Clicked";

//1.Get the Data from form
$full_name=$_POST['full_name'];
 $username=$_POST['username'];
 $email=$_POST['email'];
 $password=md5($_POST['password']);//password encryption with md5

// 2. SQL Query to save the data into database

$sql="INSERT INTO tbl_customer SET 
full_name='$full_name',
username='$username',
email='$email',
password='$password'
";


// 3.Executing Query and saving data into Database

$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

//4.Check whether the (Query is Executed ) data is  inserted or not and display appropriate message

if($res==TRUE)
{
    // Data  inserted
    // echo "Data Inserted";

    // Create a session variable to display message
    $_SESSION['add1']="<div class='login-success  text-center'>Registration Successfully </div>";
     //Redirect page to manage  admin
     header("location:".SITEURL.'register.php');
}

else
{

    // Failed to insert data
    // echo "Failed to insert data";

    
    // Create a session variable to display message
    $_SESSION['add1']="<div class='error'>Failed to Register </div>";
     //Redirect page to add admin
     header("location:".SITEURL.'register.php');
}

}





?>
