function checkIfPromocodeIsTyped(){

      var result = true;

      var promocode = $('#promocode').val();
      var mac = $('#mac').val();

      var data = {
                    promocode: promocode,
                    mac: mac
      };


      $.ajax({
        url:"app/actions/checkPromocodeOnly.php", //the page containing php script
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
          else if(response == 'PromocodeIsMissing')
          {
              $("#UsernameOrPasswordMissing").html("<p align='center'><font face='Arial' size='3' color='#FF0000'>Promocode is missing !</font></p>")
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
