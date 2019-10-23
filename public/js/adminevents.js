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
            $("#files").html('');
            $('#eventID').val(activeEvent.id);
            $('#eventNameInput').val(activeEvent.name);
            $('#locationInput').val(activeEvent.location);
            $('#eventStartPicker').val(activeEvent.eventStart);
            $('#eventEndPicker').val(activeEvent.eventEnd);
            $('#aboutTextArea').val(activeEvent.about);
            $('#addBtnRow').addClass('d-none');
            $('#updateRemoveBtnRow').removeClass('d-none');  

            if(activeEvent.photos){
                activeEvent.photos.forEach(function(photo, key){
                    $("#files").prepend('<img id="'+ key +'" src="../storage/events/'+ activeEvent.id + '/' + photo +'" class="img-thumbnail eventPhoto" style="max-height: 200px;"/>');
                });

                $('.eventPhoto').click(function(e){
                    if(!$(e.target).hasClass('bg-primary')){
                        $(e.target).addClass('bg-primary');
                        $('#removeImages').val($('#removeImages').val() + activeEvent.photos[$(e.target).attr('id')] + ' ');
                    }
                    else{
                        $(e.target).removeClass('bg-primary');
                        $('#removeImages').val($('#removeImages').val().replace(activeEvent.photos[$(e.target).attr('id')], ''));
                    }
                })
            }
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
            $('#removeImages').empty();
            $('#files').html('');
        }
    })
})