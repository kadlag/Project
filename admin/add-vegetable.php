<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Vegetable-Fruit</h1>

        <br> <br>

        <?php

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>

    <form action="" method="POST" enctype="multipart/form-data">

    <table class="tbl-30">
     <tr>
         <td>Title:</td>
         <td>
             <input type="text" name="title" placeholder="Title of the Vegetable/fruit">
         </td>

     </tr>

      <tr>

         <td>Description:</td>
         <td>
             <textarea name="description"  cols="30" rows="5" placeholder="Description of the vegetable/fruit"></textarea>
         </td>
     </tr>

     <tr>
         <td>Price</td>
         <td>
             <input type="text" name="price" >
            
         </td>
     </tr>

     <tr>
         <td> Select Image:</td>
         <td>  <input type="file" name="image"></td>
        
     </tr>


     <tr>
         <td>Category:</td>
         <td>
             <select name="category" >

             <?php
              
              //Create Php code to display categories from database
              //1.Create SQL to get all active categoriesfrom Database


              $sql="SELECT * FROM tbl_category WHERE active='Yes'";

              //execute the query

              $res=mysqli_query($conn,$sql);


              //count rows to check whether we have categories or not

              $count=mysqli_num_rows($res);

              //If count is greater than zero we have categories else we do not have categories

              if($count>0)
              {
                  //we have categories
                  while($row=mysqli_fetch_assoc($res))
                  {
                      //get the details of the category

                      $id=$row['id'];
                      $title=$row['title'];
                      ?>

                    <option value="<?php echo $id; ?>"> <?php echo $title; ?></option>
                      <?php
                  }
              }
            

              else
              {
                  //we do not have categories
                  ?>
                 <option value="0">No Category Found</option>


                  <?php
              }
              //Display the Dropdown


           ?>
        
             </select>
         </td>
     </tr>


     <tr>
         <td>Featured:</td>

        <td>
            <input type="radio" name="featured" value="Yes"> Yes
            <input type="radio" name="featured" value="No"> No
        </td>
     </tr>

     <tr>
         <td>Active:</td>
         <td>
         <input type="radio" name="active" value="Yes"> Yes
         <input type="radio" name="active" value="No"> No  
         </td>
     </tr>

     <tr>
         <td colspan="2">
             <input type="submit" name="submit" value="Add Vegetable/Fruit" class="btn-secondary">
         </td>
     </tr>
    </table>
    </form>

    <?php

    //Check whether the button is clicked or not
    if(isset($_POST['submit']))
    { 
        //Add the food in Database
        //echo "Clicked";

        //1.Get the data from form

          $title=$_POST['title'];
          $description=$_POST['description'];
          $price=$_POST['price'];
          $category=$_POST['category'];

          //Check whether the radion button for featured and active are checked or not

          if(isset($_POST['featured']))
          {
              $featured=$_POST['featured'];

          }

          else
          {
              $featured="No";//Setting the Default value
          }


          if(isset($_POST['active']))
          {
              $active=$_POST['active'];
          }

          else
          { 
              $active="No";//Setting the Default value
          }

        //2.Upload the image if selected
        //Check whether the select image is clicked or not and upload the image on if the image is selected

        if(isset($_FILES['image']['name']))
        {
            //Get  the  details of the selected image
            $image_name=$_FILES['image']['name'];

            //Check whether the image  is selected or not and upload the image only if selected
            if($image_name!="")
            {
                //Image is selected
                //A.Rename the image
                //Get the extension of the selected image (jpg, png, gif ,etc.) "sakshi-kadlag.jpg" => sakshi-kadlag jpg
                $ext=end(explode('.',$image_name));

                //Create a new name for image
                $image_name="Food-Name-".rand(0000,9999).".".$ext; //New image name may be "Food-Name-657.jpg"


                //B.Upload the image
                //Get the source path and Destination path
                
                //Source path is the current location of the image
                $src=$_FILES['image']['tmp_name'];

                //Destination path for the image  to be uploaded
                $dst="../images/vegetable/".$image_name;

                //Finally upload the food image
                $upload=move_uploaded_file($src,$dst);

                //check whether the image is uploaded or not

                if($upload==false)
                {
                    //Failed to upload the image

                    //Redirect to add food page with Error Message
                    $_SESSION['upload']="<div class='error'>Failed to upload Image.</div>";
                    header("location:".SITEURL.'admin/add-vegetable.php');
                    //Stop the process
                    die();

                }

            }
        }

        else
        {
            $image_name=""; //setting Default value as blank


        }

        //3.Insert into Database

        //Create a SQL to save or Add food
        //For Numerical we do not need to pass value inside quotes ' ' but for string value it is compulsory to add quotes ''
        $sql2="INSERT INTO tbl_vegetable SET
               title='$title',
               description='$description',
               price='$price',
               image_name='$image_name',
               category_id=$category,
               featured='$featured',
               active='$active'
             ";

          
        //execute the Query
        $res2=mysqli_query($conn,$sql2);

        //Check whether the data is inserted or not
        //4.Redirect with message to manage-food page
        if($res2==true)
        {
            //Data inserted successfully
            $_SESSION['add']="<div class='success'>vegetable-fruit Added Successfully</div>";
            header("location:".SITEURL.'admin/manage-vegetable.php');


        }
        
        else
        {
            //Failedto insert data

            $_SESSION['add']="<div class='error'>Failed to Add Vegetable..</div>";
            header("location:".SITEURL.'admin/manage-vegetable.php');
        }

      

    }


    ?>
    </div>
</div>


<?php include('partials/footer.php');?>