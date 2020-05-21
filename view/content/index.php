<?php

namespace Anax\View;

/**
 * Template file to render index view
 */

?>

<?php
if (!$resultset2) {
    return;
}
?>
<div class="jumbotron hero">
    <div class="container">
    </div>
</div>
<div class="container"></div>
<div class="container">
    <h2>Latest news</h2>
    <div class="jumbotron jumbotron-fluid featured-blogpost p-3 p-md-5">
        <div class="col-md-6 px-0">
            <h1 class="display-4 text-dark">Stone Island</h1>
            <p class="lead my-3 text-dark">New delivery from Stone Island including a hooded sweatshirt, a half-zip overshirt and a nylon seersucker suit now online.</p>
            <p class="lead mb-0 text-dark"><a href="blogpost?route=blog/stone-island" class="text-white font-weight-bold text-dark">Continue reading...</a></p>
        </div>
    </div>
</div>
<div class="container news">
    <div class="row">
        <?php $id = -1;
        foreach ($resultset as $row) :
            $id++; ?>
            <div class="col-md-4">
                <h4><?= esc($row->title) ?></h4>
                <p> <?= esc($row->data) ?></p>
                <p>
                    <a class="btn btn-secondary" href="<?= url("blogpost") . "?route=blog/" . esc($row->slug) ?>" role="button">Read more »</a>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
    <hr>
</div>
<div class="container featured-brand">
    <h2>Featured brand</h2>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="8"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="9"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="10"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/brand/1.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Common Projects</h5>
                    <p>White Original Achilles Leather Sneakers </p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/brand/2.jpg" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Common Projects</h5>
                    <p>Light-gray Original Achilles Leather Sneakers</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/brand/3.jpg" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Common Projects</h5>
                    <p>Black Original Achilles Leather Sneakers</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/brand/4.jpg" alt="Fourth slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Common Projects</h5>
                    <p>Washed-black Original Achilles Leather Sneakers</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/brand/5.jpg" alt="Fifth slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Common Projects</h5>
                    <p>Beige Original Achilles Leather Sneakers</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/brand/6.jpg" alt="Sixth slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Common Projects</h5>
                    <p>Gray Original Achilles Leather Sneakers</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/brand/7.jpg" alt="Seventh slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Common Projects</h5>
                    <p>Navy Original Achilles Leather Sneakers</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/brand/8.jpg" alt="Eighth slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Common Projects</h5>
                    <p>Maroon Achilles Leather Sneakers</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/brand/9.jpg" alt="Ninth slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Common Projects</h5>
                    <p>Faded-white Original Achilles Leather Sneakers</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <p class="lead">Common Projects is a premium footwear brand made in collaboration between designers Flavio Girolami and Prathan Poopat. Inspired by the lines and shapes of everyday objects, they design their pieces with tailored approach and all items are handmade in Italy using the finest materials and techniques.</p>
    <hr>
</div>
<div class="container new-arrivals">
    <h2>New arrivals</h2>
    <div class="row">
        <?php $id = -1;
        foreach ($resultset2 as $row) :
            $id++; ?>
            <div class="col-md-4">
                <div class="card-mb-4 shadow-sm">
                    <img class="card-img-top" src="<?= $row->image  ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row->name ?></h5>
                        <p class="card-text"><?= $row->short_description ?></p>
                        <p class="card-text"><?= $row->price ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="container sale">
    <h2>Sale</h2>
    <div class="row">
        <?php $id = -1;
        foreach ($resultset4 as $row) :
            $id++; ?>
            <div class="col-md-4">
                <div class="card-mb-4 shadow-sm">
                    <img class="card-img-top" src="<?= $row->image  ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row->name ?></h5>
                        <p class="card-text"><?= $row->short_description ?></p>
                        <p class="card-text price" style="text-decoration: line-through"><?= $row->price ?></p>
                        <p class="card-text text-danger"><?= $newPrice = (intval($row->price) / 1.25) ?> SEK -25%</p>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>