$(document).ready(function(){
    $('.dtpick').datetimepicker();

    var activeCard;
    var activeEvent;

    $('.card').click(function(e){
        if(activeCard){
            $(activeCard[0].children[0]).removeClass('bg-primary');
            $(activeCard[0].children[1]).removeClass('bg-info');
        }
        activeCard = $(e.currentTarget);
        $(activeCard[0].children[0]).addClass('bg-primary');
        $(activeCard[0].children[1]).addClass('bg-info');

        $.get('getevent/'+$(activeCard).attr('id').split('#')[1], function(data){
            activeEvent = data;
            $('#eventID').val(activeEvent.id);
            $('#eventNameInput').val(activeEvent.name);
            $('#locationInput').val(activeEvent.location);
            $('#eventStartPicker').val(activeEvent.eventStart);
            $('#eventEndPicker').val(activeEvent.eventEnd);
            $('#aboutTextArea').val(activeEvent.about);
            $('#addBtnRow').addClass('d-none');
            $('#updateRemoveBtnRow').removeClass('d-none');
        });
    })

    $(document).click(function(event){
        var isClickInside = activeCard[0].contains(event.target);
        var isFormClicked = event.target.contains($('#eventForm')[0]);

        if(!isClickInside && isFormClicked){
            $(activeCard[0].children[0]).removeClass('bg-primary');
            $(activeCard[0].children[1]).removeClass('bg-info');
            $('#eventNameInput').val('');
            $('#locationInput').val('');
            $('#eventStartPicker').val('');
            $('#eventEndPicker').val('');
            $('#aboutTextArea').val('');
            $('#addBtnRow').removeClass('d-none');
            $('#updateRemoveBtnRow').addClass('d-none');
        }
    })
})