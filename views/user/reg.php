<div class="container">
    <h2 class="statusinfo"><?= $status_str ?></h2>
</div>

<?php if ($showRegForm) : ?>
    <main class="container regBlock">

        <form class="regBlock_form" action="index.php?path=user/reg" method="POST">
            <p class="regBlock_form_heading">Your Name</p>
            <input class="regBlock_form_input" type="text" name="firstname" placeholder="First Name">
            <input class="regBlock_form_input" type="text" name="lastname" placeholder="Last Name">
            <div class="regBlock_form_radioBlock">
                <input type="radio" id="Male" name="gender" value="Male">
                <label for="Male">Male</label>
                <input type="radio" id="Female" name="gender" value="Female">
                <label for="Female">Female</label>
            </div>
            <p class="regBlock_form_heading">Login details</p>
            <input class="regBlock_form_input" type="email" name="email" placeholder="Email">
            <input class="regBlock_form_input" type="password" name="pass" placeholder="Password">
            <p class="regBlock_form_note">
                Please use 8 or more characters,
                with at least 1 number and a mixture
                of uppercase and lowercase letters
            </p>
            <p class="regBlock_form_note">
                Have you alredy registered? <a href="index.php?path=user/login">Log in.</a>
            </p>
            <button class="regBlock_form_btn">
                <span>Join now</span>
                <img src="data/img/righr_arrow_btn.svg" alt="righr_arrow_btn">
            </button>
        </form>

        <div class="regBlock_privileges">
            <h2 class="regBlock_privileges_heading">Loyalty has its perks</h2>
            <p class="regBlock_privileges_text">Get in on the loyalty program where you can earn points and unlock serious perks. Starting with these as soon as you join:</p>
            <ul class="regBlock_privileges_list">
                <li class="regBlock_privileges_text">
                    <span>15% off welcome offer</span>
                </li>
                <li class="regBlock_privileges_text">
                    <span>Free shipping, returns and exchanges on all orders</span>
                </li>
                <li class="regBlock_privileges_text">
                    <span>$10 off a purchase on your birthday</span>
                </li>
                <li class="regBlock_privileges_text">
                    <span>Early access to products</span>
                </li>
                <li class="regBlock_privileges_text">
                    <span>Exclusive offers & rewards</span>
                </li>
            </ul>

        </div>

    </main>
<?php
    endif;
    include "views/static/contact.php";
?>