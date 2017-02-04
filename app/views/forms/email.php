<form class="main" action="app/actions/signin.php" method="post" id="register-form" name="ContactForm" onsubmit="return checkEmail();">
    <h1>Martin Slavov's WiFi</h1>
    <div class="inset">
		<h2>Please Fill in your <b55>E-mail</b55> to use our Free WiFi service.</h2>
		<h3>After you click submit you will receive <b55>E-mail</b55> with login details.</h3>
			<p>
				<p><input type="textEmail" name="email" id="email" value="" placeholder="Email"></p>
				<?= '<input name="mac" type="hidden" value="'.$mac_variable.'"   />'; ?>
				<?= '<input name="ip" type="hidden" value="'.$ip.'"   />'; ?>
				<center><font color="red" text="center"><p id="checkIfEmailExist"></p></font></center>       
			</p>
    </div>
		<p class="p-container">
        <input type="submit" id="submintLogin" name="commit" value="SUBMIT" >
		</p> 
		<p id="status"></p>
</form>