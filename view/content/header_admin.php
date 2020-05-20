<?php

namespace Anax\View;

/**
 * Template file to render admin view
 */

?>

<div class="container">
    <h1>Admin</h1>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?= url("overview") ?>">Overview</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?= url("admin") ?>">Edit blogpost</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url("create") ?>">Create blogpost</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url("products2") ?>">Edit product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url("createproduct") ?>">Create product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url("users") ?>">Edit user</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url("reset") ?>">Reset</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url("logout") ?>">Log out</a>
        </li>
    </ul>
</div>