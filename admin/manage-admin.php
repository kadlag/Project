<?php include('partials/menu.php');?>

    <!-- main content section starts -->

    <div class="main-content">
    <div class="wrapper">
     <h1>Manage Farmer</h1>

<br> <br> 


<?php
if(isset($_SESSION['add']))
{
  echo $_SESSION['add'];//Dispalying Session Message

  unset($_SESSION['add']);//Removing Session Message
}


if(isset($_SESSION['delete']))
{
  echo $_SESSION['delete'];
  unset($_SESSION['delete']);
}

if(isset($_SESSION['update']))
{
  echo $_SESSION['update'];
  unset($_SESSION['update']);
}

if(isset($_SESSION['user-not-found']))
{
  echo $_SESSION['user-not-found'];
  unset($_SESSION['user-not-found']);
}

if(isset($_SESSION['pwd-not-match']))
{
  echo $_SESSION['pwd-not-match'];
  unset($_SESSION['pwd-not-match']);

}

if(isset($_SESSION['change-pwd']))
{
  echo $_SESSION['change-pwd'];
  unset($_SESSION['change-pwd']);
  
}
?>

<br> <br>
     <!-- Button to add admin -->
     <a href="add-admin.php" class="btn-primary">Add Farmer</a>


     <br> <br><br>
     <table class="tbl-full">
       <tr>
         <th>S.N</th>
         <th>Full Name</th>
         <th>Username</th>
         <th>Actions</th>
       </tr>



<?php 
//Query to get all admin
$sql="SELECT * FROM tbl_admin";

//Execute the Query
$res=mysqli_query($conn,$sql);

//Check whether the Query is executed or not
if($res==TRUE)
{
  //count rows to check we have data in database or not
  $count=mysqli_num_rows($res);//Fnction to get all rows in database


  $sn=1;//create a variable and assign the value
  //Check the num of rows
  if($count>0)
  {
    //we have data in database

    while($rows=mysqli_fetch_assoc($res))
     {

      //Using while loop to get all the data from database
      //And while loop will run as long as we have data in database

      //Get individual data

      $id=$rows['id'];
      $full_name=$rows['full_name'];
      $username=$rows['username'];

      //Display the values in table
      ?>

<tr>
         <td><?php echo $sn++;?></td>
         <td><?php echo $full_name; ?></td>
         <td><?php echo $username; ?></td>
         <td>
           <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
           <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
           <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
         </td>
       </tr>



      <?php
     }

     
  }

  else
  {
    //We do not have data in database
  
  }
}
?>
  
     </table>


      <div class="clearfix"></div>
    </div>
    </div>
    <!-- main section ends-->

    <?php include('partials/footer.php');?>