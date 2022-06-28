<?php
    include("header.php");

    $sql = "SELECT * FROM my_slider ORDER BY id DESC LIMIT 3";
    $result=$conn->query($sql);
    $cnt;

    if($result->num_rows > 0)
    {
        $cnt=$result->num_rows;
    }

?>
<section>
    <div id="carouselId" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
                for($i=0; $i<$cnt;$i++)
                {
                    if($i==0)
                        echo '<li data-target="#carouselId" data-slide-to="'.$i.'" class="active"></li>';
                    else
                        echo '<li data-target="#carouselId" data-slide-to="'.$i.'"></li>';
                }
            ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php
                if($result->num_rows > 0)
                {
                    $j=0;
                   while($row=$result->fetch_assoc())
                   {
                       if($j==0)
                       {
                        ?>
                        <div class="carousel-item active">
                            <img src="<?php echo $row["image_path"];?>" alt="<?php echo $row["image_title"];?>" style="width:100%;height:450px;">
                        </div>
                        <?php
                        $j++;
                       }
                       else{
                        ?>
                        <div class="carousel-item">
                            <img src="<?php echo $row["image_path"];?>" alt="<?php echo $row["image_title"];?>" style="width:100%;height:450px;">
                        </div>
                        <?php
                       }
                       
                   }
                }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>



<?php
    include("footer.php");
?>