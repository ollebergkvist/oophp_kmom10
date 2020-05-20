<?php

namespace Anax\View;

/**
 * Template file to render admin view
 */

?>

<?php
if (!$resultset) {
    return;
}
?>

<div class="container">
    <form method="get" class="d-inline">
        <legend>Search</legend>
        <label>Title (use % as wildcard):</label>
        <input type="search" class="form-control mb-2" name="searchTitle" value="<?= $searchTitle ?>" />
        <input type="submit" class="btn btn-primary d-inline" name="doSearch" value="Search">
    </form>
    <form method="get" class="d-inline">
        <input type="submit" class="btn btn-primary d-inline" name="viewAll" value="View all" formaction="admin">
    </form>
</div>

<div class="container mt-4">
    <table class="table table-hover">
        <thead>
            <tr class="first">
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">Published</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th scope="col">Deleted</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $id = -1;

            foreach ($resultset as $row) :
                $id++; ?>
                <tr>
                    <td><?= $row->id ?></td>
                    <td><?= $row->title ?></td>
                    <td><?= $row->type ?></td>
                    <td><?= $row->published ?></td>
                    <td><?= $row->created ?></td>
                    <td><?= $row->updated ?></td>
                    <td><?= $row->deleted ?></td>
                    <td>
                        <a class="icons" href="<?= url("edit?id=") . $row->id ?> " title="Edit this content">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a class="icons" href="<?= url("delete?id=") . $row->id ?>" title="Edit this content">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
        </tbody>
    <?php endforeach; ?>
    </table>
</div>