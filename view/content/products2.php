<?php

namespace Anax\View;

/**
 * Template file to render products2 view
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
            <tr class="first">
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
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
                    <td><?= $row->name ?></td>
                    <td><?= $row->category ?></td>
                    <td><?= $row->short_description ?></td>
                    <td><?= $row->image ?></td>
                    <td><?= $row->price ?></td>
                    <td><?= $row->amount ?></td>
                    <td><?= $row->created ?></td>
                    <td><?= $row->updated ?></td>
                    <td><?= $row->deleted ?></td>
                    <td>
                        <a class="icons" href="<?= url("admin/editproduct?id=") . $row->id ?> " title="Edit this content">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a class="icons" href="<?= url("admin/deleteproduct?id=") . $row->id ?>" title="Delete this content">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </thead>
        </tbody>
    </table>
</div>