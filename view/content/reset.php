<?php

namespace Anax\View;

/**
 * Template file to render reset view
 */

?>

<div class="container">
    <form method="post">
        <input type="submit" name="reset" value="Reset database">
        <?= $output ?>
    </form>
</div>