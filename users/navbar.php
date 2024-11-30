<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website Title</title>

    <!-- Add your stylesheets and scripts here -->
    <link rel="stylesheet" href="path/to/your/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include other scripts if needed -->
    
    <!-- Bootstrap CSS (if used) -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <!-- Font Awesome (if used) -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-faTfBR5F5R8L6M6FjQlckv3WCAA6a0IjMpuc7ZCBuWQJaigvmU8XDDs3RntcfR9D" crossorigin="anonymous"> -->

    <!-- Your custom styles -->
    <style>
        /* Add your custom styles here */
    </style>
</head>

<body>

    <header class="header">
        <div class="header__top">
            <div class="header__container container">
                <div class="header__contact">
                    <span>(+01) - 2345 - 6789</span>
                    <span>Our location</span>
                </div>
                <p class="header__alert-news">
                    Super Values Deals - Save more coupons
                </p>
                <a href="login-register.html" class="header__top-action">
                    Log In / Sign Up
                </a>
            </div>
        </div>

        <nav class="nav container">
            <a href="index.html" class="nav__logo">
                <img class="nav__logo-img" src="assets/img/logo.svg" alt="website logo">
            </a>
            <div class="nav__menu" id="nav-menu">
                <div class="nav__menu-top">
                    <a href="index.html" class="nav__menu-logo">
                        <img src="./assets/img/logo.svg" alt="">
                    </a>
                    <div class="nav__close" id="nav-close">
                        <i class="fi fi-rs-cross-small"></i>
                    </div>
                </div>
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="index.html" class="nav__link active-link">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="shop.html" class="nav__link">Shop</a>
                    </li>
                    <li class="nav__item">
                        <a href="accounts.html" class="nav__link">My Account</a>
                    </li>
                    <li class="nav__item">
                        <a href="compare.html" class="nav__link">Compare</a>
                    </li>
                    <li class="nav__item">
                        <a href="login-register.html" class="nav__link">Login</a>
                    </li>
                </ul>
                <div class="header__search">
                    <input type="text" placeholder="Search For Items..." class="form__input" />
                    <button class="search__btn">
                        <img src="assets/img/search.png" alt="search icon" />
                    </button>
                </div>
            </div>
            <div class="header__user-actions">
                <a href="wishlist.html" class="header__action-btn" title="Wishlist">
                    <img src="assets/img/icon-heart.svg" alt="" />
                    <span class="count">3</span>
                </a>
                <a href="cart.html" class="header__action-btn" title="Cart">
                    <img src="assets/img/icon-cart.svg" alt="" />
                    <span class="count">3</span>
                </a>
                <div class="header__action-btn nav__toggle" id="nav-toggle">
                    <img src="./assets/img/menu-burger.svg" alt="">
                </div>
            </div>
        </nav>
    </header>

    <!-- Include your other content here -->

    <!-- Include your scripts at the end of the body, after the HTML content -->
    <script src="path/to/your/scripts.js"></script>
    <!-- Include other scripts if needed -->

    <!-- Bootstrap JS (if used) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

</body>

</html>
