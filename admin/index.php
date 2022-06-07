
<?php include('partials/menu.php');?>

    <!-- main content section starts -->

    <div class="main-content">
    <div class="wrapper">
     <h1>Dashboard</h1>

     <br> <br>
     <?php

if(isset($_SESSION['login']))
{

   echo $_SESSION['login'];
   unset($_SESSION['login']);
}


 ?>

 <br><br>

      <div class="col-4 text-center">

           <?php
              //SQL Query
              $sql="SELECT * FROM tbl_category";

              //Execute Query
              $res=mysqli_query($conn,$sql);

              //count rows
              $count=mysqli_num_rows($res);


            ?>
          <h1><?php echo $count;?></h1>
          <br>
          Categories
      </div>

      <div class="col-4 text-center">

           <?php
               //SQL Query
              $sql2="SELECT * FROM tbl_vegetable";

              //Execute Query
              $res2=mysqli_query($conn,$sql2);

              //count rows
              $count2=mysqli_num_rows($res2);


            ?>
               <h1><?php echo $count2;?></h1>

          <br>
          Vegetable-Fruit
      </div>

      <div class="col-4 text-center">


             <?php
              //SQL Query
              $sql3="SELECT * FROM tbl_order";

              //Execute Query
              $res3=mysqli_query($conn,$sql3);

              //count rows
              $count3=mysqli_num_rows($res3);


            ?>
          <h1><?php echo $count3;?></h1>
          
          <br>
          Total Orders
      </div>

      <div class="col-4 text-center">
          <?php
          
             //Create SQL Query to get total Revenue Generated
             //Aggregate function in SQL
             $sql4="SELECT SUM(total) as Total FROM tbl_order where status='Delivered'";
             
             //execute the query

             $res4=mysqli_query($conn,$sql4);

             //Get the value
             $row4=mysqli_fetch_assoc($res4);

             //Get the Total Revenue
             $total_revenue=$row4['Total'];

          ?>
          <h1><?php echo $total_revenue;?></h1>
          <br>
          Revenue Generated
      </div>

      <div class="clearfix"></div>
    </div>
    </div>
    <!-- main section ends-->

   <?php include('partials/footer.php'); ?>