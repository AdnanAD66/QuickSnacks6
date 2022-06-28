<?php
    include("header.php");

    if(isset($_GET["p_id"]))
    {
        $id = $_GET["p_id"];
        $sql = "SELECT * FROM product_tbl where prdct_id ='$id'";
        $result=$conn->query($sql);
        if($result->num_rows > 0)
        {
            $row=$result->fetch_assoc();
        }
        $cid=$row['cate_id'];
        $hsql = "SELECT * FROM category_tbl where cate_id=$cid";
        $hresult=$conn->query($hsql);
        if($hresult->num_rows > 0)
        {
            $hrow=$hresult->fetch_assoc();
        }

        $stock="<small style='color:red'>Out of Stock</small>"; 
        if($row["prdct_qty"] > 0)
        {
            $stock="<small style='color:green'>In Stock</small>";
        }
    }
?>



<section class="container-fluid mt-5 mb-5" >  
    <div class="row">   
        <div class="col-md-5">
            <img src="<?php echo $row["prdct_img"];?>" alt="" style="width:100%;height:400px;">
        </div>
        <div class="col-md-7">
            <form action="" method="post">
                <div>
                    <h5>Product Id</h5>
                    <p><?php echo $row["prdct_id"]?></p>
                </div>
                <div>
                    <h5>Product Name</h5>
                    <p><?php echo $row["prdct_name"]?></p>
                </div>
                <div>
                    <h5>Product Category</h5>
                    <p><?php echo $hrow["cate_name"]?></p>
                </div>
                <div>
                    <h5>Product Price</h5>
                    <p><?php echo $row["prdct_price"]?></p>
                </div>
                <div>
                    <h5>Product Weight</h5>
                    <p><?php echo $row["prdct_wet_per_qty"].$row["prdct_unit"]?></p>
                </div>
                <div>
                    <h5>Product Quantity : <?php  echo $stock?></h5>
                    <div>
                    <input type="number" min=1 max=10 class="form-control" name="p_qty" id="p_qty" style="width:30%;" value="1">
                    </div>
                </div>
                <?php
                    if($stock=="<small style='color:red'>Out of Stock</small>")
                    {
                     ?>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-info" name="btn_buynow" style="width:70%;">Add to Wish List</button>
                        </div>
                     <?php
                    }
                    else
                    {
                     ?>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-success" name="btn_buynow" style="width:30%;">Buy Now</button>
                            <a id="alink" onclick='link();' class="btn btn-danger"  style="width:30%;" >Add to Cart</a>
                            <!-- <button type="submit" class="btn btn-danger" name="btn_addcart" style="width:30%;">Add to Cart</button> -->
                        </div>
                     <?php
                    }
                ?>
             <script>
                 function link()
                 {
                     var qty=document.getElementById("p_qty").value;
                     document.getElementById("alink").href = "prodct_dt.php?p_id=<?php echo $row["prdct_id"]?>&action=add&p_qty="+qty;
                    //alert(qty);
                 }
             </script>
            </form>
        </div>
    </div>
</section>

<?php
    include("footer.php");
?>