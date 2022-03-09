<?php
    $nextpart = $part + 1;
    $prevpart = $part - 1;
    $status_str = ($status != null) ? "You don't have access to the admin panel. Please <a href='index.php?path=user/login'>log in</a> as a user with admin rights." : "";
?>

<div class="popup_window">
    <p>There are new orders.&nbsp;</p>
    <a href="index.php?path=admin/orders">Show.</a>
</div>

<div class="container admin">
    <?php
        if ($isAdmin) :
    ?>
    <ul class="admmenu">
        <li><a href="index.php?path=admin/show">Home</a></li>
        <li><a href="index.php?path=admin/goods">Goods</a></li>
        <li><a href="index.php?path=admin/orders">Orders</a></li>
    </ul>
    <?php
        else :
    ?>
        <div></div>
    <?php
        endif;
    ?>
    <div>
        <?php
            if($status_str != "") :
        ?>
        <h2 class="statusinfo"><?= $status_str ?></h2>
        <?php
            endif;
            if(!empty($goods)): ?>
            <ul class="admingoods">
            <?php
                foreach($goods as $good) :
            ?>
                <li class="admingoods_item">
                    <img class="admingoods_item_img" src="data/img/catalog/<?= $good['img'] ?>" alt="img">
                    <h3 class="admingoods_item_title"><?= $good['title'] ?></h3>
                    <div class="admingoods_item_linkbox">
                        <a class="admingoods_item_linkbox_link" href="index.php?path=admin/editgood/<?= $good['id'] ?>">Edit</a>
                    </div>
                </li>
            <?php
                endforeach;
            ?>
        </ul>
                <?php
                    if ($parts > 1) :
                ?>
                <nav class="pagination">
                    <?php
                        if ($part != 1) :
                    ?>
                    <a href="index.php?path=admin/goods/<?= $prevpart ?>" class="pagination_arrow">
                        <img src="data/img/left_arrow.svg" alt="left_arrow_img">
                    </a>
                    <?php
                        endif;
                    ?>
                    <ul class="pagination_nav">
                        <?php
                            for($i = 1; $i <= $parts; $i++) :
                                if($i == $part) :
                        ?>
                            <li class="pagination_nav_item_current"><?= $i ?></li>
                        <?php
                            else :
                        ?>
                            <li class="pagination_nav_item"><a href="index.php?path=admin/goods/<?= $i ?>"><?= $i ?></a></li>
                        <?php
                            endif;
                            endfor;
                        ?>
                    </ul>
                    <?php
                        if ($part != $parts) :
                    ?>
                    <a href="index.php?path=admin/goods/<?= $nextpart ?>" class="pagination_arrow">
                        <img src="data/img/right_arrow.svg" alt="right_arrow_img">
                    </a>
                    <?php
                        endif;
                    ?>
                </nav>
                <?php
                    endif;
                ?>
                <a class="admin_button" href="index.php?path=admin/addgood">Add new good</a>
            <?php
            endif;
        ?>
    </div>
</div>