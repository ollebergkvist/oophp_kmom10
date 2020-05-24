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
$defaultRoute = "?route=admin&"
?>

<div class="container">
    <form method="get" class="d-inline">
        <label>Search:</label>
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
                <th scope="col">Id <?= orderby2("id", $defaultRoute) ?></th>
                <th scope="col">Title <?= orderby2("title", $defaultRoute) ?></th>
                <th scope="col">Type <?= orderby2("type", $defaultRoute) ?> </th>
                <th scope="col">Published <?= orderby2("published", $defaultRoute) ?></th>
                <th scope="col">Created <?= orderby2("created", $defaultRoute) ?></th>
                <th scope="col">Updated <?= orderby2("updated", $defaultRoute) ?></th>
                <th scope="col">Deleted <?= orderby2("deleted", $defaultRoute) ?></th>
                <th scope="col">Actions <?= orderby2("actions", $defaultRoute) ?></th>
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
                        <a class="icons" href="<?= url("admin/edit?id=") . $row->id ?> " title="Edit this content">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a class="icons" href="<?= url("admin/delete?id=") . $row->id ?>" title="Delete this content">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
        </tbody>
            <?php endforeach; ?>
    </table>
    <div class="container">
        <p>Items per page:
            <a href="<?= mergeQueryString(["hits" => 2], $defaultRoute) ?>">2</a> |
            <a href="<?= mergeQueryString(["hits" => 4], $defaultRoute) ?>">4</a> |
            <a href="<?= mergeQueryString(["hits" => 8], $defaultRoute) ?>">8</a>
        </p>
    </div>
    <div class="container">
        <p>
            Pages:
            <?php for ($i = 1; $i <= $max; $i++) : ?>
                <a href="<?= mergeQueryString(["page" => $i], $defaultRoute) ?>"><?= $i ?></a>
            <?php endfor; ?>
        </p>
    </div>
</div>