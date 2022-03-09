<div class="slider">
    <a class="slider_arrow left" href="#"><img src="data/img/left_arrow_slider.svg" alt="left_arrow_slider"></a>
    <img src="data/img/catalog/<?= $img ?>" alt="image">
    <a class="slider_arrow right" href="#"><img src="data/img/right_arrow_slider.svg" alt="right_arrow_slider"></a>
</div>

<div class="product container">
    <h2 class="product_pagename">Men collection</h2>
    <hr class="product_smalline">
    <h2 class="product_header"><?= $title ?></h2>
    <p class="product_text"><?= $long_desc ?></p>
    <p class="product_price">$<?= $price ?></p>

    <hr class="product_line">

    <!--<div class="filters">
        <div class="filters_item">
            <a href="#">Choose color
                <img src="data/img/down_arrow.svg" alt="down_arrow_img">
            </a>
        </div>
        <div class="filters_item">
            <a class="filters_item_size" href="#">Choose Size
                <img src="data/img/down_arrow.svg" alt="down_arrow_img">
            </a>
        </div>
        <div class="filters_item filters_item_last">
            <a href="#">Quantity
                <img src="data/img/down_arrow.svg" alt="down_arrow_img">
            </a>
        </div>
    </div>-->

    <a onclick="carthandler(<?= $id ?>, 'add')" class="product_btn">
        <img src="data/img/add_to_cart_icon_red.svg" alt="add_to_cart_icon_red">
        <p>Add to Cart</p>
    </a>

</div>

<!--<div class="container">
    <main class="catalog">
        <div class="catalog_product">
            <div class="catalog_card">
                <div class="catalog_card_top">
                    <div class="catalog_card_top_hover">
                        <a class="catalog_card_top_hover_btn" href="#">
                            <img class="catalog_card_top_hover_img" src="../img/cart_icon.svg" alt="cart_icon">
                            <p class="catalog_card_top_hover_text">Add to Cart</p>
                        </a>
                    </div>
                    <img class="catalog_card_img" src="../img/card4_img.png" alt="img">
                </div>
                <div class="catalog_card_info">
                    <h3 class="catalog_card_heading">ELLERY X M'O CAPSULE</h3>
                    <p class="text catalog_card_text">Known for her sculptural takes on traditional tailoring,
                        Australian
                        arbiter of cool Kym Ellery teams up with Moda Operandi.</p>
                    <p class="catalog_card_price">$52.00</p>
                </div>
            </div>
            <div class="catalog_card">
                <div class="catalog_card_top">
                    <div class="catalog_card_top_hover">
                        <a class="catalog_card_top_hover_btn" href="#">
                            <img class="catalog_card_top_hover_img" src="../img/cart_icon.svg" alt="cart_icon">
                            <p class="catalog_card_top_hover_text">Add to Cart</p>
                        </a>
                    </div>
                    <img class="catalog_card_img" src="../img/card3_img.png" alt="img">
                </div>
                <div class="catalog_card_info">
                    <h3 class="catalog_card_heading">ELLERY X M'O CAPSULE</h3>
                    <p class="text catalog_card_text">Known for her sculptural takes on traditional tailoring,
                        Australian
                        arbiter of cool Kym Ellery teams up with Moda Operandi.</p>
                    <p class="catalog_card_price">$52.00</p>
                </div>
            </div>
            <div class="catalog_card hiden">
                <div class="catalog_card_top">
                    <div class="catalog_card_top_hover">
                        <a class="catalog_card_top_hover_btn" href="#">
                            <img class="catalog_card_top_hover_img" src="../img/cart_icon.svg" alt="cart_icon">
                            <p class="catalog_card_top_hover_text">Add to Cart</p>
                        </a>
                    </div>
                    <img class="catalog_card_img" src="../img/card6_img.png" alt="img">
                </div>
                <div class="catalog_card_info">
                    <h3 class="catalog_card_heading">ELLERY X M'O CAPSULE</h3>
                    <p class="text catalog_card_text">Known for her sculptural takes on traditional tailoring,
                        Australian
                        arbiter of cool Kym Ellery teams up with Moda Operandi.</p>
                    <p class="catalog_card_price">$52.00</p>
                </div>
            </div>
        </div>
    </main>
</div>-->

<?php
    include_once "views/static/contact.php";
?>