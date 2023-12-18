<?php session_start(); ?>
<?php include 'includes/header.php'; ?>

<body onload="checkAuthentication(); home();">

    <?php include 'includes/modal.php'; ?>

    <?php include 'includes/loader.php'; ?>

    <div id="wrapper">

        <?php include 'includes/sidebar.php'; ?>
        <?php include 'includes/searchbar.php'; ?>

        <main id="page_content">
            <div class="hero" style="background-image: url(images/banner/home.jpg);"></div>
            <div class="under-hero container">
                <div class="section">
                    <div class="section__head">
                        <div class="flex-grow-1"><span class="section__subtitle">Listen top charts</span>
                            <h3 class="mb-0">Top <span class="text-primary">Charts</span></h3>
                        </div><a href="music.php" class="btn btn-link" onclick="musics();">View All</a>
                    </div>
                    <div class="swiper-carousel swiper-carousel-button">
                        <div class="swiper" data-swiper-slides="5" data-swiper-autoplay="true">
                            <div class="swiper-wrapper" id="top-charts">
                                <!-- top charts -->
                            </div>
                        </div>
                        <div class="swiper-button-prev btn-default rounded-pill"></div>
                        <div class="swiper-button-next btn-default rounded-pill"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="section col-xl-6">
                        <div class="section__head">
                            <div class="flex-grow-1">
                                <h3 class="mb-0">Top <span class="text-primary">Albums</span></h3>
                            </div><a href="albums.php" class="btn btn-link" onclick="albums();">View All</a>
                        </div>
                        <div class="list list--lg list--order">
                            <div class="row">
                                <div class="col-xl-12" id="album-div-1">
                                    <!-- albums -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-1"></div>
                    <div class="section col-xl-5">
                        <div class="mat-tabs">
                            <ul class="nav nav-tabs" id="songs_list" role="tablist">
                                <?php
                                if (isset($_SESSION['id'])) {
                                    echo '<li class="nav-item" role="presentation" id="recentHide"><button class="nav-link active" id="recent" data-bs-toggle="tab" data-bs-target="#recent_pane" type="button" role="tab" aria-controls="recent_pane" aria-selected="true">Recent</button></li>';
                                }
                                ?>
                                <li class="nav-item" role="presentation"><button class="nav-link
                                <?php
                                if(!isset($_SESSION['id']))
                                {
                                    echo ' active';
                                } 
                                ?>" id="trending" data-bs-toggle="tab" data-bs-target="#trending_pane" type="button" role="tab" aria-controls="trending_pane" aria-selected="false">Bollywood</button></li>
                                <li class="nav-item" role="presentation"><button class="nav-link" id="international" data-bs-toggle="tab" data-bs-target="#international_pane" type="button" role="tab" aria-controls="international_pane" aria-selected="false">International</button></li>
                            </ul>
                        </div>
                        <div class="tab-content mt-4" id="songs_list_content">
                            <?php
                            if(isset($_SESSION['id']))
                            {
                                echo '<div class="tab-pane fade show active" id="recent_pane" role="tabpanel" aria-labelledby="recent" tabindex="0">
                                <div class="list" id="recent-pane-div">
                                    <!-- recent -->
                                </div>
                            </div>';
                            }
                            ?>
                            <div class="tab-pane fade <?php if(!isset($_SESSION['id']))
                            {
                                echo 'show active';
                            } ?>" id="trending_pane" role="tabpanel" aria-labelledby="trending" tabindex="0">
                                <div class="list" id="trending-pane-div">
                                    <!-- bollywood -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="international_pane" role="tabpanel" aria-labelledby="international" tabindex="0">
                                <div class="list" id="international-pane-div">
                                    <!-- international -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section">
                    <div class="section__head">
                        <div class="flex-grow-1"><span class="section__subtitle">New to listen</span>
                            <h3 class="mb-0">New <span class="text-primary">Releases</span></h3>
                        </div><a href="music.php" class="btn btn-link" onclick="musics();">View All</a>
                    </div>
                    <div class="swiper-carousel swiper-carousel-button">
                        <div class="swiper" data-swiper-slides="5" data-swiper-autoplay="true">
                            <div class="swiper-wrapper" id="new-release-div">
                                <!-- new releases  -->
                            </div>
                        </div>
                        <div class="swiper-button-prev btn-default rounded-pill"></div>
                        <div class="swiper-button-next btn-default rounded-pill"></div>
                    </div>
                </div>
                <div class="section">
                    <div class="section__head">
                        <div class="flex-grow-1"><span class="section__subtitle">Best to listen</span>
                            <h3 class="mb-0">Featured <span class="text-primary">Artists</span></h3>
                        </div><a href="artists.php" class="btn btn-link" onclick="artists();">View All</a>
                    </div>
                    <div class="swiper-carousel swiper-carousel-button">
                        <div class="swiper" data-swiper-slides="6" data-swiper-autoplay="true">
                            <div class="swiper-wrapper" id="artists-div">
                                <!-- artists  -->
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
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