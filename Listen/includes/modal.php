<!--create Playlist Modal -->
<div class="modal fade" id="createPlaylistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Playlist</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createPlaylistForm" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Title</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="playlistName" required>
                        <div class="invalid-feedback">Please enter a valid playlist name</div>
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