<?php

namespace Anax\View;

/**
 * Template file to render a view for the registration.
 */

?>
<div class="container page">
    <h3>Register</h3>
    <hr>
    <form method="post">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label>First name:</label>
            <input type="text" class="form-control" name="firstname" placeholder="Enter first name" required>
        </div>
        <div class="form-group">
            <label>Last name:</label>
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