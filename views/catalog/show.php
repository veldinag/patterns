<div class="container">
    <main class="catalog">
        <nav class="filterbox">
            <div class="main_filter">
                <a class="main_filter_text" href="#main_filter_content">
                    <span>Filter</span>
                    <img class="main_filter_img" src="data/img/filter_icon.svg" alt="filter_icon">
                </a>
                <div id="main_filter_content" class="main_filter_content">
                    <a class="main_filter_text main_filter_text_red" href="#">
                        <span>Filter</span>
                        <img class="main_filter_img" src="data/img/filter_icon_red.svg" alt="filter_icon">
                    </a>
                    <div class="main_filter_content_item">
                        <a class="main_filter_content_item_heading" href="#">Category</a>
                        <ul class="main_filter_content_item_list">
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Bags</a></li>
                            <li><a href="#">Denim</a></li>
                            <li><a href="#">Hoodies & Sweatshirts</a></li>
                            <li><a href="#">Jackets & Coats</a></li>
                            <li><a href="#">Polos</a></li>
                            <li><a href="#">Shirts</a></li>
                            <li><a href="#">Shoes</a></li>
                            <li><a href="#">Sweaters & Knits</a></li>
                            <li><a href="#">T-Shirts</a></li>
                            <li><a href="#">Tanks</a></li>
                        </ul>
                    </div>
                    <div class="main_filter_content_item">
                        <a class="main_filter_content_item_heading" href="#">Brand</a>
                    </div>
                    <div class="main_filter_content_item">
                        <a class="main_filter_content_item_heading" href="#">Designer</a>
                    </div>
                </div>
            </div>
            <div class="filters">
                <div class="filters_item">
                    <a href="#">Trending now
                        <img src="data/img/down_arrow.svg" alt="down_arrow_img">
                    </a>
                </div>
                <div class="filters_item">
                    <a class="filters_item_size" href="#">Size
                        <img src="data/img/down_arrow.svg" alt="down_arrow_img">
                    </a>
                    <ul class="filters_item_content">
                        <li>
                            <input type="checkbox" id="XS">
                            <label for="XS">XS</label>
                        </li>
                        <li>
                            <input type="checkbox" id="S">
                            <label for="S">S</label>
                        </li>
                        <li>
                            <input type="checkbox" id="M">
                            <label for="M">M</label>
                        </li>
                        <li>
                            <input type="checkbox" id="L">
                            <label for="L">L</label>
                        </li>
                    </ul>
                </div>
                <div class="filters_item filters_item_last">
                    <a href="#">Price
                        <img src="data/img/down_arrow.svg" alt="down_arrow_img">
                    </a>
                </div>
            </div>
        </nav>
        <div class="catalog_main" id="catalog_main">
            <?php
            foreach($goods as $good) : ?>
                <div class="catalog_card" id="good_<?=$good['id']?>">
                    <div class="catalog_card_top">
                        <div class="catalog_card_top_hover">
                            <a class="catalog_card_top_hover_btn" onclick="carthandler(<?= $good['id'] ?>,'add')">
                                <img class="catalog_card_top_hover_img" src="data/img/cart_icon.svg" alt="cart_icon">
                                <p class="catalog_card_top_hover_text">Add to Cart</p>
                            </a>
                        </div>
                        <img class="catalog_card_img" src="data/img/catalog/<?= $good['img'] ?>" alt="img">
                    </div>
                    <div class="catalog_card_info">
                        <a href="index.php?path=Product/show/<?= $good['id'] ?>">
                            <h3 class="catalog_card_heading">
                                <?= $good['title'] ?>
                            </h3>
                        </a>
                        <p class="text catalog_card_text"><?= $good['short_desc'] ?></p>
                        <p class="catalog_card_price">$<?= $good['price'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="catalog_showBtn <?= $isShowBtnVisible ?>"
                id="showBtn"
                onclick="goodsloadhandler(<?= $nextPart ?>)">
            Show more
        </button>
        <!--<nav class="pagination">
            <a href="#" class="pagination_arrow">
                <img src="img/left_arrow.svg" alt="left_arrow_img">
            </a>
            <ul class="pagination_nav">
                <li class="pagination_nav_item_current">1</li>
                <li class="pagination_nav_item"><a href="#">2</a></li>
                <li class="pagination_nav_item"><a href="#">3</a></li>
                <li class="pagination_nav_item"><a href="#">4</a></li>
                <li class="pagination_nav_item"><a href="#">5</a></li>
                <li class="pagination_nav_item"><a href="#">6</a></li>
                <li class="pagination_nav_item"><a href="#">20</a></li>
            </ul>
            <a href="#" class="pagination_arrow">
                <img src="img/right_arrow.svg" alt="right_arrow_img">
            </a>
        </nav>-->
    </main>
</div>
<?php
    include "views/static/privileges.php";
    include "views/static/contact.php";
?>