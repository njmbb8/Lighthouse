$(document).ready(function(){
    var activeUser;
    var activeItem;

    $('.list-group-item').click(function(e){
        if(activeItem){
            $(activeItem).removeClass('bg-primary');
        }
        activeItem = $(e.currentTarget);
        activeItem.addClass('bg-primary');

        $.get('/getUser/'+activeItem.attr('id'), function(data){
            activeUser = data;
            $('#userID').val(activeUser.id);
            $('#formfNameInput').val(activeUser.fname);
            $('#formlNameInput').val(activeUser.lname);
            $('#emailInput').val(activeUser.email);
            $('#passwdInput').val(activeUser.password);
            $('#roleSelect').val(activeUser.role_id);
            $('#addBtnRow').addClass('d-none');
            $('#updateRemoveBtnRow').removeClass('d-none'); 
        })

        $(document).click(function(event){
            var isClickInside = activeItem[0] == event.target;
            var isFormClicked = event.target.contains($('#userForm')[0]);
    
            if(!isClickInside && isFormClicked){
                $(activeItem).removeClass('bg-primary');
                $("#userID").val('');
                $("#formfNameInput").val('');
                $("#formlNameInput").val('');
                $("#emailInput").val('');
                $("#passwdInput").val('');
                $('#roleSelect').val(0);
                $('#addBtnRow').removeClass('d-none');
                $('#updateRemoveBtnRow').addClass('d-none');
            }
        })
    })
})