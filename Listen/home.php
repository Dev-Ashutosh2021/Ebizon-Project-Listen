<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from www.kri8thm.in/html/listen/theme/demo/home.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 Nov 2023 15:17:52 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Listen App - Online Music Streaming App Template">
    <meta name="keywords" content="music template, music app, music web app, responsive music app, music, themeforest, html music app template, css3, html5">
    <title>Listen App - Online Music Streaming App</title>
    <link href="images/logos/favicon.png" rel="icon">
    <link rel="apple-touch-icon" href="images/logos/touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/logos/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/logos/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="167x167" href="images/logos/touch-icon-ipad-retina.png">
    <link href="css/plugins.bundle.css" rel="stylesheet" type="text/css">
    <link href="css/styles.bundle.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body onload="checkAuthentication(); fetchAll();">

    <!--create Playlist Modal -->
    <div class="modal fade" id="createPlaylistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Playlist</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createPlaylistForm">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Title</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="playlistName">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="createPlaylist()">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!--Show Playlist Modal -->
    <div class="modal fade" id="showPlaylistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Your All Playlists</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="showPlaylistModalBody">
                    <table id="datatablesSimple">
                        <!-- Playlist -->
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="openCreatePlaylistModal()">Create New Playlist</button>
                </div>
            </div>
        </div>
    </div>


    <!--Add to Playlist Modal -->
    <div class="modal fade" id="addToPlaylistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Your All Playlists</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="showPlaylistModalBody">
                    <form id="playlistAddForm">
                        <select class="form-select" aria-label="Default select example" id="addPlaylist" name="playlist">
                            <!-- content -->
                        </select>
                        <input type="hidden" name="song_id" id="hidden_song_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="addToPlaylist()">Add</button>
                </div>
            </div>
        </div>
    </div>


    <div id="line_loader"></div>
    <div id="loader">
        <div class="loader">
            <div class="loader__eq mx-auto"><span></span> <span></span> <span></span> <span></span> <span></span>
                <span></span>
            </div><span class="loader__text mt-2">Loading</span>
        </div>
    </div>
    <div id="wrapper">
        <aside id="sidebar">
            <div class="sidebar-head d-flex align-items-center justify-content-between"><a href="index.html" class="brand external"><img src="images/logos/logo.svg" alt="Listen app"> </a><a href="javascript:void(0);" role="button" class="sidebar-toggler" aria-label="Sidebar toggler">
                    <div class="d-none d-lg-block"><i class="ri-menu-3-line sidebar-menu-1"></i> <i class="ri-menu-line sidebar-menu-2"></i></div><i class="ri-menu-fold-line d-lg-none"></i>
                </a></div>
            <div class="sidebar-body" data-scroll="true">
                <nav class="navbar d-block p-0">
                    <ul class="navbar-nav">
                        <li class="nav-item" onclick="fetchAll(); fetchFavSong(); fetchFavAlbum();"><a href="home.php" class="nav-link d-flex align-items-center active"><i class="ri-home-4-line fs-5"></i> <span class="ps-3">Home</span></a></li>
                        <li class="nav-item" onclick="genres();"><a href="genres.html" class="nav-link d-flex align-items-center"><i class="ri-disc-line fs-5"></i> <span class="ps-3">Genres</span></a></li>
                        <li class="nav-item" onclick="musics();"><a href="music.html" class="nav-link d-flex align-items-center"><i class="ri-music-2-line fs-5"></i> <span class="ps-3">Musics</span></a></li>
                        <li class="nav-item" onclick="albums();"><a href="albums.html" class="nav-link d-flex align-items-center"><i class="ri-album-line fs-5"></i> <span class="ps-3">Albums</span></a></li>
                        <li class="nav-item" onclick="artists();"><a href="artists.html" class="nav-link d-flex align-items-center"><i class="ri-mic-line fs-5"></i> <span class="ps-3">Artists</span></a></li>
                        <!-- <li class="nav-item"><a href="stations.html" class="nav-link d-flex align-items-center"><i
                                    class="ri-radio-2-line fs-5"></i> <span class="ps-3">Stations</span></a></li> -->
                        <li class="nav-item nav-item--head"><span class="nav-item--head__text">Music</span> <span class="nav-item--head__dots">...</span></li>
                        <li class="nav-item"><a href="favorites.html" class="nav-link d-flex align-items-center" onclick="favourites();"><i class="ri-heart-line fs-5"></i> <span class="ps-3">Favourites</span></a></li>
                        <li class="nav-item"><a href="javascript:void(0);" class="nav-link d-flex align-items-center" onclick="showPlaylistModal()"><i class="ri-file-list-line fs-5"></i> <span class="ps-3">Playlists</span></a></li>
                        <li class="nav-item" onclick="recentHistory(); fetchFavSong();"><a href="history.html" class="nav-link d-flex align-items-center"><i class="ri-history-line fs-5"></i> <span class="ps-3">History</span></a></li>
                        <!-- <li class="nav-item nav-item--head"><span class="nav-item--head__text">Events</span> <span
                                class="nav-item--head__dots">...</span></li>
                        <li class="nav-item"><a href="events.html" class="nav-link d-flex align-items-center"><i
                                    class="ri-calendar-event-line fs-5"></i> <span class="ps-3">Events</span></a></li>
                        <li class="nav-item"><a href="event-details.html" class="nav-link d-flex align-items-center"><i
                                    class="ri-newspaper-line fs-5"></i> <span class="ps-3">Event Details</span></a></li>
                        <li class="nav-item"><a href="add-event.html" class="nav-link d-flex align-items-center"><i
                                    class="ri-add-circle-line fs-5"></i> <span class="ps-3">Add Event</span></a></li>
                        <li class="nav-item nav-item--head"><span class="nav-item--head__text">Extra</span> <span
                                class="nav-item--head__dots">...</span></li>
                        <li class="nav-item"><a href="404.html" class="nav-link d-flex align-items-center external"><i
                                    class="ri-error-warning-line fs-5"></i> <span class="ps-3">404 Page</span></a></li>
                        <li class="nav-item"><a href="blank.html" class="nav-link d-flex align-items-center"><i
                                    class="ri-file-line fs-5"></i> <span class="ps-3">Blank Template</span></a></li> -->
                    </ul>
                </nav>
            </div>
            <div class="sidebar-foot"><a href="javascript:void(0);" class="btn btn-primary d-flex" onclick="openCreatePlaylistModal()">
                    <div class="btn__wrap"><i class="ri-file-list-line"></i> <span>Create Playlist</span></div>
                </a></div>
            <div class="sidebar-foot"><a href="javascript:void(0);" class="btn btn-primary d-flex" onclick='window.location.href="login.html"'>
                    <div class="btn__wrap"><i class="ri-user-fill"></i> <span>Log In</span></div>
                </a></div>
        </aside>
        <header id="header">
            <div class="container">
                <div class="header-container">
                    <div class="d-flex align-items-center"><a href="javascript:void(0);" role="button" class="header-text sidebar-toggler d-lg-none me-3" aria-label="Sidebar toggler"><i class="ri-menu-3-line"></i></a>
                        <form action="#" id="search_form" class="me-3"><label for="search_input"><i class="ri-search-2-line"></i></label> <input type="text" placeholder="Type anything to get result..." id="search_input" class="form-control form-control-sm" autocomplete="off"></form>
                        <div id="search_results" class="search pb-3" style="visibility: hidden;">
                            <div class="search__body" data-scroll="true">
                                <div class="mb-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3"><span class="search__title" id="artist-label">Artists</span> <a href="artists.html" class="btn btn-link">View All</a></div>
                                    <div class="row g-4 list" id="artist-search">
                                        <!-- content -->
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3"><span class="search__title">Songs</span> <a href="songs.html" class="btn btn-link">View All</a></div>
                                    <div class="row g-4 list" id="song-search">
                                        <!-- content -->
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center justify-content-between mb-3"><span class="search__title">Albums</span> <a href="albums.html" class="btn btn-link">View All</a></div>
                                    <div class="row g-4 list" id=album-search>
                                        <!-- content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <!-- <div class="dropdown"><a href="javascript:void(0);" class="header-text d-flex align-items-center" role="button" id="language_menu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><i class="ri-earth-line fs-5"></i> <span class="d-none d-md-block ms-1">Language</span></a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="language_menu">
                                    <div class="py-2 px-4"><span class="d-block fw-bold">What music do you like?</span>
                                        <p>Select languages you want to listen.</p>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <div class="d-flex flex-wrap py-2">
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_1"> <label class="form-check-label fw-semi-bold" for="lang_1">Hindi</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_2"> <label class="form-check-label fw-semi-bold" for="lang_2">Punjabi</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_3"> <label class="form-check-label fw-semi-bold" for="lang_3">Tamil</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_4"> <label class="form-check-label fw-semi-bold" for="lang_4">Bengali</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_5"> <label class="form-check-label fw-semi-bold" for="lang_5">Kannada</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_6"> <label class="form-check-label fw-semi-bold" for="lang_6">Gujarati</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_7"> <label class="form-check-label fw-semi-bold" for="lang_7">Urdu</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_8"> <label class="form-check-label fw-semi-bold" for="lang_8">English</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_9"> <label class="form-check-label fw-semi-bold" for="lang_9">Telugu</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_10"> <label class="form-check-label fw-semi-bold" for="lang_10">Bhojpuri</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_11"> <label class="form-check-label fw-semi-bold" for="lang_11">Malayalam</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_12"> <label class="form-check-label fw-semi-bold" for="lang_12">Marathi</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_13"> <label class="form-check-label fw-semi-bold" for="lang_13">Haryanvi</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_14"> <label class="form-check-label fw-semi-bold" for="lang_14">Rajasthani</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_15"> <label class="form-check-label fw-semi-bold" for="lang_15">Assamese</label></div>
                                        </div>
                                        <div class="py-2 px-4 w-50">
                                            <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="lang_16"> <label class="form-check-label fw-semi-bold" for="lang_16">Odia</label></div>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <div class="py-2 px-4"><button type="button" class="btn btn-primary w-100 justify-content-center">Update</button></div>
                                </div>
                            </div> -->
                            <div class="dropdown ms-3 ms-sm-4"><a href="javascript:void(0);" class="avatar header-text" role="button" id="user_menu" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar__image"><img src="images/users/thumb.jpg" alt="user"></div><span class="ps-2 d-none d-sm-block" id="username"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-md dropdown-menu-end" aria-labelledby="user_menu">
                                    <li>
                                        <div class="py-2 px-3 avatar avatar--lg">
                                            <div class="avatar__image"><img src="images/users/thumb.jpg" alt="user">
                                            </div>
                                            <div class="avatar__content"><span class="avatar__title" id="fullname"></span>
                                            </div>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item d-flex align-items-center" href="profile.html"><i class="ri-user-3-line fs-5"></i> <span class="ps-2">Profile</span></a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center" href="favorites.html"><i class="ri-heart-line fs-5"></i> <span class="ps-2">Favorites</span></a>
                                    </li>
                                    <li onclick="logout()"><a class="dropdown-item d-flex align-items-center external text-danger" href="javascript:void(0);"><i class="ri-logout-circle-line fs-5"></i> <span class="ps-2">Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main id="page_content">
            <div class="hero" style="background-image: url(images/banner/home.jpg);"></div>
            <div class="under-hero container">
                <div class="section">
                    <div class="section__head">
                        <div class="flex-grow-1"><span class="section__subtitle">Listen top charts</span>
                            <h3 class="mb-0">Top <span class="text-primary">Charts</span></h3>
                        </div><a href="music.html" class="btn btn-link" onclick="musics();">View All</a>
                    </div>
                    <div class="swiper-carousel swiper-carousel-button">
                        <div class="swiper" data-swiper-slides="5" data-swiper-autoplay="true">
                            <div class="swiper-wrapper" id="top-charts">
                                <!-- <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="1" data-song-name="I love you mummy"
                                        data-song-artist="Arebica Luna" data-song-album="Mummy"
                                        data-song-url="audio/ringtone-1.mp3" data-song-cover="images/cover/small/1.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-danger"><i
                                                            class="ri-heart-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="1">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="1">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="1">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="1">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="1">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/1.jpg"
                                                alt="I love you mummy"> <button type="button"
                                                class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="1"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="song-details.html"
                                                class="cover__title text-truncate">I love you mummy</a>
                                            <p class="cover__subtitle text-truncate"><a
                                                    href="artist-details.html">Arebica Luna</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="2" data-song-name="Shack your butty"
                                        data-song-artist="Gerrina Linda" data-song-album="Hot shot"
                                        data-song-url="audio/ringtone-2.mp3" data-song-cover="images/cover/small/2.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-info"><i
                                                            class="ri-vip-crown-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="2">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="2">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="2">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="2">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="2">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/2.jpg"
                                                alt="Shack your butty"> <button type="button"
                                                class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="2"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="song-details.html"
                                                class="cover__title text-truncate">Shack your butty</a>
                                            <p class="cover__subtitle text-truncate"><a
                                                    href="artist-details.html">Gerrina Linda</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="3"
                                        data-song-name="Do it your way(Female)"
                                        data-song-artist="Zunira Willy & Nutty Nina" data-song-album="Own way"
                                        data-song-url="audio/ringtone-3.mp3" data-song-cover="images/cover/small/3.jpg">
                                        <div class="cover__head">
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="3">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="3">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="3">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="3">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="3">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/3.jpg"
                                                alt="Do it your way(Female)"> <button type="button"
                                                class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="3"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="song-details.html"
                                                class="cover__title text-truncate">Do it your way(Female)</a>
                                            <p class="cover__subtitle text-truncate"><a
                                                    href="artist-details.html">Zunira Willy</a>, <a
                                                    href="artist-details.html">Nutty Nina</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="4" data-song-name="Say yes"
                                        data-song-artist="Johnny Marro" data-song-album="Say yes"
                                        data-song-url="audio/ringtone-4.mp3" data-song-cover="images/cover/small/4.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-danger"><i
                                                            class="ri-heart-fill"></i></span></li>
                                                <li><span class="badge rounded-pill bg-info"><i
                                                            class="ri-vip-crown-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="4">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="4">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="4">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="4">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="4">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/4.jpg" alt="Say yes">
                                            <button type="button" class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="4"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="song-details.html"
                                                class="cover__title text-truncate">Say yes</a>
                                            <p class="cover__subtitle text-truncate"><a
                                                    href="artist-details.html">Johnny Marro</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="5"
                                        data-song-name="Where is your letter"
                                        data-song-artist="Jina Moore & Lenisa Gory" data-song-album="Letter"
                                        data-song-url="audio/ringtone-5.mp3" data-song-cover="images/cover/small/5.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-info"><i
                                                            class="ri-vip-crown-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="5">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="5">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="5">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="5">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="5">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/5.jpg"
                                                alt="Where is your letter"> <button type="button"
                                                class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="5"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="song-details.html"
                                                class="cover__title text-truncate">Where is your letter</a>
                                            <p class="cover__subtitle text-truncate"><a href="artist-details.html">Jina
                                                    Moore</a>, <a href="artist-details.html">Lenisa Gory</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="6" data-song-name="Hey not me"
                                        data-song-artist="Rasomi Pelina" data-song-album="Find soul"
                                        data-song-url="audio/ringtone-6.mp3" data-song-cover="images/cover/small/6.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-info"><i
                                                            class="ri-vip-crown-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="6">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="6">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="6">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="6">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="6">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/6.jpg" alt="Hey not me">
                                            <button type="button" class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="6"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="song-details.html"
                                                class="cover__title text-truncate">Hey not me</a>
                                            <p class="cover__subtitle text-truncate"><a
                                                    href="artist-details.html">Rasomi Pelina</a></p>
                                        </div>
                                    </div>
                                </div> -->
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
                            </div><a href="albums.html" class="btn btn-link" onclick="albums();">View All</a>
                        </div>
                        <!-- <div class="swiper-carousel">
                            <div class="swiper" data-swiper-slides="2" data-swiper-autoplay="true">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="cover cover--round"><a href="event-details.html"
                                                class="cover__image"><img src="images/background/horizontal/2.jpg"
                                                    alt="Event cover"></a>
                                            <div class="cover__foot mt-3 px-2">
                                                <p class="cover__subtitle d-flex mb-2"><i
                                                        class="ri-map-pin-fill fs-6"></i> <span
                                                        class="ms-1 fw-semi-bold">258 Goff Avenue, MI - USA</span></p><a
                                                    href="event-details.html" class="cover__title fs-6 mb-3">New year
                                                    1st night with BendiQ Band</a>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-group">
                                                            <div class="avatar">
                                                                <div class="avatar__image"><img
                                                                        src="images/users/thumb-3.jpg" alt=""></div>
                                                            </div>
                                                            <div class="avatar">
                                                                <div class="avatar__image"><img
                                                                        src="images/users/thumb-4.jpg" alt=""></div>
                                                            </div>
                                                            <div class="avatar">
                                                                <div class="avatar__image"><img
                                                                        src="images/users/thumb-5.jpg" alt=""></div>
                                                            </div>
                                                        </div>
                                                        <div class="ps-1">24+</div>
                                                    </div><a href="event-details.html"
                                                        class="btn btn-sm btn-light-primary">Join Event</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="cover cover--round"><a href="event-details.html"
                                                class="cover__image"><img src="images/background/horizontal/3.jpg"
                                                    alt="Event cover"></a>
                                            <div class="cover__foot mt-3 px-2">
                                                <p class="cover__subtitle d-flex mb-2"><i
                                                        class="ri-map-pin-fill fs-6"></i> <span
                                                        class="ms-1 fw-semi-bold">2105 Badger Pond Lane, FL - USA</span>
                                                </p><a href="event-details.html" class="cover__title fs-6 mb-3">Varida
                                                    Meronny music band</a>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-group">
                                                            <div class="avatar">
                                                                <div class="avatar__image"><img
                                                                        src="images/users/thumb.jpg" alt=""></div>
                                                            </div>
                                                            <div class="avatar">
                                                                <div class="avatar__image"><img
                                                                        src="images/users/thumb-2.jpg" alt=""></div>
                                                            </div>
                                                            <div class="avatar">
                                                                <div class="avatar__image"><img
                                                                        src="images/users/thumb-3.jpg" alt=""></div>
                                                            </div>
                                                        </div>
                                                        <div class="ps-1">40+</div>
                                                    </div><a href="event-details.html"
                                                        class="btn btn-sm btn-light-primary">Join Event</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="cover cover--round"><a href="event-details.html"
                                                class="cover__image"><img src="images/background/horizontal/1.jpg"
                                                    alt="Event cover"></a>
                                            <div class="cover__foot mt-3 px-2">
                                                <p class="cover__subtitle d-flex mb-2"><i
                                                        class="ri-map-pin-fill fs-6"></i> <span
                                                        class="ms-1 fw-semi-bold">2801 Pine Lake Rd, TX - USA</span></p>
                                                <a href="event-details.html" class="cover__title fs-6 mb-3">Music night
                                                    virtual event to welcome new year</a>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-group">
                                                            <div class="avatar">
                                                                <div class="avatar__image"><img
                                                                        src="images/users/thumb.jpg" alt=""></div>
                                                            </div>
                                                            <div class="avatar">
                                                                <div class="avatar__image"><img
                                                                        src="images/users/thumb-2.jpg" alt=""></div>
                                                            </div>
                                                            <div class="avatar">
                                                                <div class="avatar__image"><img
                                                                        src="images/users/thumb-3.jpg" alt=""></div>
                                                            </div>
                                                        </div>
                                                        <div class="ps-1">40+</div>
                                                    </div><a href="event-details.html"
                                                        class="btn btn-sm btn-light-primary">Join Event</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div> -->

                        <div class="list list--lg list--order">
                            <div class="row">
                                <div class="col-xl-12" id="album-div-1">
                                    <!-- <div class="list__item"><a href="album-details.html" class="list__cover"><img
                            src="images/cover/small/1.jpg" alt="Mummy"></a>
                    <div class="list__content"><a href="album-details.html"
                            class="list__title text-truncate">Mummy</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.html">Arebica
                                Luna</a></p>
                    </div>
                    <ul class="list__option">
                        <li><span class="badge rounded-pill bg-info"><i
                                    class="ri-vip-crown-fill"></i></span></li>
                        <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                aria-label="Favorite" data-favorite-id="100"><i
                                    class="ri-heart-line heart-empty"></i> <i
                                    class="ri-heart-fill heart-fill"></i></a></li>
                        <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-label="Cover options" aria-expanded="false"><i
                                    class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-favorite-id="100">Favorite</a></li>
                                <li><a class="dropdown-item" href="audio/ringtone-1.mp3"
                                        download>Download</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"
                                        role="button">Share</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="album-details.html">View details</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="list__item"><a href="album-details.html" class="list__cover"><img
                            src="images/cover/small/2.jpg" alt="Hot shot"></a>
                    <div class="list__content"><a href="album-details.html"
                            class="list__title text-truncate">Hot shot</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.html">Gerrina
                                Linda</a></p>
                    </div>
                    <ul class="list__option">
                        <li><span class="badge rounded-pill bg-info"><i
                                    class="ri-vip-crown-fill"></i></span></li>
                        <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                aria-label="Favorite" data-favorite-id="101"><i
                                    class="ri-heart-line heart-empty"></i> <i
                                    class="ri-heart-fill heart-fill"></i></a></li>
                        <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-label="Cover options" aria-expanded="false"><i
                                    class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-favorite-id="101">Favorite</a></li>
                                <li><a class="dropdown-item" href="audio/ringtone-2.mp3"
                                        download>Download</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"
                                        role="button">Share</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="album-details.html">View details</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="list__item"><a href="album-details.html" class="list__cover"><img
                            src="images/cover/small/3.jpg" alt="Own way"></a>
                    <div class="list__content"><a href="album-details.html"
                            class="list__title text-truncate">Own way</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.html">Zunira
                                Willy & Nutty Nina</a></p>
                    </div>
                    <ul class="list__option">
                        <li><span class="badge rounded-pill bg-info"><i
                                    class="ri-vip-crown-fill"></i></span></li>
                        <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                aria-label="Favorite" data-favorite-id="102"><i
                                    class="ri-heart-line heart-empty"></i> <i
                                    class="ri-heart-fill heart-fill"></i></a></li>
                        <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-label="Cover options" aria-expanded="false"><i
                                    class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-favorite-id="102">Favorite</a></li>
                                <li><a class="dropdown-item" href="audio/ringtone-3.mp3"
                                        download>Download</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"
                                        role="button">Share</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="album-details.html">View details</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="list__item"><a href="album-details.html" class="list__cover"><img
                            src="images/cover/small/4.jpg" alt="Say yes"></a>
                    <div class="list__content"><a href="album-details.html"
                            class="list__title text-truncate">Say yes</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.html">Johnny
                                Marro</a></p>
                    </div>
                    <ul class="list__option">
                        <li><span class="badge rounded-pill bg-info"><i
                                    class="ri-vip-crown-fill"></i></span></li>
                        <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                aria-label="Favorite" data-favorite-id="103"><i
                                    class="ri-heart-line heart-empty"></i> <i
                                    class="ri-heart-fill heart-fill"></i></a></li>
                        <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-label="Cover options" aria-expanded="false"><i
                                    class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-favorite-id="103">Favorite</a></li>
                                <li><a class="dropdown-item" href="audio/ringtone-4.mp3"
                                        download>Download</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"
                                        role="button">Share</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="album-details.html">View details</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="list__item"><a href="album-details.html" class="list__cover"><img
                            src="images/cover/small/5.jpg" alt="Letter"></a>
                    <div class="list__content"><a href="album-details.html"
                            class="list__title text-truncate">Letter</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.html">Jina Moore
                                & Lenisa Gory</a></p>
                    </div>
                    <ul class="list__option">
                        <li><span class="badge rounded-pill bg-info"><i
                                    class="ri-vip-crown-fill"></i></span></li>
                        <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                aria-label="Favorite" data-favorite-id="104"><i
                                    class="ri-heart-line heart-empty"></i> <i
                                    class="ri-heart-fill heart-fill"></i></a></li>
                        <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-label="Cover options" aria-expanded="false"><i
                                    class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-favorite-id="104">Favorite</a></li>
                                <li><a class="dropdown-item" href="audio/ringtone-5.mp3"
                                        download>Download</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"
                                        role="button">Share</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="album-details.html">View details</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div> -->
                                </div>
                                <!-- <div class="col-xl-6" id="album-div-2"> -->
                                <!-- <div class="list__item"><a href="album-details.html" class="list__cover"><img
                            src="images/cover/small/6.jpg" alt="Find soul"></a>
                    <div class="list__content"><a href="album-details.html"
                            class="list__title text-truncate">Find soul</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.html">Rasomi
                                Pelina</a></p>
                    </div>
                    <ul class="list__option">
                        <li><span class="badge rounded-pill bg-info"><i
                                    class="ri-vip-crown-fill"></i></span></li>
                        <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                aria-label="Favorite" data-favorite-id="105"><i
                                    class="ri-heart-line heart-empty"></i> <i
                                    class="ri-heart-fill heart-fill"></i></a></li>
                        <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-label="Cover options" aria-expanded="false"><i
                                    class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-favorite-id="105">Favorite</a></li>
                                <li><a class="dropdown-item" href="audio/ringtone-6.mp3"
                                        download>Download</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"
                                        role="button">Share</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="album-details.html">View details</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="list__item"><a href="album-details.html" class="list__cover"><img
                            src="images/cover/small/7.jpg" alt="Deep inside"></a>
                    <div class="list__content"><a href="album-details.html"
                            class="list__title text-truncate">Deep inside</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.html">Pimila
                                Holliwy</a></p>
                    </div>
                    <ul class="list__option">
                        <li><span class="badge rounded-pill bg-info"><i
                                    class="ri-vip-crown-fill"></i></span></li>
                        <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                aria-label="Favorite" data-favorite-id="106"><i
                                    class="ri-heart-line heart-empty"></i> <i
                                    class="ri-heart-fill heart-fill"></i></a></li>
                        <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-label="Cover options" aria-expanded="false"><i
                                    class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-favorite-id="106">Favorite</a></li>
                                <li><a class="dropdown-item" href="audio/ringtone-7.mp3"
                                        download>Download</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"
                                        role="button">Share</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="album-details.html">View details</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="list__item"><a href="album-details.html" class="list__cover"><img
                            src="images/cover/small/8.jpg" alt="Sadness"></a>
                    <div class="list__content"><a href="album-details.html"
                            class="list__title text-truncate">Sadness</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.html">Karen
                                Jennings</a></p>
                    </div>
                    <ul class="list__option">
                        <li><span class="badge rounded-pill bg-info"><i
                                    class="ri-vip-crown-fill"></i></span></li>
                        <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                aria-label="Favorite" data-favorite-id="107"><i
                                    class="ri-heart-line heart-empty"></i> <i
                                    class="ri-heart-fill heart-fill"></i></a></li>
                        <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-label="Cover options" aria-expanded="false"><i
                                    class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-favorite-id="107">Favorite</a></li>
                                <li><a class="dropdown-item" href="audio/ringtone-8.mp3"
                                        download>Download</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"
                                        role="button">Share</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="album-details.html">View details</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="list__item"><a href="album-details.html" class="list__cover"><img
                            src="images/cover/small/9.jpg" alt="Electric wave"></a>
                    <div class="list__content"><a href="album-details.html"
                            class="list__title text-truncate">Electric wave</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.html">Lenisa
                                Gory</a></p>
                    </div>
                    <ul class="list__option">
                        <li><span class="badge rounded-pill bg-info"><i
                                    class="ri-vip-crown-fill"></i></span></li>
                        <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                aria-label="Favorite" data-favorite-id="108"><i
                                    class="ri-heart-line heart-empty"></i> <i
                                    class="ri-heart-fill heart-fill"></i></a></li>
                        <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-label="Cover options" aria-expanded="false"><i
                                    class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-favorite-id="108">Favorite</a></li>
                                <li><a class="dropdown-item" href="audio/ringtone-1.mp3"
                                        download>Download</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"
                                        role="button">Share</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="album-details.html">View details</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="list__item"><a href="album-details.html" class="list__cover"><img
                            src="images/cover/small/10.jpg" alt="Lover soul"></a>
                    <div class="list__content"><a href="album-details.html"
                            class="list__title text-truncate">Lover soul</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.html">Nutty
                                Nina</a></p>
                    </div>
                    <ul class="list__option">
                        <li><span class="badge rounded-pill bg-info"><i
                                    class="ri-vip-crown-fill"></i></span></li>
                        <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                aria-label="Favorite" data-favorite-id="109"><i
                                    class="ri-heart-line heart-empty"></i> <i
                                    class="ri-heart-fill heart-fill"></i></a></li>
                        <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-label="Cover options" aria-expanded="false"><i
                                    class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-favorite-id="109">Favorite</a></li>
                                <li><a class="dropdown-item" href="audio/ringtone-2.mp3"
                                        download>Download</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"
                                        role="button">Share</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="album-details.html">View details</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div> -->
                                <!-- </div> -->
                            </div>
                        </div>


                    </div>
                    <div class="col-xl-1"></div>
                    <div class="section col-xl-5">
                        <div class="mat-tabs">
                            <ul class="nav nav-tabs" id="songs_list" role="tablist">
                                <li class="nav-item" role="presentation"><button class="nav-link active" id="recent" data-bs-toggle="tab" data-bs-target="#recent_pane" type="button" role="tab" aria-controls="recent_pane" aria-selected="true">Recent</button></li>
                                <li class="nav-item" role="presentation"><button class="nav-link" id="trending" data-bs-toggle="tab" data-bs-target="#trending_pane" type="button" role="tab" aria-controls="trending_pane" aria-selected="false">Bollywood</button></li>
                                <li class="nav-item" role="presentation"><button class="nav-link" id="international" data-bs-toggle="tab" data-bs-target="#international_pane" type="button" role="tab" aria-controls="international_pane" aria-selected="false">International</button></li>
                            </ul>
                        </div>
                        <div class="tab-content mt-4" id="songs_list_content">
                            <div class="tab-pane fade show active" id="recent_pane" role="tabpanel" aria-labelledby="recent" tabindex="0">
                                <div class="list" id="recent-pane-div">
                                    <!-- <div class="list__item" data-song-id="2" data-song-name="Shack your butty"
                                        data-song-artist="Gerrina Linda" data-song-album="Hot shot"
                                        data-song-url="audio/ringtone-2.mp3" data-song-cover="images/cover/small/2.jpg">
                                        <div class="list__cover"><img src="images/cover/small/2.jpg"
                                                alt="Shack your butty"> <a href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="2" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Shack your butty</a>
                                            <p class="list__subtitle text-truncate"><a
                                                    href="artist-details.html">Gerrina Linda</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><span class="badge rounded-pill bg-info"><i
                                                        class="ri-vip-crown-fill"></i></span></li>
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="2"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>03:24</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="2">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="2">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="2">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="2">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="list__item" data-song-id="4" data-song-name="Say yes"
                                        data-song-artist="Johnny Marro" data-song-album="Say yes"
                                        data-song-url="audio/ringtone-4.mp3" data-song-cover="images/cover/small/4.jpg">
                                        <div class="list__cover"><img src="images/cover/small/4.jpg" alt="Say yes"> <a
                                                href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="4" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Say yes</a>
                                            <p class="list__subtitle text-truncate"><a href="artist-details.html">Johnny
                                                    Marro</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="4"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>04:20</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="4">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="4">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="4">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="4">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="list__item" data-song-id="6" data-song-name="Hey not me"
                                        data-song-artist="Rasomi Pelina" data-song-album="Find soul"
                                        data-song-url="audio/ringtone-6.mp3" data-song-cover="images/cover/small/6.jpg">
                                        <div class="list__cover"><img src="images/cover/small/6.jpg" alt="Hey not me">
                                            <a href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="6" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Hey not me</a>
                                            <p class="list__subtitle text-truncate"><a href="artist-details.html">Rasomi
                                                    Pelina</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="6"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>01:12</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="6">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="6">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="6">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="6">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="list__item" data-song-id="8" data-song-name="Sadness inside"
                                        data-song-artist="Karen Jennings" data-song-album="Sadness"
                                        data-song-url="audio/ringtone-8.mp3" data-song-cover="images/cover/small/8.jpg">
                                        <div class="list__cover"><img src="images/cover/small/8.jpg" alt="Hey not me">
                                            <a href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="8" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Sadness inside</a>
                                            <p class="list__subtitle text-truncate"><a href="artist-details.html">Karen
                                                    Jennings</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><span class="badge rounded-pill bg-info"><i
                                                        class="ri-vip-crown-fill"></i></span></li>
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="8"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>02:37</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="8">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="8">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="8">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="8">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="list__item" data-song-id="10" data-song-name="Nothing like your eyes"
                                        data-song-artist="Nutty Nina" data-song-album="Lover soul"
                                        data-song-url="audio/ringtone-2.mp3"
                                        data-song-cover="images/cover/small/10.jpg">
                                        <div class="list__cover"><img src="images/cover/small/10.jpg"
                                                alt="Nothing like your eyes"> <a href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="10" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Nothing like your eyes</a>
                                            <p class="list__subtitle text-truncate"><a href="artist-details.html">Nutty
                                                    Nina</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><span class="badge rounded-pill bg-info"><i
                                                        class="ri-vip-crown-fill"></i></span></li>
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="10"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>03:54</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="10">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="10">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="10">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="10">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="trending_pane" role="tabpanel" aria-labelledby="trending" tabindex="0">
                                <div class="list" id="trending-pane-div">
                                    <!-- <div class="list__item" data-song-id="2" data-song-name="Shack your butty"
                                        data-song-artist="Gerrina Linda" data-song-album="Hot shot"
                                        data-song-url="audio/ringtone-2.mp3" data-song-cover="images/cover/small/2.jpg">
                                        <div class="list__cover"><img src="images/cover/small/2.jpg"
                                                alt="Shack your butty"> <a href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="2" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Shack your butty</a>
                                            <p class="list__subtitle text-truncate"><a
                                                    href="artist-details.html">Gerrina Linda</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><span class="badge rounded-pill bg-info"><i
                                                        class="ri-vip-crown-fill"></i></span></li>
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="2"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>03:24</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="2">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="2">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="2">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="2">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="list__item" data-song-id="4" data-song-name="Say yes"
                                        data-song-artist="Johnny Marro" data-song-album="Say yes"
                                        data-song-url="audio/ringtone-4.mp3" data-song-cover="images/cover/small/4.jpg">
                                        <div class="list__cover"><img src="images/cover/small/4.jpg" alt="Say yes"> <a
                                                href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="4" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Say yes</a>
                                            <p class="list__subtitle text-truncate"><a href="artist-details.html">Johnny
                                                    Marro</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="4"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>04:20</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="4">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="4">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="4">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="4">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="list__item" data-song-id="6" data-song-name="Hey not me"
                                        data-song-artist="Rasomi Pelina" data-song-album="Find soul"
                                        data-song-url="audio/ringtone-6.mp3" data-song-cover="images/cover/small/6.jpg">
                                        <div class="list__cover"><img src="images/cover/small/6.jpg" alt="Hey not me">
                                            <a href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="6" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Hey not me</a>
                                            <p class="list__subtitle text-truncate"><a href="artist-details.html">Rasomi
                                                    Pelina</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="6"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>01:12</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="6">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="6">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="6">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="6">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="list__item" data-song-id="8" data-song-name="Sadness inside"
                                        data-song-artist="Karen Jennings" data-song-album="Sadness"
                                        data-song-url="audio/ringtone-8.mp3" data-song-cover="images/cover/small/8.jpg">
                                        <div class="list__cover"><img src="images/cover/small/8.jpg" alt="Hey not me">
                                            <a href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="8" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Sadness inside</a>
                                            <p class="list__subtitle text-truncate"><a href="artist-details.html">Karen
                                                    Jennings</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><span class="badge rounded-pill bg-info"><i
                                                        class="ri-vip-crown-fill"></i></span></li>
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="8"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>02:37</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="8">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="8">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="8">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="8">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="list__item" data-song-id="10" data-song-name="Nothing like your eyes"
                                        data-song-artist="Nutty Nina" data-song-album="Lover soul"
                                        data-song-url="audio/ringtone-2.mp3"
                                        data-song-cover="images/cover/small/10.jpg">
                                        <div class="list__cover"><img src="images/cover/small/10.jpg"
                                                alt="Nothing like your eyes"> <a href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="10" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Nothing like your eyes</a>
                                            <p class="list__subtitle text-truncate"><a href="artist-details.html">Nutty
                                                    Nina</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><span class="badge rounded-pill bg-info"><i
                                                        class="ri-vip-crown-fill"></i></span></li>
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="10"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>03:54</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="10">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="10">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="10">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="10">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="international_pane" role="tabpanel" aria-labelledby="international" tabindex="0">
                                <div class="list" id="international-pane-div">
                                    <!-- <div class="list__item" data-song-id="2" data-song-name="Shack your butty"
                                        data-song-artist="Gerrina Linda" data-song-album="Hot shot"
                                        data-song-url="audio/ringtone-2.mp3" data-song-cover="images/cover/small/2.jpg">
                                        <div class="list__cover"><img src="images/cover/small/2.jpg"
                                                alt="Shack your butty"> <a href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="2" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Shack your butty</a>
                                            <p class="list__subtitle text-truncate"><a
                                                    href="artist-details.html">Gerrina Linda</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><span class="badge rounded-pill bg-info"><i
                                                        class="ri-vip-crown-fill"></i></span></li>
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="2"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>03:24</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="2">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="2">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="2">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="2">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="list__item" data-song-id="4" data-song-name="Say yes"
                                        data-song-artist="Johnny Marro" data-song-album="Say yes"
                                        data-song-url="audio/ringtone-4.mp3" data-song-cover="images/cover/small/4.jpg">
                                        <div class="list__cover"><img src="images/cover/small/4.jpg" alt="Say yes"> <a
                                                href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="4" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Say yes</a>
                                            <p class="list__subtitle text-truncate"><a href="artist-details.html">Johnny
                                                    Marro</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="4"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>04:20</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="4">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="4">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="4">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="4">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="list__item" data-song-id="6" data-song-name="Hey not me"
                                        data-song-artist="Rasomi Pelina" data-song-album="Find soul"
                                        data-song-url="audio/ringtone-6.mp3" data-song-cover="images/cover/small/6.jpg">
                                        <div class="list__cover"><img src="images/cover/small/6.jpg" alt="Hey not me">
                                            <a href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="6" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Hey not me</a>
                                            <p class="list__subtitle text-truncate"><a href="artist-details.html">Rasomi
                                                    Pelina</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="6"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>01:12</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="6">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="6">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="6">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="6">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="list__item" data-song-id="8" data-song-name="Sadness inside"
                                        data-song-artist="Karen Jennings" data-song-album="Sadness"
                                        data-song-url="audio/ringtone-8.mp3" data-song-cover="images/cover/small/8.jpg">
                                        <div class="list__cover"><img src="images/cover/small/8.jpg" alt="Hey not me">
                                            <a href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="8" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Sadness inside</a>
                                            <p class="list__subtitle text-truncate"><a href="artist-details.html">Karen
                                                    Jennings</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><span class="badge rounded-pill bg-info"><i
                                                        class="ri-vip-crown-fill"></i></span></li>
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="8"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>02:37</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="8">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="8">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="8">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="8">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="list__item" data-song-id="10" data-song-name="Nothing like your eyes"
                                        data-song-artist="Nutty Nina" data-song-album="Lover soul"
                                        data-song-url="audio/ringtone-2.mp3"
                                        data-song-cover="images/cover/small/10.jpg">
                                        <div class="list__cover"><img src="images/cover/small/10.jpg"
                                                alt="Nothing like your eyes"> <a href="javascript:void(0);"
                                                class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                data-play-id="10" aria-label="Play pause"><i
                                                    class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></a></div>
                                        <div class="list__content"><a href="song-details.html"
                                                class="list__title text-truncate">Nothing like your eyes</a>
                                            <p class="list__subtitle text-truncate"><a href="artist-details.html">Nutty
                                                    Nina</a></p>
                                        </div>
                                        <ul class="list__option">
                                            <li><span class="badge rounded-pill bg-info"><i
                                                        class="ri-vip-crown-fill"></i></span></li>
                                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex"
                                                    aria-label="Favorite" data-favorite-id="10"><i
                                                        class="ri-heart-line heart-empty"></i> <i
                                                        class="ri-heart-fill heart-fill"></i></a></li>
                                            <li>03:54</li>
                                            <li class="dropstart d-inline-flex"><a class="dropdown-link"
                                                    href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                    aria-label="Cover options" aria-expanded="false"><i
                                                        class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="10">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="10">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="10">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="10">Play</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section">
                    <div class="section__head">
                        <div class="flex-grow-1"><span class="section__subtitle">New to listen</span>
                            <h3 class="mb-0">New <span class="text-primary">Releases</span></h3>
                        </div><a href="music.html" class="btn btn-link" onclick="musics();">View All</a>
                    </div>
                    <div class="swiper-carousel swiper-carousel-button">
                        <div class="swiper" data-swiper-slides="5" data-swiper-autoplay="true">
                            <div class="swiper-wrapper" id="new-release-div">
                                <!-- <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="1" data-song-name="I love you mummy"
                                        data-song-artist="Arebica Luna" data-song-album="Mummy"
                                        data-song-url="audio/ringtone-1.mp3" data-song-cover="images/cover/small/1.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-danger"><i
                                                            class="ri-heart-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="1">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="1">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="1">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="1">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="1">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/1.jpg"
                                                alt="I love you mummy"> <button type="button"
                                                class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="1"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="song-details.html"
                                                class="cover__title text-truncate">I love you mummy</a>
                                            <p class="cover__subtitle text-truncate"><a
                                                    href="artist-details.html">Arebica Luna</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="2" data-song-name="Shack your butty"
                                        data-song-artist="Gerrina Linda" data-song-album="Hot shot"
                                        data-song-url="audio/ringtone-2.mp3" data-song-cover="images/cover/small/2.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-info"><i
                                                            class="ri-vip-crown-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="2">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="2">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="2">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="2">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="2">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/2.jpg"
                                                alt="Shack your butty"> <button type="button"
                                                class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="2"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="song-details.html"
                                                class="cover__title text-truncate">Shack your butty</a>
                                            <p class="cover__subtitle text-truncate"><a
                                                    href="artist-details.html">Gerrina Linda</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="3"
                                        data-song-name="Do it your way(Female)"
                                        data-song-artist="Zunira Willy & Nutty Nina" data-song-album="Own way"
                                        data-song-url="audio/ringtone-3.mp3" data-song-cover="images/cover/small/3.jpg">
                                        <div class="cover__head">
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="3">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="3">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="3">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="3">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="3">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/3.jpg"
                                                alt="Do it your way(Female)"> <button type="button"
                                                class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="3"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="song-details.html"
                                                class="cover__title text-truncate">Do it your way(Female)</a>
                                            <p class="cover__subtitle text-truncate"><a
                                                    href="artist-details.html">Zunira Willy</a>, <a
                                                    href="artist-details.html">Nutty Nina</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="4" data-song-name="Say yes"
                                        data-song-artist="Johnny Marro" data-song-album="Say yes"
                                        data-song-url="audio/ringtone-4.mp3" data-song-cover="images/cover/small/4.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-danger"><i
                                                            class="ri-heart-fill"></i></span></li>
                                                <li><span class="badge rounded-pill bg-info"><i
                                                            class="ri-vip-crown-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="4">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="4">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="4">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="4">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="4">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/4.jpg" alt="Say yes">
                                            <button type="button" class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="4"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="song-details.html"
                                                class="cover__title text-truncate">Say yes</a>
                                            <p class="cover__subtitle text-truncate"><a
                                                    href="artist-details.html">Johnny Marro</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="5"
                                        data-song-name="Where is your letter"
                                        data-song-artist="Jina Moore & Lenisa Gory" data-song-album="Letter"
                                        data-song-url="audio/ringtone-5.mp3" data-song-cover="images/cover/small/5.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-info"><i
                                                            class="ri-vip-crown-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="5">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="5">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="5">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="5">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="5">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/5.jpg"
                                                alt="Where is your letter"> <button type="button"
                                                class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="5"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="song-details.html"
                                                class="cover__title text-truncate">Where is your letter</a>
                                            <p class="cover__subtitle text-truncate"><a href="artist-details.html">Jina
                                                    Moore</a>, <a href="artist-details.html">Lenisa Gory</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="6" data-song-name="Hey not me"
                                        data-song-artist="Rasomi Pelina" data-song-album="Find soul"
                                        data-song-url="audio/ringtone-6.mp3" data-song-cover="images/cover/small/6.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-info"><i
                                                            class="ri-vip-crown-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="6">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-playlist-id="6">Add to playlist</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="6">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="6">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="6">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/6.jpg" alt="Hey not me">
                                            <button type="button" class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="6"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="song-details.html"
                                                class="cover__title text-truncate">Hey not me</a>
                                            <p class="cover__subtitle text-truncate"><a
                                                    href="artist-details.html">Rasomi Pelina</a></p>
                                        </div>
                                    </div>
                                </div> -->
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
                        </div><a href="artists.html" class="btn btn-link" onclick="artists();">View All</a>
                    </div>
                    <div class="swiper-carousel swiper-carousel-button">
                        <div class="swiper" data-swiper-slides="6" data-swiper-autoplay="true">
                            <div class="swiper-wrapper" id="artists-div">
                                <!-- <div class="swiper-slide">
                                    <div class="avatar avatar--xxl d-block text-center">
                                        <div class="avatar__image"><a href="artist-details.html"><img
                                                    src="images/cover/large/1.jpg" alt="Arebica Luna"></a></div><a
                                            href="artist-details.html" class="avatar__title mt-3">Arebica Luna</a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="avatar avatar--xxl d-block text-center">
                                        <div class="avatar__image"><a href="artist-details.html"><img
                                                    src="images/cover/large/2.jpg" alt="Gerrina Linda"></a></div><a
                                            href="artist-details.html" class="avatar__title mt-3">Gerrina Linda</a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="avatar avatar--xxl d-block text-center">
                                        <div class="avatar__image"><a href="artist-details.html"><img
                                                    src="images/cover/large/3.jpg" alt="Zunira Willy"></a></div><a
                                            href="artist-details.html" class="avatar__title mt-3">Zunira Willy</a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="avatar avatar--xxl d-block text-center">
                                        <div class="avatar__image"><a href="artist-details.html"><img
                                                    src="images/cover/large/4.jpg" alt="Johnny Marro"></a></div><a
                                            href="artist-details.html" class="avatar__title mt-3">Johnny Marro</a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="avatar avatar--xxl d-block text-center">
                                        <div class="avatar__image"><a href="artist-details.html"><img
                                                    src="images/cover/large/5.jpg" alt="Jina Moore"></a></div><a
                                            href="artist-details.html" class="avatar__title mt-3">Jina Moore</a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="avatar avatar--xxl d-block text-center">
                                        <div class="avatar__image"><a href="artist-details.html"><img
                                                    src="images/cover/large/6.jpg" alt="Rasomi Pelina"></a></div><a
                                            href="artist-details.html" class="avatar__title mt-3">Rasomi Pelina</a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="avatar avatar--xxl d-block text-center">
                                        <div class="avatar__image"><a href="artist-details.html"><img
                                                    src="images/cover/large/7.jpg" alt="Pimila Holliwy"></a></div><a
                                            href="artist-details.html" class="avatar__title mt-3">Pimila Holliwy</a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="avatar avatar--xxl d-block text-center">
                                        <div class="avatar__image"><a href="artist-details.html"><img
                                                    src="images/cover/large/8.jpg" alt="Karen Jennings"></a></div><a
                                            href="artist-details.html" class="avatar__title mt-3">Karen Jennings</a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="avatar avatar--xxl d-block text-center">
                                        <div class="avatar__image"><a href="artist-details.html"><img
                                                    src="images/cover/large/9.jpg" alt="Lenisa Gory"></a></div><a
                                            href="artist-details.html" class="avatar__title mt-3">Lenisa Gory</a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="avatar avatar--xxl d-block text-center">
                                        <div class="avatar__image"><a href="artist-details.html"><img
                                                    src="images/cover/large/10.jpg" alt="Nutty Nina"></a></div><a
                                            href="artist-details.html" class="avatar__title mt-3">Nutty Nina</a>
                                    </div>
                                </div> -->
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>

                <!-- <div class="section">
                    <div class="section__head">
                        <div class="flex-grow-1"><span class="section__subtitle">Collection to listen</span>
                            <h3 class="mb-0">Best <span class="text-primary">Playlist</span></h3>
                        </div><a href="albums.html" class="btn btn-link">View All</a>
                    </div>
                    <div class="swiper-carousel">
                        <div class="swiper" data-swiper-slides="4" data-swiper-autoplay="true">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="cover cover--round">
                                        <div class="cover__image"><a href="album-details.html"><img src="images/background/horizontal/1.jpg" alt="DJ Remix"></a>
                                            <div class="cover__image__content"><a href="album-details.html" class="cover__title mb-1 fs-6 text-truncate">DJ Remix</a> <span class="cover__subtitle">10 Songs | 10 Favorites</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round">
                                        <div class="cover__image"><a href="album-details.html"><img src="images/background/horizontal/2.jpg" alt="Rock Band"></a>
                                            <div class="cover__image__content"><a href="album-details.html" class="cover__title mb-1 fs-6 text-truncate">Rock Band</a> <span class="cover__subtitle">14 Songs | 12 Favorites</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round">
                                        <div class="cover__image"><a href="album-details.html"><img src="images/background/horizontal/3.jpg" alt="Solo Special"></a>
                                            <div class="cover__image__content"><a href="album-details.html" class="cover__title mb-1 fs-6 text-truncate">Solo Special</a> <span class="cover__subtitle">21 Songs | 45 Favorites</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round">
                                        <div class="cover__image"><a href="album-details.html"><img src="images/background/horizontal/4.jpg" alt="Romantic"></a>
                                            <div class="cover__image__content"><a href="album-details.html" class="cover__title mb-1 fs-6 text-truncate">Romantic</a> <span class="cover__subtitle">12 Songs | 75 Favorites</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round">
                                        <div class="cover__image"><a href="album-details.html"><img src="images/background/horizontal/5.jpg" alt="GYM"></a>
                                            <div class="cover__image__content"><a href="album-details.html" class="cover__title mb-1 fs-6 text-truncate">GYM</a> <span class="cover__subtitle">16 Songs | 32 Favorites</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round">
                                        <div class="cover__image"><a href="album-details.html"><img src="images/background/horizontal/6.jpg" alt="Retro Special"></a>
                                            <div class="cover__image__content"><a href="album-details.html" class="cover__title mb-1 fs-6 text-truncate">Retro Special</a> <span class="cover__subtitle">34 Songs | 69 Favorites</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-prev btn-default rounded-pill"></div>
                        <div class="swiper-button-next btn-default rounded-pill"></div>
                    </div>
                </div> -->
                <!-- <div class="section">
                    <div class="section__head">
                        <div class="flex-grow-1"><span class="section__subtitle">Listen live now</span>
                            <h3 class="mb-0">Live <span class="text-primary">Radios</span></h3>
                        </div><a href="stations.html" class="btn btn-link">View All</a>
                    </div>
                    <div class="swiper-carousel swiper-carousel-button">
                        <div class="swiper" data-swiper-slides="5" data-swiper-autoplay="true">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="1" data-song-name="I love you mummy"
                                        data-song-artist="Arebica Luna" data-song-album="Mummy"
                                        data-song-url="audio/ringtone-1.mp3" data-song-cover="images/cover/small/1.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-danger"><i
                                                            class="ri-heart-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="1">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="1">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="1">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="1">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/1.jpg"
                                                alt="International"> <button type="button"
                                                class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="1"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="javascript:void(0);" role="button"
                                                class="cover__title text-truncate">International</a></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="2" data-song-name="Shack your butty"
                                        data-song-artist="Gerrina Linda" data-song-album="Hot shot"
                                        data-song-url="audio/ringtone-2.mp3" data-song-cover="images/cover/small/2.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-info"><i
                                                            class="ri-vip-crown-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="2">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="2">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="2">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="2">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/2.jpg" alt="Network">
                                            <button type="button" class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="2"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="javascript:void(0);" role="button"
                                                class="cover__title text-truncate">Network</a></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="3"
                                        data-song-name="Do it your way(Female)"
                                        data-song-artist="Zunira Willy & Nutty Nina" data-song-album="Own way"
                                        data-song-url="audio/ringtone-3.mp3" data-song-cover="images/cover/small/3.jpg">
                                        <div class="cover__head">
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="3">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="3">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="3">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="3">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/3.jpg" alt="Alpha Gamma">
                                            <button type="button" class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="3"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="javascript:void(0);" role="button"
                                                class="cover__title text-truncate">Alpha Gamma</a></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="4" data-song-name="Say yes"
                                        data-song-artist="Johnny Marro" data-song-album="Say yes"
                                        data-song-url="audio/ringtone-4.mp3" data-song-cover="images/cover/small/4.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-danger"><i
                                                            class="ri-heart-fill"></i></span></li>
                                                <li><span class="badge rounded-pill bg-info"><i
                                                            class="ri-vip-crown-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="4">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="4">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="4">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="4">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/4.jpg"
                                                alt="Leanne Hutton"> <button type="button"
                                                class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="4"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="javascript:void(0);" role="button"
                                                class="cover__title text-truncate">Leanne Hutton</a></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="5"
                                        data-song-name="Where is your letter"
                                        data-song-artist="Jina Moore & Lenisa Gory" data-song-album="Letter"
                                        data-song-url="audio/ringtone-5.mp3" data-song-cover="images/cover/small/5.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-info"><i
                                                            class="ri-vip-crown-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="5">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="5">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="5">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="5">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/5.jpg" alt="K S N F">
                                            <button type="button" class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="5"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="javascript:void(0);" role="button"
                                                class="cover__title text-truncate">K S N F</a></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cover cover--round" data-song-id="6" data-song-name="Hey not me"
                                        data-song-artist="Rasomi Pelina" data-song-album="Find soul"
                                        data-song-url="audio/ringtone-6.mp3" data-song-cover="images/cover/small/6.jpg">
                                        <div class="cover__head">
                                            <ul class="cover__label d-flex">
                                                <li><span class="badge rounded-pill bg-info"><i
                                                            class="ri-vip-crown-fill"></i></span></li>
                                            </ul>
                                            <div class="cover__options dropstart d-inline-flex ms-auto"><a
                                                    class="dropdown-link" href="javascript:void(0);" role="button"
                                                    data-bs-toggle="dropdown" aria-label="Cover options"
                                                    aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-favorite-id="6">Favorite</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-queue-id="6">Add to queue</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-next-id="6">Next to play</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button">Share</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"
                                                            role="button" data-play-id="6">Play</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cover__image"><img src="images/cover/large/6.jpg" alt="Clay Gandy">
                                            <button type="button" class="btn btn-play btn-default btn-icon rounded-pill"
                                                data-play-id="6"><i class="ri-play-fill icon-play"></i> <i
                                                    class="ri-pause-fill icon-pause"></i></button></div>
                                        <div class="cover__foot"><a href="javascript:void(0);" role="button"
                                                class="cover__title text-truncate">Clay Gandy</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div> -->
            </div>
            <footer id="footer">
                <div class="container">
                    <div class="text-center mb-4"><a href="mailto:info@listenapp.com" class="display-5 email">info@listenapp.com</a></div>
                    <div class="app-btn-group pt-2"><a href="#" class="btn btn-lg btn-primary">
                            <div class="btn__wrap"><i class="ri-google-play-fill"></i> <span class="ms-2">Google
                                    Play</span></div>
                        </a><a href="#" class="btn btn-lg btn-primary">
                            <div class="btn__wrap"><i class="ri-app-store-fill"></i> <span class="ms-2">App Store</span>
                            </div>
                        </a></div>
                </div>
            </footer>
        </main>
    </div>
    <div id="player">
        <div class="container">
            <div class="player-container">
                <div class="player-progress"><progress class="amplitude-buffered-progress player-progress__bar" value="0"></progress><progress class="amplitude-song-played-progress player-progress__bar"></progress><input type="range" class="amplitude-song-slider player-progress__slider" aria-label="Progress slider"></div>
                <div class="cover d-flex align-items-center">
                    <div class="cover__image"><img data-amplitude-song-info="cover_art_url" src="images/cover/small/1.jpg" alt=""></div>
                    <div class="cover__content ps-3 d-none d-sm-block"><a href="song-details.html" class="cover__title text-truncate" data-amplitude-song-info="name"></a> <a href="artist-details.html" class="cover__subtitle text-truncate" data-amplitude-song-info="artist"></a></div>
                </div>
                <div class="player-control"><button type="button" class="amplitude-repeat btn btn-icon me-4 d-none d-md-block" aria-label="Repeat"><i class="ri-repeat-2-fill fs-5"></i></button> <button type="button" class="amplitude-prev btn btn-icon" aria-label="Backward"><i class="ri-skip-back-mini-fill"></i></button> <button type="button" class="amplitude-play-pause btn btn-icon btn-default rounded-pill" aria-label="Play pause"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></button>
                    <button type="button" class="amplitude-next btn btn-icon" aria-label="Forward"><i class="ri-skip-forward-mini-fill"></i></button> <button type="button" class="amplitude-shuffle amplitude-shuffle-off btn btn-icon ms-4 d-none d-md-block" aria-label="Shuffle"><i class="ri-shuffle-fill fs-5"></i></button>
                </div>
                <div class="player-info">
                    <div class="me-4 d-none d-xl-block"><span class="amplitude-current-minutes"></span>:<span class="amplitude-current-seconds"></span> / <span class="amplitude-duration-minutes"></span>:<span class="amplitude-duration-seconds"></span>
                    </div>
                    <div class="player-volume dropdown d-none d-md-block"><button class="btn btn-icon" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-label="Volume" aria-expanded="false"><i class="ri-volume-mute-fill fs-5 d-none"></i> <i class="ri-volume-down-fill fs-5"></i> <i class="ri-volume-up-fill fs-5 d-none"></i></button>
                        <div class="dropdown-menu prevent-click"><input type="range" class="amplitude-volume-slider" value="50" min="0" max="100" aria-label="Volume slider"></div>
                    </div>
                    <div class="dropstart d-none d-md-block"><button class="btn btn-icon" data-bs-toggle="dropdown" aria-label="Song options" aria-expanded="false"><i class="ri-more-2-fill fs-5"></i></button>
                        <ul class="dropdown-menu dropdown-menu-sm" id="player_options">
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-favorite-id="1">Favorite</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="1">Add to playlist</a></li>
                            <li><a class="dropdown-item" href="audio/ringtone-1.mp3" download>Download</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button">Share</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="song-details.html">View details</a></li>
                        </ul>
                    </div>
                    <div class="playlist dropstart me-3"><button class="btn btn-icon" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-label="Playlist" aria-expanded="false"><i class="ri-play-list-fill fs-5"></i></button>
                        <div class="dropdown-menu playlist__dropdown">
                            <div class="playlist__head d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">Next Lineup</h6><a href="javascript:void(0);" role="button" id="clear_playlist" class="btn btn-link">Clear</a>
                            </div>
                            <div id="playlist" class="list playlist__body" data-scroll="true">
                                <div class="col-sm-8 col-10 mx-auto mt-5 text-center"><i class="ri-music-2-line mb-3"></i>
                                    <p>No songs, album or playlist are added on lineup.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="backdrop"></div>
    <script src="js/plugins.bundle.js"></script>
    <script src="js/scripts.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script src="js/script.js"></script>
</body>
<!-- Mirrored from www.kri8thm.in/html/listen/theme/demo/home.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 Nov 2023 15:18:16 GMT -->

</html>