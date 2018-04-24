<?php

if($utente == "manrico"){

	if(isset($_POST['Add_Led']) && $_POST['Add_Led']=="Prosegui"){
		$result_js="I seguenti campi sono obligatori: ";
		//gestione errori
		if(!isset($_POST['nome']) && $_POST['nome']!=""){
			$result_js.="Nome completo";
		}
		if(!isset($_POST['modello']) && $_POST['modello']!=""){
			if($result_js!="I seguenti campi sono obligatori: "){
				$result_js.=", ";
			}
			$result_js.="Modello";
		}
		if(!isset($_POST['prezzo']) && $_POST['prezzo']!=""){
			if($result_js!="I seguenti campi sono obligatori: "){
				$result_js.=", ";
			}
			$result_js.="Prezzo";
		}
		if(!isset($_POST['consumo']) && $_POST['consumo']!=""){
			if($result_js!="I seguenti campi sono obligatori: "){
				$result_js.=", ";
			}
			$result_js.="Consumo";
		}
		if(!isset($_POST['durata']) && $_POST['durata']!=""){
			if($result_js!="I seguenti campi sono obligatori: "){
				$result_js.=", ";
			}
			$result_js.="Durata";
		}
		if($result_js=="I seguenti campi sono obligatori: "){
					/* CONNESSIONE */
				$result_js="Errore interno:";
				include("../configUsers.php");
				$mysqli = new mysqli(DB_SERVER,DB_USERNAME, DB_PASSWORD, DB_NAME);
				if ($mysqli->connect_errno) {
					$result_js.=" conessione db.";
				}
				//gestisco l'inserimento o la selezione della foto
				$id_foto=0;
				$temp_foto = $_POST['foto'];//str_replace( ";" , "", $_POST['foto']);
				if(strpos($temp_foto,"data")==0){
					$sql= "INSERT INTO img(`content`) VALUES('". $temp_foto."');";
					if ($mysqli->query($sql)==false) {
						$result_js.=" query db (image insert).";						
					}else{
						$id_foto=($mysqli->insert_id);						
					}
					
					
				}else{
					$id_foto = $temp_foto;
				}
				//inserisco il led
				$sql= "INSERT INTO leds(`modello`, `id_foto`, `prezzo`, `group_modello`, `consumo`, `durata`, `nome_lungo`, `marca`, `lumen`, `note`, `kelvin`, `garanzia`) VALUES('".str_replace( ";" , "", $_POST['modello'])."','".$id_foto."','".str_replace( ";" , "", $_POST['prezzo'])."','".str_replace( ";" , "", $_POST['gruppo'])."','".str_replace( ";" , "", $_POST['consumo'])."','".str_replace( ";" , "", $_POST['durata'])."','".str_replace( ";" , "", $_POST['nome'])."','".str_replace( ";" , "", $_POST['marca'])."','".str_replace(";" , "", $_POST['lumen'])."','".str_replace( ";" , "", $_POST['note'])."','".str_replace( ";" , "", $_POST['kelvin'])."','".str_replace(";" , "", $_POST['garanzia'])."');";
				if ($mysqli->query($sql)==false) {
					$result_js.=" query db (led insert).";
				}
				
				if($result_js=="Errore interno:"){
					$result_js="Led aggiunto con successo.";
				}


				$mysqli->close();
		}
		
		
		

		echo('<script>alert("'.$result_js.'");</script>');
	}
		


}else{
	echo "<h2>Access denied</h2>";
}


?>
