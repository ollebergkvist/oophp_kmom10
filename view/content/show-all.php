<?php

namespace Anax\View;

/**
 * Template file to render index view
 */

?>


<?php
if (!$resultset) {
    return;
}
?>
<div class="container">
    <table class="table table-striped">
        <caption>List of pages and posts</caption>
        <thead>
            <tr class="first">
                <th scope="col">Rad</th>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">Path</th>
                <th scope="col">Slug</th>
                <th scope="col">Published</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th scope="col">Deleted</th>
            </tr>
        </thead>
        <tbody>
            <?php $id = -1;
            foreach ($resultset as $row) :
                $id++; ?>
                <tr>
                    <td><?= $id ?></td>
                    <td><?= $row->id ?></td>
                    <td><?= $row->title ?></td>
                    <td><?= $row->type ?></td>
                    <td><?= $row->path ?></td>
                    <td><?= $row->slug ?></td>
                    <td><?= $row->published ?></td>
                    <td><?= $row->created ?></td>
                    <td><?= $row->updated ?></td>
                    <td><?= $row->deleted ?></td>
                </tr>
            <?php endforeach; ?>
            </thead>
        </tbody>
    </table>
</div>