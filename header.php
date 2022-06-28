<?php
    session_start();
   //$_SESSION["cart_item"]=null;

if(isset($_POST["btn_logout"]))
{
    unset($_SESSION["customer_id"]);
    unset($_SESSION["customer_name"]);
    unset($_SESSION["customer_email"]);
    unset($_SESSION["customer_cellno"]);
    header("Location:login.php");
}


    include("conn.php");

    $hsql = "SELECT * FROM category_tbl";
    $hresult=$conn->query($hsql);

    if(!empty($_GET["action"]))
    {
        switch($_GET["action"])
        {
            case "add": 
                    $pcodeid=$_GET["p_id"];
                    $pqty=$_GET["p_qty"];
                    $p_sql="SELECT * FROM product_tbl where prdct_id=$pcodeid;";
                    $p_result=$conn->query($p_sql);
                    if($p_result->num_rows > 0)
                    {
                        $p_row=$p_result->fetch_assoc();
                        $items=array($p_row["prdct_id"],$p_row["prdct_name"],$p_row["prdct_img"],$p_row["prdct_price"],$pqty);

                        if(!empty($_SESSION["cart_item"]))
                        {
                            // foreach ($_SESSION["cart_item"] as $select=>$val)
                            // {
                            //     if($val[0]==$pcodeid)
                            //     {
                            //        // unset($_SESSION["cart_item"][$select]);
                            //     }
                            //     else
                            //     {
                                    array_push($_SESSION["cart_item"],$items);
                            //     }  
                            // }
                        }
                        else
                        {
                            $_SESSION["cart_item"]=array();
                            array_push($_SESSION["cart_item"],$items);
                        }    
                    }
                break;
            case "remove": 
                    $pcodeid=$_GET["p_id"];
                    if(!empty($_SESSION["cart_item"]))
                    {
                        foreach ($_SESSION["cart_item"] as $select=>$val)
                        {
                            if($val[0]==$pcodeid)
                            {
                                unset($_SESSION["cart_item"][$select]);
                            }
                        }
                    }
                break;
            case "empty": 
                unset($_SESSION["cart_item"]);
                break;
        }
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 </head>
  <body>



    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Online Mart</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Product</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <?php
                          if($hresult->num_rows > 0)
                          {
                             while($hrow=$hresult->fetch_assoc())
                             {
                                 echo '<a class="dropdown-item" href="product.php?cate_id='.$hrow["cate_id"].'">'.$hrow["cate_name"].'</a>';
                             }
                          }
                        ?>       
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="post">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 ml-1" type="submit">Search</button>

                <?php
                    if(empty($_SESSION["customer_name"]))
                    {
                        echo '<a href="login.php" class="btn btn-outline-success my-2 my-sm-0 ml-1" style="color:green;">Login</a>';
                    }
                    else
                    {
                        $cust_name=$_SESSION["customer_name"];
                        $cust_email=$_SESSION["customer_email"];
                        $cust_cellno=$_SESSION["customer_cellno"];

                        echo '<button  type="submit" class="btn btn-outline-success my-2 my-sm-0 ml-1" name="btn_logout" style="color:green;">Logout</button>';
                    }
                ?>
              
                

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#modelId"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                </button> 
                
                <!-- Modal -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cart Items</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <table class="tbl-cart" cellpadding="10" cellspacing="1" border="1" width="100%">
                                    <tr class="bg-light">
                                        <th style="text-align:left;">Name</th>
                                        <th style="text-align:left;">Code</th>
                                        <th style="text-align:right;">Qty</th>
                                        <th style="text-align:right;">Price (in Rs.)</th>
                                        <th style="text-align:right;">Total (in Rs.)</th>
                                        <th style="text-align:center;">Remove</th>
                                    </tr>

                                    <?php
                                  //  $_SESSION["cart_item"];
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
                                                <td><img src="<?php echo $item[2] ?>" class="cart-item-image" style="width:100px;height:100px;"><?php echo $item[1] ?></td>
                                                <td><?php echo $item[0] ?></td>
                                                <td style="text-align:right;"><?php echo $item[4] ?></td>
                                                <td style="text-align:right;"><?php echo $item[3] ?></td>
                                                <td style="text-align:right;"><?php echo $total ?></td>
                                                <td style="text-align:center;">
                                                    <a href="index.php?action=remove&amp;p_id=<?php echo $item[0] ?>" class="btnRemoveAction">
                                                        <img src="images/icon-delete.png" alt="Remove Item">
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                   
                                    
                                    ?>
                                    <tr  class="bg-light">
                                        <td colspan="2" style="text-align:right;">Total</td>
                                        <td  style="text-align:right;"><?php echo $tot_qty;?></td>
                                        <td  style="text-align:right;" colspan="2"><strong>Rs. <?php echo $tot_price;?>/=</strong></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-success" data-dismiss="modal">Close</button> -->
                                <a href="index.php?action=empty" class="btn btn-danger">Empty cart</a>
                                <a href="checkout.php" class="btn btn-danger">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- End Modal -->

            </form>
        </div>
    </nav>
    
  