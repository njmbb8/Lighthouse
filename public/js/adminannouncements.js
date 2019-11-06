$(document).ready(function(){
    var activeCard;
    var activeAnnouncement;

    $(".card").click(function(e){
        if(activeCard){
            $(activeCard[0].children[0]).removeClass('bg-primary');
            $(activeCard[0].children[1]).removeClass('bg-info');
        }
        activeCard = $(e.currentTarget);
        $(activeCard[0].children[0]).addClass('bg-primary');
        $(activeCard[0].children[1]).addClass('bg-info');
        $('#addBtnRow').addClass('d-none');
        $('#updateRemoveBtnRow').removeClass('d-none');

        $.get('getAnnouncement/'+$(activeCard).attr('id'), function(data){
            activeAnnouncement = data;
            $("#announcementID").val(activeAnnouncement.id);
            $("#announcementTitle").val(activeAnnouncement.title);
            $("#announcementText").val(activeAnnouncement.content);
        })
    })

    $(document).click(function(event){
        var isClickInside = activeCard[0].contains(event.target);
        var isFormClicked = event.target.contains($('#announcementForm')[0]);

        if(!isClickInside && isFormClicked){
            $(activeCard[0].children[0]).removeClass('bg-primary');
            $(activeCard[0].children[1]).removeClass('bg-info');
            $("#announcementTitle").val('');
            $("#announcementText").val('');
        }
    })
})