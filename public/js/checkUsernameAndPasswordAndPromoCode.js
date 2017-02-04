function validateContactForm(){

      var result = true;

      var username = $('#username').val();
      var password = $('#password').val();
      var promocode = $('#promocode').val();

      var data = {
                    username: username,
                    password: password,
                    promocode: promocode
      };


      $.ajax({
        url:"app/actions/checkUsernameAndPasswordAndPromocode.php", //the page containing php script
        type: "POST", //request type
        async: false,
        data: data,
        success:function(response){
          if (response == 'true')
          {
              $("#UsernameOrPasswordMissing").html("<p align='center'><font face='Arial' size='3' color='#FF0000'>Username or password missing!</font></p>")
              result = false;

          }
          else if(response == 'false')
          {
              $("#UsernameOrPasswordMissing").html("<p align='center'><font face='Arial' size='3' color='#FF0000'>The <STRONG>username</STRONG> is already in use.</font></p>")
               result = false;

          }
          else if(response == 'UsernameOrPasswordIsWrong')
          {
             $("#UsernameOrPasswordMissing").html("<p align='center'><font face='Arial' size='3' color='#FF0000'>Username or Password is incorrect!</font></p>");
              result = false;

          }
          else if(response == 'PromocodeIsWrong')
          {
              $("#UsernameOrPasswordMissing").html("<p align='center'><font face='Arial' size='3' color='#FF0000'>Promocode is incorrect !</font></p>")
               result = false;

          }
          else
          {
              $("#UsernameOrPasswordMissing").html("<p align='center'><font face='Arial' size='3' color='#FF0000'></font></p>")
               result = true;

          }
          //return false;
       }
     });

     return result;

 }

