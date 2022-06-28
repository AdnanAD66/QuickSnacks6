<?php
    session_start();

if($_SESSION["customer_name"]=="")
{
    header("Location:login.php");
}
if(isset($_POST["btn_cnfrm_order"]))
{
    include("conn.php");
    $cust_id=$_SESSION["customer_id"];
    $cust_name=$_POST["full_name_txt"];
    $cust_email=$_POST["email_txt"];
    $cust_cntry=$_POST["country_txt"];
    $cust_city=$_POST["city_txt"];
    $cust_adres=$_POST["adres_txt"];
    $cust_cellno=$_POST["cellno_txt"];
    $payment_method=$_POST["p_metdh"];

    $card_name=$_POST["crd_name"];
    $card_cvv=$_POST["crd_cvv"];
    $card_no=$_POST["crd_no"];
    $card_expiry=$_POST["crd_exp"];

    $vchr_code=$_POST["vcode_txt"];
    $delivery_carge=$_POST["delverycharge_txt"];
    $total_bill_amnt= $_SESSION["Total_Bill"];
    $order_date=date("Y/m/d");


    $sql_order="insert into order_tbl values(0,'$cust_id','$order_date')";
    if ($conn->query($sql_order) === TRUE)
    {
        $last_order_id = $conn->insert_id;  

        $sql_bill="insert into billing_tbl values(0,'$cust_name','$cust_email','$cust_cntry','$cust_city','$cust_adres','$cust_cellno',$cust_id,$last_order_id,$total_bill_amnt,'$order_date','$payment_method','none')";
        $conn->query($sql_bill);

        if(!empty($_SESSION["cart_item"]))
        {                          
            foreach ($_SESSION["cart_item"] as $item)
            {
                $p_id=$item[0];
                $p_price=$item[3];
                $p_qty=$item[4];
                $o_id= $last_order_id ;

                $sql_order_detail="insert into order_dt_tbl values(0,$p_id,$p_price,$p_qty,$o_id);";
                $conn->query($sql_order_detail);

            }
        }


        $_SESSION["order_id"]=$last_order_id;
    } 
    else 
    {
        echo "Error: " . $sql_order . "<br>" . $conn->error;
    }

    header("Location:confirm_order.php");
}

include("header.php");

?>



<section class="container-fluid mt-5 mb-5" >  
    <div class="row">  
        <div class="col-md-9">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Billing/Shipping Address</h4>
                        <div class="form-group">
                            <i class="fa fa-user"></i>
                            <label for="">Full Name</label>
                            <input type="text" class="form-control" name="full_name_txt" aria-describedby="helpId" required value="<?php echo $cust_name; ?>">
                        </div>

                        <div class="form-group">
                            <i class="fa fa-envelope"></i>
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email_txt" aria-describedby="helpId" required value="<?php echo $cust_email; ?>">
                        </div>

                        <div class="form-group">
                            <i class="fa fa-flag"></i>
                            <label for="">Country</label><br>
                            <select class="custom-select" name="country_txt">
                                <option selected>Select Country</option>
                                <option value="Pakistan">Pakistan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <i class="fas fa-city"></i>
                            <label for="">City</label><br>
                            <select class="custom-select" name="city_txt">
                                <option selected>Select City</option>
                                <option value="Karachi">Karachi</option>
                                <option value="Lahore">Lahore</option>
                                <option value="Islamabad">Islamabad</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <i class="fa fa-address-card"></i>
                            <label for="">Street Address</label>
                            <input type="text" class="form-control" name="adres_txt" aria-describedby="helpId" required>
                        </div>
                        

                        <div class="form-group">
                            <i class="fa fa-envelope"></i>
                            <label for="">Cell Number</label>
                            <input type="text" class="form-control" name="cellno_txt" aria-describedby="helpId" required value="<?php echo $cust_cellno; ?>">
                        </div>
                    </div>

                
                    <div class="col-md-6">
                        <h4>Payments</h4>
                        <br>
                        <label for="">Payment Method</label><br>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input ml-5" type="radio" name="p_metdh" id="pp" value="COD"> Cash on Delivery  
                                <br>
                                <input class="form-check-input ml-5" type="radio" name="p_metdh" id="op" value="OP"> Onilne Payment
                                <br>
                                <input class="form-check-input ml-5" type="radio" name="p_metdh" id="pp" value="EP"> EasyPaisa
                                <br>
                                <input class="form-check-input ml-5" type="radio" name="p_metdh" id="pp" value="PP"> PayPal
                            </label>
                        </div>
                      <br>
                        <!-- card form code -->

                       <div class="card_div" id="card_div">    
                            <h4 class="mt-3">Card Information</h4>
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <input type="text"
                                        class="form-control" name="crd_name" id="" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Card Name</small>
                                    </div>

                                    <div class="form-group">
                                    <input type="number"
                                        class="form-control" name="crd_cvv" id="" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">CVV Code</small>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="number"
                                            class="form-control" name="crd_no" id="" aria-describedby="helpId" placeholder="">
                                        <small id="helpId" class="form-text text-muted">Credit Card Number</small>
                                    </div>

                                    <div class="form-group">
                                    <input type="date"
                                        class="form-control" name="crd_exp" id="" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Card Expiry</small>
                                    </div>

                                </div>
                            </div>
                        </div>


<script>
    $(document).ready(function(){
        $(".card_div").hide();

        $("input[id='op']").click(function(){
            $(".card_div").show();
        });

        $("input[id='pp']").click(function(){
            $(".card_div").hide();
        });
    });
</script>

                            <div class="form-group mt-3">
                                <label for="">Vocher Code</label>
                                <input type="text" class="form-control" name="vcode_txt" id="" aria-describedby="helpId" placeholder="">
                            </div>

                            <div class="form-group mt-3">
                                <label for="">Delivery Charges : </label>
                                <label for="">Rs. 50/=</label>
                                <input type="hidden" class="form-control" name="delverycharge_txt" value="50">
                            </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success w-50" name="btn_cnfrm_order">Confirm Order</button>
                    </div>
                </div>
            </form>
        </div>
       
        <div class="col-md-3 p-3">
            <h4>Cart Items</h4>
                <table class="tbl-cart"  width="90%">
                    <tr class="bg-light">
                        <th style="text-align:left;">Name</th>
                        <th style="text-align:right;">Qty</th>
                        <th style="text-align:right;">Total (in Rs.)</th>               
                    </tr>

                    <?php
                    $tot_qty=0;
                    $tot_price=0;

                    if(!empty($_SESSION["cart_item"]))
                    {                          
                        foreach ($_SESSION["cart_item"] as $item)
                        {
                            $total=$item[4]* $item[3];
                            $tot_qty+=$item[4];
                            $tot_price+=$total;
                    ?>
                    <tr>
                        <td><?php echo $item[1] ?></td>
                        <td style="text-align:right;"><?php echo $item[4] ?></td>
                        <td style="text-align:right;"><?php echo $total ?></td>
                    </tr>
                    <?php
                        }
                    }                       
                    ?>
                    <tr  class="bg-light">
                        <td  style="text-align:right;">Total</td>
                        <td  style="text-align:right;"><?php echo $tot_qty;?></td>
                        <td  style="text-align:right;"><strong>Rs. <?php echo $tot_price;  $_SESSION["Total_Bill"]=$tot_price;  ?>/=</strong></td>

                    </tr>
                </table>
        </div>
    </div>
</section>

<?php
    include("footer.php");
?>