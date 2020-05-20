<?php

namespace Anax\View;

/**
 * Template file to render edit user view
 */

?>

<div class="container">
    <h1>Edit user</h1>
    <form method="post">
        <div class="form-group">
            <input type="hidden" name="username" value="<?= esc($content->username) ?>" />
        </div>
        <div class="form-group">
            <label>Firstname: </label>
            <input type="text" class="form-control" name="firstname" value="<?= esc($content->firstname) ?>" />
        </div>
        <div class="form-group">
            <label>Lastname:</label>
            <input type="text" class="form-control" name="lastname" value="<?= esc($content->lastname) ?>" />
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="text" class="form-control" name="email" value="<?= esc($content->email) ?>" />
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="text" class="form-control" name="password" value="<?= esc($content->password) ?>" />
        </div>
        <button class="btn btn-primary" type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        <button class="btn btn-primary" type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
    </form>
</div>