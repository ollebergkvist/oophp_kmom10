<?php

namespace Anax\View;

/**
 * Template file to render a view for the login.
 */

?>
<div class="container page">
    <h1>Update user</h1>
    <form method="post">
        <!-- <div class="form-group">
            <input type="hidden" name="contentId" value="<?= esc($user->id) ?>" />
        </div> -->
        <div class="form-group">
            <label>Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Enter username" value="<?= esc($user->username) ?>" required>
        </div>
        <div class="form-group">
            <label>Firstname:</label>
            <input type="text" class="form-control" name="firstname" placeholder="Enter first name" value="<?= esc($user->firstname) ?>" required>
        </div>
        <div class="form-group">
            <label>Lastname:</label>
            <input type="text" class=" form-control" name="lastname" placeholder="Enter last name" value="<?= esc($user->lastname) ?>" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email" value="<?= esc($user->email) ?>" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password" value="<?= esc($user->password) ?>" required>
        </div>
        <p><?= $message ?></p>
        <button class="btn btn-primary" type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        <button class="btn btn-primary" type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
        <input type="submit" class="btn btn-primary btn-block" name="logout" value="Logout">
    </form>
</div>