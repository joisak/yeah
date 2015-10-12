// on page load
 $(window).load(function() {

    // define api keys
    var apiKey = '2716701230e056321ef598407d964f0b';
    var apiSecret = '2f8cd54971dee66376ae12c9d5832717';
 
    // create a Cache object
    var cache = new LastFMCache();

    // create a LastFM object
    var lastfm = new LastFM({
        apiKey    : apiKey,
        apiSecret : apiSecret,
        cache     : cache
    });

    var topArtistName = '';

    // get weekly artist chart by tag 'trance'
    lastfm.tag.getWeeklyArtistChart({tag: 'hiphop', limit: 6}, {success: function(data){

        // render top weekly artist using 'lastfmTemplateArtists' template
        $('#top_artists').html(
            $('#lastfmTemplateArtists').render(data.weeklyartistchart.artist)
        );

        // define top artist name
        topArtistName = data.weeklyartistchart.artist[0].name;

        // load details of the artist
        lastfm.artist.getInfo({artist: topArtistName}, {success: function(data){

            // render the single artist info using 'lastfmTemplateArtistInfo' template
            $('#top_artist').html(
                $('#lastfmTemplateArtistInfo').render(data.artist)
            );

            // load the artis's top tracks
            lastfm.artist.getTopTracks({artist: topArtistName, limit: 9}, {success: function(data){

                // render the tracks using 'lastfmTemplateTracks' template
                // $('#top_tracks').html(
                //     $('#lastfmTemplateTracks').render(data.toptracks.track)
                // );
            }});

            var artist = 'wu tang clan'; 

     lastfm.artist.getInfo({artist : artist }, {success : function(data){
        console.log(data);
        $('#top_tracks').html(
                    $('#lastfmTemplateTracks').render(data.artist)
                );

       }});


        }, error: function(code, message){
            alert('Error #'+code+': '+message);
        }});
    }});
});