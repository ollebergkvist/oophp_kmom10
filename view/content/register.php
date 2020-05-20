<?php

namespace Anax\View;

/**
 * Template file to render a view for the login.
 */

?>
<div class="container page">
    <h1>Register</h1>
    <form method="post">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label>Firstname:</label>
            <input type="text" class="form-control" name="firstname" placeholder="Enter first name" required>
        </div>
        <div class="form-group">
            <label>Lastname:</label>
            <input type="text" class=" form-control" name="lastname" placeholder="Enter last name" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
        </div>
        <p><?= $message ?></p>
        <input type="submit" class="btn btn-primary btn-block" name="register" value="Register">
        <input type="reset" class="btn btn-primary btn-block" name="reset" value="Reset">
    </form>
</div>