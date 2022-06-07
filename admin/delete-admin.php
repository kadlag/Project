<?php


//Include constants.php file here
include('../config/constants.php');

//1.get the ID of admin to be deleted

$id=$_GET['id'];

//2.Create SQL Query to Delete Admin

$sql="DELETE FROM tbl_admin where id=$id";

//Execute the Query

$res=mysqli_query($conn,$sql);

//Check whether the query executed successfully or not
if($res==true)
{
    //Query Executed Successfully and Admin Deleted
     //echo "Admin Deleted";

     //Create session variable to Display message
     $_SESSION['delete']="<div class='success'> Admin Deleted Succesfully </div>";

     //Redirect to manage adnin page
     header('location:'.SITEURL.'admin/manage-admin.php');
}

else
{

    
    //Failed to Delete Admin
    //echo "Failed to DElete Admin";
    $_SESSION['delete']="<div class='error'> Failed to Delete Admin.Try again Later  </div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

//3.Redirect to Manage Admin page with message(success/error)

?>