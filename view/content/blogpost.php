<?php

namespace Anax\View;

/**
 * Movie-edit view
 */

?>

<div class="container">
    <article>
        <header>
            <h1><?= esc($content->title) ?></h1>
            <p>Published: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></p>
        </header>
        <?= $content->data ?>
    </article>
</div>