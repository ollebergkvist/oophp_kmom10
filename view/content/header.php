<?php

namespace Anax\View;

/**
 * Template file to render header view
 */

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title . $titleExtended ?></title>
    <link rel="stylesheet" href="<?= url("css/style.css") ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/e5579368c4.js"></script>
</head>

<body>
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">Eshop</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= url("content/index") ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("content/admin") ?>">Store</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("content/blog") ?>">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("content/blog") ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("content/doc") ?>">Doc</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("content/admin") ?>">Login</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="<?= url("content/create") ?>">Create</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("content/reset") ?>">Reset database</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= url("content/index") ?>">Overview <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("content/pages") ?>">View pages</a> -->
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <main role="main" class="main-container ">
        <div container>
            <div class="row justify-content-md-center">