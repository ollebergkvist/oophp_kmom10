<?php

namespace Anax\View;

/**
 * A layout rendering views in defined regions.
 */

?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $title . $titleExtended ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if (isset($stylesheets)) : ?>
        <?php foreach ($stylesheets as $stylesheet) : ?>
            <link rel="stylesheet" type="text/css" href="<?= asset($stylesheet) ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ea92a5ff95.js" crossorigin="anonymous"></script>
</head>

<header>

    <script src="https://use.fontawesome.com/ea808bf820.js"></script>

    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
        <div class="container">
            <a class=" navbar-brand" href="#">ESHOP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= url("index") ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("blog") ?>">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("products") ?>">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("about") ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("doc") ?>">Doc</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("register") ?>">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("login") ?>">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<body>
    <main role="main" class="main-container ">
        <?php if (regionHasContent("main")) : ?>
            <?php renderRegion("main") ?>
        <?php endif; ?>
        </div>
    </main>
    <div class="container">
        <hr class="md-2">
        <div class="container mt-5 footer">
            <div class="row justify-content-between">
                <div class="col-auto text-center">
                    <div class="row flex-column">
                        <div class="col-auto">
                            <h6>About</h6>
                        </div>
                        <div class="col-auto">
                            <p>Swedish retailer founded in 2006</p>
                        </div>

                    </div>
                </div>
                <div class="col-auto text-center">
                    <div class="row flex-column">
                        <div class="col-auto">
                            <h6>Contact</h6>
                        </div>
                        <div class="col-auto">
                            <p class="mb-0 ">Birger Jarlsgatan 26</p>
                        </div>
                        <div class="col-auto">
                            <p class="mb-0 ">118 51 Stockholm</p>
                        </div>
                        <div class="col-auto">
                            <p class="mb-0 ">info@eshop.com </p>
                        </div>
                        <div class="footer-bottom">
                            <div class="container">
                                <div class="row">
                                    <div class="col footer-social">
                                        <div class="container text-center">
                                            <a href="#"><i class="fab fa-facebook-square"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer-credit">
                            <div class="container">
                                <div class="row">
                                    <div class="col footer-email text-center">
                                        <a href="mailto:hello@ollebergkvist.com">hello@ollebergkvist.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto text-center">
                    <div class="row flex-column">
                        <div class="col-auto">
                            <h6>Opening hours:</h6>
                        </div>
                        <div class="col-auto">
                            <p class="mb-0 ">Monday-Friday 11.00 – 18.00</p>
                            <p class="mb-0 ">Saturday 11.00 – 17.00</p>
                            <p class="mb-0 ">Sunday 12.00 – 16.00</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>