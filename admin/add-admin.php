<?php include('partials/menu.php');?>




<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br> <br> <br>

        <?php

        if(isset($_SESSION['add']))  //checking whether the session is set or not
        {
            echo $_SESSION['add'];//Display the session message if set
            unset($_SESSION['add']);//Remove Session message
        }
        ?>
        <form action=""   method="POST">
      
        <table class="tbl-30">
           <tr>
               <td>Full name:</td>
               <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
           </tr>

           <tr>
               <td>Username:</td>
               <td><input type="text" name="username" placeholder="Your Username"></td>
           </tr>

           <tr>
               <td>Password:</td>
               <td>
                   <input type="password" name="password" placeholder="Your Password">
               </td>
           </tr>

           <tr>
               <td colspan="2">
                   <input type="submit" name="submit" value="Add Farmer" class="btn-secondary">
               </td>
           </tr>
       </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php');?>


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
 $password=md5($_POST['password']);//password encryption with md5

// 2. SQL Query to save the data into database

$sql="INSERT INTO tbl_admin SET 
full_name='$full_name',
username='$username',
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
    $_SESSION['add']="<div class='success'>Admin Added Successfully </div>";
     //Redirect page to manage  admin
     header("location:".SITEURL.'admin/manage-admin.php');
}

else
{

    // Failed to insert data
    // echo "Failed to insert data";

    
    // Create a session variable to display message
    $_SESSION['add']="<div class='error'>Failed to add Admin </div>";
     //Redirect page to add admin
     header("location:".SITEURL.'admin/add-admin.php');
}

}





?>
