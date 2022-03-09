<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/style/style.css">
    <title><?=$title?></title>
</head>

<body onload="get_new_orders()">
    <script src="views/script/carthandler.js"></script>
    <script src="views/script/goodsloadhandler.js"></script>
    <script src="views/script/imagehandler.js"></script>
    <script src="views/script/ordersadminhandler.js"></script>
    
    <header>
        <div class="container">
        <?php
            if ($showAdmin && $menu['find'] != "") :
                include "views/static/adminnav.php";
            endif;
            include "views/static/navbar.php";
        ?>
        </div>
    <?php
        include "views/static/header_bottom.php";
    ?>
    </header>

    <?=$content?>
    
    <?php
        include "views/static/footer.php";
    ?>

</body>

</html>