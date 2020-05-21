<?php

namespace Anax\View;

/**
 * Template file to render delete product view
 */

?>

<div class="container">
    <legend>Delete</legend>
    <form method="post">
        <div class="form-group">
            <input type="hidden" name="id" value="<?= esc($content->id) ?>" />
            <label>Name: </label>
            <input class="form-control" type="text" name="name" value="<?= esc($content->name) ?>" readonly />
        </div>
        <button class="btn-primary" type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </form>
</div>