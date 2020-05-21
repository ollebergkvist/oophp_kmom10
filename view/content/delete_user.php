<?php

namespace Anax\View;

/**
 * Template file to render delete user view
 */

?>
<div class="container">
    <legend>Delete</legend>
    <form method="post">
        <div class="form-group">
            <label>Username: </label>
            <input class="form-control" type="text" name="username" value="<?= esc($content->username) ?>" readonly />
        </div>
        <button class="btn-primary" type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </form>
</div>