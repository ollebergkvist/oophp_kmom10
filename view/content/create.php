<?php

namespace Anax\View;

/**
 * Template file to render create blogpost view
 */

?>

<div class="container">
    <form method="post">
        <div class="form-group">
            <label>Title:</label>
            <input class="form-control" type="text" name="contentTitle" required />
            <small id="emailHelp" class="form-text text-muted">Enter title to create</small>
        </div>
        <button class="btn btn-primary" type="submit" name="doCreate"> Create</button>
        <button class="btn btn-primary" type="reset"> Reset</button>
    </form>
</div>