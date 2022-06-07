<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
        <?php

           //Get the search Keyword
           //$search=$_POST['search'];//Old method
           $search=mysqli_real_escape_string($conn,$_POST['search']);

            ?>
            <h2>Vegetable/Fruit on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Vegetable-Fruit Menu</h2>

            <?php
               
               //SQL Query to get foods based on search keyword
               //$search=burger';DROP database name;
               //"SELECT * FROM tbl_food WHERE title LIKE '%burger'%' OR description LIKE'%burger'%'";
               $sql="SELECT * FROM tbl_vegetable WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

               //execute the Query

               $res=mysqli_query($conn,$sql);

               //count rows

               $count=mysqli_num_rows($res);

               //check whether food available or not

               if($count>0)
               {
                   //food available
                   while($row=mysqli_fetch_assoc($res))
                   {
                       //Get the Details
                       $id=$row['id'];
                       $title=$row['title'];
                       $price=$row['price'];
                       $description=$row['description'];
                       $image_name=$row['image_name'];
                       ?>
                             
                     <div class="food-menu-box">
                                <div class="food-menu-img">

                                <?php
                                   //Check whether the image nmame is available or not

                                   if($image_name=="")
                                   {
                                       //Image not Available
                                       echo "<div class='error'>Image not Available</div>";
                                   }

                                   else
                                   {
                                       //Image Available
                                       ?>
                                          <img src="<?php echo SITEURL;?>images/vegetable/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                       <?php
                                   }
                                ?>
                                     
                                </div>

                       <div class="food-menu-desc">
                           <h4><?php echo $title;?></h4>
                           <p class="food-price"><?php echo $price?></p>
                            <p class="food-detail">
                                 <?php echo $description;?>
                           </p>
                           <br>

                           <a href="<?php echo SITEURL;?>add-to-cart.php?food_id=<?php echo $id;?>" class="btn btn-primary">Add to Cart</a>
                       </div>
                      </div>

                       <?php
                   }
               }

               else
               {
                   //food not available
                   echo "<div class='error'>Vegetable/fruit not found</div>";
               }


            ?>

           

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>