<?php
	$vorname = $_POST['vorname'];
	$nachname = $_POST['nachname'];
	$email = $_POST['email'];
	$nachricht = $_POST['nachricht'];

	if(isset($_POST['isHuman'])) {
    $captcha = $_POST['isHuman'];
	} else {
    	die();
	}
	
	$ergebnis = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeDFCcUAAAAAO154YoiplfrMZrX6DezrvQ87uzD&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);

	if($ergebnis.success == false) {
    die(); 
	}
        
	$empfaenger = "max-eric.behr@t-online.de";
	$absendername = "Kontaktformular";
	$absendermail = $email;
	$betreff = "Support Anfrage von ".$email;
	$text = "Es ist eine neue Support Anfrage über das Kontaktformular eingetroffen. Folgende Daten wurden übermittelt:
        
	
	Name, Vorname: ".$nachname.". ".$vorname."
	E-Mail: ".$email."
	Nachricht:
	".$nachricht;
	mail($empfaenger, $betreff, $text, "From: $absendername <$absendermail>");

	$empfaenger_user = $email;
	$absendername_user = "Support - KatWare";
	$absendermail_user = "support@katware.de";
	$betreff_user = "Anfrage eingegangen";
	$text_user  = "Ihre Anfrage ist eingegangen und wird von unserem Supportteam überprüft.
	
	
	Ihre Nachricht:
	".$nachricht."
	
	
	Mit freundlichen Grüßen
	Ihr KatWare Support";
	mail($empfaenger_user, $betreff_user, $text_user, "From: $absendername_user <$absendermail_user>");

	
	echo('Vielen Dank! Wir melden uns schnellstmöglich bei Ihnen.');
?>