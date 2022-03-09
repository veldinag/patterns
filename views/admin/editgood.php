<?php
    switch($status) {
        case 1:
            $status_str = "Changes saved.";
            break;
        case 2:
            $status_str = "Operation canceled.";
            break;
        case 3:
            $status_str = "Changes are not saved. Error working with the database.";
            break;
        case 4:
            $status_str = "Item deleted.";
            break;
        case 5:
            $status_str = "You don't have access to the admin panel. Please <a href='index.php?path=user/login'>log in</a> as a user with admin rights.";
            break;
        default:
            $status_str = "";
            break;
    }
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
    <div class="admin_wrapper">
        <?php 
            if ($isAdmin && is_array($good)) :
        ?>
        <form action="index.php?path=admin/editgood/<?= $good['id'] ?>" method="POST" enctype="multipart/form-data">
            <div class="editproduct">
                <p class="editproduct_title">Title:</p>
                <input class="editproduct_input" type="text" name="title" value="<?= $good['title'] ?>">
                <p class="editproduct_title">Short description:</p>
                <textarea class="editproduct_textarea" name="short_desc"><?= $good['short_desc'] ?></textarea>
                <p class="editproduct_title">Long description:</p>
                <textarea class="editproduct_textarea" name="long_desc"><?= $good['long_desc'] ?></textarea>
                <p class="editproduct_title">Price:</p>
                <input class="editproduct_input" type="text" name="price" value="<?= $good['price'] ?>">
                <p class="editproduct_title">Image:</p>
                <div class="editproduct_imgedit">
                    <div id="preview">
                        <img src="data/img/catalog/<?= $good['img'] ?>" alt="image">
                    </div>
                    <div>
                        <div class="editproduct_imgedit_img-upload">
                            <label>
                                <input class="editproduct_imgedit_img-upload_btn" id="file" type="file" name="img" onchange="getFileParam();" />
                                <span>Select file</span>
                            </label>
                        </div>
                        <span class="editproduct_imgedit_filename" id="filename"></span>
                    </div>

                </div>
                <span></span>
                <div>
                    <button class="editproduct_btn" name="operation" value="change">Save changes</button>
                    <button class="editproduct_btn" name="operation" value="delete">Delete item</button>
                    <button class="editproduct_btn" name="operation" value="cancel">Cancel</button>
                </div>
            </div>
        </form>
        <?php
            endif;
            if ($status_str !== "") :
        ?>
        <h2 class="statusinfo"><?= $status_str ?></h2>
        <?php
            endif;
        ?>
    </div>
</div>