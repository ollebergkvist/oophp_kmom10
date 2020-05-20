<?php

namespace Anax\View;

/**
 * Template file to render create view
 */

?>

<div class="container">
    <form method="post">
        <div class="form-group">
            <label>Name:</label>
            <input class="form-control" type="text" name="name" default="A Title" />
            <small id="emailHelp" class="form-text text-muted">Enter product name to create</small>
        </div>
        <button class="btn btn-primary" type="submit" name="doCreate"> Create</button>
        <button class="btn btn-primary" type="reset"> Reset</button>
    </form>
</div>