<?php

namespace Anax\View;

/**
 * Template file to render reset view
 */

?>

<div class="container page">
    <form method="post">
        <input type="submit" class="btn btn-warning btn-block" name="reset" value="Reset database">
        <?= $output ?>
    </form>
</div>