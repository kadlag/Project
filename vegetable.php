<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>vegetable-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for vegetable-fruit.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Vegetable-Fruits Menu</h2>
             <?php

               //Diplay food that are active

               $sql="SELECT * FROM tbl_vegetable WHERE active='Yes'";

               //Execute the Query
                $res=mysqli_query($conn,$sql);


                //count rows
                $count=mysqli_num_rows($res);

                //Check whether the food is available or not

                if($count>0)
                {
                    //Foods Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $description=$row['description'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];

                        ?>
                        <div class="food-menu-box">
                             <div class="food-menu-img">

                             <?php

                             //Check Whether image available or not
                             if($image_name=="")
                             {
                                 //Image not available
                                 echo "<div class='error'>Image Not Available</div>";

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
                              <p class="food-price"><?php echo $price;?></p>
                             <p class="food-detail">
                              <?php echo $description ?>
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
                    //Food not available
                    echo "<div class='error'>Vegetable/Fruit not found</div>";

                }

             ?>

           

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>