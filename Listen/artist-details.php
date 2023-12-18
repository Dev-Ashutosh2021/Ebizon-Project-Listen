<?php session_start(); ?>
<?php include 'includes/header.php'; ?>

<body onload="artistDetails()">

    <?php include 'includes/modal.php'; ?>

    <?php include 'includes/loader.php'; ?>

    <div id="wrapper">

        <?php include 'includes/sidebar.php'; ?>

        <?php include 'includes/searchbar.php'; ?>

        <main id="page_content">
            <div class="hero" style="background-image: url(images/banner/artists.jpg);"></div>
            <div class="under-hero container">
                <div class="section" id="artist-detail">
                    <!-- content -->
                </div>
                <div class="section">
                    <div class="section__head">
                        <h3 class="mb-0"><span class="text-primary" id="song-span"></span></h3>
                    </div>
                    <div class="list">
                        <div class="row" data-collection-song-id="1">
                            <div class="col-xl-6" id="song-1">
                                <!-- content -->
                            </div>
                            <div class="col-xl-6" id="song-2">
                                <!-- content -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section">
                    <div class="section__head">
                        <h3 class="mb-0"><span class="text-primary" id="album-span"></span></h3>
                    </div>
                    <div class="swiper-carousel swiper-carousel-button">
                        <div class="swiper" data-swiper-slides="5" data-swiper-autoplay="true">
                            <div class="swiper-wrapper" id="artist-album">
                                <!-- content -->
                            </div>
                        </div>
                        <div class="swiper-button-prev btn-default rounded-pill"></div>
                        <div class="swiper-button-next btn-default rounded-pill"></div>
                    </div>
                </div>
            </div>
            <footer id="footer">
                <div class="container">
                    <div class="text-center mb-4"><a href="mailto:info@listenapp.com" class="display-5 email">ebizon@listenapp.com</a></div>
                </div>
            </footer>
        </main>
    </div>

    <?php include 'includes/footer.php'; ?>

</body>


</html>