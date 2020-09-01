$(document).ready(function(){

    var activeCard;
    var activeVideo;

    $(".card").click(function(e){
        if(activeCard){
            $(activeCard[0].children[0]).removeClass('bg-primary');
            $(activeCard[0].children[1]).removeClass('bg-info');
        }
        activeCard = $(e.currentTarget);
        $(activeCard[0].children[0]).addClass('bg-primary');
        $(activeCard[0].children[1]).addClass('bg-info');

        $.get('getVideo/' + activeCard.attr('id'), function(data){
            activeVideo = data;
            $("#videoID").val(activeVideo.id);
            $("#videoTitleInput").val(activeVideo.title);
            $("#videoDescriptionInput").val(activeVideo.about);
            $('#addBtnRow').addClass('d-none');
            $('#updateRemoveBtnRow').removeClass('d-none');  
        })

        $("#videoPlayer").removeClass('d-none');

        $("#videoPlayer").html(
            '<source src="/storage/videos/' + activeVideo.id + '/' + activeVideo.filename + '" type="video/mp4">'
        )
    })

    $(document).click(function(event){
        var isClickInside = activeCard[0].contains(event.target);
        var isVideoClicked = event.target.contains($('#Video')[0]);

        if(!isClickInside && isVideoClicked){
            $(activeCard[0].children[0]).removeClass('bg-primary');
            $(activeCard[0].children[1]).removeClass('bg-info');
            $("#VideoID").val('');
            $("#VideoTitleInput").val('');
            $("#VideoDescriptionInput").val('');
            $('#addBtnRow').removeClass('d-none');
            $('#updateRemoveBtnRow').addClass('d-none');
            $('#videoPlayer').addClass('d-none');
            $('#videoPlayer').html('');
        }
    })
})