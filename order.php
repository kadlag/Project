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
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

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
                        <input type="text" name="qty" class="input-responsive" value="1" required>
                       
                    </div>

                </fieldset>

              

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Kadlag Sakshi" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. kadlag@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                   
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                    <a href="<?php echo SITEURL;?>bill.php?food_id=<?php echo $id;?>" class="btn btn-primary">Next</a>
       
                   
                    
                </fieldset>

            </form>

            <?php

               //Check whether the submit button is clicked or not
               if(isset($_POST['submit']))
               {
                   //Get all the details of the form
                   $vegetable=$_POST['food'];
                   $price=$_POST['price'];
                   $qty=$_POST['qty'];
                  
                   $total=(int)$price*(int)$qty;//total=price x quantity

                   $order_date=date("Y-m-d h:i:sa"); //Order Date

                   $status="Ordered"; //Orderd,On Delivery,Delivered,Cancel

                   $customer_name=$_POST['full-name'];
                   $customer_contact=$_POST['contact'];
                   $customer_email=$_POST['email'];
                   $customer_address=$_POST['address'];


                   //Save the Order in Database
                   //Create SQL Query to save the data
                   $sql2="INSERT INTO tbl_order SET
                   vegetable='$vegetable',
                   price='$price',
                   qty='$qty',
                   total='$total',
                   order_date='$order_date',
                   status='$status',
                   customer_name='$customer_name',
                   customer_contact='$customer_contact',
                   customer_email='$customer_email',
                   customer_address='$customer_address'
                   ";


                   //execute the query
                   $res2=mysqli_query($conn,$sql2);

                   //Check whether query is executed successfully or not
                   if($res2==true)
                   {
                       //Query Executed and order saved
                    //    $_SESSION['order']="<div class='success text-center'> Vegetable/Fruit Ordered Successfully</div>";

                    //    $_SESSION['quantity']=$qty;

                    //    header("Location:http://localhost/veg-fruit-order/bill.php");
                
                    // header('location:'.SITEURL."bill.php?food_id=<?php echo $");
                
                    
                   }

                   else
                   {
                       //failed to save order

                       $_SESSION['order']="<div class='error text-center'>Failed to Order Vegetable/Fruit</div>";
                       header('location:'.SITEURL);
                   }


               }
               

            ?>
              
             

             
        </div>

    

    </section>


   
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>