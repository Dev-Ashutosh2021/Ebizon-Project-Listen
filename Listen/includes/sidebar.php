<aside id="sidebar">
    <div class="sidebar-head d-flex align-items-center justify-content-between"><a href="home.php" class="brand external"><img src="images/logos/logo.svg" alt="Listen app"> </a><a href="javascript:void(0);" role="button" class="sidebar-toggler" aria-label="Sidebar toggler">
            <div class="d-none d-lg-block"><i class="ri-menu-3-line sidebar-menu-1"></i> <i class="ri-menu-line sidebar-menu-2"></i></div><i class="ri-menu-fold-line d-lg-none"></i>
        </a></div>
    <div class="sidebar-body" data-scroll="true">
        <nav class="navbar d-block p-0">
            <ul class="navbar-nav">
                <li class="nav-item" onclick="fetchAll();"><a href="home.php" class="nav-link d-flex align-items-center" id="home"><i class="ri-home-4-line fs-5"></i>
                        <span class="ps-3">Home</span></a></li>
                <li class="nav-item" onclick="genres();checkAuthentication();"><a href="genres.php" class="nav-link d-flex align-items-center" id="genres"><i class="ri-disc-line fs-5"></i> <span class="ps-3">Genres</span></a></li>
                <li class="nav-item" onclick="musics();"><a href="music.php" class="nav-link d-flex align-items-center" id="music"><i class="ri-music-2-line fs-5"></i> <span class="ps-3">Musics</span></a></li>
                <li class="nav-item" onclick="albums();"><a href="albums.php" class="nav-link d-flex align-items-center" id="albums"><i class="ri-album-line fs-5"></i> <span class="ps-3">Albums</span></a></li>
                <li class="nav-item" onclick="artists();"><a href="artists.php" class="nav-link d-flex align-items-center" id="artists"><i class="ri-mic-line fs-5"></i> <span class="ps-3">Artists</span></a></li>
                <?php if (isset($_SESSION['id'])) {
                    echo '<li class="nav-item nav-item--head"><span class="nav-item--head__text">Music</span> <span class="nav-item--head__dots">...</span></li>
                <li class="nav-item"><a href="favorites.php" class="nav-link d-flex align-items-center" onclick="favourites();" id="favorites"><i class="ri-heart-line fs-5"></i> <span class="ps-3">Favourites</span></a></li>
                <li class="nav-item"><a href="javascript:void(0);" class="nav-link d-flex align-items-center" onclick="showPlaylistModal();" id="playlists"><i class="ri-file-list-line fs-5"></i> <span class="ps-3">Playlists</span></a></li>
                <li class="nav-item" onclick="recentHistory();"><a href="history.php" class="nav-link d-flex align-items-center" id="history"><i class="ri-history-line fs-5"></i> <span class="ps-3">History</span></a></li>';
                } ?>
            </ul>
        </nav>
    </div>
    <div class="sidebar-foot"><a href="javascript:void(0);" class="btn btn-primary d-flex" onclick="openCreatePlaylistModal()">
            <div class="btn__wrap"><i class="ri-file-list-line"></i> <span>Create Playlist</span></div>
        </a></div>
    <?php
    if (!isset($_SESSION['id'])) {
        echo '<div class="sidebar-foot"><a href="javascript:void(0);" class="btn btn-primary d-flex" onclick="window.location.href=\'login.php\'">
        <div class="btn__wrap"><i class="ri-user-fill"></i> <span>Log In</span></div>
    </a></div>';
    }
    ?>

</aside>