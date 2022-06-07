<?php include('partials/menu.php'); ?>

<?php
     //Check whether the id is set or not
     if(isset($_GET['id']))
     {
       //Get all the details
        $id=$_GET['id'];

        //SQL Query to get the selected food
        $sql2="SELECT * FROM tbl_vegetable WHERE id=$id";

        //execute the query
        $res2=mysqli_query($conn,$sql2);

        //Get the value based on the query executed
        $row2=mysqli_fetch_assoc($res2);

        //Get the Individual value of the  selected food
        $title=$row2['title'];
        $description=$row2['description'];
        $price=$row2['price'];
        $current_image=$row2['image_name'];
        $current_category=$row2['category_id'];
        $featured=$row2['featured'];
        $active=$row2['active'];

     }

else
{
    //Redirect to manage food
    header("location:".SITEURL.'admin/manage-vegetable.php');
}
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Vegetable-Fruit</h1>
        <br> <br>

        <form action="" method="POST"  enctype="multipart/form-data">
            <table class="tbl-30">

            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title;?>" >
                </td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" cols="30" rows="5"> <?php echo $description;?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td>
                    <input type="text" name="price" value="<?php echo $price;?>" >
                </td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                  
                <?php
                   if($current_image=="")
                   {
                       //Image not available
                       echo "<div class='error'>Image not Available </div>";
                   }

                   else
                   {
                       //Image Available

                       ?>
                       <img src="<?php echo SITEURL;?>images/vegetable/<?php echo $current_image;?>" width="100px">
                       <?php
                   }


                ?>

                </td>
            </tr>


            <tr>
                <td>Select New Image:</td>
                <td>
                    <input type="file" name="image" >
                </td>
            </tr>
            <tr>
                <td>Category:</td>
                <td>
                    <select name="category" >

                       <?php
                        //Query to get active categories
                       $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                       //Execute the Query

                       $res=mysqli_query($conn,$sql);

                       //Count rows
                       $count=mysqli_num_rows($res);

                       //Check whether category available or not
                       if($count>0)
                       {
                           //Category Available
                           while($row=mysqli_fetch_assoc($res))
                           {
                               $category_title=$row['title'];
                               $category_id=$row['id'];


                               //echo "<option value='$category_id'>$category_title </option>";
                               
                               ?>
                               <option <?php if($current_category==$category_id){ echo "selected";}?> value="<?php echo $category_id;?>"> <?php echo $category_title;?></option>

                               <?php
                           }
                       }

                       else
                       {
                           //Category not avaialble

                           echo "<option value='0'> Category Not Available </option>";
                       }


                       ?>
                      
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=='Yes'){ echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
                    <input  <?php if($featured=='No'){ echo "checked";}?> type="radio" name="featured" value="No"> No

                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=='Yes'){ echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=='No'){ echo "checked";}?> type="radio" name="active" value="No"> No

                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">

                    <input type="submit" name="submit" value="Update Vegetable/Fruit" class="btn-secondary">  
                </td>
                
            </tr>
         </table>
            
            <?php
               if(isset($_POST['submit']))
               {
                  // echo "button Clicked";
                  //1.Get all the Details from the form

                  $id=$_POST['id'];
                  $title=$_POST['title'];
                  $description=$_POST['description'];
                  $price=$_POST['price'];
                  $current_image=$_POST['current_image'];
                  $category=$_POST['category'];

                  $featured=$_POST['featured'];
                  $active=$_POST['active'];

                  
                  //2.Upload the image if selected
                  //Check whether upload button is clicked or not

                  if(isset($_FILES['image']['name']))
                  {
                      //Upload Button Clicked
                      $image_name=$_FILES['image']['name'];//NEW Image name

                      //Check whether the file is available or not

                      if($image_name!="")
                      {
                          //Image is Available
                          //A. Uploading new image
                          //Rename the Image

                          $ext=end(explode('.',$image_name));//Gets the extension of the image

                          $image_name="vegetable-Name-".rand(0000,9999).'.'.$ext;  //This will be renamed image

                          //Get the source path and destination path

                          $src_path=$_FILES['image']['tmp_name'];//Source Path
                          $dest_path="../images/vegetable/".$image_name;//Destination Path


                          //upload the image
                          $upload=move_uploaded_file($src_path,$dest_path);

                          //Check whether the image is uploaded or not
                          if($upload==false)
                          {
                              //Failed to upload
                              $_SESSION['upload']="<div class='error>Failed to Upload new Image</div>";

                              //Redirect to manage food
                              header("location:".SITEURL.'admin/manage-vegetable.php');
                              
                              //Stop the process
                              die();

                            }

                            //3.Remove the image if new image is uploaded and current image exists
                          //B.Remove the  current image if available
                          if($current_image!="")
                          {
                            //Current Image is Available
                            
                            //Remove the image
                            $remove_path="../images/vegetable/".$current_image;

                            $remove=unlink($remove_path);

                            //Check whether the image i removed or not

                            if($remove==false)
                            {
                                //Failed to remove current image
                                $_SESSION['remove-failed']="<div class='error'>Failed to remove Current image</div>";

                                //Redirect to manage food
                                header("location:".SITEURL.'admin/manage-vegetable.php');

                                //Stop the Process
                                die();

                            }
                        }
                      }

                      else
                      {
                        $image_name=$current_image;//Default image when image is not selected


                      }
                  }

                  else
                  {
                      $image_name=$current_image;//Default image when button is not clicked

                  }

                

                  //4.Update the food in Database

                  $sql3="UPDATE tbl_vegetable SET
                  title='$title',
                  description='$description',
                  price='$price',
                  image_name='$image_name',
                  category_id='$category',
                  featured='$featured',
                  active='$active'
                  WHERE id=$id
                  ";
                   
                   //execute the query
                   $res3=mysqli_query($conn,$sql3);

                   //Check whether the query is executed or not

                   if($res3==true)
                   {
                       //Query executed and food updated
                       $_SESSION['update']="<div class='success'> Vegetable Updated Successfully</div>";
                       header("location:".SITEURL.'admin/manage-vegetable.php');
                   }

                   else
                   {
                       //Failed to update food
                       $_SESSION['update']="<div class='error'> Failed to update vegetable</div>";
                       header("location:".SITEURL.'admin/manage-vegetable.php');
                   }

                  




               }        
            ?>
        </form>


    </div>
</div>


<?php include('partials/footer.php'); ?>