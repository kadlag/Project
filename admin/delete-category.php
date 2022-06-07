<?php
//Include Constants file
include('../config/constants.php');
//echo "Delete page";
//Check wthether the id and image_name value is set or not
if(isset($_GET['id'])  AND isset($_GET['image_name']))
{
    //Get the value and delete
   // echo "Get value and Delete";
   $id=$_GET['id'];
   $image_name=$_GET['image_name'];

   //Remove the physical image file is available

   if($image_name!=" ")
   {
       //image is available.So remove it
       $path="../images/category/".$image_name;
   }
   
   //Remove the image

$remove=unlink($path);

//If failed to remove the image then add an error message and stop the process 
if($remove==false)
{
    //set the session message

    $_SESSION['remove']="<div class='error'>Failed to Remove Category image</div>";
    //Redirect  to manage category page
    header("location:".SITEURL.'admin/manage-category.php');

    //Stop the process
    die();
}
   //Delete Data from Database
   //SQL Query to Delete Data from Database
   $sql="DELETE FROM tbl_category WHERE  id=$id ";


   //Execute the Query
   $res=mysqli_query($conn,$sql);

   //Check whether the data is deleted from database or not

   if($res==true)
   {
     //Set the message and Redirect

    $_SESSION['delete']="<div class='success'>Category Deleted Successfully</div>";

    //Redirect to manage category page
    header("location:".SITEURL.'admin/manage-category.php');

   }

   else
   {
    //set fail message  and redirect
   
    $_SESSION['delete']="<div class='error'>Failed to Delete Category</div>";

    //Redirect to manage category page
    header("location:".SITEURL.'admin/manage-category.php');

   }
  
}

else
{
    //Redirect to manage category page
    header("location:".SITEURL.'admin/manage-category.php');
}
?>