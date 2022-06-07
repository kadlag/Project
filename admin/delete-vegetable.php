<?php
//Include constants page
include('../config/constants.php');
//echo "Delete food page";

if(isset($_GET['id']) && isset($_GET['image_name']))  //Either use '&&' or 'AND'
{
    //Process to Delete
    //echo "Process to delete";

    //1.Get ID and Image Name
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];


    //2.Remove the image if available
    //Check whether the image is available or not and Delete only if available
    
    if($image_name !="")
    {
       //It has image and need to remove from folder
       //Get the image path

       $path="../images/vegetable/".$image_name;

       //Remove image file from folder

       $remove=unlink($path);


       //Check whether the image is removed or not
       if($remove==false)
       {
           //Failed to remove  image

           $_SESSION['upload']= "<div class='error'> Failed to Remove Image File</div>";
           //Redirect to manage food
           header("location:".SITEURL.'admin/manage-vegetable.php');
           //Stop the process of deleting food
           die();

        }
    }

    //3.Delete food from Database

    $sql="DELETE FROM tbl_vegetable  WHERE id=$id";
    //Execute the Query

    $res=mysqli_query($conn,$sql);

    //Check whether the query is executed or not and set the session message respectively
      //4.Redirect to manage food with Session message

    if($res==true)
    {
        //Food Deleted
        $_SESSION['delete']="<div class='success'>Vegetable/Fruit Deleted Successfully</div>";
        header("location:".SITEURL.'admin/manage-vegetable.php');
    }
    else
    {
        //Failed to Delete Food
        $_SESSION['unauthorize']="<div class='error'>Failed to Delete vegetable/fruit</div>";
        header("location:".SITEURL.'admin/manage-vegetable.php');
    }
  

}

else
{
    //Redirect to manage food page
    //echo "Redirect";

    $_SESSION['delete']="<div class='error'>Unauthorized Access</div>";
    header("location:".SITEURL.'admin/manage-vegetable.php');

}

?>