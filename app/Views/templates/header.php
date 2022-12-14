<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo($title) ?></title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/062265acee.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" crossorigin="use-credentials" href="/assets/css/style.css">
</head>
<body>

<!-- HEADER: MENU + HEROE SECTION -->
<header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/shop">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/faq">FAQ</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php
                    if (!session()->get('isLoggedIn')) {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="/login">Login</a>
                                  </li>';
                        echo '<li class="nav-item">
                                <a class="nav-link" href="register">Register</a>
                                  </li>';
                    } else {
                        echo '<li class="nav-item">
                                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#cartModal" href="#"><i class="fa-solid fa-cart-shopping"></i> Cart</a>
                                  </li>';
                        echo '<li class="nav-item">
                                <a class="nav-link" href="/profile"><i class="fa-solid fa-user"></i> Profile</a>
                                  </li>';
                        echo '<li class="nav-item">
                                <a class="nav-link" href="/userAuth/logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                                  </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

</header>