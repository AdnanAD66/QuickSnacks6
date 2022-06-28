<?php
    include("header.php");
    if(isset($_GET["cate_id"]))
    {
        $id=$_GET["cate_id"];
        $csql = "SELECT * FROM category_tbl where cate_id=$id";
        $cresult=$conn->query($csql);
        if($cresult->num_rows > 0)
        {
            $crow=$cresult->fetch_assoc();
        }

        $psql = "SELECT * FROM product_tbl where cate_id=$id";
        $presult=$conn->query($psql);
        

    } 
?>

<section class="container-fluid" style="margin-top:2%;min-height:450px;">
    <h4>Product / <?php echo $crow["cate_name"]; ?></h4>
    <div class="container-fluid row">
        <?php
            if($presult->num_rows > 0)
            {
                while( $prow=$presult->fetch_assoc())
                {
                    ?>
                    <div class="col-md-3" style="padding:2%;">
                        <img src="<?php echo $prow["prdct_img"];?>" alt="" style="width:100%;height:250px;">

                        <h5><?php echo $prow["prdct_name"];?></h5>
                        <h6>Rs.<?php echo $prow["prdct_price"];?>/=</h6>
                        <a href="prodct_dt.php?p_id=<?php echo $prow["prdct_id"];?>" class="btn btn-primary" style="width:100%;">View Details</a>
                    </div>
                    <?php
                }
            }
            else
            {
                echo "<h5>No Records Found</h5>";
            }
        ?>
    </div>
</section>


<?php
    include("footer.php");
?>


