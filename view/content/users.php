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
    <table class="table table-hover">
        <thead>
            <tr class="first">
                <th scope="col">Username</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Password</th>
                <th scope="col">Email</th>
                <th scope="col">Rights</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th scope="col">Activated</th>
                <th scope="col">Deleted</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $id = -1;
            foreach ($resultset as $row) :
                $id++; ?>
                <tr>
                    <td><?= $row->username ?></td>
                    <td><?= $row->firstname ?></td>
                    <td><?= $row->lastname ?></td>
                    <td><?= $row->password ?></td>
                    <td><?= $row->email ?></td>
                    <td><?= $row->rights ?></td>
                    <td><?= $row->created ?></td>
                    <td><?= $row->updated ?></td>
                    <td><?= $row->activated ?></td>
                    <td><?= $row->deleted ?></td>
                    <td>
                        <a class="icons" href="<?= url("edituser?username=") . $row->username ?> " title="Edit this content">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a class="icons" href="<?= url("deleteuser?username=") . $row->username ?>" title="Edit this content">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </thead>
        </tbody>
    </table>
</div>