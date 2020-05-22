<?php

namespace Anax\View;

/**
 * Template file to render header admin view
 */

?>

<div class="container page">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link first-item" href="<?= url("admin") ?>">Edit blogpost</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url("admin/create") ?>">Create blogpost</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url("admin/products2") ?>">Edit product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url("admin/createproduct") ?>">Create product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url("admin/users") ?>">Edit user</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url("admin/reset") ?>">Reset</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url("eshop/logout") ?>">Log out</a>
        </li>
    </ul>
</div>