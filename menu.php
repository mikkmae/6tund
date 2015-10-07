<h2> Menüü </h2>

<ul>
	<?php if($page_file_name == "home.php"){ ?>
	
		<li>Kodu</li>
		
	<?php }else{?>

	<li><a href="page/home.php">Kodu</a></li>
	
	<?php } ?>
	
	<?php
		if($page_file_name == "login.php"){ ?>
			echo '<li>Login</li>';
		<?php } else { ?>
			<li><a href="login.php">Login</a></li>
		<?php } ?>
	
</ul>