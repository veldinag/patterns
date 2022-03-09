<div class="container">
    <h2 class="statusinfo" id="status_str"><?= $status_str ?></h2>
</div>

<?php if( $cart !== null ) : ?>

    <main class="container shCart" id="shCart">

        <div class="shCart_list">

            <?php
                foreach($cart as $item) :
            ?>

                <div class="shCart_list_card" id="good_<?= $item['good_id'] ?>">
                    <img class="shCart_list_card_img" src="data/img/catalog/<?= $item['img'] ?>" alt="card_image">
                    <div class="shCart_list_card_descr">
                        <h3><?= $item['title'] ?></h3>
                        <ul>
                            <li>Price: <span>$<?= $item['price'] ?></span></li>
                            <li class="quant">
                                <p>Quantity:</p>
                                <span>
                                            <a onclick="carthandler(<?= $item['good_id'] ?>, 'sub')">-</a>
                                            <p id="q_<?= $item['good_id'] ?>"><?= $item['qty'] ?></p>
                                            <a onclick="carthandler(<?= $item['good_id'] ?>, 'add')">+</a>
                                        </span>
                            </li>
                        </ul>
                    </div>
                    <a class="close" href="" onclick="carthandler(<?= $item['good_id'] ?>, 'del')">
                        <img src="data/img/close_icon.svg" alt="close_icon">
                    </a>
                </div>

            <?php endforeach; ?>

            <div class="shCart_list_buttons">
                <a href="#" onclick="carthandler(0, 'clear')">Clear shopping cart</a>
                <a href="index.php">Continue shopping</a>
            </div>

        </div>

        <div class="shCart_action">
            <form action="#" class="shCart_action_shipping">
                <h3>Shipping adress</h3>
                <input type="text" placeholder="Bangladesh">
                <input type="text" placeholder="State">
                <input type="text" placeholder="Postcode / Zip">
                <button type="submit">Get a quote</button>
            </form>
            <div class="shCart_action_proceed">
                <p class="sub_total" id="sub_total">Sub total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?= $total ?></p>
                <br>
                <p class="grand_total" id="grand_total">Grand total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>$<?= $total ?></span></p>
                <a href="index.php?path=order/show">Proceed to checkout</a>
            </div>
        </div>

    </main>

<?php endif; ?>

<?php
    include "views/static/contact.php";
?>