var allData;


window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
});




function initializeTable() {
    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
}



function fetchAll() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=fetchAll', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            allData = JSON.parse(xhr.responseText);
            document.getElementById("total-songs").innerText = "Total Songs: " + allData.totalsongs.length;
            document.getElementById("total-users").innerText = "Total Users: " + allData.totalusers.length;


            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Pie Chart Example
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ["Songs", "Users", "Artists", "Genres"],
                    datasets: [{
                        data: [allData.totalsongs.length, allData.totalusers.length, allData.totalartists.length, allData.totalgenres.length],
                        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
                    }],
                },
            });


            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Bar Chart Example
            var ctx = document.getElementById("myBarChart");
            var myLineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Songs", "Users", "Artists", "Genre"],
                    datasets: [{
                        label: "Revenue",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: [allData.totalsongs.length, allData.totalusers.length, allData.totalartists.length, allData.totalgenres.length],
                    }],
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 5,
                                suggestedMax: 50,
                                maxTicksLimit: 6
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                    },
                    legend: {
                        display: false
                    }
                }
            });
        }
    };

    xhr.send();
}




function dashboard() {
    document.getElementById("content-div").innerHTML = `<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body"><i class="fa-solid fa-music fa-2xl me-3" style="color: #ffffff;"></i>Songs
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#" onclick="songs()">View Details</a>
                    <div class="small text-white" id="total-songs">10245 Songs</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body"><i class="fa-solid fa-users fa-2xl me-3" style="color: #ffffff;"></i>Users
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#" onclick="users()">View Details</a>
                    <div class="small text-white" id="total-users">12567 Users</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Bar Chart
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Pie Chart
                </div>
                <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
            </div>
        </div>
    </div>

    <div class="card mb-4 mt-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Total Songs
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Artists</th>
                        <th>Duration</th>
                        <th>Audio</th>
                        <th>Genre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table rows will be added here dynamically -->
                </tbody>
            </table>
        </div>
    </div>
</div>`;
    fetchAll();
    getAllSongs();
}




function songs() {
    document.getElementById("content-div").innerHTML = `<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Songs</h1>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body"><i class="fa-solid fa-music fa-2xl me-3"
                        style="color: #ffffff;"></i>Add a Song</div>
                <div class="card-footer d-flex align-items-center justify-content-between" onclick="getAllArtists(); getAllGenres()">
                    <a class="small text-white stretched-link" href="#" data-bs-toggle="modal"
                        data-bs-target="#exampleModal2">Click Here</a>
                    <div class="small text-white">Total Songs: ${allData.totalsongs.length}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body"><i class="fa-solid fa-user-tie fa-2xl me-3" style="color: #ffffff;">
                </i>Add an Artist</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#" data-bs-toggle="modal"
                        data-bs-target="#exampleModal3">Click Here</a>
                    <div class="small text-white">Total Artists: ${allData.totalartists.length}</div>
                </div>
            </div>
        </div><div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body"><i class="fa-solid fa-list fa-2xl me-3" style="color: #ffffff;"></i>Add a Genre</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#" data-bs-toggle="modal"
                    data-bs-target="#addGenreModal">Click Here</a>
                <div class="small text-white">Total Genres: ${allData.totalgenres.length}</div>
            </div>
        </div>
    </div>

    </div>
    <div class="card mb-4 mt-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Total Songs
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Artists</th>
                        <th>Duration</th>
                        <th>Audio</th>
                        <th>Genre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <!-- Table rows will be added here dynamically -->
                </tbody>
            </table>
        </div>
    </div>
</div>`;
    getAllSongs();
}




function users() {
    document.getElementById("content-div").innerHTML = `<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Users</h1>
    <div class="card mb-4 mt-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Total Users
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- table content -->
                </tbody>
            </table>
        </div>
    </div>
</div>`;
    getAllUsers();
}




function addArtist() {
    var name = document.getElementById('artistName').value;
    var thumbnail = document.getElementById('artistThumbnail').files[0];

    var formData = new FormData();
    formData.append('name', name);
    formData.append('thumbnail', thumbnail);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=addArtist', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);

            if (response.result === true) {
                alert('Artist added successfully');
                $('#exampleModal3').modal('hide');
                document.getElementById("addArtistForm").reset();
                songs();

            } else {
                alert('Error adding artist: ' + response.result);
            }
        }
    };

    xhr.send(formData);
}



function addGenre() {
    var name = document.getElementById('genreName').value;

    var formData = new FormData();
    formData.append('genrename', name);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=addGenre', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);

            if (response.result === true) {
                alert('Genre added successfully');
                $('#addGenreModal').modal('hide');
                document.getElementById('genreName').value = '';
                songs();

            } else {
                alert('Error adding artist: ' + response.result);
            }
        }
    };

    xhr.send(formData);
}




function addSong() {
    title = document.getElementById('title').value;
    artist = document.getElementById('artistSelect').value;
    thumbnail = document.getElementById('formFileThumbnail').files[0];
    audio = document.getElementById('formFileAudio').files[0];
    genre = document.getElementById('genreSelect').value;


    var formData = new FormData();
    formData.append('title', title);
    formData.append('artist', artist);
    formData.append('thumbnail', thumbnail);
    formData.append('audio', audio);
    formData.append('genre', genre);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=addSong', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);

            if (response.result === true) {
                alert('Song added successfully');
                $('#exampleModal2').modal('hide');
                document.getElementById("addSongForm").reset();
                getAllSongs();

            } else {
                alert('Error adding song: ' + response.result);
            }
        }
    };

    xhr.send(formData);
}




function getAllArtists() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=getAllArtists', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);

            if (response.result) {
                // Assuming the result is an array of artists
                var artists = response.result;

                // Process the fetched artists (you can update the UI, etc.)
                // Get the select element
                var selectElement = document.getElementById('artistSelect');
                selectElement.innerHTML='<option selected disabled>Select artist</option>';

                // Loop through the array of artists and create options
                artists.forEach(function (artist) {
                    // Create an option element
                    var option = document.createElement('option');

                    // Set the value and text of the option (you can customize this based on your needs)
                    option.value = artist.artist_id;
                    option.text = artist.name;

                    // Append the option to the select element
                    selectElement.appendChild(option);
                });
            } else {
                // Handle the error
                console.error('Error fetching artists: ' + response.error);
            }
        }
    };

    xhr.send();
}




function getAllGenres() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=getAllGenres', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);

            if (response.result) {
                // Assuming the result is an array of artists
                var genres = response.result;

                // Process the fetched genres (you can update the UI, etc.)
                // Get the select element
                var selectElement = document.getElementById('genreSelect');
                selectElement.innerHTML='<option selected disabled>Select genre</option>';

                // Loop through the array of artists and create options
                genres.forEach(function (genre) {
                    // Create an option element
                    var option = document.createElement('option');

                    // Set the value and text of the option (you can customize this based on your needs)
                    option.value = genre.genre_id;
                    option.text = genre.name;

                    // Append the option to the select element
                    selectElement.appendChild(option);
                });
            } else {
                // Handle the error
                console.error('Error fetching artists: ' + response.error);
            }
        }
    };

    xhr.send();
}




function getAllSongs() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=getAllSongs', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            jsonData = JSON.parse(xhr.responseText);

            var tableBody = document.getElementsByTagName("tbody")[0];

            // Clear existing rows in the table body
            tableBody.innerHTML = '';

            // Iterate through songs and append rows to the table
            jsonData.songs.forEach(function (song) {
                var row = tableBody.insertRow();
                row.insertCell(0).innerText = song.song_id;
                var thumbnailCell = row.insertCell(1);
                thumbnailCell.innerHTML = '<img src="' + song.thumbnail + '" alt="Thumbnail" style="width: 50px; height: 50px;">';
                row.insertCell(2).innerText = song.title;

                // Lookup artist name based on artist_id
                var artist = jsonData.artists.find(a => a.artist_id === song.artist_id);
                row.insertCell(3).innerText = artist ? artist.name : '';

                row.insertCell(4).innerText = song.duration;

                // Assuming song.audio is the path to the audio file
                var audioCell = row.insertCell(5);
                audioCell.innerText = song.file_path;

                // Lookup genre name based on genre_id
                var genre = jsonData.genres.find(g => g.genre_id === song.genre_id);
                row.insertCell(6).innerText = genre ? genre.name : '';

                var actionsCell = row.insertCell(7);
                actionsCell.innerHTML = `<div class="d-flex gap-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="fillEditModalSongs(${song.song_id})"><i class="fa-solid fa-pen-to-square fa-lg" style="color: #ffffff;"></i></button><button type="button" class="btn btn-danger" onclick="openDeleteSongModal(${song.song_id})"><i class="fa-solid fa-trash fa-lg" style="color: #ffffff;"></i></button></div>`;
            });
            initializeTable();
        }
    };

    xhr.send();
}




function fillEditModalSongs(songId) {
    var song = jsonData.songs.find(s => s.song_id === songId);

    // Fill modal fields with song details
    document.getElementById('editTitle').value = song.title;

    // Populate artist select dropdown
    var artistSelect = document.getElementById('editArtistSelect');
    artistSelect.innerHTML = ''; // Clear existing options

    jsonData.artists.forEach(artist => {
        var option = document.createElement('option');
        option.value = artist.artist_id;
        option.text = artist.name;
        if (artist.artist_id === song.artist_id) {
            option.selected = true; // Select the artist of the song
        }
        artistSelect.add(option);
    });

    // Populate genre select dropdown
    var genreSelect = document.getElementById('editGenreSelect');
    genreSelect.innerHTML = ''; // Clear existing options

    jsonData.genres.forEach(genre => {
        var option = document.createElement('option');
        option.value = genre.genre_id;
        option.text = genre.name;
        if (genre.genre_id === song.genre_id) {
            option.selected = true; // Select the genre of the song
        }
        genreSelect.add(option);
    });
    document.getElementById("editHidden").value = songId;
    document.getElementById("hidden-thumbnail").value=song.thumbnail;
    document.getElementById("hidden-audio").value=song.file_path;
    document.getElementById("hidden-duration").value=song.duration;
}




function saveEditSong() {
    title = document.getElementById('editTitle').value;
    artist = document.getElementById('editArtistSelect').value;
    thumbnail = document.getElementById('editFormFileThumbnail').files[0];
    audio = document.getElementById('editFormFileAudio').files[0];
    genre = document.getElementById('editGenreSelect').value;
    hidden = document.getElementById('editHidden').value;
    hidden_thumbnail=document.getElementById('hidden-thumbnail').value;
    hidden_audio=document.getElementById('hidden-audio').value;
    hidden_duration=document.getElementById('hidden-duration').value;

    var formData = new FormData();
    formData.append('editTitle', title);
    formData.append('editArtistSelect', artist);
    formData.append('editFormFileThumbnail', thumbnail);
    formData.append('editFormFileAudio', audio);
    formData.append('editGenreSelect', genre);
    formData.append('songid', hidden);
    formData.append('thumpath', hidden_thumbnail);
    formData.append('audpath', hidden_audio);
    formData.append('audduration', hidden_duration);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=saveChangesSong', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);

            if (response.result === true) {
                alert('Song updated successfully');
                document.getElementById('editTitle').value='';
                document.getElementById('editArtistSelect').value='';
                document.getElementById('editFormFileThumbnail').value='';
                document.getElementById('editFormFileAudio').value=''
                document.getElementById('editGenreSelect').value='';
                document.getElementById('editHidden').value='';
                document.getElementById('hidden-thumbnail').value='';
                document.getElementById('hidden-audio').value='';
                document.getElementById('hidden-duration').value='';

                // Close the modal
                $('#exampleModal').modal('hide');
                getAllSongs();
            } else {
                alert('Error adding song: ' + response.result);
            }
        }
    };

    xhr.send(formData);
}




function openDeleteSongModal(Id) {
    $("#exampleModal1").modal('show');
    document.getElementById('deleteHidden').value = Id;
}




function deleteSong() {
    delhidden = document.getElementById('deleteHidden').value;

    var formData = new FormData();
    formData.append('hideId', delhidden);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=deleteSong', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);

            if (response.result === true) {
                alert('Song deleted successfully');
                // Clear form fields
                document.getElementById('deleteHidden').value = '';

                // Close the modal
                $('#exampleModal1').modal('hide');
                getAllSongs();
            } else {
                alert('Error deleting song: ' + response.result);
            }
        }
    };

    xhr.send(formData);
}




function getAllUsers() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?action=getAllUsers', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            userData = JSON.parse(xhr.responseText);
            var tableBody = document.getElementsByTagName("tbody")[0];

            // Clear existing rows in the table body
            tableBody.innerHTML = '';

            // Iterate through songs and append rows to the table
            userData.users.forEach(function (user) {
                var row = tableBody.insertRow();
                row.insertCell(0).innerText = user.user_id;
                row.insertCell(1).innerText = user.first_name;
                row.insertCell(2).innerText = user.last_name;
                row.insertCell(3).innerText = user.username;
                row.insertCell(4).innerText = user.email;
                row.insertCell(5).innerText = user.created_at;

                var actionsCell = row.insertCell(6);
                actionsCell.innerHTML = `<div class="d-flex gap-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalUser" onclick="fillEditModalUsers(${user.user_id})"><i class="fa-solid fa-pen-to-square fa-lg" style="color: #ffffff;"></i></button><button type="button" class="btn btn-danger" onclick="openDeleteUserModal(${user.user_id})"><i class="fa-solid fa-trash fa-lg" style="color: #ffffff;"></i></button></div>`;
            });
            initializeTable();
        }
    };

    xhr.send();
}




function fillEditModalUsers(userId) {
    var user = userData.users.find(s => s.user_id === userId);

    // Fill modal fields with song details
    document.getElementById('userid').value = user.user_id;
    document.getElementById("firstName").value = user.first_name;
    document.getElementById("LastName").value = user.last_name;
    document.getElementById("userName").value = user.username;
    document.getElementById("userEmail").value = user.email;
}




function saveUserdetail() {
    userid = document.getElementById('userid').value;
    firstname = document.getElementById('firstName').value;
    lastname = document.getElementById('LastName').value;
    username = document.getElementById('userName').value;
    email = document.getElementById('userEmail').value;

    var formData = new FormData();
    formData.append('userid', userid);
    formData.append('firstName', firstname);
    formData.append('LastName', lastname);
    formData.append('userName', username);
    formData.append('userEmail', email);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=saveUserDetail', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);

            if (response.result === true) {
                alert('User updated successfully');
                // Clear form fields
                document.getElementById('userid').value = '';
                document.getElementById('firstName').value = '';
                document.getElementById('LastName').value = '';
                document.getElementById('userName').value = '';
                document.getElementById('userEmail').value = '';

                // Close the modal
                $('#exampleModalUser').modal('hide');
                getAllUsers();
            } else {
                alert('Error adding song: ' + response.result);
            }
        }
    };

    xhr.send(formData);
}



function openDeleteUserModal(Id) {
    $("#deleteUserModal").modal('show');
    document.getElementById('deleteHiddenUser').value = Id;
}



function deleteUser() {
    delhidden = document.getElementById('deleteHiddenUser').value;

    var formData = new FormData();
    formData.append('deleteUserId', delhidden);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=deleteUser', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);

            if (response.result === true) {
                alert('User deleted successfully');
                // Clear form fields
                document.getElementById('deleteHiddenUser').value = '';

                // Close the modal
                $('#deleteUserModal').modal('hide');
                getAllUsers();
            } else {
                alert('Error deleting song: ' + response.result);
            }
        }
    };

    xhr.send(formData);
}
  