dasdada
    <form class="main" name="login" action="../php/signinForLoginForm.php" method="post" id="loginWithEmai" onclick="return validateContactForm();">
    asdad
      <h1>Martin Slavov's WiFi</h1>
      <div class="inset">
      <h2>Please Fill in your <b55>E-mail</b55> to use our Free WiFi service.</h2>
      <h3>After you click submit you will receive <b55>E-mail</b55> with login details.</h3>
          <p><input type="username" name="username" id="username" value="" placeholder="username"></p>
          <p><input type="password" name="password" id="password" value="" placeholder="password"></p>
          <p><input type="promocode" name="promocode" id="promocode" value="" placeholder="promocode"></p>
                        <a calss="center" id="UsernameOrPasswordMissing"></a>
                        <a calss="center" id="UsernameOrPasswordIsIncorrect"></a>
                        <a calss="center" id="PromocodeIsWrong"></a>
                        <p calss="center" id="status"></p>
                            <?php $mac = $_GET['mac']; ?>
                            <?php $ip = $_GET['ip']; ?>
                            <?php echo '<input name="mac" type="hidden" value="'.$mac.'"   />'; ?>
                            <?php echo '<input name="ip" type="hidden" value="'.$ip.'"   />'; ?>     
      
        <p class="p-container"><input type="submit" id="submintLogin" name="commit" value="Login"></p>
    </form>
    <form name="login" action="../php/sendNewLoginDetails.php" method="post" id="valadateEmailForm" onclick="return checkEmailDetails();"> 
                        <p><input type="textEmail" name="textEmailDetails" id="textEmailDetails" value="" placeholder="email"></p>
                            <?php $mac = $_GET['mac']; ?>
                            <?php $ip = $_GET['ip']; ?>                        
                            <?php echo '<input name="mac" type="hidden" value="'.$mac.'"   />'; ?>
                            <?php echo '<input name="ip" type="hidden" value="'.$ip.'"   />'; ?>
                            <p calss="center" id="statusForNewLoginDetails"></p>
                        <p class="submit"><input type="submit" name="commit" value="Get New Login Details"></p>
                        <br>
                        <br>
                        <br>
                        <br>
                        
    </form>
    <!--<form name="login" action="../php/loginOnlyWithEmail.php" method="post" id="valadateEmailFormLoginOnlyEmail"> -->
    <form name="login" action="../php/loginOnlyWithEmail.php" method="post" onclick="return checkEmail();">
                            <?php $email = $_GET['email']; ?>
                        <p><input type="textEmail" name="textEmail" id="textEmail" value="<?php echo $email;?>" placeholder="email"></p>
                            <?php $mac = $_GET['mac']; ?>
                            <?php $ip = $_GET['ip']; ?>                        
                            <?php echo '<input name="mac" type="hidden" value="'.$mac.'"   />'; ?>
                            <?php echo '<input name="ip" type="hidden" value="'.$ip.'"   />'; ?>
                             <p calss="center" id="statusForLoginOnlyWithEmail"></p>
                        <p class="submit"><input type="submit" name="commit" value="Lgoin only with Email"></p>
                        <br>
                        <br>
                       
    </form>
    </div>