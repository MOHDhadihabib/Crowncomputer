<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylish E-Commerce Header</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <header>
        <div class="header-top">
            <div class="container">
                <ul class="header-social-container">
                    <li><a href="#" class="social-link"><ion-icon name="logo-facebook"></ion-icon></a></li>
                    <li><a href="#" class="social-link"><ion-icon name="logo-twitter"></ion-icon></a></li>
                    <li><a href="#" class="social-link"><ion-icon name="logo-instagram"></ion-icon></a></li>
                    <li><a href="#" class="social-link"><ion-icon name="logo-linkedin"></ion-icon></a></li>
                </ul>
                <div class="header-alert-news">
                    <p><b>Free Shipping</b> This Week Order Over - $55</p>
                </div>
                <div class="header-top-actions">
                    <select name="currency">
                        <option value="usd">USD &dollar;</option>
                        <option value="eur">EUR &euro;</option>
                    </select>
                    <select name="language">
                        <option value="en-US">English</option>
                        <option value="es-ES">Español</option>
                        <option value="fr">Français</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="header-main">
            <div class="container">
                <a href="#" class="header-logo">
                    <img src="logo.jpg"  width="100" height="100" margin-top="20">
                </a>
                <div class="header-search-container">
                    <input type="search" name="search" class="search-field" placeholder="Enter your product name...">
                    <button class="search-btn"><ion-icon name="search-outline"></ion-icon></button>
                </div>
                <div class="header-user-actions">
                    <button class="action-btn"><ion-icon name="person-outline"></ion-icon></button>
                    <button class="action-btn"><ion-icon name="heart-outline"></ion-icon><span class="count">0</span></button>
                    <button class="action-btn"><ion-icon name="bag-handle-outline"></ion-icon><span class="count">0</span></button>
                </div>
            </div>
        </div>

        <nav class="desktop-navigation-menu">
            <div class="container">
                <ul class="desktop-menu-category-list">
                    <li class="menu-category"><a href="#" class="menu-title">Home</a></li>
                    <li class="menu-category">
                        <a href="#" class="menu-title">Categories</a>
                        <div class="dropdown-panel">
                            <!-- Repeat for each category -->
                            <ul class="dropdown-panel-list">
                                <li class="menu-title"><a href="#">Electronics</a></li>
                                <li class="panel-list-item"><a href="#">Desktop</a></li>
                                <li class="panel-list-item"><a href="#">Laptop</a></li>
                                <!-- Add more items as needed -->
                                <li class="panel-list-item"><a href="#"><img src="./assets/images/electronics-banner-1.jpg" alt="Electronics" width="250" height="119"></a></li>
                            </ul>
                            <!-- More dropdown-panel-list for other categories -->
                        </div>
                    </li>
                    <!-- Repeat for each top-level menu item -->
                    <li class="menu-category"><a href="#" class="menu-title">Blog</a></li>
                    <li class="menu-category"><a href="#" class="menu-title">Hot Offers</a></li>
                </ul>
            </div>
        </nav>

        <div class="mobile-bottom-navigation">
            <button class="action-btn" data-mobile-menu-open-btn><ion-icon name="menu-outline"></ion-icon></button>
            <button class="action-btn"><ion-icon name="bag-handle-outline"></ion-icon><span class="count">0</span></button>
            <button class="action-btn"><ion-icon name="home-outline"></ion-icon></button>
            <button class="action-btn"><ion-icon name="heart-outline"></ion-icon><span class="count">0</span></button>
            <button class="action-btn" data-mobile-menu-open-btn><ion-icon name="grid-outline"></ion-icon></button>
        </div>

        <nav class="mobile-navigation-menu has-scrollbar" data-mobile-menu>
            <div class="menu-top">
                <h2 class="menu-title">Menu</h2>
                <button class="menu-close-btn" data-mobile-menu-close-btn><ion-icon name="close-outline"></ion-icon></button>
            </div>
            <ul class="mobile-menu-category-list">
                <li class="menu-category"><a href="#" class="menu-title">Home</a></li>
                <li class="menu-category">
                    <button class="accordion-menu" data-accordion-btn>
                        <p class="menu-title">Men's</p>
                        <ion-icon name="add-outline" class="add-icon"></ion-icon>
                        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </button>
                    <ul class="submenu-category-list" data-accordion>
                        <li class="submenu-category"><a href="#" class="submenu-title">Shirt</a></li>
                        <li class="submenu-category"><a href="#" class="submenu-title">Shorts & Jeans</a></li>
                        <!-- Add more items as needed -->
                    </ul>
                </li>
                <!-- Repeat for each top-level menu item -->
                <li class="menu-category">
                    <button class="accordion-menu" data-accordion-btn>
                        <p class="menu-title">Language</p>
                        <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
                    </button>
                    <ul class="submenu-category-list" data-accordion>
                        <li class="submenu-category"><a href="#" class="submenu-title">English</a></li>
                        <li class="submenu-category"><a href="#" class="submenu-title">Español</a></li>
                        <li class="submenu-category"><a href="#" class="submenu-title">Français</a></li>
                    </ul>
                </li>
                <!-- Repeat for other submenu items -->
            </ul>
            <div class="menu-bottom">
                <ul class="menu-category-list">
                    <!-- Social links or other footer content -->
                    <li class="menu-category"><a href="#" class="menu-title">Social Media</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <style>
      /* Basic styles for header, navigation, and buttons */
body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.header-top, .header-main, .desktop-navigation-menu, .mobile-bottom-navigation, .mobile-navigation-menu {
    background-color: #333;
    color: white;
}

.container {
    width: 90%;
    margin: 0 auto;
}

.header-top {
    padding: 10px 0;
    border-bottom: 1px solid #444;
}

.header-social-container {
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 0;
}

.header-social-container li {
    margin: 0 10px;
}

.header-social-container .social-link ion-icon {
    font-size: 20px;
    color: white;
}

.header-alert-news {
    text-align: center;
    padding: 5px 0;
}

.header-top-actions select {
    background: #444;
    color: white;
    border: none;
    margin-left: 10px;
    padding: 5px;
}

.header-main {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
}

.header-logo img {
    display: block;
}

.header-search-container {
    flex: 1;
    display: flex;
    align-items: center;
    margin: 0 20px;
}

.search-field {
    width: 100%;
    padding: 10px;
    border: 1px solid #444;
}

.search-btn {
    background: #444;
    border: none;
    color: white;
    padding: 10px;
}

.header-user-actions {
    display: flex;
}

.action-btn {
    background: none;
    border: none;
    color: white;
    margin-left: 10px;
    cursor: pointer;
}

.header-user-actions .count {
    background: red;
    color: white;
    border-radius: 50%;
    padding: 2px 5px;
    font-size: 12px;
    position: absolute;
    top: -5px;
    right: -10px;
}

.desktop-navigation-menu {
    background: #222;
}

.desktop-menu-category-list {
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 0;
}

.desktop-menu-category-list .menu-category {
    position: relative;
}

.desktop-menu-category-list .menu-category .dropdown-panel {
    position: absolute;
    top: 100%;
    left: 0;
    background: #222;
    display: none;
    list-style: none;
    padding: 0;
}

.desktop-menu-category-list .menu-category:hover .dropdown-panel {
    display: block;
}

/* Add more styles as needed */

    </style>
</body>
</html>
