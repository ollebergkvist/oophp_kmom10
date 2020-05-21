<?php

namespace Anax\View;

/**
 * Template file to render edit product view
 */

?>

<div class="container">
    <h1>Edit product</h1>
    <form method="post">
        <div class="form-group">
            <input type="hidden" name="id" value="<?= esc($content->id) ?>" />
        </div>
        <div class="form-group">
            <label>Name: </label>
            <input type="text" class="form-control" name="name" value="<?= esc($content->name) ?>" />
        </div>
        <div class="form-group">
            <label>Category:</label>
            <input type="text" class="form-control" name="category" value="<?= esc($content->category) ?>" />
        </div>
        <div class="form-group">
            <label>Description:</label>
            <input type="text" class="form-control" name="short_description" value="<?= esc($content->short_description) ?>" />
        </div>
        <div class="form-group">
            <label>Amount:</label>
            <input type="text" class="form-control" name="amount" value="<?= esc($content->amount) ?>" />
        </div>
        <div class="form-group">
            <label>Price:</label>
            <input type="text" class="form-control" name="price" value="<?= esc($content->price) ?>" />
        </div>
        <div class="form-group">
            <label>Image:</label>
            <input type="text" class="form-control" name="image" value="<?= esc($content->image) ?>" />
        </div>
        <button class="btn btn-primary" type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        <button class="btn btn-primary" type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
        <button class="btn btn-primary" type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </form>
</div>