var allData;


function albumLoad() {
    if (document.getElementById('album-div-1')) {
        document.getElementById("album-div-1").innerHTML='';
        for (let i = 0; i < allData.totalalbums.length; i++) {
            const art = allData.totalartists.find(artist => artist.artist_id === allData.totalalbums[i].artist_id);

            document.getElementById("album-div-1").innerHTML += `<div class="list__item"><a href="album-details.html?albumId=${allData.totalalbums[i].album_id}" class="list__cover"><img src="${allData.totalalbums[i].thumbnail}"
                    alt="${allData.totalalbums[i].title}" onclick="albumDetails()"></a>
            <div class="list__content"><a href="album-details.html?albumId=${allData.totalalbums[i].album_id}"
                    class="list__title text-truncate" onclick="albumDetails()">${allData.totalalbums[i].title}</a>
                <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${art.artist_id}" onclick="artistDetails()">${art.name}</a></p>
            </div>
            <ul class="list__option">
                <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                        data-favorite-id="${allData.totalalbums[i].album_id}"><i class="ri-heart-line" id="heartIcon${allData.totalalbums[i].album_id}" onclick="favClickedAlbum(${allData.totalalbums[i].album_id})" style="color:red;"></i></a></li>
            </ul>
        </div>`;
        }
    } else {
        setTimeout(albumLoad, 50);
    }
}


function bollywoodLoad() {
    if (document.getElementById('trending-pane-div')) {
        const bollywoodSongs = allData.totalsongs.filter(song => song.genre_id === 4).slice(0, 6);
            bollywoodSongs.forEach((songs)=>{

                let org = songs.thumbnail;

                // Using the split method to separate the path by '/'
                let part = org.split('/');

                // Accessing the last part of the array to get the filename
                let file = part[part.length - 1];

                // The artist_id you want to match
                let desArtistId = songs.artist_id; // Replace with the desired artist_id

                // Find the artist with the matching artist_id
                let match = allData.totalartists.find(artist => artist.artist_id === desArtistId);

                let originalString = songs.duration;
                let extractedTime = originalString.substring(0, 5);

                document.getElementById("trending-pane-div").innerHTML += `<div class="list__item" data-song-id="${songs.song_id}" data-song-name="${songs.title}" data-song-artist="${match.name}"
                data-song-album="${songs.album_id}" data-song-url="../Admin/${songs.file_path}" data-song-cover="images/cover/small/${file}">
                <div class="list__cover"><img src="images/cover/small/${file}" alt="${songs.title}"> <a href="javascript:void(0);"
                        class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${songs.song_id}" aria-label="Play pause" onclick="addCount(${songs.song_id});addRecent(${songs.song_id});getRecentsFive();"><i
                            class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a></div>
                <div class="list__content"><a href="song-details.html?songId=${songs.song_id}" class="list__title text-truncate" onclick="songDetails()">${songs.title}</a>
                    <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${songs.artist_id}" onclick="artistDetails()">${match.name}</a></p>
                </div>
                <ul class="list__option">
                    <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                            data-favorite-id="${songs.song_id}"><i class="ri-heart-line" id="heartIconRecent${songs.song_id}" onclick="favClickedSong(${songs.song_id})" style="color:red;"></i></a></li>
                    <li>${extractedTime}</li>
                    <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                            data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${songs.song_id}" onclick="fillPlaylistModal(${songs.song_id})">Add to
                                    playlist</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${songs.song_id}">Add to queue</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${songs.song_id}">Next to play</a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${songs.song_id}">Play</a></li>
                        </ul>
                    </li>
                </ul>
            </div>`;
            });
    } else {
        setTimeout(bollywoodLoad, 50); 
    }
}


function internationalLoad() {
    if (document.getElementById('international-pane-div')) {
        const internationalSongs = allData.totalsongs.filter(song => song.genre_id === 5).slice(0, 6);
            internationalSongs.forEach((songs)=>{

                let org = songs.thumbnail;

                // Using the split method to separate the path by '/'
                let part = org.split('/');

                // Accessing the last part of the array to get the filename
                let file = part[part.length - 1];

                // The artist_id you want to match
                let desArtistId = songs.artist_id; // Replace with the desired artist_id

                // Find the artist with the matching artist_id
                let match = allData.totalartists.find(artist => artist.artist_id === desArtistId);

                let originalString = songs.duration;
                let extractedTime = originalString.substring(0, 5);

                document.getElementById("international-pane-div").innerHTML += `<div class="list__item" data-song-id="${songs.song_id}" data-song-name="${songs.title}" data-song-artist="${match.name}"
                data-song-album="${songs.album_id}" data-song-url="../Admin/${songs.file_path}" data-song-cover="images/cover/small/${file}">
                <div class="list__cover"><img src="images/cover/small/${file}" alt="${songs.title}"> <a href="javascript:void(0);"
                        class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${songs.song_id}" aria-label="Play pause" onclick="addCount(${songs.song_id});addRecent(${songs.song_id});getRecentsFive();"><i
                            class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a></div>
                <div class="list__content"><a href="song-details.html?songId=${songs.song_id}" class="list__title text-truncate" onclick="songDetails()">${songs.title}</a>
                    <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${songs.artist_id}" onclick="artistDetails()">${match.name}</a></p>
                </div>
                <ul class="list__option">
                    <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                            data-favorite-id="${songs.song_id}"><i class="ri-heart-line" id="heartIconRecent${songs.song_id}" onclick="favClickedSong(${songs.song_id})" style="color:red;"></i></a></li>
                    <li>${extractedTime}</li>
                    <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                            data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${songs.song_id}" onclick="fillPlaylistModal(${songs.song_id})">Add to
                                    playlist</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${songs.song_id}">Add to queue</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${songs.song_id}">Next to play</a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${songs.song_id}">Play</a></li>
                        </ul>
                    </li>
                </ul>
            </div>`;
            });
    } else {
        setTimeout(internationalLoad, 50); 
    }
}



function artistLoad() {
    if (document.getElementById('artists-div')) {
         // Display the first 7 artists
         for (let i = 0; i < 7 && i < allData.totalartists.length; i++) {
            const artist = allData.totalartists[i];
            thumb_path=artist.thumbnail;
            breakdown=thumb_path.split('/');
            orig_file=breakdown[breakdown.length-1];
            document.getElementById("artists-div").innerHTML+=`<div class="swiper-slide">
            <div class="avatar avatar--xxl d-block text-center">
                <div class="avatar__image"><a href="artist-details.html?artistId=${artist.artist_id}" onclick="artistDetails()"><img src="images/artists/${orig_file}"
                            alt="${artist.name}"></a></div><a href="artist-details.html?artistId=${artist.artist_id}"
                    class="avatar__title mt-3" onclick="artistDetails()">${artist.name}</a>
            </div>
        </div>`;
        }

    } else {
        setTimeout(artistLoad, 50); 
    }
}



function fetchAll() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=fetchAll', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            allData = JSON.parse(xhr.responseText);
            localStorage.setItem('key', JSON.stringify(allData));
            storedData = localStorage.getItem('key');
            parsedData = JSON.parse(storedData);

            topCharts();
            newReleases();
            getRecentsFive();
            albumLoad();
            bollywoodLoad();
            internationalLoad();
            artistLoad();
            fetchFavAlbum();
            fetchFavSong();

        }
    };

    xhr.send();
}



function topCharts() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=topCharts', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var topsongs = JSON.parse(xhr.responseText);

            topsongs.forEach((song) => {
                const song_thumb_path = song.thumbnail;

                // Using the split method to separate the path by '/'
                const parts = song_thumb_path.split('/');

                // Accessing the last part of the array to get the filename
                const trim_image = parts[parts.length - 1];

                // The artist_id you want to match
                const song_ArtistId = song.artist_id; // Replace with the desired artist_id

                // Find the artist with the matching artist_id
                const final_artist = allData.totalartists.find(artist => artist.artist_id === song_ArtistId);

                document.getElementById('top-charts').innerHTML += `<div class="swiper-slide">
                <div class="cover cover--round" data-song-id="${song.song_id}" data-song-name="${song.title}" data-song-artist="${final_artist.name}"
                    data-song-album="${song.album_id}" data-song-url="../Admin/${song.file_path}" data-song-cover="images/cover/small/${trim_image}">
                    <div class="cover__head">
                        <ul class="cover__label d-flex">
                            <li><span class="badge rounded-pill bg-white"></span></li>
                        </ul>
                        <div class="cover__options dropstart d-inline-flex ms-auto"><a class="dropdown-link"
                                href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-label="Cover options"
                                aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${song.song_id}" onclick="fillPlaylistModal(${song.song_id})">Add to
                                        playlist</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${song.song_id}">Add to
                                        queue</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${song.song_id}">Next to
                                        play</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${song.song_id}">Play</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="cover__image"><img src="images/cover/large/${trim_image}" alt="${song.title}"> <button type="button"
                            class="btn btn-play btn-default btn-icon rounded-pill" data-play-id="${song.song_id}" onclick="addCount(${song.song_id});addRecent(${song.song_id});getRecentsFive();"><i
                                class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></button></div>
                    <div class="cover__foot"><a href="song-details.html?songId=${song.song_id}" class="cover__title text-truncate" onclick="songDetails()">${song.title}</a>
                        <p class="cover__subtitle text-truncate"><a href="artist-details.html?artistId=${song.artist_id}" onclick="artistDetails()">${final_artist.name}</a></p>
                    </div>
                </div>
            </div>`;
            });
        }
    };

    xhr.send();
}



function newReleases() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=newReleases', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var newsongs = JSON.parse(xhr.responseText);

            newsongs.forEach((song) => {
                const song_thumb_path = song.thumbnail;

                // Using the split method to separate the path by '/'
                const parts = song_thumb_path.split('/');

                // Accessing the last part of the array to get the filename
                const trim_image = parts[parts.length - 1];

                // The artist_id you want to match
                const song_ArtistId = song.artist_id; // Replace with the desired artist_id

                // Find the artist with the matching artist_id
                const final_artist = allData.totalartists.find(artist => artist.artist_id === song_ArtistId);

                document.getElementById('new-release-div').innerHTML += `<div class="swiper-slide">
                <div class="cover cover--round" data-song-id="${song.song_id}" data-song-name="${song.title}" data-song-artist="${final_artist.name}"
                    data-song-album="${song.album_id}" data-song-url="../Admin/${song.file_path}" data-song-cover="images/cover/small/${trim_image}">
                    <div class="cover__head">
                        <ul class="cover__label d-flex">
                            <li><span class="badge rounded-pill bg-white"></span></li>
                        </ul>
                        <div class="cover__options dropstart d-inline-flex ms-auto"><a class="dropdown-link"
                                href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-label="Cover options"
                                aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${song.song_id}" onclick="fillPlaylistModal(${song.song_id})">Add to
                                        playlist</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${song.song_id}">Add to
                                        queue</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${song.song_id}">Next to
                                        play</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${song.song_id}">Play</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="cover__image"><img src="images/cover/large/${trim_image}" alt="${song.title}"> <button type="button"
                            class="btn btn-play btn-default btn-icon rounded-pill" data-play-id="${song.song_id}" onclick="addCount(${song.song_id});addRecent(${song.song_id});getRecentsFive();""><i
                                class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></button></div>
                    <div class="cover__foot"><a href="song-details.html?songId=${song.song_id}" class="cover__title text-truncate" onclick="songDetails()">${song.title}</a>
                        <p class="cover__subtitle text-truncate"><a href="artist-details.html?artistId=${song.artist_id}" onclick="artistDetails()">${final_artist.name}</a></p>
                    </div>
                </div>
            </div>`;
            });

        }
    };

    xhr.send();
}



function addCount(song_id) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=addCount&id=' + song_id, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.result === true) {
                console.log('Count added successfully');
            } else {
                alert('Error adding count: ' + response.result);
            }
        }
    };

    xhr.send();
}



function addRecent(song_id) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=addRecent&songid=' + song_id, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {

            var response = JSON.parse(xhr.responseText);

            if (response.result === true) {
                console.log('Recent added successfully');
                getRecentsFive();

            } else {
                alert('Recent adding : ' + response.result);
            }
        }
    };
    xhr.send();
}



function getRecentsFive() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=getRecentsFive', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {

            var response = JSON.parse(xhr.responseText);
            // console.log(response);
            // console.log(allData);
            document.getElementById("recent-pane-div").innerHTML ='';
            response.forEach((counter) => {
                const desired_songs = allData.totalsongs.find(song => song.song_id === counter.song_id);

                const org = desired_songs.thumbnail;

                // Using the split method to separate the path by '/'
                const part = org.split('/');

                // Accessing the last part of the array to get the filename
                const file = part[part.length - 1];

                // The artist_id you want to match
                const desArtistId = desired_songs.artist_id; // Replace with the desired artist_id

                // Find the artist with the matching artist_id
                const match = allData.totalartists.find(artist => artist.artist_id === desArtistId);

                var originalString = desired_songs.duration;
                var extractedTime = originalString.substring(0, 5);

                document.getElementById("recent-pane-div").innerHTML += `<div class="list__item" data-song-id="${desired_songs.song_id}" data-song-name="${desired_songs.title}" data-song-artist="${match.name}"
                data-song-album="${desired_songs.album_id}" data-song-url="../Admin/${desired_songs.file_path}" data-song-cover="images/cover/small/${file}">
                <div class="list__cover"><img src="images/cover/small/${file}" alt="${desired_songs.title}"> <a href="javascript:void(0);"
                        class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${desired_songs.song_id}" aria-label="Play pause" onclick="addCount(${desired_songs.song_id});addRecent(${desired_songs.song_id});getRecentsFive();"><i
                            class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a></div>
                <div class="list__content"><a href="song-details.html?songId=${desired_songs.song_id}" class="list__title text-truncate" onclick="songDetails()">${desired_songs.title}</a>
                    <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${desired_songs.artist_id}" onclick="artistDetails()">${match.name}</a></p>
                </div>
                <ul class="list__option">
                    <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                            data-favorite-id="${desired_songs.song_id}"><i class="ri-heart-line" id="heartIconRecent${desired_songs.song_id}" onclick="favClickedSong(${desired_songs.song_id})" style="color:red;"></i></a></li>
                    <li>${extractedTime}</li>
                    <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                            data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${desired_songs.song_id}" onclick="fillPlaylistModal(${desired_songs.song_id})">Add to
                                    playlist</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${desired_songs.song_id}">Add to queue</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${desired_songs.song_id}">Next to play</a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${desired_songs.song_id}">Play</a></li>
                        </ul>
                    </li>
                </ul>
            </div>`;

            });
            fetchFavSong();
        }
    };
    xhr.send();
}



function register() {
    var form = document.getElementById('registerForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response=JSON.parse(xhr.responseText);
                // Handle successful response
                console.log(response);
                if(response.result=="User already exists")
                {
                    document.getElementById("myToast").classList.remove("bg-success");
                    document.getElementById("myToast").classList.add("bg-danger");
                }
                else
                {
                    document.getElementById("myToast").classList.remove("bg-danger");
                    document.getElementById("myToast").classList.add("bg-success");
                }
                var myToast = document.getElementById('myToast');

                // Create a Bootstrap 5 Toast instance and show it
                var toast = new bootstrap.Toast(myToast);
                document.getElementById("mess").innerText=response.result;
                toast.show();
            } else {
                // Handle error
                console.error('Error:', xhr.status);
            }
        }
    };

    xhr.open('POST', 'index.php?action=register', true);
    xhr.send(formData);
}



function login() {
    var form = document.getElementById('login-form');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response=JSON.parse(xhr.responseText);
                // Handle successful response
                console.log(response);

                if(response.result=="Login successful")
                {
                    window.location.href = "home.php";
                }
                else
                {
                    document.getElementById("myToast").classList.remove("bg-success");
                    document.getElementById("myToast").classList.add("bg-danger");
                }

                var myToast = document.getElementById('myToast');

                // Create a Bootstrap 5 Toast instance and show it
                var toast = new bootstrap.Toast(myToast);
                document.getElementById("mess").innerText=response.result;
                toast.show();
            } else {
                // Handle error
                console.error('Error:', xhr.status);
            }
        }
    };

    xhr.open('POST', 'index.php?action=login', true);
    xhr.send(formData);
}



document.getElementById('search_input').addEventListener('input', function() {
    document.getElementById("search_results").style.visibility="visible";
    document.getElementById("album-search").innerHTML='';
    document.getElementById("song-search").innerHTML='';
    document.getElementById("artist-search").innerHTML='';
    // This function will be called every time a character is typed
    var inputValue = this.value;
    // Call your desired JavaScript function here or perform any other actions
    // console.log("Typed character: " + inputValue);

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=searchBar&text='+inputValue, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let response  = JSON.parse(xhr.responseText);
            console.log(response);


            response.searchartists.forEach((artist) => {
                thumb_path = artist.thumbnail;
                breakdown = thumb_path.split('/');
                orig_file = breakdown[breakdown.length - 1];
                document.getElementById("artist-search").innerHTML += `<div class="col-xl-3 col-md-4 col-sm-6">
                <div class="list__item"><a href="artist-details.html?artistId=${artist.artist_id}" class="list__cover"><img src="images/artists/${orig_file}" alt="${artist.name}"></a>
                    <div class="list__content"><a href="artist-details.html?artistId=${artist.artist_id}" class="list__title text-truncate">${artist.name}</a></div>
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
                let match = allData.totalartists.find(artist => artist.artist_id === desArtistId);
                document.getElementById("song-search").innerHTML += `<div class="col-xl-3 col-md-4 col-sm-6">
                <div class="list__item"><a href="song-details.html?songId=${song.song_id}" class="list__cover"><img src="images/cover/small/${c}"
                            alt="${song.title}"></a>
                    <div class="list__content"><a href="song-details.html?songId=${song.song_id}" class="list__title text-truncate">${song.title}</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${song.artist_id}">${match.name}</a></p>
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
                let match = allData.totalartists.find(artist => artist.artist_id === desArtistId);
                document.getElementById("album-search").innerHTML += `<div class="col-xl-3 col-md-4 col-sm-6">
                <div class="list__item"><a href="album-details.html?albumId=${album.album_id}" class="list__cover"><img src="images/albums/${f}"
                            alt="${album.title}"></a>
                    <div class="list__content"><a href="album-details.html?albumId=${album.album_id}" class="list__title text-truncate">${album.title}</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${match.artist_id}">${match.name}</a></p>
                    </div>
                </div>
            </div>`;
            });

        }
    };

    xhr.send();

});



function songDetails() {
    if (document.getElementById('song-detail')) {
        // Get the current URL
        var currentUrl = window.location.href;

        // Create a URL object from the URL string
        var url = new URL(currentUrl);

        // Get the value of the 'songId' parameter
        var songId = url.searchParams.get('songId');

        let desired_songs = parsedData.totalsongs.find(song => song.song_id == songId);

        let org = desired_songs.thumbnail;

        // Using the split method to separate the path by '/'
        let part = org.split('/');

        // Accessing the last part of the array to get the filename
        let file = part[part.length - 1];

        // The artist_id you want to match
        let desArtistId = desired_songs.artist_id; // Replace with the desired artist_id

        // Find the artist with the matching artist_id
        let match = parsedData.totalartists.find(artist => artist.artist_id === desArtistId);
        let genre = parsedData.totalgenres.find(genre => genre.genre_id === desired_songs.genre_id);

        let originalString = desired_songs.duration;
        let extractedTime = originalString.substring(0, 5);
        document.getElementById("song-detail").innerHTML = `<div class="row" data-song-id="${desired_songs.song_id}" data-song-name="${desired_songs.title}" data-song-artist="${match.name}" data-song-album="${desired_songs.album_id}"
    data-song-url="../Admin/${desired_songs.file_path}" data-song-cover="images/cover/small/${file}">
    <div class="col-xl-3 col-md-4">
        <div class="cover cover--round">
            <div class="cover__image"><img src="images/cover/large/${file}" alt="${desired_songs.title}"></div>
        </div>
    </div>
    <div class="col-1 d-none d-xl-block"></div>
    <div class="col-md-8 mt-5 mt-md-0">
        <div class="d-flex flex-wrap mb-2"><span class="text-dark fs-4 fw-semi-bold pe-2">${desired_songs.title}</span>
            <div class="dropstart d-inline-flex ms-auto"><a class="dropdown-link" href="javascript:void(0);"
                    role="button" data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                        class="ri-more-fill"></i></a>
                <ul class="dropdown-menu dropdown-menu-sm">
                    <li><a class="dropdown-item" href="javascript:void(0);" role="button"
                            data-playlist-id="${desired_songs.song_id}">Add to playlist</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" role="button"
                            data-queue-id="${desired_songs.song_id}">Add to queue</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" role="button"
                            data-next-id="${desired_songs.song_id}">Next to play</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" role="button">Share</a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${desired_songs.song_id}">Play</a></li>
                </ul>
            </div>
        </div>
        <ul class="info-list info-list--dotted mb-3">
            <li>${genre.name}</li>
            <li>${extractedTime}</li>
            <li>${desired_songs.uploaded_at}</li>
        </ul>
        <div class="mb-4">
            <p class="mb-2">Compose by: <span class="text-dark fw-medium"><a href="artist-details.html?artistId=${match.artist_id}" class="text-dark fw-medium" onclick="artistDetails()">${match.name}</a><span></p>
        </div>
        <ul class="info-list mb-5">
            <li>
                <div class="d-flex align-items-center"><button type="button" id="play_all"
                        class="btn btn-icon btn-primary rounded-pill" data-play-id="${desired_songs.song_id}"><i
                            class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></button> <span
                        class="ps-2 fw-semi-bold">${desired_songs.play_count}</span></div>
            </li>
            <li><a href="javascript:void(0);" role="button" class="text-dark d-flex align-items-center"
                    aria-label="Favorite" data-favorite-id="1"><i class="ri-heart-line heart-empty"></i> <i
                        class="ri-heart-fill heart-fill"></i> <span class="ps-2 fw-medium">121</span></a></li>
        </ul>
    </div>
</div>`;

    } else {
        setTimeout(songDetails, 50);
    }

}



function artistDetails() {
    fetchFavSong();
    fetchFavAlbum();
    storedData = localStorage.getItem('key');
    parsedData = JSON.parse(storedData);
    if (document.getElementById('artist-detail') && document.getElementById("song-1") && document.getElementById("song-2") && document.getElementById("artist-album")) {
        document.getElementById("song-1").innerHTML=``;
        document.getElementById("song-2").innerHTML=``;
        document.getElementById("artist-album").innerHTML=``;
        // Get the current URL
        let currentUrl = window.location.href;

        // Create a URL object from the URL string
        let url = new URL(currentUrl);

        // Get the value of the 'songId' parameter
        let artistId = url.searchParams.get('artistId');

        let desired_artist = parsedData.totalartists.find(artist => artist.artist_id == artistId);
        // let desired_songs = allData.totalsongs.find(song => song.song_id == songId);

        let org = desired_artist.thumbnail;

         // Using the split method to separate the path by '/'
         let part = org.split('/');

         // Accessing the last part of the array to get the filename
         let file = part[part.length - 1];

        // // Find the artist with the matching artist_id
         let album = parsedData.totalalbums.filter(album => album.artist_id == artistId);
         console.log(album);
         let song = parsedData.totalsongs.filter(song => song.artist_id == artistId);
         console.log(song);

        // let originalString = desired_songs.duration;
        // let extractedTime = originalString.substring(0, 5);
        document.getElementById("artist-detail").innerHTML = `<div class="row align-items-center">
        <div class="col-xl-3 col-md-4">
            <div class="cover cover--round">
                <div class="cover__image"><img src="images/artists/${file}" alt="${desired_artist.name}">
                </div>
            </div>
        </div>
        <div class="col-1 d-none d-xl-block"></div>
        <div class="col-md-8 mt-5 mt-md-0">
            <div class="d-flex flex-wrap mb-2"><span class="text-dark fs-4 fw-semi-bold pe-2">${desired_artist.name}</span>
            </div>
            <ul class="info-list info-list--dotted mb-3">
                <li>${album.length} Albums</li>
                <li>${song.length} Songs</li>
                <li>${desired_artist.created}</li>
            </ul>
            <p class="mb-5" style="line-height: 3vh;">${desired_artist.about}</p>
            <ul class="info-list">
                <li><a href="javascript:void(0);" role="button" class="text-dark d-flex align-items-center"
                        aria-label="Favorite" data-favorite-id="${desired_artist.artist_id}"></a></li>
            </ul>
        </div>
    </div>`;

        for (i = 0; i < song.length; i++) {
            document.getElementById("song-span").innerText='Songs';
            const org = song[i].thumbnail;

            // Using the split method to separate the path by '/'
            const part = org.split('/');

            // Accessing the last part of the array to get the filename
            const file = part[part.length - 1];
            let art = parsedData.totalartists.find(artist => artist.artist_id == song[i].artist_id);

            let originalString = song[i].duration;
            let extractedTime = originalString.substring(0, 5);
            if (i % 2 == 0) {
                document.getElementById("song-1").innerHTML += `<div class="list__item" data-song-id="${song[i].song_id}" data-song-name="${song[i].title}" data-song-artist="${art.name}"
            data-song-album="${song[i].song_id}" data-song-url="../Admin/${song[i].file_path}" data-song-cover="images/cover/small/${file}">
            <div class="list__cover"><img src="images/cover/small/${file}" alt="${song[i].title}">
                <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${song[i].song_id}"
                    aria-label="Play pause" onclick="addCount(${song[i].song_id});addRecent(${song[i].song_id});"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a>
            </div>
            <div class="list__content"><a href="song-details.html?songId=${song[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${song[i].title}</a>
                <p class="list__subtitle text-truncate"><a href="javascript:void(0);">${art.name}</a></p>
            </div>
            <ul class="list__option">
                <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                        data-favorite-id="${song[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${song[i].song_id}" onclick="favClickedSong(${song[i].song_id})" style="color:red;"></i></a></li>
                <li>${extractedTime}</li>
                <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                        data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                            class="ri-more-fill"></i></a>
                    <ul class="dropdown-menu dropdown-menu-sm">
                        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${song[i].song_id}" onclick="fillPlaylistModal(${song[i].song_id})">Add to
                                playlist</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${song[i].song_id}">Add to queue</a>
                        </li>
                        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${song[i].song_id}">Next to play</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${song[i].song_id}">Play</a></li>
                    </ul>
                </li>
            </ul>
        </div>`;
            }
            else {
                document.getElementById("song-2").innerHTML += `<div class="list__item" data-song-id="${song[i].song_id}" data-song-name="${song[i].title}" data-song-artist="${art.name}"
            data-song-album="${song[i].song_id}" data-song-url="../Admin/${song[i].file_path}" data-song-cover="images/cover/small/${file}">
            <div class="list__cover"><img src="images/cover/small/${file}" alt="${song[i].title}">
                <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${song[i].song_id}"
                    aria-label="Play pause" onclick="addCount(${song[i].song_id});addRecent(${song[i].song_id});"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a>
            </div>
            <div class="list__content"><a href="song-details.html?songId=${song[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${song[i].title}</a>
                <p class="list__subtitle text-truncate"><a href="javascript:void(0);">${art.name}</a></p>
            </div>
            <ul class="list__option">
                <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                        data-favorite-id="${song[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${song[i].song_id}" onclick="favClickedSong(${song[i].song_id})" style="color:red;"></i></a></li>
                <li>${extractedTime}</li>
                <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                        data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                            class="ri-more-fill"></i></a>
                    <ul class="dropdown-menu dropdown-menu-sm">
                        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${song[i].song_id}" onclick="fillPlaylistModal(${song[i].song_id})">Add to
                                playlist</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${song[i].song_id}">Add to queue</a>
                        </li>
                        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${song[i].song_id}">Next to play</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${song[i].song_id}">Play</a></li>
                    </ul>
                </li>
            </ul>
        </div>`;
            }
        }


        for(i=0;i<album.length;i++)
        {
            document.getElementById("album-span").innerText='Albums';
            let art = parsedData.totalartists.find(artist => artist.artist_id == album[i].artist_id);
            document.getElementById("artist-album").innerHTML+=`<div class="swiper-slide">
            <div class="cover cover--round">
                <div class="cover__head">
                    <ul class="cover__label d-flex">
                        <li><span class="badge rounded-pill bg-white"><i class="ri-heart-line" id="heartIcon${album[i].album_id}" onclick="favClickedAlbum(${album[i].album_id})" style="color:red;"></i></span></li>
                    </ul>
                </div><a href="album-details.html?albumId=${album[i].album_id}" class="cover__image"><img src="${album[i].thumbnail}" alt="${album[i].title}" onclick="albumDetails()"></a>
                <div class="cover__foot"><a href="album-details.html?albumId=${album[i].album_id}" class="cover__title text-truncate" onclick="albumDetails()">${album[i].title}</a>
                    <p class="cover__subtitle text-truncate"><a href="javascript:void(0);">${art.name}</a></p>
                </div>
            </div>
        </div>`;
        }

    } else {
        setTimeout(artistDetails, 50);
    }

}



function albumDetails() {
    fetchFavSong();
    storedData = localStorage.getItem('key');
    parsedData = JSON.parse(storedData);
    if (document.getElementById('album-detail-div') && document.getElementById("song-1") && document.getElementById("song-2")) {
        document.getElementById("song-1").innerHTML=``;
        document.getElementById("song-2").innerHTML=``;

        // Get the current URL
        let currentUrl = window.location.href;

        // Create a URL object from the URL string
        let url = new URL(currentUrl);

        // Get the value of the 'songId' parameter
        let albumId = url.searchParams.get('albumId');
        // // Find the artist with the matching artist_id
        let album = parsedData.totalalbums.find(album => album.album_id == albumId);
        console.log(album);

        let desired_artist = parsedData.totalartists.find(artist => artist.artist_id == album.artist_id);
       
         let song = parsedData.totalsongs.filter(song => song.album_id == albumId);
         console.log(song);

        
        document.getElementById("album-detail-div").innerHTML = `<div class="row align-items-center">
        <div class="col-xl-3 col-md-4">
            <div class="cover cover--round">
                <div class="cover__image"><img src="${album.thumbnail}" alt="${album.title}"></div>
            </div>
        </div>
        <div class="col-1 d-none d-xl-block"></div>
        <div class="col-md-8 mt-5 mt-md-0">
            <div class="d-flex flex-wrap mb-2"><span class="text-dark fs-4 fw-semi-bold pe-2">${album.title}</span>
            </div>
            <ul class="info-list info-list--dotted mb-3">
                <li>Album</li>
                <li>${song.length} Songs</li>
                <li>${album.release_date}</li>
            </ul>
            <p class="mb-5">By: <a href="artist-details.html?artistId=${desired_artist.artist_id}" class="text-dark fw-medium" onclick="artistDetails()">${desired_artist.name}</a>
            </p>
        </div>
    </div>`;

        for (i = 0; i < song.length; i++) {
            document.getElementById("songs-all").innerHTML='Songs';
            const org = song[i].thumbnail;

            // Using the split method to separate the path by '/'
            const part = org.split('/');

            // Accessing the last part of the array to get the filename
            const file = part[part.length - 1];
            let art = parsedData.totalartists.find(artist => artist.artist_id == song[i].artist_id);
            let originalString = song[i].duration;
            let extractedTime = originalString.substring(0, 5);
            if (i % 2 == 0) {
                document.getElementById("song-1").innerHTML += `<div class="list__item" data-song-id="${song[i].song_id}" data-song-name="${song[i].title}" data-song-artist="${art.name}"
                data-song-album="${song[i].song_id}" data-song-url="../Admin/${song[i].file_path}" data-song-cover="images/cover/small/${file}">
                <div class="list__cover"><img src="images/cover/small/${file}" alt="${song[i].title}">
                    <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${song[i].song_id}" aria-label="Play pause" onclick="addCount(${song[i].song_id});addRecent(${song[i].song_id});"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a>
                </div>
                <div class="list__content"><a href="song-details.html?songId=${song[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${song[i].title}</a>
                    <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${art.artist_id}" onclick="artistDetails()">${art.name}</a></p>
                </div>
                <ul class="list__option">
                    <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                            data-favorite-id="${song[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${song[i].song_id}" onclick="favClickedSong(${song[i].song_id})" style="color:red;"></i></a></li>
                    <li>${extractedTime}</li>
                    <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                            data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${song[i].song_id}" onclick="fillPlaylistModal(${song[i].song_id})">Add to
                                    playlist</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${song[i].song_id}">Add to queue</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${song[i].song_id}">Next to play</a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${song[i].song_id}">Play</a></li>
                        </ul>
                    </li>
                </ul>
            </div>`;
            }
            else {
                document.getElementById("song-2").innerHTML += `<div class="list__item" data-song-id="${song[i].song_id}" data-song-name="${song[i].title}" data-song-artist="${art.name}"
            data-song-album="${song[i].song_id}" data-song-url="../Admin/${song[i].file_path}" data-song-cover="images/cover/small/${file}">
            <div class="list__cover"><img src="images/cover/small/${file}" alt="${song[i].title}">
            <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${song[i].song_id}"
                aria-label="Play pause" onclick="addCount(${song[i].song_id});addRecent(${song[i].song_id});"><i class="ri-play-fill icon-play" ></i> <i class="ri-pause-fill icon-pause"></i></a>
        </div>
            <div class="list__content"><a href="song-details.htmlsongId=${song[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${song[i].title}</a>
                <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${art.artist_id}" onclick="artistDetails()">${art.name}</a></p>
            </div>
            <ul class="list__option">
                <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                        data-favorite-id="${song[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${song[i].song_id}" onclick="favClickedSong(${song[i].song_id})" style="color:red;"></i></a></li>
                <li>${extractedTime}</li>
                <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                        data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                            class="ri-more-fill"></i></a>
                    <ul class="dropdown-menu dropdown-menu-sm">
                        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${song[i].song_id}" onclick="fillPlaylistModal(${song[i].song_id})">Add to
                                playlist</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${song[i].song_id}">Add to queue</a>
                        </li>
                        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${song[i].song_id}">Next to play</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${song[i].song_id}">Play</a></li>
                    </ul>
                </li>
            </ul>
        </div>`;
            }
        }

    } else {
        setTimeout(albumDetails, 50);
    }

}



function genres() {
    if (document.getElementById('genre-div')) {
        document.getElementById("genre-div").innerHTML = '';
        parsedData.totalgenres.forEach((genre) => {
            document.getElementById("genre-div").innerHTML += `<div class="col-xl-3 col-sm-6">
        <div class="cover cover--round"><a href="genre-details.html?genreId=${genre.genre_id}" class="cover__image" onclick="genreDetails(); fetchFavSong();"><img
                    src="${genre.thumbnail}" alt="${genre.name}">
                <div class="cover__image__content"><span class="cover__title mb-1 fs-6 text-truncate">${genre.name}</span></div>
            </a></div>
    </div>`;
        })
    }
    else {
        setTimeout(genres, 50);
    }

}



function genreDetails() {
    fetchFavSong();
    if (document.getElementById('genre-div1') && document.getElementById('genre-div2')) {
        document.getElementById("genre-div1").innerHTML = ``;
        document.getElementById("genre-div2").innerHTML = ``;
        
        storedData = localStorage.getItem('key');
        parsedData = JSON.parse(storedData);

        // Get the current URL
        var currentUrl = window.location.href;

        // Create a URL object from the URL string
        var url = new URL(currentUrl);

        // Get the value of the 'songId' parameter
        var genreId = url.searchParams.get('genreId');

        let desired_songs = parsedData.totalsongs.filter(song => song.genre_id == genreId);

        console.log(desired_songs);
        
        for(i=0;i<desired_songs.length;i++)
        {
            let org = desired_songs[i].thumbnail;

            // Using the split method to separate the path by '/'
            let part = org.split('/');

            // Accessing the last part of the array to get the filename
            let file = part[part.length - 1];

            // The artist_id you want to match
            let desArtistId = desired_songs[i].artist_id; // Replace with the desired artist_id
            // Find the artist with the matching artist_id
            let match = parsedData.totalartists.find(artist => artist.artist_id === desArtistId);
            let genre = parsedData.totalgenres.find(genre => genre.genre_id === desired_songs[i].genre_id);
            document.getElementById("genre-title").innerText=genre.name;

            let originalString = desired_songs[i].duration;
            let extractedTime = originalString.substring(0, 5);
            if(i%2==0)
            {
                document.getElementById("genre-div1").innerHTML += `<div class="list__item" data-song-id="${desired_songs[i].song_id}" data-song-name="${desired_songs[i].title}" data-song-artist="${match.name}"
                data-song-album="${desired_songs[i].album_id}" data-song-url="../Admin/${desired_songs[i].file_path}" data-song-cover="images/cover/small/${file}">
                <div class="list__cover"><img src="images/cover/small/${file}" alt="${desired_songs[i].title}">
                    <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${desired_songs[i].song_id}"
                        aria-label="Play pause" onclick="addCount(${desired_songs[i].song_id});addRecent(${desired_songs[i].song_id});"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a>
                </div>
                <div class="list__content"><a href="song-details.html?songId=${desired_songs[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${desired_songs[i].title}</a>
                    <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${desired_songs[i].artist_id}" onclick="artistDetails()">${match.name}</a></p>
                </div>
                <ul class="list__option">
                    <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                            data-favorite-id="${desired_songs[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${desired_songs[i].song_id}" onclick="favClickedSong(${desired_songs[i].song_id})" style="color:red;"></i></a></li>
                    <li>${extractedTime}</li>
                    <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                            data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${desired_songs[i].song_id}" onclick="fillPlaylistModal(${desired_songs[i].song_id})">Add to
                                    playlist</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${desired_songs[i].song_id}">Add to queue</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${desired_songs[i].song_id}">Next to play</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button">Share</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${desired_songs[i].song_id}">Play</a></li>
                        </ul>
                    </li>
                </ul>
            </div>`;
            }
            else
            {
                document.getElementById("genre-div2").innerHTML += `<div class="list__item" data-song-id="${desired_songs[i].song_id}" data-song-name="${desired_songs[i].title}" data-song-artist="${match.name}"
                data-song-album="${desired_songs[i].album_id}" data-song-url="../Admin/${desired_songs[i].file_path}" data-song-cover="images/cover/small/${file}">
                <div class="list__cover"><img src="images/cover/small/${file}" alt="${desired_songs[i].title}">
                    <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${desired_songs[i].song_id}"
                        aria-label="Play pause" onclick="addCount(${desired_songs[i].song_id});addRecent(${desired_songs[i].song_id});"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a>
                </div>
                <div class="list__content"><a href="song-details.html?songId=${desired_songs[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${desired_songs[i].title}</a>
                    <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${desired_songs[i].artist_id}" onclick="artistDetails()">${match.name}</a></p>
                </div>
                <ul class="list__option">
                    <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                            data-favorite-id="${desired_songs[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${desired_songs[i].song_id}" onclick="favClickedSong(${desired_songs[i].song_id})" style="color:red;"></i></a></li>
                    <li>01:14</li>
                    <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                            data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${desired_songs[i].song_id}" onclick="fillPlaylistModal(${desired_songs[i].song_id})">Add to
                                    playlist</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${desired_songs[i].song_id}">Add to queue</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${desired_songs[i].song_id}">Next to play</a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${desired_songs[i].song_id}">Play</a></li>
                        </ul>
                    </li>
                </ul>
            </div>`;
            }
        }

    } else {
        setTimeout(genreDetails, 50);
    }

}



function musics() {
    fetchFavSong();
    storedData = localStorage.getItem('key');
    parsedData = JSON.parse(storedData);
    if (document.getElementById('song-filter') && document.getElementById('song-div1') && document.getElementById('song-div2')) {
        document.getElementById("song-div1").innerHTML = ``;
        document.getElementById("song-div2").innerHTML = ``;

        let sortingOption = document.getElementById("song-filter").value;
        let desired_songs = parsedData.totalsongs.slice(); // Copy the array to avoid modifying the original

        // Sort the songs based on the selected option
        if (sortingOption === 'Most played') {
            // Sort by play count in descending order
            desired_songs.sort((a, b) => b.play_count - a.play_count);

        } else if (sortingOption === 'A to Z') {
            // Sort by title in ascending order
            desired_songs.sort((a, b) => a.title.localeCompare(b.title));
        } else if (sortingOption === 'Z to A') {
            // Sort by title in descending order
            desired_songs.sort((a, b) => b.title.localeCompare(a.title));
        }

        document.getElementById("song-count").innerText=`${desired_songs.length} Songs in the list`;

        for(i=0;i<desired_songs.length;i++)
        {
            let org = desired_songs[i].thumbnail;

            // Using the split method to separate the path by '/'
            let part = org.split('/');

            // Accessing the last part of the array to get the filename
            let file = part[part.length - 1];

            // The artist_id you want to match
            let desArtistId = desired_songs[i].artist_id; // Replace with the desired artist_id
            // Find the artist with the matching artist_id
            let match = parsedData.totalartists.find(artist => artist.artist_id === desArtistId);

            let originalString = desired_songs[i].duration;
            let extractedTime = originalString.substring(0, 5);
            if(i%2==0)
            {
                document.getElementById("song-div1").innerHTML += `<div class="list__item" data-song-id="${desired_songs[i].song_id}" data-song-name="${desired_songs[i].title}" data-song-artist="${match.name}"
                data-song-album="${desired_songs[i].album_id}" data-song-url="../Admin/${desired_songs[i].file_path}" data-song-cover="images/cover/small/${file}">
                <div class="list__cover"><img src="images/cover/small/${file}" alt="${desired_songs[i].title}">
                    <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${desired_songs[i].song_id}"
                        aria-label="Play pause" onclick="addCount(${desired_songs[i].song_id});addRecent(${desired_songs[i].song_id});"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a>
                </div>
                <div class="list__content"><a href="song-details.html?songId=${desired_songs[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${desired_songs[i].title}</a>
                    <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${desired_songs[i].artist_id}" onclick="artistDetails()">${match.name}</a></p>
                </div>
                <ul class="list__option">
                    <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                            data-favorite-id="${desired_songs[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${desired_songs[i].song_id}" onclick="favClickedSong(${desired_songs[i].song_id})" style="color:red;"></i></a></li>
                    <li>${extractedTime}</li>
                    <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                            data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${desired_songs[i].song_id}" onclick="fillPlaylistModal(${desired_songs[i].song_id})">Add to
                                    playlist</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${desired_songs[i].song_id}">Add to queue</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${desired_songs[i].song_id}">Next to play</a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${desired_songs[i].song_id}">Play</a></li>
                        </ul>
                    </li>
                </ul>
            </div>`;
            }
            else
            {
                document.getElementById("song-div2").innerHTML += `<div class="list__item" data-song-id="${desired_songs[i].song_id}" data-song-name="${desired_songs[i].title}" data-song-artist="${match.name}"
                data-song-album="${desired_songs[i].album_id}" data-song-url="../Admin/${desired_songs[i].file_path}" data-song-cover="images/cover/small/${file}">
                <div class="list__cover"><img src="images/cover/small/${file}" alt="${desired_songs[i].title}">
                    <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${desired_songs[i].song_id}"
                        aria-label="Play pause" onclick="addCount(${desired_songs[i].song_id});addRecent(${desired_songs[i].song_id});"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a>
                </div>
                <div class="list__content"><a href="song-details.html?songId=${desired_songs[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${desired_songs[i].title}</a>
                    <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${desired_songs[i].artist_id}" onclick="artistDetails()">${match.name}</a></p>
                </div>
                <ul class="list__option">
                    <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                            data-favorite-id="${desired_songs[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${desired_songs[i].song_id}" onclick="favClickedSong(${desired_songs[i].song_id})" style="color:red;"></i></a></li>
                    <li>01:14</li>
                    <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                            data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${desired_songs[i].song_id}" onclick="fillPlaylistModal(${desired_songs[i].song_id})">Add to
                                    playlist</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${desired_songs[i].song_id}">Add to queue</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${desired_songs[i].song_id}">Next to play</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button">Share</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${desired_songs[i].song_id}">Play</a></li>
                        </ul>
                    </li>
                </ul>
            </div>`;
            }
        }

    }
    else {
        setTimeout(musics, 50);
    }

}




function albums() {
    fetchFavAlbum();
    storedData = localStorage.getItem('key');
    parsedData = JSON.parse(storedData);
    if (document.getElementById('album-filter') && document.getElementById('album-div1') && document.getElementById('album-div2')) {
        document.getElementById("album-div1").innerHTML = ``;
        document.getElementById("album-div2").innerHTML = ``;

        let sortingOption = document.getElementById("album-filter").value;
        let desired_albums = parsedData.totalalbums.slice(); // Copy the array to avoid modifying the original

        // Sort the songs based on the selected option
        if (sortingOption === 'Z to A') {
            // Sort by play count in descending order
            desired_albums.sort((a, b) => b.title.localeCompare(a.title));

        } else if (sortingOption === 'A to Z') {
            // Sort by title in ascending order
            desired_albums.sort((a, b) => a.title.localeCompare(b.title));
        }

        document.getElementById("album-count").innerText=`${desired_albums.length} Albums in the list`;

        for(i=0;i<desired_albums.length;i++)
        {
            // The artist_id you want to match
            let desArtistId = desired_albums[i].artist_id; // Replace with the desired artist_id
            // Find the artist with the matching artist_id
            let match = parsedData.totalartists.find(artist => artist.artist_id === desArtistId);

            if(i%2==0)
            {
                document.getElementById("album-div1").innerHTML += `<div class="list__item"><a href="album-details.html?albumId=${desired_albums[i].album_id}" class="list__cover"><img src="${desired_albums[i].thumbnail}"
                alt="${desired_albums[i].title}" onclick="albumDetails()"></a>
        <div class="list__content"><a href="album-details.html?albumId=${desired_albums[i].album_id}"
                class="list__title text-truncate" onclick="albumDetails()">${desired_albums[i].title}</a>
            <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${match.artist_id}" onclick="artistDetails()">${match.name}</a></p>
        </div>
        <ul class="list__option">
            <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                    data-favorite-id="100"><i class="ri-heart-line" id="heartIcon${desired_albums[i].album_id}" onclick="favClickedAlbum(${desired_albums[i].album_id})" style="color:red;"></i></a></li>
        </ul>
    </div>`;
            }
            else
            {
                document.getElementById("album-div2").innerHTML += `<div class="list__item"><a href="album-details.html?albumId=${desired_albums[i].album_id}" class="list__cover"><img src="${desired_albums[i].thumbnail}"
                alt="${desired_albums[i].title}" onclick="albumDetails()"></a>
        <div class="list__content"><a href="album-details.html?albumId=${desired_albums[i].album_id}"
                class="list__title text-truncate" onclick="albumDetails()">${desired_albums[i].title}</a>
            <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${match.artist_id}" onclick="artistDetails()">${match.name}</a></p>
        </div>
        <ul class="list__option">
            <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                    data-favorite-id="100"><i class="ri-heart-line" id="heartIcon${desired_albums[i].album_id}" onclick="favClickedAlbum(${desired_albums[i].album_id})" style="color:red;"></i></a></li>
        </ul>
    </div>`;
            }
        }

    }
    else {
        setTimeout(albums, 50);
    }

}



function artists() {
    storedData = localStorage.getItem('key');
    parsedData = JSON.parse(storedData);
    if (document.getElementById('artist-div')) {
        document.getElementById("artist-div").innerHTML = ``;

        let desired_artists = parsedData.totalartists.slice(); // Copy the array to avoid modifying the original

        for (i = 0; i < desired_artists.length; i++) {
            let org = desired_artists[i].thumbnail;

            // Using the split method to separate the path by '/'
            let part = org.split('/');

            // Accessing the last part of the array to get the filename
            let file = part[part.length - 1];
            document.getElementById("artist-div").innerHTML += `<div class="col-6 col-xl-2 col-md-3 col-sm-4">
            <a href="artist-details.html?artistId=${desired_artists[i].artist_id}" class="cover cover--round" onclick="artistDetails()">
              <div class="cover__image">
                <img src="images/artists/${file}" alt="${desired_artists[i].name}" />
              </div>
              <div class="cover__foot">
                <span class="cover__title text-truncate">${desired_artists[i].name}</span>
              </div>
            </a>
          </div>
          `;
        }
    }
    else {
        setTimeout(artists, 50);
    }

}



function recentHistory() {
    storedData = localStorage.getItem('key');
    parsedData = JSON.parse(storedData);
    if (document.getElementById('recent-1') && document.getElementById('recent-2')) {
        document.getElementById("recent-1").innerHTML = '';
        document.getElementById("recent-2").innerHTML = '';

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'index.php?action=getRecentsAll', true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                console.log(response);
                fetchFavSong();

                // Create a mapping between song_id and the song object
                const songIdMap = new Map(parsedData.totalsongs.map(song => [song.song_id, song]));

                // Use the response array to filter and reconstruct the array in the desired order
                const filteredSongsInOrder = response.map(responseSong => songIdMap.get(responseSong.song_id));

                console.log(filteredSongsInOrder);

                for (let i = 0; i < filteredSongsInOrder.length; i++) {
                    const org = filteredSongsInOrder[i].thumbnail;

                    // Using the split method to separate the path by '/'
                    const part = org.split('/');

                    // Accessing the last part of the array to get the filename
                    const file = part[part.length - 1];

                    // The artist_id you want to match
                    const desArtistId = filteredSongsInOrder[i].artist_id; // Replace with the desired artist_id

                    // Find the artist with the matching artist_id
                    const match = parsedData.totalartists.find(artist => artist.artist_id === desArtistId);

                    var originalString = filteredSongsInOrder[i].duration;
                    var extractedTime = originalString.substring(0, 5);

                    if (i % 2 == 0) {

                        document.getElementById("recent-1").innerHTML += `<div class="list__item" data-song-id="${filteredSongsInOrder[i].song_id}" data-song-name="${filteredSongsInOrder[i].title}" data-song-artist="${match.name}"
  data-song-album="${filteredSongsInOrder[i].album_id}" data-song-url="../Admin/${filteredSongsInOrder[i].file_path}" data-song-cover="images/cover/small/${file}">
  <div class="list__cover"><img src="images/cover/small/${file}" alt="${filteredSongsInOrder[i].title}">
    <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${filteredSongsInOrder[i].song_id}"
      aria-label="Play pause" onclick="addCount(${filteredSongsInOrder[i].song_id});addRecent(${filteredSongsInOrder[i].song_id});"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a>
  </div>
  <div class="list__content"><a href="song-details.html?songId=${filteredSongsInOrder[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${filteredSongsInOrder[i].title}</a>
    <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${filteredSongsInOrder[i].artist_id}" artistDetails()>${match.name}</a></p>
  </div>
  <ul class="list__option">
    <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite" data-favorite-id="${filteredSongsInOrder[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${filteredSongsInOrder[i].song_id}" onclick="favClickedSong(${filteredSongsInOrder[i].song_id})" style="color:red;"></i></a></li>
    <li>${extractedTime}</li>
    <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
        data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i class="ri-more-fill"></i></a>
      <ul class="dropdown-menu dropdown-menu-sm">
        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${filteredSongsInOrder[i].song_id}" onclick="fillPlaylistModal(${filteredSongsInOrder[i].song_id})">Add to playlist</a>
        </li>
        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${filteredSongsInOrder[i].song_id}">Add to queue</a></li>
        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${filteredSongsInOrder[i].song_id}">Next to play</a></li>
        <li class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${filteredSongsInOrder[i].song_id}">Play</a></li>
      </ul>
    </li>
  </ul>
</div>`;
                    }
                    else {
                        document.getElementById("recent-2").innerHTML += `<div class="list__item" data-song-id="${filteredSongsInOrder[i].song_id}" data-song-name="${filteredSongsInOrder[i].title}" data-song-artist="${match.name}"
  data-song-album="${filteredSongsInOrder[i].album_id}" data-song-url="../Admin/${filteredSongsInOrder[i].file_path}" data-song-cover="images/cover/small/${file}">
  <div class="list__cover"><img src="images/cover/small/${file}" alt="${filteredSongsInOrder[i].title}">
    <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${filteredSongsInOrder[i].song_id}"
      aria-label="Play pause" onclick="addCount(${filteredSongsInOrder[i].song_id});addRecent(${filteredSongsInOrder[i].song_id});"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a>
  </div>
  <div class="list__content"><a href="song-details.html?songId=${filteredSongsInOrder[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${filteredSongsInOrder[i].title}</a>
    <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${filteredSongsInOrder[i].artist_id}" artistDetails()>${match.name}</a></p>
  </div>
  <ul class="list__option">
    <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite" data-favorite-id="${filteredSongsInOrder[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${filteredSongsInOrder[i].song_id}" onclick="favClickedSong(${filteredSongsInOrder[i].song_id})" style="color:red;"></i></a></li>
    <li>${extractedTime}</li>
    <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
        data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i class="ri-more-fill"></i></a>
      <ul class="dropdown-menu dropdown-menu-sm">
        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${filteredSongsInOrder[i].song_id}" onclick="fillPlaylistModal(${filteredSongsInOrder[i].song_id})">Add to playlist</a>
        </li>
        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${filteredSongsInOrder[i].song_id}">Add to queue</a></li>
        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${filteredSongsInOrder[i].song_id}">Next to play</a></li>
        <li class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${filteredSongsInOrder[i].song_id}">Play</a></li>
      </ul>
    </li>
  </ul>
</div>`;
                    }
                }
            }
            
        };
        xhr.send();
    }
    else {
        setTimeout(recentHistory, 50);
}
}



function historyDelete() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=historyDelete', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var recentDelete = JSON.parse(xhr.responseText);
            console.log(recentDelete);
            recentHistory();
        }
    };

    xhr.send();
}



function checkAuthentication() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=checkAuthentication', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);

            // Check the 'authenticated' property in the response
            if (response.authenticated) {
                // User is authenticated, perform necessary actions
                console.log('User is authenticated');
                document.getElementById("username").innerText=response.first;
                document.getElementById("fullname").innerText=`${response.first} ${response.last}`;
                login=response.authenticated;

            } else {
                login=response.authenticated;
                // User is not authenticated, perform necessary actions (e.g., redirect to login page)
                console.log('User is not authenticated');
                // window.location.href = 'home.php'; // Replace with your login page URL
            }
        }
    };

    xhr.send();
}



function logout()
{
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=logout', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);
            localStorage.removeItem('key');
            window.location.href='home.php';
        }
    };

    xhr.send();
}



function favClickedAlbum(albumId) {

    if (login) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'index.php?action=favAlbum&albumId='+albumId, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                console.log(response);

                var heart = document.getElementById("heartIcon" +albumId);
                if(response.result=='added')
                {
                    heart.classList.remove("ri-heart-line");
                    heart.classList.add("ri-heart-fill");
                }
                else
                { 
                    heart.classList.remove("ri-heart-fill");
                    heart.classList.add("ri-heart-line");
                }
                fetchFavAlbum();
            }
        };

        xhr.send();
    }
    else {
        window.location.href = "login.html";
    }

}



function fetchFavAlbum() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=getAllFavAlbum', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            favAlbum = JSON.parse(xhr.responseText);
            console.log(favAlbum);

            // Check if favAlbum is not empty
            if (favAlbum.length > 0) {
                for (var i = 0; i < favAlbum.length; i++) {
                    var heart = document.getElementById("heartIcon" + favAlbum[i].album_id);

                    if (heart !== null) {
                        heart.classList.remove("ri-heart-line");
                        heart.classList.add("ri-heart-fill");
                    } else {
                        continue;
                    }

                }
            } else {
                // No favorite albums, so unfill all heart icons
                var allHeartIcons = document.querySelectorAll("[id^='heartIcon']");
                allHeartIcons.forEach(function (heart) {
                    heart.classList.remove("ri-heart-fill");
                    heart.classList.add("ri-heart-line");
                });
            }
        }
    };

    xhr.send();
}



function favClickedSong(songId) {

    if (login) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'index.php?action=favRecentSix&songId='+songId, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                console.log(response);

                var heart = document.getElementById("heartIconRecent" +songId);
                if(response.result=='added')
                {
                    heart.classList.remove("ri-heart-line");
                    heart.classList.add("ri-heart-fill");
                }
                else
                { 
                    heart.classList.remove("ri-heart-fill");
                    heart.classList.add("ri-heart-line");
                }
                fetchFavSong();
            }
        };

        xhr.send();
    }
    else {
        window.location.href = "login.html";
    }

}



function fetchFavSong() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=getAllFavRecent', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            favSong = JSON.parse(xhr.responseText);
            console.log(favSong);

            // Check if favAlbum is not empty
            if (favSong.length > 0) {
                for (var i = 0; i < favSong.length; i++) {

                    var heart = document.getElementById("heartIconRecent" + favSong[i].song_id);

                    if (heart !== null) {
                        heart.classList.remove("ri-heart-line");
                        heart.classList.add("ri-heart-fill");
                    } else {
                        continue;
                    }

                }
            } else {
                // No favorite albums, so unfill all heart icons
                var allHeartIcons = document.querySelectorAll("[id^='heartIconRecent']");
                allHeartIcons.forEach(function (heart) {
                    heart.classList.remove("ri-heart-fill");
                    heart.classList.add("ri-heart-line");
                });
            }
        }
    };

    xhr.send();
}



function favourites() {
    storedData = localStorage.getItem('key');
    parsedData = JSON.parse(storedData);
    if (document.getElementById("song-1") && document.getElementById("song-2") && document.getElementById("fav-album")) {
        document.getElementById("song-1").innerHTML = ``;
        document.getElementById("song-2").innerHTML = ``;
        document.getElementById("fav-album").innerHTML = ``;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'index.php?action=favourites', true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                allFavourites = JSON.parse(xhr.responseText);

                // Filter albums based on album array
                var album = parsedData.totalalbums.filter(albumObj =>
                    allFavourites.favalbums.some(albumItem => albumItem.album_id === albumObj.album_id)
                );

                // Filter songs based on song array
                var song = parsedData.totalsongs.filter(songObj =>
                    allFavourites.favsongs.some(songItem => songItem.song_id === songObj.song_id)
                );

                console.log('Filtered Albums:', album);
                console.log('Filtered Songs:', song);



                fetchFavSong();
                fetchFavAlbum();

                for (i = 0; i < song.length; i++) {
                    const org = song[i].thumbnail;

                    // Using the split method to separate the path by '/'
                    const part = org.split('/');

                    // Accessing the last part of the array to get the filename
                    const file = part[part.length - 1];
                    let art = parsedData.totalartists.find(artist => artist.artist_id == song[i].artist_id);

                    let originalString = song[i].duration;
                    let extractedTime = originalString.substring(0, 5);
                    if (i % 2 == 0) {
                        document.getElementById("song-1").innerHTML += `<div class="list__item" data-song-id="${song[i].song_id}" data-song-name="${song[i].title}" data-song-artist="${art.name}"
                    data-song-album="${song[i].song_id}" data-song-url="../Admin/${song[i].file_path}" data-song-cover="images/cover/small/${file}">
                    <div class="list__cover"><img src="images/cover/small/${file}" alt="${song[i].title}">
                        <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${song[i].song_id}"
                            aria-label="Play pause" onclick="addCount(${song[i].song_id});addRecent(${song[i].song_id});"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a>
                    </div>
                    <div class="list__content"><a href="song-details.html?songId=${song[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${song[i].title}</a>
                        <p class="list__subtitle text-truncate"><a href="javascript:void(0);">${art.name}</a></p>
                    </div>
                    <ul class="list__option">
                        <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                                data-favorite-id="${song[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${song[i].song_id}" onclick="favClickedSong(${song[i].song_id})" style="color:red;"></i></a></li>
                        <li>${extractedTime}</li>
                        <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                                data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                    class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${song[i].song_id}" onclick="fillPlaylistModal(${song[i].song_id})">Add to
                                        playlist</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${song[i].song_id}">Add to queue</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${song[i].song_id}">Next to play</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${song[i].song_id}">Play</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>`;
                    }
                    else {
                        document.getElementById("song-2").innerHTML += `<div class="list__item" data-song-id="${song[i].song_id}" data-song-name="${song[i].title}" data-song-artist="${art.name}"
                    data-song-album="${song[i].song_id}" data-song-url="../Admin/${song[i].file_path}" data-song-cover="images/cover/small/${file}">
                    <div class="list__cover"><img src="images/cover/small/${file}" alt="${song[i].title}">
                        <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${song[i].song_id}"
                            aria-label="Play pause" onclick="addCount(${song[i].song_id});addRecent(${song[i].song_id});"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a>
                    </div>
                    <div class="list__content"><a href="song-details.html?songId=${song[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${song[i].title}</a>
                        <p class="list__subtitle text-truncate"><a href="javascript:void(0);">${art.name}</a></p>
                    </div>
                    <ul class="list__option">
                        <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                                data-favorite-id="${song[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${song[i].song_id}" onclick="favClickedSong(${song[i].song_id})" style="color:red;"></i></a></li>
                        <li>${extractedTime}</li>
                        <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                                data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                    class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${song[i].song_id}" onclick="fillPlaylistModal(${song[i].song_id})">Add to
                                        playlist</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${song[i].song_id}">Add to queue</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${song[i].song_id}">Next to play</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${song[i].song_id}">Play</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>`;
                    }
                }
                


                for (i = 0; i < album.length; i++) {
                    let art = parsedData.totalartists.find(artist => artist.artist_id == album[i].artist_id);
                    document.getElementById("fav-album").innerHTML += `<div class="col-6 col-xl-2 col-md-3 col-sm-4">
                    <div class="cover cover--round">
                        <div class="cover__head">
                            <ul class="cover__label d-flex">
                                <li><span class="badge rounded-pill bg-white"><i class="ri-heart-line" id="heartIcon${album[i].album_id}" onclick="favClickedAlbum(${album[i].album_id})" style="color:red;"></i></span></li>
                            </ul>
                        </div><a href="album-details.html?albumId=${album[i].album_id}" class="cover__image"><img src="${album[i].thumbnail}" alt="${album[i].title}" onclick="albumDetails()"></a>
                        <div class="cover__foot"><a href="album-details.html?albumId=${album[i].album_id}" class="cover__title text-truncate" onclick="albumDetails()">${album[i].title}</a>
                            <p class="cover__subtitle text-truncate"><a href="javascript:void(0);">${art.name}</a></p>
                        </div>
                    </div>
                </div>`;
                }

            }
        };

        xhr.send();

    } else {
        setTimeout(favourites, 50);
    }

}



function openCreatePlaylistModal() {

    if (login) {
        $("#createPlaylistModal").modal('show');
    }
    else {
        window.location.href = "login.html";
    }

}



function createPlaylist() {
    let form = document.getElementById("createPlaylistForm");
    let formData = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=createPlaylist', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);
            $("#createPlaylistModal").modal('hide');
            form.reset();
        }
    };

    xhr.send(formData);

}



function showPlaylistModal() {
    $("#showPlaylistModal").modal('show');

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=showPlaylist', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);

            // Create new DataTable
            var table = document.createElement('table');
            table.id = 'datatablesSimple';
            table.className = 'display';

            // Create table header
            var thead = document.createElement('thead');
            var headerRow = document.createElement('tr');
            headerRow.innerHTML = '<th>Title</th><th>Delete</th>';
            thead.appendChild(headerRow);
            table.appendChild(thead);

            // Create table body
            var tbody = document.createElement('tbody');
            for (let i = 0; i < response.length; i++) {
                var row = document.createElement('tr');
                row.setAttribute('data-id', response[i].playlist_id); // Set the playlistId as a data attribute
                row.innerHTML = `<td><a href="playlist-details.html?playlistId=${response[i].playlist_id}" onclick="playlistDetails()">${response[i].title}</a></td>
                    <td><i class="fa-solid fa-trash fa-xl" style="color: red" onclick="deletePlaylist(${response[i].playlist_id})"></i></td>`;
                tbody.appendChild(row);
            }
            table.appendChild(tbody);

            // Append the table to the modal body
            var modalBody = document.getElementById('showPlaylistModalBody');
            modalBody.innerHTML = '';
            modalBody.appendChild(table);

            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        }
    };

    xhr.send();
}




function deletePlaylist(playlistId) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=deletePlaylist&playlistId=' + playlistId, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);
            showPlaylistModal();
        }
    }

    xhr.send();
}




function playlistDetails() {
    storedData = localStorage.getItem('key');
    parsedData = JSON.parse(storedData);
    $("#showPlaylistModal").modal('hide');

    if (document.getElementById('songs-all') && document.getElementById("song-1") && document.getElementById("song-2")) {
        document.getElementById("song-1").innerHTML = ``;
        document.getElementById("song-2").innerHTML = ``;

        // Get the current URL
        let currentUrl = window.location.href;

        // Create a URL object from the URL string
        let url = new URL(currentUrl);

        // Get the value of the 'songId' parameter
        let playlistId = url.searchParams.get('playlistId');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?action=getPlaylistSongs&playId=' + playlistId, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                console.log(response);

                let playlist=parsedData.totalplaylists.find(song => song.playlist_id == playlistId);

                let playlist_songs = response.filter(song => song.playlist_id == playlistId);
                // Extract song IDs from the playlist_songs array
                let playlistSongIds = playlist_songs.map(song => song.song_id);

                // Filter the totalsongs array based on the playlistSongIds
                let song = parsedData.totalsongs.filter(song => playlistSongIds.includes(song.song_id));

                console.log(song);

                if(song.length==0)
                {
                    document.getElementById("songs-all").innerHTML = `Playlist Empty`;
                }
                else
                {
                    document.getElementById("songs-all").innerHTML = `${playlist.title}`;
                }

                for (i = 0; i < song.length; i++) {
                    const org = song[i].thumbnail;

                    // Using the split method to separate the path by '/'
                    const part = org.split('/');

                    // Accessing the last part of the array to get the filename
                    const file = part[part.length - 1];
                    let art = parsedData.totalartists.find(artist => artist.artist_id == song[i].artist_id);
                    let originalString = song[i].duration;
                    let extractedTime = originalString.substring(0, 5);
                    if (i % 2 == 0) {
                        document.getElementById("song-1").innerHTML += `<div class="list__item" data-song-id="${song[i].song_id}" data-song-name="${song[i].title}" data-song-artist="${art.name}"
                        data-song-album="${song[i].song_id}" data-song-url="../Admin/${song[i].file_path}" data-song-cover="images/cover/small/${file}">
                        <div class="list__cover"><img src="images/cover/small/${file}" alt="${song[i].title}">
                            <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${song[i].song_id}" aria-label="Play pause" onclick="addCount(${song[i].song_id});addRecent(${song[i].song_id});"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></a>
                        </div>
                        <div class="list__content"><a href="song-details.html?songId=${song[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${song[i].title}</a>
                            <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${art.artist_id}" onclick="artistDetails()">${art.name}</a></p>
                        </div>
                        <ul class="list__option">
                            <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                                    data-favorite-id="${song[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${song[i].song_id}" onclick="favClickedSong(${song[i].song_id})" style="color:red;"></i></a></li>
                            <li>${extractedTime}</li>
                            <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                                    data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                        class="ri-more-fill"></i></a>
                                <ul class="dropdown-menu dropdown-menu-sm">
                                    <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${song[i].song_id}">Add to
                                            playlist</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${song[i].song_id}">Add to queue</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${song[i].song_id}">Next to play</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" role="button">Share</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${song[i].song_id}">Play</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>`;
                    }
                    else {
                        document.getElementById("song-2").innerHTML += `<div class="list__item" data-song-id="${song[i].song_id}" data-song-name="${song[i].title}" data-song-artist="${art.name}"
                    data-song-album="${song[i].song_id}" data-song-url="../Admin/${song[i].file_path}" data-song-cover="images/cover/small/${file}">
                    <div class="list__cover"><img src="images/cover/small/${file}" alt="${song[i].title}">
                    <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${song[i].song_id}"
                        aria-label="Play pause" onclick="addCount(${song[i].song_id});addRecent(${song[i].song_id});"><i class="ri-play-fill icon-play" ></i> <i class="ri-pause-fill icon-pause"></i></a>
                </div>
                    <div class="list__content"><a href="song-details.htmlsongId=${song[i].song_id}" class="list__title text-truncate" onclick="songDetails()">${song[i].title}</a>
                        <p class="list__subtitle text-truncate"><a href="artist-details.html?artistId=${art.artist_id}" onclick="artistDetails()">${art.name}</a></p>
                    </div>
                    <ul class="list__option">
                        <li><a href="javascript:void(0);" role="button" class="d-inline-flex" aria-label="Favorite"
                                data-favorite-id="${song[i].song_id}"><i class="ri-heart-line" id="heartIconRecent${song[i].song_id}" onclick="favClickedSong(${song[i].song_id})" style="color:red;"></i></a></li>
                        <li>${extractedTime}</li>
                        <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);" role="button"
                                data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                    class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-playlist-id="${song[i].song_id}">Add to
                                        playlist</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${song[i].song_id}">Add to queue</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-next-id="${song[i].song_id}">Next to play</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button">Share</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${song[i].song_id}">Play</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>`;
                    }
                    fetchFavSong();
                }
            }
        };

        xhr.send();

    } else {
        setTimeout(playlistDetails, 50);
    }

}




function fillPlaylistModal(song_id)
{
    if(login)
    {
        $("#addToPlaylistModal").modal('show');
        storedData = localStorage.getItem('key');
        parsedData = JSON.parse(storedData);
        console.log(parsedData.totalplaylists);
        document.getElementById("addPlaylist").innerHTML=`<option selected disabled>Select Playlist</option>`
        document.getElementById("hidden_song_id").value=song_id;
        for(i=0;i<parsedData.totalplaylists.length;i++)
        {
            document.getElementById("addPlaylist").innerHTML+=`
            <option value="${parsedData.totalplaylists[i].playlist_id}">${parsedData.totalplaylists[i].title}</option>`;
        }

    }
    else
    {
        window.location.href = "login.html";
    }   
}



function addToPlaylist() {
    let form = document.getElementById("playlistAddForm");
    let formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=addToPlaylist', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);
        }
    }

    xhr.send(formData);
}
