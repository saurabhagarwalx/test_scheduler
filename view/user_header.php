<div class = "mainContainer">
		
			<div class="header bg-vib-blue">
				<div class="logo"><img src="<?php echo IMAGE_PATH;?>/logo.png"></div>
				<h1>
				<font style="color:black">test</font>scheduler</h1>

				<div class="username_login">
				<label class="welcome_user" ><?php echo "Welcome ,".@$_SESSION['SESS_USER_NAME'];?></label>	
				<a class="welcome_user hover" href="<?php echo SITE_PATH."logout"; ?>"> Logout</a>
				<a class="welcome_user hover" href="<?php echo SITE_PATH."accountSettings/accountSettings"; ?>"> Account Settings</a>
			</div>
			</div>
				
</div>