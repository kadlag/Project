    <?php include('partials-front/menu.php');?>



    


<?php

            //Check whether the food id is set or not
            if(isset($_GET['food_id']))
            {
                //Get the food id and details of the selected food
                $food_id=$_GET['food_id'];

                //Get the details of the selected food

                $sql="SELECT * FROM tbl_vegetable WHERE id=$food_id";
                //execute the Query
                $res=mysqli_query($conn,$sql);

                //count the rows
                $count=mysqli_num_rows($res);
               
                //check whether the data is availble or not
                if($count==1)
                {
                    //we have data
                    //Get the data from database
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                    $id=$row['id'];



                }
                else
                {
                    //food not available
                    //Redirect to home page
                    header('location:'.SITEURL);

                }
            }

            else
            {
                //Redirect to home page
                header("location:".SITEURL);

            }


        ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Bill</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Vegetable/Fruit</legend>

                    <div class="food-menu-img">
                        <?php
                            //Check whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Available
                                echo "<div class='error'>Image not available</div>";
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
                        <h3><?php echo $title;?></h3>

                        <input type="hidden" name="food" value="<?php echo $title;?>">
                        <p class="food-price"><?php echo $price;?></p>

                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="text" name="qty" class="input-responsive"  required>
                        
                      
                        <input type="submit" name="submit" value="Confirm Bill" class="btn btn-primary">
                    </div>

                </fieldset>


                <?php
                if(isset($_POST['submit']))
                {

                 $price=$_POST['price'];
                $qty=$_POST['qty'];

               $total=(int)$price*(int)$qty;
               ?>









                  <fieldset>

                <legend > Bill</legend>

               <div class="text-center  bold">Total:</div>    
              <p class="text-center bold"><?php echo $total;?></p>
              <?php $_SESSION['total']=$total;?>
              
              <a href="<?php echo SITEURL;?>payment.php?food_id=<?php echo $id;?>" class="btn btn-primary text-item-center">Payment</a>
                  </fieldset>
                  <?php
                }

               ?>
           
            

           

             <!-- <fieldset>

             <legend > Bill</legend>

             <div class="text-center  bold">Total:</div>    
            
             </fieldset>
                  -->

     </section>

    <?php include('partials-front/footer.php');?>