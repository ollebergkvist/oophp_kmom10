<?php

namespace Anax\View;

/**
 * Template file to render edit view
 */

$filters = ["bbcode", "link", "markdown", "nl2br"];
$applyFilters = explode(',', $content->filter);

?>

<legend>Edit</legend>
<form method="post">
    <div class="form-group">
        <input type="hidden" name="contentId" value="<?= esc($content->id) ?>" />
    </div>
    <div class="form-group">
        <label>Title: </label>
        <input type="text" class="form-control" name="contentTitle" value="<?= esc($content->title) ?>" />
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
        <label>Path:</label>
        <input type="text" class="form-control" name="contentPath" value="<?= esc($content->path) ?>" />
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
        <label>Slug:</label>
        <input type="text" class="form-control" name="contentSlug" value="<?= esc($content->slug) ?>" />
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
        <label>Text:</label>
        <textarea class="form-control" name="contentData"><?= esc($content->data) ?></textarea>
    </div>
    <div class="form-group">
        <label>Type:</label>
        <input type="radio" class="form-control" name="contentType" value="post" required <?php if ($content->type == "post") : ?> checked<?php endif; ?> /> Post<br>
        <input type="radio" class="form-control" name="contentType" value="page" required <?php if ($content->type == "page") : ?> checked <?php endif; ?> /> Page<br>
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
        <label class=>Filters:</label>
        <?php foreach ($filters as $filter) : ?>
            <input type="checkbox" class="form-control" name="contentFilter" value="<?= $filter ?>" <?= !in_array($filter, $applyFilters) ? "" : "checked" ?>><?= $filter ?>
        <?php endforeach; ?>
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
        <label>Publish:</label>
        <input type="datetime" class="form-control" name="contentPublish" value="<?= esc($content->published) ?>" />
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <button class="btn btn-primary" type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
    <button class="btn btn-primary" type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
    <button class="btn btn-primary" type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
</form>