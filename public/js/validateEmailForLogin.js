function checkEmail() {

    var email = document.getElementById("email");
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var result = true;

    if (!filter.test(email.value)) {
    $("#checkIfEmailExist").html("<p align='center'><font face='Arial' size='5' color='#FF0000'>Please enter a valid email</font></p>");
    email.focus;

        result = false;
	}
	else
	{
        var result = checkIfEmailExist();
	}
    return result;
}
function checkIfEmailExist(){

      var result = true;

      var email = $('#email').val();
      var mac = $('#mac').val();

      var data = {
                    email: email,
                    mac: mac
      };


       $.ajax({
        url:"app/actions/checkDublicatedEmail.php", //the page containing php script
        type: "POST", //request type
        async: false,
        data: data,
        success:function(response){
          if (response == 'true')
          {
              $("#checkIfEmailExist").html("<p align='center'><font face='Arial' size='4' color='#FF0000'></font></p>")
              result = true;
          }
          else if (response == 'false')
          {
              var emailIsAlreadyInUse= "<font face='Arial' size='4' color='#FF0000'>The Email </font>" + email + "<font face='Arial' size='4' color='#FF0000'> is already in use.</font>";
              $("#checkIfEmailExist").html(emailIsAlreadyInUse)
               result = false;
          }
		  else
		  {
			var emailIsAlreadyInUse= "<font face='Arial' size='4' color='#FF0000'>Undefine ERROR </font>" + email + "<font face='Arial' size='4' color='#FF0000'> .</font>";
		    $("#checkIfEmailExist").html(emailIsAlreadyInUse)
		    result = false;

		  }
       }
     });

     return result;

 }

