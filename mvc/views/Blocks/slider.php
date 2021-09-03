<?php
require_once "./mvc/host.php";
?>
<div class="row mt-3 mb-3">
    <!-- slider -->
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="slider-images" src="./public/images/slider-1.png" alt="First slide" height="100%" width="100%">
                </div>
                <div class="carousel-item">
                    <img class="slider-images" src="./public/images/slider-2.png" alt="Second slide" height="100%" width="100%">
                </div>
                <div class="carousel-item">
                    <img class="slider-images" src="./public/images/slider-3.png" alt="Third slide" height="100%" width="100%">
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
    </div>
</div>