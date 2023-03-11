
<?php

// include "controller/connect.php";


// $DB = new connect_DB("localhost","root","","beachresort");

$data_latest = $DB->get_list("SELECT news.id,news.title_new,news.date,news.summary_new,news.description,authors.name_author FROM news,authors WHERE news.id_author = authors.id_author AND news.status = 1 ORDER BY `date` DESC LIMIT 3");

?>
<div id="main">
    <div class="box">
        <div>
            <div>
                <h3>Latest Blog</h3>
                <ul>
                    <?php foreach($data_latest as $value){?>
                    <li>
                        <h4><a href="news.php?id_new=<?php echo $value['id'];?>"><?php echo $value['title_new'];?></a></h4>
                        <span><?php echo $value['date'];?></span>
                        <p>
                            <?php echo $value['summary_new'];?>
                        </p>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
    <div id="testimonials" class="box">
        <div>
            <div>
                <h3>Testimonials</h3>
                <p>
                    “In hac habitasse platea dictumst. Integer purus justo, egestas eu consectetur eu, cursus in tortor. Quisque nec nunc ac mi ultrices iaculis. Aenean quis elit mauris, nec vestibulum lorem.” <span>- <a href="index.php">Juan De La Cruz</a></span>
                </p>
            </div>
        </div>
    </div>
</div>
<div id="sidebar">
    <div class="section">
        <a href="rooms.php"><img src="images/rooms.png" alt="Img"></a>
    </div>
    <div class="section">
        <a href="dives.php"><img src="images/dive-site.png" alt="Img"></a>
    </div>
    <div class="section">
        <a href="foods.php"><img src="images/food.png" alt="Img"></a>
    </div>
</div>
</div>