<?php session_start(); ?>
<?php include 'includes/header.php'; ?>

<body onload="recentHistory(); fetchFavSong();">

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
                        <div class="flex-grow-1"><span class="section__subtitle">Recently listened</span>
                            <h3 class="mb-0">History</h3>
                        </div><a href="javascript:void(0);" class="btn btn-link" onclick="historyDelete()">Clear All</a>
                    </div>
                    <div class="list list--order">
                        <div class="row">
                            <div class="col-xl-6" id="recent-1">
                                <!-- content -->
                            </div>
                            <div class="col-xl-6" id="recent-2">
                                <!-- content -->
                            </div>
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