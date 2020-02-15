<?php
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.php');
        exit();
    }
    $DATABASE_HOST = 'localhost:3307';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'companysignature';
    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    $logo = '';
    $iso = '';
    $service = ''; 
    if ( mysqli_connect_errno() ) {
        // If there is an error with the connection, stop the script and display the error.
        die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    $sql = 'SELECT * FROM default_image ORDER BY id DESC LIMIT 1';
    $result = $conn->query($sql);
    if($result->num_rows < 1 ) {
        $state = 0;
    }else{
        $state = 1;
        while($row = $result->fetch_assoc()) {
            $logo = $row['logo'];
            $iso = $row['iso'];
            $service = $row['service_image'];
        }
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <title>Home Page</title>
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
			<h2>Home Page</h2>
            <p>Bienvenido a la aplicación generadora de firmas del grupo Roxu.</p>
            <div class="signature-content">
                <form class = "signature-form" action="check-make-signature.php" method="post">
                    <div class="line1">
                        <div class="group1">      
                            <input type="text" name="field1" required>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label style="top:-20px; font-size:14px;">Nombre</label>
                        </div>                       
                        <div class="group2">      
                            <input type="text" name="field2" required>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label style="top:-20px; font-size:14px;">Apellidos</label>
                        </div>
                    </div>
                    <div class="line2">
                        <div class="group1">      
                            <input type="text" name="field3" value="" >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Cargo en castellano</label>
                        </div>                        
                        <div class="group2">      
                            <input type="text" name="field4" value="" >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Cargo en inglés</label>
                        </div>
                    </div>
                    <div class="line3">
                        <div class="group1">      
                            <input id="phonenum1" name="field5" type="text" value=""  >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Teléfono +34 999 999 999</label>
                        </div>                       
                        <div class="group2">      
                            <input id="phonenum2" name="field6" type="text" value="" >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Móvil</label>
                        </div>
                    </div>
                    <div class="line4">
                        <div class="group1">      
                            <input type="text" name="field7" value="" >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Dirección</label>
                        </div>                       
                        <div class="group2">      
                            <input type="text" name="field8" value="" >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Web</label>
                        </div>
                    </div>
                    <h3 class="title-textarea">Aviso Legal</h3>
                    <textarea class="textarea" rows='15' name="field9" placeholder='Input Legal content here' required>AVISO LEGAL: Este mensaje y sus archivos adjuntos van dirigidos exclusivamente a su destinatario, pudiendo contener información confidencial sometida a secreto profesional. No está permitida su comunicación, reproducción o distribución sin la autorización expresa de GRUAS ROXU, S.A.. Si usted no es el destinatario final, por favor elimínelo e infórmenos por esta vía.
PROTECCIÓN DE DATOS: De conformidad con lo dispuesto en las normativas vigentes en protección de datos personales, el Reglamento (UE) 2016/679 de 27 de abril de 2016 (GDPR) y la Ley Orgánica (ES) 15/1999 de 13 de diciembre (LOPD), le informamos que los datos personales y dirección de correo electrónico, recabados del propio interesado o de fuentes públicas, serán tratados bajo la responsabilidad de   GRUAS ROXU, S.A. para el envío de comunicaciones sobre nuestros productos y servicios y se conservarán mientras exista un interés mutuo para ello. Los datos no serán comunicados a terceros, salvo obligación legal. Le informamos que puede ejercer los derechos de acceso, rectificación, portabilidad y supresión de sus datos y los de limitación y oposición a su tratamiento dirigiéndose a Ctra. Santander S/N 33199 Meres - Siero (Asturias) o enviando un mensaje al correo electrónico a roxu@gruasroxu.com. Si considera que el tratamiento no se ajusta a la normativa vigente, podrá presentar una reclamación ante la autoridad de control en www.agpd.es</textarea>
                    <div class="wrapper">
                        <div class="upload1">
                            <div class="file-upload logo-image">
                                <input id="logo-image" name="field10" type="file" accept="image/*" onchange="readURL_logo(this);"  />
                                <i class="fa fa-arrow-up"></i>
                            </div>
                            <h3 class="file-title">Logo</h3>
                        </div>
                        <div class="upload2">
                            <div class="file-upload iso-image">
                                <input id="iso-image" name="field11" type="file" accept="image/*" onchange="readURL_iso(this);"  />
                                <i class="fa fa-arrow-up"></i>
                            </div>
                            <h3 class="file-title">ISO</h3>
                        </div>
                        <div class="upload3">
                            <div class="file-upload service-image">
                                <input id="service-image" name="field12" type="file" accept="image/*" onchange="readURL_service(this);"  />
                                <i class="fa fa-arrow-up"></i>
                            </div>
                            <h3 class="file-title">Servicios</h3>
                        </div>  
                    </div>
                        <!-- image box -->
                    <div class="wrapper1">
                            <div class="box">
                                <img id="blah-logo" src="<?php if($logo == ''){echo'http://placehold.it/380';}else{echo $logo;} ?>" alt="logo image" />
                            </div>

                            <div class="box">
                                <img id="blah-iso" src="<?php if($iso == ''){echo'http://placehold.it/380';}else{echo $iso;} ?>" alt="iso image" />
                            </div>

                            <div class="box">
                                <img id="blah-service" src="<?php if($service == ''){echo'http://placehold.it/380';}else{echo $service;} ?>" alt="service image" />
                            </div>
                    </div>
                    <div style="display:none">
                        <input type="checkbox" name="image1" id="imageOne" value="" required>
                        <input type="checkbox" name="image2" id="imageTwo" value="" required>
                        <input type="checkbox" name="image3" id="imageThree" value="" required>
                    </div>
                    
                    <div class = "wrapper">
                        <dib  id="save_image" title="Button push blue/green" class="button1">Guardar Imagen</dib>
                        <button type="submit" id="generate_signature" title="Button push blue/green" class="button1">Crear Firma</button>
                        
                    </div>
                    
                    <!-- <button id="generate_signature">Generate</button> -->
                </form>
            </div>
		</div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="assets/js/style.js"></script>
</html>