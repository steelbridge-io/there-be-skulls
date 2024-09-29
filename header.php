<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Header -->
<header id="masthead" class="site-header bg-black py-3" >
    
    <!-- sale carousel -->
    <div class="container header-carousel">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="width: 100%; height: 50px;">
        <div class="carousel-inner" style="height: 100%;">
            <div class="carousel-item active">
                <span class="header-carousel-text">Sale! $$$$</span>
            </div>
            <div class="carousel-item">
                <span class="header-carousel-text">More on Sale!!</span>
            </div>
            <div class="carousel-item">
                <span class="header-carousel-text">Even more Sale!!</span>
            </div>
        </div>
        <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                 data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button> -->
    </div>
    </div>
    
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="text-4xl fw-bold text-danger tracking-wider">There Be Skulls</h1>
            <!-- <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                            <li class="nav-item"><a href="/shop" class="nav-link">Shop</a></li>
                            <li class="nav-item"><a href="/about" class="nav-link">About</a></li>
                            <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
                            <li class="nav-item"><a href="/cart" class="nav-link">Cart ({{ cart_count }})</a></li>
                        </ul>
                    </div>
                </div>
            </nav> -->
        </div>
    </div>
</header>
<div class="container-fluid d-flex justify-content-center navigation sticky-top" style="height:100px;">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="/shop" class="nav-link">Shop</a></li>
                    <li class="nav-item"><a href="/about" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
                    <li class="nav-item"><a href="/cart" class="nav-link">Cart ({{ cart_count }})</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

