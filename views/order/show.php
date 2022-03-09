<div class="container">
    <div class="order_heading">
        <h2>
            Your order #<?= $order_id ?> is accepted.
            Our manager will contact you shortly to clarify the details of delivery.
        </h2>
        <h2>
            Your order includes:
        </h2>
    </div>

    <div class="order_box">
        <span class="heading">№</span>
        <span class="heading">Product name</span>
        <span class="heading">Cost</span>
        <span class="heading">Quantity</span>
        <span class="heading">Total cost</span>

        <?php
            $total = 0;
            $n = 0;
            foreach($ordered_goods as $item) :
                $total += $item['total'];
                $n++;
                ?>
                <span><?= $n ?>.</span>
                <span><?= $item['title'] ?></span>
                <span>$<?= $item['price'] ?></span>
                <span><?= $item['qty'] ?></span>
                <span>$<?= $item['total'] ?></span>
            <?php endforeach; ?>
            <i></i><i></i><i></i><i></i>
            <span class="total">$<?= $total ?></span>
        </div>
    </div>

<?php
    include "views/static/contact.php";
?>