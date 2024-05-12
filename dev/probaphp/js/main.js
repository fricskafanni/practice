function sendAjax(_url, _formId, _callback)
{
    if (!$(_formId).valid())
    {
        alert("You must complete all the fields");
        return;
    }
    
    var $form_inputs = $(_formId).find(':input');
    var form_data = {};
    $form_inputs.each(function () {
        if (this.type == 'checkbox')
            form_data[this.name] = $(this).is(':checked') ? 1 : 0;
        else
            form_data[this.name] = $(this).val();
    });
            
    $.ajax({
        url: _url,
        method: 'POST',
        dataType: 'json',
        data: form_data,
        success: function(data) {
            if (data.error == 1) {
                alert(data.message)
            }else {
                _callback(data);
            }
        }
    });
}

$(document).ready(function(){
    
    // LOGIN PAGE FUNCTIONS
    $("#loginForm").validate({
        ignore: [],
        rules: {
            email: {required: true, email: true},
            password: {required: true}
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
        },
        errorElement: 'small',
        errorClass: 'input-error',
        validClass: 'success'
    });
    
    $("#login").on("click", function(e){
        e.preventDefault();
        
        sendAjax('verification.php', '#loginForm', function (data) {
            console.log(data.message);
            if(data.error == 0){
                if(data.message == 'admin'){
                    window.location.href = "admin.php";
                }else{
                    window.location.href = "user_page.php";
                }
            }
        });
    });
    
    // END LOGIN PAGE FUNCTIONS
    
    // EDIT USER FUNCTIONS
    $("#userDataForm").validate({
        ignore: [],
        rules: {
            email: {required: true, email: true},
            password: {required: true},
            name: {required: true},
            lastname: {required: true},
            dob: {required: true, fecha: true}
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
        },
        errorElement: 'small',
        errorClass: 'input-error',
        validClass: 'success'
    });

    $("#update").on("click", function(e){
        e.preventDefault();        

        sendAjax('update.php', '#userDataForm', function (data) {
            console.log(data.message);
            if(data.error == 0){
                if(data.message == 'admin'){
                    window.location.href = "admin.php";
                }else{
                    window.location.href = "user_page.php";
                }
            }else{
                alert('error');
            }
        });
    });
    
    $("#updateUser").on("click", function(e){
        e.preventDefault();     
        sendAjax('update_user.php', '#userDataForm', function (data) {
            console.log(data);
            if(data.error == 0){
                window.location.href = "admin.php";
            }else{
                alert('error');
            }
        });
    });
        
    $("#updateUserPassword").on("click", function(e){
        e.preventDefault(); 
        let id = $(this).data('id');
        let p = $(this).data('password');
        let p1 = $(this).data('password1');
        let p2 = $(this).data('password2');
        
        if(p1 == p2){
            sendAjax('update_password.php', '#userDataForm', function (data) {
                if(data.error == 0){
                    window.location.href = "admin.php";
                }else{
                    alert(data.message);
                }
            });
        } else {
            alert('The previous password is not good!');
        }

        //check p1 p2 egyenloe

    });
            
    $("#createNewUser").on("click", function(e){
        e.preventDefault();     
        sendAjax('create_user.php', '#userDataForm', function (data) {
            console.log(data.message);
            if(data.error == 0){
                window.location.href = "admin.php";
            }else{
                alert(data.message);
            }
        });
    });
    
    // END EDIT USER FUNCTIONS
    
    
    // DELETE USER FUNCTION
   /* $("#deleteUserBtn").on("click", function(e) {
        e.preventDefault();
        var userEmail = $(this).data("user-email");
console.log(userEmail);
        if (confirm("Are you sure you want to delete this user?")) {
            sendAjax('delete_user.php', { email: userEmail }, function(data) {
                if (data === "success") {
                    location.reload();
                } else {
                    alert("Failed to delete user. Please try again.");
                }
            });
        }
    });*/
    
});
function deleteUser(userId) {

        var userId = userId;

        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                url: 'delete_user.php',
                method: 'POST',
                dataType: 'json',
                data: { userId: userId },
                success: function(data) {
                    if (data.error == 1) {
                        console.log(data.message);
                    }else {
                        alert("Record deleted successfully");
                        window.location.reload(true);
                    }
                }
            });
        }
}

function editUser(id) {
    window.location.href = 'edit_user/'+id;
    return;
    var userId = id;
    
        $.ajax({
            url: 'edit_user.php',
            method: 'POST',
            dataType: 'json',
            data: { userId: id },
            success: function(data) {
                console.log(data.message);
                if (data.error == 1) {
                    console.log(data.message);
                }else {
                    console.log(data.message);
                }
        }
    });
}

function changeUserPassword(id){
    window.location.href = 'edit_password.php?id='+id;
    return;
    var userId = id;
    
        $.ajax({
            url: 'edit_password.php',
            method: 'POST',
            dataType: 'json',
            data: { userId: id },
            success: function(data) {
                console.log(data.message);
                if (data.error == 1) {
                    console.log(data.message);
                }else {
                    console.log(data.message);
                }
        }
    });
}