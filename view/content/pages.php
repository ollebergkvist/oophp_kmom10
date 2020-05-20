<?php

namespace Anax\View;

/**
 * Template file to render pages view
 */

?>

<?php
if (!$resultset) {
    return;
}
?>

<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col">Published</th>
                <th scope="col">Deleted</th>
            </tr>
        </thead>
        <tbody>
            <?php $id = -1;
            foreach ($resultset as $row) :
                $id++; ?>
                <tr>
                    <td><?= $row->id ?></td>
                    <td><a href=<?= url("page?route=") . esc($row->path) ?>><?= esc($row->title) ?></a></td>
                    <td><?= $row->type ?></td>
                    <td><?= $row->status ?></td>
                    <td><?= $row->published ?></td>
                    <td><?= $row->deleted ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>