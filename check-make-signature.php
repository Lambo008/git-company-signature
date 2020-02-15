<?php
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.php');
        exit();
    }
    $data = "<!DOCTYPE html>
                <html lang='en'>
                    <title>Signature</title>
                    <link rel='icon' type='image/png' href='assets/images/redfarm-big-logo.png'>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
                    <meta charset='UTF-8'>
                    <head>
                    </head>
                    <body>
                        <div style='display:inline'>
                            <div style='display:flex;'>
                                <div style='display:inline'>
                                    <p style='color: rgb(31, 73, 125); margin-bottom:0px ; font-family:Arial; font-size:13px;font-weight: bold;'>".$_POST['field1']."&nbsp&nbsp".$_POST['field2']."</p>";
                                    if ($_POST['field3'] !='') {
                                        $data = $data."<p style='color: rgb(31, 73, 125); margin-top:2px ; margin-bottom: 0px; font-family:Arial; font-size:12px;'>".$_POST['field3']."</p>";
                                    }
                                    if ($_POST['field4'] !='') {
                                        $data = $data."<p style='color: rgb(31, 73, 125); margin-bottom:0px ; margin-top: 2px; font-family:Arial; font-size:12px;'>".$_POST['field4']."</p>";
                                    }
                                    if ($_POST['field5'] !='') {
                                        $data = $data."<p style='margin-top: 2px;margin-bottom:0px ;font-family:Arial;font-size:10.5px;'>Telf:&nbsp&nbsp".$_POST['field5']."</p>";
                                    }
                                    if ($_POST['field6'] !='') {
                                        $data = $data."<p style='margin-top: 2px;margin-bottom:0px ;font-family:Arial;font-size:10.5px;'>Móvil:&nbsp&nbsp".$_POST['field6']."</p>";
                                        //$data = $data."<br>Móvil:&nbsp&nbsp".$_POST['field6']."</p>";
                                    }
                                    if ($_POST['field8'] !='') {
                                        $data = $data."<a style='color: rgb(31, 73, 125); font-family:Arial;font-size:10.5px; margin-top:2px;' href='".$_POST['field8']."'>".$_POST['field8']."</a>";
                                    }
                                    
                                    $data = $data."<div style='display: flex; margin-bottom: 30px; margin-top: 10px;'>
                                        <img src='".$_POST['image1']."' style='margin-right: 40px;' alt='service_image'>
                                        <img src='".$_POST['image2']."' style='margin-right: 60px;' alt='service_image'>
                                    </div>
                                </div>

                                <div style='margin-top:13px'>
                                    <img src='".$_POST['image3']."'alt='service_image'>
                                </div>
                            </div>

                            <div style='width: 100%;'>
                                <p style='font-family:Arial; font-size:9px; line-height:18px;'>".$_POST['field9']."</p>
                            </div>
                        </div>
                    </body>
                </html>";


    $filename = "signature.html";
    if(!isset($_SESSION['filename'])){
        $_SESSION['filename'] = "";
        $_SESSION['makingState'] = "failed";
    }
    if($filename == $_SESSION['filename']){
        $filename = "1".$_SESSION['filename'];
    }
    $fh = fopen($filename,"w");
    fwrite($fh,$data);
    fclose($fh);
    $_SESSION['filename'] = $filename;
    $_SESSION['makingState'] = "successful";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <title>Checked!</title>
        <link rel="icon" type="image/png" href="assets/images/redfarm-big-logo.png"/>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
                <img class="logo" src="assets/images/logo.png" width="240px" height="40px" alt="logo">
				<h1>Company Signature</h1>
                <a href="home.php"><i class="fas fa-home"></i>Home</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Estado de creación de la firma</h2>
			<div>
                <p>La firma ha sido generada correctamente!</p>
                <?php
                    if($_SESSION['makingState'] == "successful"){
                        echo "<a style='float:left;' href='".$_SESSION['filename']."' target='_blank'><p>Haga Click para descargar</p></a><p>. (si se previsualiza en el navegador, pulse con el botón derecho sobre ella y seleccione 'Guardar como').</p>";
                    }
                ?>
			</div>
		</div>
	</body>
</html>