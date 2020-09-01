$(document).ready(function(){
    $(".card").click(function(click){
        var activeCard = $(click.currentTarget);
        var activeVideo = '';
        $('#VideoModal').modal('show');
        var modal = $('#VideoModal')
        $.get('getVideo/' + activeCard.attr('id'), function(data){
            $('#modaltitle').text(data.title)
            $('#videoPlayer').html('<source src="/storage/videos/'+data.id+'/'+data.filename+'" type="video/mp4">');
            $('#about').text(data.about);
        })
    });
});