<?php include('partials-front/menu.php');?>





        <fieldset class="pay-field">

                <legend >Select Payment Method</legend>
                <div class="payment">
                <div class=payment-text> <input type="radio" name="upi" id="">   UPI (Not available)</div>
                <div class=payment-text> <input type="radio" name="Wallets" id="">   Wallets (Not Available)</div>
                <div class=payment-text> <input type="radio" name="credit" id="">   Credit/Debit/ATM Card (Not Available)</div>
                <div class=payment-text> <input type="radio" name="net" id="">   Net Banking (Not Available)</div>
                <div class=payment-text> <input type="radio" name="cash" id="">   Cash On Delivery</div>
                
                </div>
                
                

        </fieldset>
        

        <fieldset class="pay-field">

                <legend >Price Details</legend>
                <div class="payment">
                
               

                <?php
                if (isset($_SESSION['total'])) {
                 $total_price= $_SESSION['total'];

                 }

                 ?>

                 <p class="payable">Amount Payable: <?php echo $total_price;?> Rs</p>
                
                 <a href="<?php echo SITEURL;?>success.php" class="btn btn-primary pay">Submit</a>
          
                </div>
                
                

        </fieldset>
<?php include('partials-front/footer.php');?>