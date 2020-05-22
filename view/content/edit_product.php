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
            <input type="text" class="form-control" name="name" value="<?= esc($content->name) ?>" placeholder="Enter product name" required />
        </div>
        <div class="form-group">
            <label>Category:</label>
            <input type="text" class="form-control" name="category" value="<?= esc($content->category) ?>" placeholder="Enter category" required />
        </div>
        <div class="form-group">
            <label>Description:</label>
            <input type="text" class="form-control" name="short_description" value="<?= esc($content->short_description) ?>" placeholder="Enter description" required />
        </div>
        <div class="form-group">
            <label>Amount:</label>
            <input type="number" class="form-control" name="amount" value="<?= esc($content->amount) ?>" placeholder="Enter stock amount" required />
        </div>
        <div class="form-group">
            <label>Price:</label>
            <input type="text" class="form-control" name="price" value="<?= esc($content->price) ?>" placeholder="Enter price" required />
        </div>
        <div class="form-group">
            <label>Image:</label>
            <input type="text" class="form-control" name="image" value="<?= esc($content->image) ?>" placeholder="Enter image link" required />
        </div>
        <button class="btn btn-primary" type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        <button class="btn btn-primary" type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
    </form>
</div>