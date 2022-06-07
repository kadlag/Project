<?php include('partials/menu.php');?>



<div class="main-content">
    <div class="wrapper">
    <h1>Manage vegetable-fruit</h1>
   
   
    <br> <br>

    <?php
    if(isset($_SESSION['add']))
    {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }

    if(isset($_SESSION['delete']))
    {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }


    if(isset($_SESSION['upload']))
    {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }
    
    
    if(isset($_SESSION['unauthorize']))
    {
      echo $_SESSION['unauthorize'];
      unset($_SESSION['unauthorize']);
    }

    if(isset($_SESSION['update']))
    {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }


    ?>

     <br><br>
     <!-- Button to add admin -->
     <a href="<?php echo SITEURL;?>admin/add-vegetable.php" class="btn-primary">Add Vegetable/Fruit</a>

      <br><br><br>
     
     <table class="tbl-full">
       <tr>
         <th>S.N</th>
         <th>Title</th>
         <th>Price</th>
         <th>Image</th>
         <th>Featured</th>
         <th>Active</th>
         <th>Actions</th>
       </tr>

      <?php
       //Create  a SQL Query  to get all the food 
       $sql="SELECT * FROM tbl_vegetable";

       //execute the Query
       $res=mysqli_query($conn,$sql);

       //count rows to check we have foods or not

       $count=mysqli_num_rows($res);


       //Create serial number variable and set default value as 1
        $sn=1;  
       if($count>0)
       {
         //we have food in database
         //Get the foods from database and display

         while($row=mysqli_fetch_assoc($res))
         {
           //get the values from individual columns
           $id=$row['id'];
           $title=$row['title'];
           $price=$row['price'];
           $image_name=$row['image_name'];
           $featured=$row['featured'];
           $active=$row['active'];
        ?>

             <tr>
               <td><?php echo $sn++;?></td>
               <td><?php echo $title;?></td>
               <td><?php echo $price;?></td>
               <td>
                 <?php 
                  //check whether we have image or not
                  if($image_name=="")
                  {
                    //we do not have image,Display error message
                    echo "<div class='error'> Image not Added</div>";
                  }

                  else
                  {
                    //we have image ,Display image
                    ?>

                    <img src="<?php echo SITEURL;?>images/vegetable/<?php echo $image_name;?>" width="100px" >

                    <?php
                  }
                 ?>
               </td>
               <td><?php echo $featured;?></td>
               <td><?php echo $active;?></td>
               <td>
                   <a href="<?php echo SITEURL;?>admin/update-vegetable.php?id=<?php echo $id;?>" class="btn-secondary">Update Vegetable-Fruit</a>
                   <a href="<?php echo SITEURL ;?>admin/delete-vegetable.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Vegetable-Fruit</a>
               </td>
             </tr>


           <?php
         }
       

       }

       else 
       {
         //food not added in database

        echo "<tr> <td colspan='7' class='error'>Vegetable/Fruit not Added Yet </td></tr>";
       }

       ?>
     
       
     </table>
    </div>
    
</div>


<?php include('partials/footer.php');?>