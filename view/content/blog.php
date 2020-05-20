<?php

namespace Anax\View;

/**
 * Template file to render blog view
 */

?>


<?php
if (!$resultset) {
    return;
}
?>

<div class="container page">
    <h3>News</h3>
    <?php foreach ($resultset as $row) : ?>
        <section>
            <header>
                <h2><a href=<?= url("blogpost") . "?route=blog/" . esc($row->slug) ?>><?= esc($row->title) ?></a></h2>

                <p><i>Published: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></i></p>
            </header>
            <?= esc($row->data) ?>
        </section>
    <?php endforeach; ?>
</div>