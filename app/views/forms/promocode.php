<form class="main" name="login" action="app/actions/loginForIncreaseSpeed.php" method="post" id="register-form" name="ContactForm" onsubmit="return checkIfPromocodeIsTyped();">
    <h1>Martin Slavov's WiFi</h1>
    <div class="inset">
		<h2>Please Fill in your <b55>E-mail</b55> to use our Free WiFi service.</h2>
		<h3>After you click submit you will receive <b55>E-mail</b55> with login details.</h3>
		<p>
		<p><input type="promocode" name="promocode" id="promocode" value="" placeholder="promocode"></p>
        <a id="UsernameOrPasswordMissing"></a>
        <a id="UsernameOrPasswordIsIncorrect"></a>
        <a id="PromocodeIsWrong"></a>
        <p id="status"></p>
		<?= '<input name="mac" id="mac" type="hidden" value="'.$mac_variable.'"   />'; ?>
		<?= '<input name="ip" type="hidden" value="'.$ip.'"   />'; ?>
        </p>
        <p class="p-container">
        <input type="submit" id="submintLogin" name="commit" value="Increase Your WiFi Speed"></p>
</form>
<form name="login" action="app/actions/loginOnlyWithEmail.php" method="post" id="valadateEmailFormLoginOnlyEmail" name="form" onclick="return checkEmail();"> 
		<p><input type="textEmail" name="textEmail" id="textEmail" value="<?= $email; ?>" placeholder="email"></p>
		<?= '<input name="mac" id="mac" type="hidden" value="'.$mac_variable.'"   />'; ?>
		<?= '<input name="ip" type="hidden" value="'.$ip.'"   />'; ?>
		<p calss="center" id="statusForLoginOnlyWithEmail"></p>
		<p class="submit"><input type="submit" name="commit" value="Lgoin only with Email"></p>
		<br>
		<br>
</form>
</div>