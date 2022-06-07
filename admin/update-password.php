<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">

    <h1>Change Password</h1>
    <br> <br>


    <?php

    if(isset($_GET['id']))
    {
        $id=$_GET['id'];

    }
    ?>

    
    <form action="" method="POST">


    <table  class="tbl-30">

        <tr>
            <td>Current Password:</td>
            <td>
                <input type="password" name="current_password" placeholder="current Password">
            </td>
        </tr>

        <tr>
            <td>New Password</td>
            <td>
                <input type="password" name="new_password"  placeholder="new password">
            </td>
        </tr>

        <tr>
            <td>Confirm Password</td>

            <td>
                <input type="password" name="confirm_password" placeholder="confirm password">
            </td>
        </tr>

        <tr>
            <td colspan="2">
         <input type="hidden" name="id"  value="<?php echo $id;?>">
            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
            </td>

        </tr>

    </table>
    </form>

</div>
</div>


<?php
    
     //Check wthether the submit button is clicked or not

     if(isset($_POST['submit']))

    {
            // echo "clicked";

            //1.Get the data from form
            $id=$_POST['id'];
            $current_password= md5($_POST['current_password']);
            $new_password=md5($_POST['new_password']);
            $confirm_password=md5($_POST['confirm_password']);


            //2.Check whether the  user with current ID and current password  exists or not


            $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password' ";


            //execute the Query
            $res=mysqli_query($conn,$sql);

            if($res==true)
            {
                //check whether data is available or not
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    //user exists and pasword can be changed
                   // echo "User Found";
                   
                   //Check whether the new password and confirm password match or not
                   if($new_password==$confirm_password)
                   {
                       //Update the password

                    $sql2="UPDATE tbl_admin SET 
                           password='$new_password '
                           where id=$id
                           ";
                   

                   //Execute the Query
                   $res2=mysqli_query($conn,$sql2);

                   //Check whether the query executed or not
                   if($res2==TRUE)
                   {
                       //Display Success message
                       $_SESSION['change-pwd']="<div class='success' > Password changed successfully </div>";

                       //Redirect the User
                       header("location:".SITEURL.'admin/manage-admin.php');

                   }
                   else
                   {
                       //Display Error message

                       $_SESSION['change-pwd']="<div class='error' > Failed to Changed Password </div>";

                       //Redirect the User
                       header("location:".SITEURL.'admin/manage-admin.php');
                   }
                }

                   else
                   {
                        //REdiect to manage admin page with error message
                        $_SESSION['pwd-not-match']="<div class='error' > Password Did not match </div>";

                        //Redirect the User
                        header("location:".SITEURL.'admin/manage-admin.php');
                   }
                }


                else
                {
                    //User does not exist Set Message and Redirect
                    $_SESSION['user-not-found']="<div class='error' > User Not Found  </div>";

                    //Redirect the User
                    header("location:".SITEURL.'admin/manage-admin.php');
                }
            }

            //3.Check whether the New password and confirmed password match or not

            //4.change password if all above is true
    }
?>


<?php include('partials/footer.php');?>