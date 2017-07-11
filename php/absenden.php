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
	$from = "From: Support - KatWare <support@katware.de>\n";
	$from .= "Reply-To: support@katware.de\n";
	$from .= "Content-Type: text/html\n";

	$text_user  .= '<html>
<head>
    <title>Support Anfrage</title>
</head>
 
<body>
 
<h1>Support Anfrage</h1>
 
<p>Danke für ihre Supportanfrage. Unser Support wird sich darum kümmern. Sie erhalten dann eine Antwort zur ihre Frage per Email</p>
 

</body>
</html>';
	
	mail($empfaenger_user, $betreff_user, $text_user, $from);

	
	echo('Vielen Dank! Wir melden uns schnellstmöglich bei Ihnen.');
?>