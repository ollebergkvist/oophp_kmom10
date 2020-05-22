<?php

namespace Anax\View;

/**
 * Template file to render delete blogpost view
 */

?>
<div class="container">
    <legend>Delete</legend>
    <form method="post" action="<?= url("admin/delete") ?>">
        <div class="form-group">
            <input type="hidden" name="contentId" value="<?= esc($content->id) ?>" />
            <label>Title: </label>
            <input class="form-control" type="text" name="contentTitle" value="<?= esc($content->title) ?>" readonly />
        </div>
        <button class="btn-primary" type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </form>
</div>