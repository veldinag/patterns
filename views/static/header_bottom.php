<div class="header_bottom">
    <div class="container header_bottom_site">
        <h2 class="header_bottom_site_heading"><?=$heading?></h2>
        <nav class="breadcrumbs <?= $bc['visible'] ?>">
            <a href="#" class="breadcrumbs_item"><?= $bc['first'] ?></a>
            <p class="breadcrumbs_item">&nbsp;/&nbsp;</p>
            <a href="#" class="breadcrumbs_item"><?= $bc['second'] ?></a>
            <p class="breadcrumbs_item">&nbsp;/&nbsp;</p>
            <p class="breadcrumbs_item_current"><?= $bc['last'] ?></p>
        </nav>
    </div>
</div>