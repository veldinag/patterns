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
            if(!empty($orders)): ?>
            <div class="switch">
                <h2 class="switch-heading">Show only new orders</h2>
                <div class="switch-btn" id="switch-btn" onclick="switchhandler()"></div>
            </div>
            <ul class="container ordersadmin">
                <li id="orderlist_header">
                    <div class="orderlist orderlist_header">
                        <p>№</p>
                        <p>Order ID</p>
                        <p>Client</p>
                        <p>Order date</p>
                        <p>Status</p>
                    </div>
                </li>
            <?php
                $i = 1;
                foreach($orders as $order) :
            ?>
                <li>
                    <div class="orderlist" id="orderID_<?= $order['id'] ?>" onclick="getOrderDetails(<?= $order['id'] ?>)">
                        <p class="pos"><?= $i++ ?>.</p>
                        <p><?= $order['id'] ?></p>
                        <p class="ta_left"><?= $order['name'] ?></p>
                        <p><?= $order['date'] ?></p>
                        <p class="order_status" id="status<?= $order['id'] ?>"><?= $order['status'] ?></p>
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
                    <a href="index.php?path=admin/orders/<?= $prevpart ?>" class="pagination_arrow">
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
                            <li class="pagination_nav_item"><a href="index.php?path=admin/orders/<?= $i ?>"><?= $i ?></a></li>
                        <?php
                            endif;
                            endfor;
                        ?>
                    </ul>
                    <?php
                        if ($part != $parts) :
                    ?>
                    <a href="index.php?path=admin/orders/<?= $nextpart ?>" class="pagination_arrow">
                        <img src="data/img/right_arrow.svg" alt="right_arrow_img">
                    </a>
                    <?php
                        endif;
                    ?>
                </nav>
            <?php
                    endif;
            endif;
        ?>
    </div>
</div>