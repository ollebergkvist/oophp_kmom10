<?php

namespace Anax\View;

/**
 * Template file to render product view
 */

?>

<div class="container page">
    <h1><?= esc($content->name) ?></h1>
    <h4><?= esc($content->category) ?></h4>
    <div class="row">
        <div class="col">
            <img class="img-fluid" src="<?= $content->image ?>">
        </div>
        <div class="col-8">
            <p><?= $content->short_description ?></p>
            <p><?= $content->price ?></p>
        </div>



    </div>