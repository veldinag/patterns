<nav class="navbar">
    <ul class="navbar_left">
        <li class="navbar_left_item">
            <a href="index.php">
                <img src="data/img/logo.svg" alt="logo">
            </a>
        </li>
        <?php if($menu['find']) : ?>
        <li class="navbar_left_item">
            <a href="#">
                <img src="data/img/find.svg" alt="find_img">
            </a>
        </li>
        <?php endif; ?>
    </ul>
    <?php if($menu['right']) : ?>
    <ul class="navbar_right">
        <li class="navbar_right_item">
            <a class="navbar_main_menu_btn" href="#main_menu_content">
                <img src="data/img/menu.svg" alt="menu_img">
            </a>
        </li>
        <li class="navbar_right_item log_in">
            <a href="index.php?path=user/login/0">
                <img src="data/img/log_in.svg" alt="log_in_img">
            </a>
        </li>
        <li class="navbar_right_item shop_cart">
            <a href="index.php?path=cart/show">
                <img src="data/img/shop_cart.svg" alt="shop_cart_img">
            </a>
                <span class="navbar_right_item_incart <?= $cartIcon['incart'] ?>" id="row_items"><?= $cartIcon['row_items'] ?></span>
        </li>
    </ul>

    <div id="main_menu_content" class="main_menu_content">
        <a class="main_menu_content_close_btn" href="#close">
            <img src="data/img/close_icon.svg" alt="close_icon">
        </a>
        <h2 class="main_menu_content_heading">Menu</h2>

        <nav>
            <h2 class="main_menu_content_subheading">Man</h2>
            <ul>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">Accessories</a>
                </li>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">Bags</a>
                </li>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">Denim</a>
                </li>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">T-shirts</a>
                </li>
            </ul>
        </nav>

        <nav>
            <h2 class="main_menu_content_subheading">Woman</h2>
            <ul>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">Accessories</a>
                </li>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">Jackets & Coats</a>
                </li>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">Polos</a>
                </li>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">T-shirts</a>
                </li>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">Shirts</a>
                </li>
            </ul>
        </nav>

        <nav>
            <h2 class="main_menu_content_subheading">Kids</h2>
            <ul>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">Accessories</a>
                </li>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">Jackets & Coats</a>
                </li>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">Polos</a>
                </li>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">T-shirts</a>
                </li>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">Shirts</a>
                </li>
                <li class="main_menu_content_item">
                    <a class="text main_menu_content_item_link" href="#">Bags</a>
                </li>
            </ul>
        </nav>

    </div>

    <?php endif; ?>

</nav>