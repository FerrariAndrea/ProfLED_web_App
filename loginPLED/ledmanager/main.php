
<!DOCTYPE html>
	<html>
			<?php

			session_start();

			// If session variable is not set it will redirect to login page
			if($_SESSION['username'] != "manrico"){
			  header("location: ../login.php");
			  exit;
			}else{
			  $utente = $_SESSION['username'];
			  if ($utente == "manrico"){
				echo "<h2>Benvenuto Manrico </h2>";
				echo "<p>Solo tu hai accesso a questa area</p>";
			  }else{
				echo "<h2>Non sei autoruizzato a visualizzare questa pagina. Premi su uscire</h2>";
			  }
			}
			
			
			
			include_once("insertondb.php");
			?>




		<header>
			<script src="./jspdf.debug.js"></script>
			<script src="./jspdf.plugin.autotable.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

			<meta charset="UTF-8">
			<title>LedManager</title>

			<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
			<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
			<style>

			/*---------------------------------------
    Preloader section
-----------------------------------------*/
.loading_screen {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 99999;
  display: flex;
  flex-flow: row nowrap;
  justify-content: center;
  align-items: center;
  background: none repeat scroll 0 0 #000000;
}

.sk-rotating-plane {
  width: 70px;
  height: 70px;
  background-color: #222;
	background-image: url("./logo.jpg");
  -webkit-animation: sk-rotatePlane 1.2s infinite ease-in-out;
          animation: sk-rotatePlane 1.2s infinite ease-in-out; }

@-webkit-keyframes sk-rotatePlane {
  0% {
    -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg);
            transform: perspective(120px) rotateX(0deg) rotateY(0deg); }
  50% {
    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
            transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg); }
  100% {
    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
            transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg); } }

@keyframes sk-rotatePlane {
  0% {
    -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg);
            transform: perspective(120px) rotateX(0deg) rotateY(0deg); }
  50% {
    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
            transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg); }
  100% {
    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
            transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg); } }




			/*   radio button style */
					.control {
		    font-family: arial;
		    display: block;
		    position: relative;
		    padding-left: 30px;
		    margin-bottom: 5px;
		    padding-top: 3px;
		    cursor: pointer;
		    font-size: 16px;
		}
		    .control input {
		        position: absolute;
		        z-index: -1;
		        opacity: 0;
		    }
				.control_indicator {
				    position: absolute;
				    top: 2px;
				    left: 0;
				    height: 20px;
				    width: 20px;
				    background: #e6e6e6;
				    border: 0px solid #000000;
				}
				.control-radio .control_indicator {
				    border-radius: 50%;
				}

				.control:hover input ~ .control_indicator,
				.control input:focus ~ .control_indicator {
				    background: #cccccc;
				}

				.control input:checked ~ .control_indicator {
				    background: #2aa1c0;
				}
				.control:hover input:not([disabled]):checked ~ .control_indicator,
				.control input:checked:focus ~ .control_indicator {
				    background: #0e6647d;
				}
				.control input:disabled ~ .control_indicator {
				    background: #e6e6e6;
				    opacity: 0.6;
				    pointer-events: none;
				}
				.control_indicator:after {
				    box-sizing: unset;
				    content: '';
				    position: absolute;
				    display: none;
				}
				.control input:checked ~ .control_indicator:after {
				    display: block;
				}
				.control-radio .control_indicator:after {
				    left: 7px;
				    top: 7px;
				    height: 6px;
				    width: 6px;
				    border-radius: 50%;
				    background: #ffffff;
				}
				.control-radio input:disabled ~ .control_indicator:after {
				    background: #7b7b7b;
				}
				/* other styles*/

				.body{
					background-color: #88d0f7;
				}

				.flex-container {
				  display: flex;
				}

				.flex-containerPLED {
				  display: flex;
					margin: auto;
	    		width: 50%;
				}

				.container {
				  flex-direction: column ;
				  margin: 1rem;
					background-color: #88d0f7;
					border: 2px solid green;
			    border-radius: 25px;
				}

				.flex-container > div {
				  padding: 20px;
				}

				.flex-containerPLED > div {
					padding: 20px;
				}

				.buttonStep {
				    background-color: #4286f4;
				    border: none;
						border-radius: 12px;
				    color: white;
				    padding: 15px 32px;
				    text-align: center;
				    text-decoration: none;
				    display: inline-block;
				    font-size: 16px;
				    margin: 4px 2px;
						margin-bottom: 1rem;
				    cursor: pointer;
				}

				.buttonAddItem {
						background-color: #2da024;
						border: none;
						border-radius: 12px;
						color: white;
						padding: 15px 32px;
						text-align: center;
						text-decoration: none;
						display: inline-block;
						font-size: 16px;
						margin: 4px 2px;
						margin-bottom: 1rem;
						cursor: pointer;
				}

				.buttonRemoveItem {
						background-color: #b2151d;
						border: none;
						border-radius: 12px;
						color: white;
						padding: 15px 32px;
						text-align: center;
						text-decoration: none;
						display: inline-block;
						font-size: 16px;
						margin: 4px 2px;
						margin-bottom: 1rem;
						cursor: pointer;
				}

				.buttonPlus {
				    background-color: #2da024;
				    border: none;
						border-radius: 20px;
				    color: black;

				    text-align: center;
				    text-decoration: none;
				    display: inline-block;
				    font-size: 16px;

				    cursor: pointer;
				}

				.buttonLess {
				    background-color: #b2151d;
				    border: none;
						border-radius: 20px;
				    color: black;

				    text-align: center;
				    text-decoration: none;
				    display: inline-block;
				    font-size: 16px;

				    cursor: pointer;
				}

				.input{
					text-align: center;
				}
			</style>

			<script>

			(function(){
			  if (window.addEventListener)
			  {
			    window.addEventListener("load", nascondi_loading_screen, false);
			  }else{
			    window.attachEvent("onload", nascondi_loading_screen);
			  }
			})();
			function mostra_loading_screen()
			{
			  document.getElementById("loading_screen").style.display = 'block';
			}
			function nascondi_loading_screen()
			{
			  document.getElementById("loading_screen").style.display = 'none';
			}

			</script>
		</header>

		<body background="https://static.webshopapp.com/shops/001680/files/145451846/striscia-led-rigida-impermeabile-blanco-5050-smd-7.jpg" style="background-size:cover">

			
			<div class="loading_screen" id="loading_screen">
				<div class="sk-rotating-plane"></div>
			</div>

			<center>
				<?php include_once("add.php");?>
			</center>

			<?php
				echo "<div align='right' style='margin:1rem'>";
				echo "<p>Web app realizzata da Matteo Mendula © Tutti i diritti riservati.</p>";
				echo "<a href='../logout.php'>LOGOUT</a>";
				echo "</div>"
			?>
		</body>
	</html>












