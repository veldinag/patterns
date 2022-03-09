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
        if ($isAdmin) :
    ?>
    <div class="stat">
        <div class="stat_box">
            <h2 class="stat_box_heading">Users</h2>
            <div class="stat_box_itembox">
                <div class="stat_box_item">
                    <h3 class="stat_box_item_val"><?= $users ?></h3>
                    <p class="stat_box_item_desc">Registered users</p>
                </div>
            </div>
        </div>
        <div class="stat_box">
            <h2 class="stat_box_heading">Products</h2>
            <div class="stat_box_itembox">
                <div class="stat_box_item">
                    <h3 class="stat_box_item_val"><?= $goods ?></h3>
                    <p class="stat_box_item_desc">Products in catalog</p>
                </div>
            </div>
        </div>
        <div class="stat_box">
            <h2 class="stat_box_heading">Orders</h2>
            <div class="stat_box_itembox">
                <div class="stat_box_item">
                    <h3 class="stat_box_item_val"><?= $total_orders ?></h3>
                    <p class="stat_box_item_desc">Total orders</p>
                </div>
                <div class="stat_box_item">
                    <h3 class="stat_box_item_val"><?= $compl_orders ?></h3>
                    <p class="stat_box_item_desc">Completed orders</p>
                </div>
                <div class="stat_box_item">
                    <h3 class="stat_box_item_val"><?= $new_orders ?></h3>
                    <p class="stat_box_item_desc">New orders</p>
                </div>
                <div class="stat_box_item">
                    <h3 class="stat_box_item_val stat_box_item_valsmall">$<?= $orders_amount ?></h3>
                    <p class="stat_box_item_desc">Orders amount</p>
                </div>
                <div class="stat_box_item">
                    <h3 class="stat_box_item_val stat_box_item_valsmall">$<?= $compl_orders_amount ?></h3>
                    <p class="stat_box_item_desc">Completed orders amount</p>
                </div>
                <div class="stat_box_item">
                    <h3 class="stat_box_item_val stat_box_item_valsmall">$<?= $new_orders_amount ?></h3>
                    <p class="stat_box_item_desc">New orders amount</p>
                </div>
            </div>
        </div>
    </div>
    <?php
        endif;
    ?>
</div>