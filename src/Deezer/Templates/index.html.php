<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
<div id="dz-root"></div>
<div id="player" style="width:100%;" align="center"></div>
<br/>
<div id="controlers">
    <input type="button" id="loadPlaylistButton" value="Play my VG playlist"/>
</div>
<script>
    var playlistId = 3315958922;
    var playlistData = {};
    var loadPlaylistButton = document.getElementById('loadPlaylistButton');
    function updatePlaylistData(playlistId, callback = undefined) {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if(request.readyState === 4) {
                if(request.status === 200) {
                    playlistData = JSON.parse(request.responseText);
                    if (callback != undefined) {
                        callback();
                    };
                }
            }
        };
        request.open('Get',  '/index.php/proxy/?url=<?php echo urlencode('http://api.deezer.com/playlist/');?>'+playlistId);
        request.send();
    };
    updatePlaylistData(playlistId);
    function loadPlaylist(playlistId) {
        DZ.player.playPlaylist(playlistId);
    };
    loadPlaylistButton.addEventListener('click', function() {
        loadPlaylist(playlistId);
    });
    document.addEventListener('DOMContentLoaded', function() {
        loadPlaylistButton.setAttribute('disabled', 'disabled');
    });
    function onPlayerLoaded() {
        loadPlaylistButton.removeAttribute('disabled');
        DZ.Event.subscribe('track_end', function(arg){
            var originalplaylistData = playlistData;
            updatePlaylistData(playlistId, function (){
                if (originalplaylistData.checksum != playlistData.checksum) {
                    //Reload playlist at the end of each song to reload if playlist has changed
                    loadPlaylist(playlistId);
                }
            });
        });
    };
    window.dzAsyncInit = function() {
        DZ.init({
            appId  : 'testdeezer',
            channelUrl : 'http://developers.deezer.com/examples/channel.php',
            player : {
                container : 'player',
                cover : true,
                playlist : true,
                width : 650,
                height : 300,
                onload : onPlayerLoaded
            }
        });
    };
    (function() {
        var e = document.createElement('script');
        e.src = '//e-cdn-files.deezer.com/js/min/dz.js';
        e.async = true;
        document.getElementById('dz-root').appendChild(e);
    }());
</script>
</body>
</html>
<?php return ob_get_contents();?>
