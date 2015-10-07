<?php
	//*****************************
	//******MYSQL******************
	//*****************************
	
	require_once("../config.php");
	$database = "if15_mikkmae";
	$mysqli = new mysqli($servername, $username, $password, $database);
	
	
	
	
	
	//*****************************
	//*****************************
	//*****************************			VÄLJADE KONTROLLIMISEKS
	//*****************************
	//*****************************
	//*****************************
	
	$email_error_login = "";
	$password_error_login = "";
	$name_error = "";
	$email_error_create ="";
	$password_error_create= "";
	$email_login = "";
	$password_login = "";
	$name = "";
	$email_create ="";
	$password_create= "";
		
		//*****************************
		//*****************************
		//*****************************
		//*****************************
		
		
		
		
		
	//**INPUT NUPPU KONTROLLIMINE
	if($_SERVER["REQUEST_METHOD"] == "POST" ) {
		
		
		//**EMAIL VÄLI
		
		if(isset($_POST["login"])){
			echo "Vajutasite Logi sisse nuppu";
		
		
		if ( empty($_POST["email_login"]) ) {
			$email_error_login = "See väli on kohustuslik";
		}else{
			$email_login = test_input($_POST["email_create"]);
		}
		
		//** PASSWORD VÄLI
		
		if (empty($_POST["password_login"]) ) {
			$password_error_login = "Väli on kohustuslik";
		}else{
			$password_login = test_input($POST["email"]);
		} 
		
		if($email_error == "" && $password_error == ""){
			echo "Valmis sisselogimiseks! Kasutaja nimi on ".$email_login."ja parool on".$password_login;
			
			$hash = hash("sha512", $password_login);
			
			$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
			$stmt->bind_param("ss", $email, $hash);
			
			//MUUTUJAD SISESTATUD ANDMETELE
			$stmt->bind_result($id_from_db, $email_from_db);
			$stmt->execute();
			
			//VANA HEA FETCH ET KONTROLLIDA
			if($stmt->fetch()){
			
				echo " E-mail and password are correct, user id=".$id_from_db;
			}else{
				
				echo " Wrong credentials!";
			}
			
			$stmt->close();
		}	
			
			
	//***************************************************************************			
	//***************************************************************************	
	//*****************************TAGASI VÄLJADE KONTROLLIMISELE****************	
	//***************************************************************************		
	    
		}elseif(isset($_POST["create"])){	
			echo" vajutas create user nuppu!";	
	
	
			if (empty($_POST["e-mail"])){
			$email_error2 = "See väli on kohustuslik";
			}
			if (empty($_POST["pass"]) ) {
			$password_error2 = "See väli on kohustuslik";
			} else {
			
				if(strlen($_POST["pass"]) <8) {
				$password_error2 = "Parool on liiga lühike, peab olema vähemalt 8 tähemärki pikk!";
				}
				$sname = test_input($_POST["name"]);
	
			}
			if (empty ($_POST["name"])){
			$name_error = "See väli on kohustuslik";
			}
			
			}
			
	
	
	//***************************************************************************			
	//***************************************************************************	
	
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
	//********MYSQL*************
	$mysqli->close();	
	
	
?>

<?php	
	$page_title="Sisselogimine";
	$page_file_name="login.php";
?>
<?php require_once("../header.php"); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Logimine</title>
</head>
<body>

	<h2>Logi sisse</h2>
		
		<form action="login.php" method="post" >
			<input name="email" type="email" placeholder="E-mail"> <?php echo $email_error_login; ?> <br><br>
			<input name="password" type="password" placeholder="Parool"> <?php echo $password_error_login; ?> <br><br>
			<input name="login" type="submit" value="Logi sisse!" >
		</form>
		
		
	<h2>Loo endale kasutaja</h2>
		
		<form action="login.php" method="post" >
			<input name="e-mail" type="email" placeholder="E-mail" ><?php echo $email_error_create; ?> <br><br>
			<input name="pass" type="password" placeholder="Parool" ><?php echo $password_error_create; ?> <br><br><br><br>
			<input name="name" type="text" placeholder="Nimi"><?php echo $name_error; ?> <br><br>
			<input name="create" type="submit" value="Loo kasutaja!" >
		</form>	
			
<p style="text-align:center">Mõte on luua koht, kuhu inimesed saavad sisestada mõne koha, kus pakutakse teenust, näiteks restoranid,
	autorehvivahetus, rattaparanduse kohad jne. Ei suutnud meelde tuletada selle ingliskeelset versiooni, kuid näide sellest kuidas asi välja näeks: <br>
	Lähed rehve vahetama kuhugi mitte kõige prestiižemasse kohta, mingit infot internetist selle kohta ei leia. Käid ära ning märkad et velje peal
	on täkked, rehvijooks valet pidi, teenindus halb ja sada muud häda ning tahaksid selle kuhugi üles visata, et teised samasse auku ei astuks. <br>
	Kohti saavad inimesed ise sisestada(aadress, pildid nimi jne) ja selle kohta siis oma arvustus lisada. Võivad ka olla muidugi positiivsed soovitused.
	Kindlasti tuleks teha ka mingi jaotus erinevate teenuste vahel, et vajadusel kui keegi näiteks lähebki otsima kohta kus oma rehve vahetada, siis 
	saab ta seda lihtsalt ja kiirelt teha ning jääb lõpptulemusega rahule.</p>
	
<body>
<html>
