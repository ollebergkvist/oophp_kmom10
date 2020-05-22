<?php

namespace Anax\View;

/**
 * Template file to render products view
 */

?>

<?php
if (!$resultset) {
    return;
}
?>

<div class="container page">
    <h3>Products</h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php $id = -1;
            foreach ($resultset as $row) :
                $id++; ?>
                <tr>
                    <td><a href=<?= url("eshop/product") . "?route=product/" . esc($row->article_number) ?>><?= esc($row->article_number) ?></td>
                    <td><?= $row->name ?></td>
                    <td><?= $row->category ?></td>
                    <td><?= $row->short_description ?></td>
                    <td><img class="img-fluid img-thumbnail" src="../<?= $row->image ?>"></td>
                    <td><?= $row->price ?></td>
                    <td><?= $row->amount ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>