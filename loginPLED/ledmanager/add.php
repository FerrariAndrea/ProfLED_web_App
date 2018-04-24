<script>
//var base64;
function select_upload_img(){
	document.getElementById("container_1").style.display="none";
	document.getElementById("container_2").style.display="none";
	document.getElementById("container_3").style.display="block";
}

function select_img(){
	document.getElementById("container_1").style.display="none";
	document.getElementById("container_2").style.display="block";
	document.getElementById("container_3").style.display="none";
}
function selected_img(id){
	if(id!="0"){
		if(id=="nuova"){
				document.getElementById("immagine_label").innerHTML = "Attendere la conversione della nuova immagine.";
				var filesSelected = document.getElementById("inputFileToLoad").files;
				if (filesSelected.length > 0)
				{
					var fileToLoad = filesSelected[0];
			 
					var fileReader = new FileReader();
			 
					fileReader.onload = function(fileLoadedEvent) 
					{
						document.getElementById("foto").value = fileLoadedEvent.target.result;
						//base64 = fileLoadedEvent.target.result;
						document.getElementById("immagine_label").innerHTML = "Selezionata una nuova immagine.";
					};
			 
					fileReader.readAsDataURL(fileToLoad);
				}
			
		}else{
			document.getElementById("immagine_label").innerHTML = "Immagine N°"+id+" selezionata.";
			document.getElementById("foto").value=id;
		}
	
			
		
	}else{
		
			document.getElementById("immagine_label").innerHTML = "Nessuna immagine selezionata.";	
			document.getElementById("foto").value="0";
		
	}
	
	document.getElementById("container_1").style.display="block";
	document.getElementById("container_2").style.display="none";	
	document.getElementById("container_3").style.display="none";
}
</script>
<?php

if($utente == "manrico"){
	
include_once("../configUsers.php");

$text="";

	

$text.='<div class="container" style="display:block;" id="container_1"><h2><big><strong>Aggiungi un led</strong></big></h2><div><form action="main.php" method="POST"><center>';
$text.="<div><span>Nome completo</span></div>";
$text.='<div><input type="text"  name="nome" placeholder="es. Panel LED INDUSTRIALE ** Watt. cm. ** x ** URG <**"  style="width: 500px;"></input></div>';
$text.='<table style="border-collapse: separate;border-spacing: 10px;"><tr><td><div><span>Modello</span></div>';
$text.='<div><input type="text"  name="modello" placeholder="es. Sigla-****-*KW"  style="width: 250px;"></input></div></td>';
$text.="<td><div><span>Prezzo</span></div>";
$text.='<div><input type="text"  name="prezzo" placeholder="es. 350.00" style="width: 250px;"></input></div></td></tr>';
$text.="<tr><td><div><span>Gruppo modello</span></div>";
$text.='<div><select name="gruppo"  style="width: 250px;">
<option value="Case">Case</option>
<option value="Panel Led">Panel Led</option>
<option value="Plafo 4k">Plafo 4k</option>
<option value="Plafo 5k">Plafo 5k</option>
<option value="Plafo 6k">Plafo 6k</option>
<option value="Proiettore">Proiettore</option>
<option value="Fari SPORT">Fari SPORT</option>
<option value="Campana">Campana</option>
<option value="alimentatori">alimentatori</option>
<option value="Varie">Varie</option>
</select></div></td>';
$text.="<td><div><span>Consumo</span></div>";
$text.='<div><input type="text"  name="consumo" placeholder="es. 40" style="width: 250px;"></input></div></td></tr>';
$text.="<tr><td><div><span>Durata</span></div>";
$text.='<div><input type="text"  name="durata" placeholder="es. 70000" style="width: 250px;"></input></div></td>';
$text.="<td><div><span>Garanzia</span></div>";
$text.='<div><input type="text"  name="garanzia"  placeholder="es. 5"style="width: 250px;" ></input></div></td></tr>';
$text.="<tr><td><div><span>Marca</span></div>";
$text.='<div><input type="text"  name="marca"  style="width: 250px;"></input></div></td>';
$text.="<td><div><span>Lumen</span></div>";
$text.='<div><input type="text"  name="lumen" placeholder="es. Potenza *** Lumen/Watt -*.*** Lumen" style="width: 250px;"></input></div></td></tr>';
$text.="<tr><td><div><span>Note</span></div>";
$text.='<div><input type="text"  name="note" style="width: 250px;"></input></div></td>';
$text.="<td><div><span>Kelvin</span></div>";
$text.='<div><input type="text"  name="kelvin" placeholder="es. Luce bianca *.***K" style="width: 250px;"></input></div></td></tr>';
$text.='<tr><td><p onclick="select_img();" class="buttonStep"  style="width: 250px;">Scegli immagine esistente</p></td><td><p onclick="select_upload_img();" class="buttonStep"  style="width: 250px;">Carica nuova immagine</p></td></tr></table>';
$text.='<input id="foto" type="hidden"  name="foto" value=""></input><p id="immagine_label" style="color:red;">Nessuna immagine selezionata.</p>';
$text.='<input class="buttonStep" type="submit" name="Add_Led" value="Prosegui" style="width: 500px;"></input><br><br>';
$text.='</center></div></form></div>';
//------------------------------------------------------------------------------------------------------
$text.='<div class="container"  style="display:none;" id="container_2"><center>';
$text.='<h2><big><strong>Seleziona un immagine</strong></big></h2><a style="font-size:22px;" onclick="selected_img(0);">Oppure torna indietro</a>';
/* CONNESSIONE */
$mysqli = new mysqli(DB_SERVER,DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_errno) {
	echo("Errore interno: conessione db.");
	exit;
}
$sql = "SELECT * FROM img";
if (!$result = $mysqli->query($sql)) {
	echo("Errore interno: query db.");
	exit;
}
while ($img = $result->fetch_assoc()) {
	$text.='<br><br><img id="img_'.$img['id'].'" onclick="selected_img('.$img['id'].');"  src="'.$img['content'].'"/>';

}											
$text.='<br><br></center></div>';		
//------------------------------------------------------------------------------------------------------
$text.='<div class="container"  style="display:none;" id="container_3"><center>';
$text.='<h2><big><strong>Carica una nuova immagine</strong></big></h2><a style="font-size:22px;" onclick="selected_img(0);">Oppure torna indietro</a>';
$text.='<br><input id="inputFileToLoad" type="file" /><br>';		
$text.='<p onclick="selected_img('."'".'nuova'."'".');" class="buttonStep"  style="width: 250px;">Conferma</p><br><br>';							
$text.='<br><br></center></div>';	

echo($text);		
		
$result->free();
$mysqli->close();
	
}else{
	echo "<h2>Access denied</h2>";
}

?>