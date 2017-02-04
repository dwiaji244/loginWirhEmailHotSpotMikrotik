function validateEmail() {

    var email = document.getElementById("textEmailDetails");
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var result = true;

    if (!filter.test(email.value)) {
    $("#checkIfEmailExist").html("<p align='center'><font face='Arial' size='5' color='#FF0000'>Please enter a valid email</font></p>");
    email.focus;

        result = false;
	}
	else
	{
       result = true;
	}
    return result;
}