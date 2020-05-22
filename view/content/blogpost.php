<?php

namespace Anax\View;

/**
 * Template file to render blogpost view
 */

?>

<div class="container page">
    <h1><?= esc($content->title) ?></h1>
    <p>Published: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></p>
    <p><?= $content->data ?></p>
    <img class="img-fluid img-thumbnail" src="../<?= $content->image ?>">
</div>