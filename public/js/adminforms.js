$(document).ready(function(){

    var activeCard;
    var activeForm;

    $(".card").click(function(e){
        if(activeCard){
            $(activeCard[0].children[0]).removeClass('bg-primary');
            $(activeCard[0].children[1]).removeClass('bg-info');
        }
        activeCard = $(e.currentTarget);
        $(activeCard[0].children[0]).addClass('bg-primary');
        $(activeCard[0].children[1]).addClass('bg-info');

        $.get('getform/' + activeCard.attr('id'), function(data){
            activeForm = data;
            $("#formID").val(activeForm.id);
            $("#formTitleInput").val(activeForm.title);
            $("#formDescriptionInput").val(activeForm.description);
            $('#addBtnRow').addClass('d-none');
            $('#updateRemoveBtnRow').removeClass('d-none');  
        })
    })

    $(document).click(function(event){
        var isClickInside = activeCard[0].contains(event.target);
        var isFormClicked = event.target.contains($('#formForm')[0]);

        if(!isClickInside && isFormClicked){
            $(activeCard[0].children[0]).removeClass('bg-primary');
            $(activeCard[0].children[1]).removeClass('bg-info');
            $("#formID").val('');
            $("#formTitleInput").val('');
            $("#formDescriptionInput").val('');
            $('#addBtnRow').removeClass('d-none');
            $('#updateRemoveBtnRow').addClass('d-none');
        }
    })
})