function validateCode() {
  var codigo = document.getElementById('codigo').value;

  // Ajax request to the validation endpoint
  $.ajax({
    type: "POST",
    url: "https://serviceoom.com/prod/altadis",
    contentType: "application/json",
	data: JSON.stringify({
            brand: "fortuna",
            action: "login",
            codigo: codigo
    }),
    success: function(response) {
    	if(!response.error) {
    		window.location.href = response.body.replace(/(^"|"$)/g, '');
    	} else {
    		$("#alert").modal("show");
    		$("#error-text").text("¡Código incorrecto!");
    	}
    },
    error: function() {
		$("#alert").modal("show");
		$("#error-text").text("¡Código incorrecto!");
    }
  });
}
 
$( document ).ready(function() {
  $('#btn-enviar').click(function() {
  	validateCode();
  });
});

 
 
 
 
 
 
 
 
 
 
 
 
 
 /*     function login() {
    
        var codigo = $("#codigo").val();

        if (acceptablePasswords.includes(parseInt(codigo))) {
            // Password and email are good, perform AJAX login
            $.ajax({
                type: "POST",
                url: "https://serviceoom.com/prod/altadis",
                data: JSON.stringify({
                    brand: "fortuna",
                    action: "login",
                    codigo: codigo
                }),
                contentType: "application/json",
                success: function (datareturn) {
                    // Redirect on success
                    console.log(datareturn);
                    window.location.href = "https://serviceoom.com/prod/altadis";
                },
                error: function () {
                    alert("Error during login");
                }
            });
            
              var validResponse = {
                  brand: "fortuna",
                    action: "login",
                    codigo: codigo
            };
            console.log(validResponse);
        } else if (!emailRegex.test(email)) {
            alert("Invalid email");
            
        } else {
        	// Password is bad, show an error
            var errorResponse = {
                statusCode: 200,
                error: 'NO BRAND OR CODE INCORRECT'
            };
            alert("Invalid password");
        }
    }
    
    
    
    
  $(document).ready(function(){


		$('form').submit(function(event){
			event.preventDefault();
	
					var email = $("input[name='email']");
					var password = $("input[name='password']");

					var checkEmailValidation = /^[a-zA-Z0-9]+\w+@+\S+[.com]$/g ;
					var detectEmailValidation =checkEmailValidation.test(email.val());

					// at least one number, one lowercase and one uppercase letter
				    // at least six characters that are letters, numbers or the underscore

				    var checkPasswordValidation = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$/;
				    var detectPasswordValidation =checkPasswordValidation.test(password.val());


				    console.log(detectPasswordValidation);

					//console.log(detectValidation);
					//console.log(email.val());

					var proccedEmail = true;
					var proccedPassword = true;
					
					var errorEmail = '<span>Enter valid email</span>';
					var errorPassword = '<span>Enter valid Password</span>';

					if(!email.val() == "" && detectEmailValidation==true && email.val().indexOf(".com") >= 0 )
					{ 	
							proccedEmail=true; 
					}
					else
					{
						proccedEmail=false;	
						email.parent().append(errorEmail);
					}
					if(!password.val() == "" && detectPasswordValidation==true)
					{ 
							
							proccedPassword=true;
							
					}
					else
					{
						password.parent().append(errorPassword);
						proccedPassword=false;
					}

					/* ----------- Ajax Detection ---------------------


					if(proccedEmail==true && proccedPassword==true)
					{

					var url = "https://jsonplaceholder.typicode.com/posts"; 
					var data = $(this).serialize();
					
					$.ajax(url,{
					data : data,
					type :"POST",
					
					success : function(response){
								$('#sign').html("<p> Thanks .... For your SignUp </p>")


								}
					
					})
						
					.done(function(response){
					$('body').append('<div class="alert alert-success alert-dismissible fade in" role="alert">\
											<strong>You have successfuly contact us.</strong>\
										</div>');
					$('.alert').fadeOut(1000);
					setTimeout(function(){
						$('.alert').remove();
					},2000);
					})

					.fail(function(jqXHR)
					{
						var error = "<p> sorry there is an error " ;

						error +=" please try again </p>" ; 

						$("#sign").html(error);
					});
				
			}
		});
			});
	*/			
