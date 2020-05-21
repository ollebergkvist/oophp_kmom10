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
    <hr>
    <?php foreach ($resultset as $row) : ?>
        <h2><a href=<?= url("blogpost") . "?route=blog/" . esc($row->slug) ?>><?= esc($row->title) ?></a></h2>
        <p class=>Published: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></p>
        <p class="mb-4"><?= esc($row->data) ?></p>
    <?php endforeach; ?>
</div>