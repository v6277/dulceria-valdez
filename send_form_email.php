<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "dulceriavaldez@hotmail.com";
    $email_subject = $_POST['name']." de ".$_POST['email'];
 
    function died($error) {
        // your error code can go here
        echo "Lo sentimos pero hay errores en su formulario.";
        echo "Estos errores son: <br /><br />";
        echo $error."<br /><br />";
        echo "Por favor regrese y arregle estos errores, gracias.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['comments'])) {
        died('Lo sentimos pero hay errores en su formulario.');       
    }  
 
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'El correo que introdució no parece ser correcto.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'Hay un error en su nombre.<br />';
  }

 
  if(strlen($comments) < 2) {
    $error_message .= 'El mensaje no es válido.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Detalles del formulario:\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Nombre: ".clean_string($name)."\n";
    $email_message .= "Correo: ".clean_string($email_from)."\n";
    $email_message .= "Mensaje: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
<!DOCTYPE html>
<html lang="es">
<head>
<title>Dulceria Valdez</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<meta name="Keywords" content="Dulceria, Dulceria Valdez">
<meta charset="utf-8">
<link rel="stylesheet" href="stylesheets/styles.css">
<link rel="stylesheet" href="stylesheets/form-styles.css">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
</head>

<body class="body">
    <!--Persistant header-->
    <div class="header" id="header">
        <!--Techo-->
        <img src="photos/techo.png" 
             alt="Cabezera"
             class="header-stripes">
        <!--Logo-->
        <img src="photos/logo.png"
             alt="logo"
             class="logo">
    </div>

    <a href="/index.html" class="form-message"> 
      <h1>¡Gracias por contactárnos!</h1>
      <h2>Estaremos en contácto con usted pronto.</h2>
      Para regresar de click aquí.
    </a>

    <script src="script/persistant-header.js"></script>
</body>

<?php
  
}
?>
