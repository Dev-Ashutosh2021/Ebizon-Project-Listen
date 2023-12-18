<header id="header" id="searchBar">
    <div class="container">
        <div class="header-container">
            <div class="d-flex align-items-center"><a href="javascript:void(0);" role="button" class="header-text sidebar-toggler d-lg-none me-3" aria-label="Sidebar toggler"><i class="ri-menu-3-line"></i></a>
                <form action="#" id="search_form" class="me-3"><label for="search_input"><i class="ri-search-2-line"></i></label> <input type="text" placeholder="Type anything to get result..." id="search_input" class="form-control form-control-sm" autocomplete="off"></form>
                <div id="search_results" class="search pb-3" style="visibility: hidden;">
                    <div class="search__body" data-scroll="true">
                        <div class="mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3"><span class="search__title" id="artist-label">Artists</span> <a href="artists.php" class="btn btn-link">View All</a></div>
                            <div class="row g-4 list" id="artist-search">
                                <!-- content -->
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3"><span class="search__title">Songs</span> <a href="songs.php" class="btn btn-link">View All</a></div>
                            <div class="row g-4 list" id="song-search">
                                <!-- content -->
                            </div>
                        </div>
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3"><span class="search__title">Albums</span> <a href="albums.php" class="btn btn-link">View All</a></div>
                            <div class="row g-4 list" id=album-search>
                                <!-- content -->
                            </div>
                        </div>
                    </div>
                </div>

             <?php if(isset($_SESSION['id']))
             {
                echo '<div class="d-flex align-items-center">
                <div class="dropdown ms-3 ms-sm-4" id="userMenu"><a href="javascript:void(0);" class="avatar header-text" role="button" id="user_menu" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar__image"><img src="'.$_SESSION['pic'].'" alt="user" id="userPic1"></div><span class="ps-2 d-none d-sm-block" id="username">'.$_SESSION['first'].'</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-md dropdown-menu-end" aria-labelledby="user_menu">
                        <li>
                            <div class="py-2 px-3 avatar avatar--lg">
                                <div class="avatar__image"><img src="'.$_SESSION['pic'].'" alt="user" id="userPic2">
                                </div>
                                <div class="avatar__content"><span class="avatar__title" id="fullname">'.$_SESSION['first']." ".$_SESSION['last'].'</span>
                                </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item d-flex align-items-center" href="profile.php" onclick="editProfile();"><i class="ri-user-3-line fs-5"></i> <span class="ps-2">Profile</span></a>
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="favorites.php" onclick="favourites();"><i class="ri-heart-line fs-5"></i> <span class="ps-2">Favorites</span></a>
                        </li>
                        <li onclick="logout()"><a class="dropdown-item d-flex align-items-center external text-danger" href="javascript:void(0);"><i class="ri-logout-circle-line fs-5"></i> <span class="ps-2">Logout</span></a></li>
                    </ul>
                </div>
            </div>';
             } ?>
            </div>
        </div>
    </div>
</header>

<script>
    document.getElementById('search_input').addEventListener('input', function() {
        document.getElementById("search_results").style.visibility = "visible";
        document.getElementById("album-search").innerHTML = '';
        document.getElementById("song-search").innerHTML = '';
        document.getElementById("artist-search").innerHTML = '';
        storedData = localStorage.getItem('key');
        parsedData = JSON.parse(storedData);
        // This function will be called every time a character is typed
        var inputValue = this.value;
        // Call your desired JavaScript function here or perform any other actions
        // console.log("Typed character: " + inputValue);

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'index.php?action=searchBar&text=' + inputValue, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let response = JSON.parse(xhr.responseText);
                console.log(response);


                response.searchartists.forEach((artist) => {
                    thumb_path = artist.thumbnail;
                    breakdown = thumb_path.split('/');
                    orig_file = breakdown[breakdown.length - 1];
                    document.getElementById("artist-search").innerHTML += `<div class="col-xl-3 col-md-4 col-sm-6">
                <div class="list__item"><a href="artist-details.php?artistId=${artist.artist_id}" class="list__cover"><img src="images/artists/${orig_file}" alt="${artist.name}"></a>
                    <div class="list__content"><a href="artist-details.php?artistId=${artist.artist_id}" class="list__title text-truncate">${artist.name}</a></div>
                </div>
            </div>`;
                });


                response.searchsongs.forEach((song) => {
                    a = song.thumbnail;
                    b = a.split('/');
                    c = b[b.length - 1];
                    // The artist_id you want to match
                    let desArtistId = song.artist_id; // Replace with the desired artist_id

                    // Find the artist with the matching artist_id
                    let match = parsedData.totalartists.find(artist => artist.artist_id === desArtistId);
                    document.getElementById("song-search").innerHTML += `<div class="col-xl-3 col-md-4 col-sm-6">
                <div class="list__item"><a href="song-details.php?songId=${song.song_id}" class="list__cover"><img src="images/cover/small/${c}"
                            alt="${song.title}"></a>
                    <div class="list__content"><a href="song-details.php?songId=${song.song_id}" class="list__title text-truncate">${song.title}</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.php?artistId=${song.artist_id}">${match.name}</a></p>
                    </div>
                </div>
            </div>`;
                });


                response.searchalbums.forEach((album) => {
                    d = album.thumbnail;
                    e = d.split('/');
                    f = e[e.length - 1];
                    // The artist_id you want to match
                    let desArtistId = album.artist_id; // Replace with the desired artist_id

                    // Find the artist with the matching artist_id
                    let match = parsedData.totalartists.find(artist => artist.artist_id === desArtistId);
                    document.getElementById("album-search").innerHTML += `<div class="col-xl-3 col-md-4 col-sm-6">
                <div class="list__item"><a href="album-details.php?albumId=${album.album_id}" class="list__cover"><img src="images/albums/${f}"
                            alt="${album.title}"></a>
                    <div class="list__content"><a href="album-details.php?albumId=${album.album_id}" class="list__title text-truncate">${album.title}</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.php?artistId=${match.artist_id}">${match.name}</a></p>
                    </div>
                </div>
            </div>`;
                });

            }
        };

        xhr.send();

    });
</script>