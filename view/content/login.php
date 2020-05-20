<?php

namespace Anax\View;

/**
 * Template file to render a view for the login
 */

?>
<div class="container page">
    <form method="post">
        <h3>Login</h3>
        <div class="form-group">
            <label>Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
        </div>
        <p><?= $message ?></p>
        <input type="submit" class="btn btn-primary btn-block" name="login" value="Log in">
    </form>
</div>