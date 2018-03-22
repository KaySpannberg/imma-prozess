
<?php
//Generierung eines RandomStrings zur dynamischen Benennung des Dokuments
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
//Vergabe des Zeitstempels als Dokumentenname, falls mindestens 2 Leute 
//den gleichen Namen für ihr Dokument hochladen sollten
$id = time();
//Leere Objekt, wird später mit dem PPST Befehl zum Claim der User-Task befüllt
$filegelump = '';

//Personalausweis
//Encode und POST an Camunda REST, wenn Personalausweis erwartet wird
if (file_exists($_FILES['personalausweis']['tmp_name'])){
	//Der Name der Datei im lokalen Ablageordner
	$filename = "perso".$id."-".generateRandomString(5).".pdf";
	//Der Pfad des Ablageorts des Dokuments + Dokumentenname
	$target_file = "uploads/".$filename;
	// ???
	if (move_uploaded_file($_FILES["personalausweis"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["personalausweis"]["name"]). " has been uploaded.</br>";
		//File aus Ablageordner entnehmen
		$data = file_get_contents($target_file);
		//Encode String der Datei zu dem Format Base64 für die Camunda REST Schnittstelle
		$encoded = base64_encode($data);
		//Erstellung des REST-Variable zum Push an Camunda REST Schnittstelle
		$filegelump .= '"uPersonalausweis": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'", "mimeType": "application/pdf"}}';
	}
	//Wenn Dokument fehlt, dann Fehlermeldung
	else {
		echo "Sorry, es gab ein Problem beim Upload des Personalausweises.</br>";
		exit();
	}
}

//Hochschulberechtigung
//Encode und POST an Camunda REST, wenn Hochschulberechtigung erwartet wird
if (file_exists($_FILES['hochschulzugangsberechtigung']['tmp_name'])){
	//Der Name der Datei im lokalen Ablageordner
	$filename = "zuga".$id."-".generateRandomString(5).".pdf";
	//Der Pfad des Ablageorts des Dokuments + Dokumentenname
	$target_file = "uploads/".$filename;
	// ???
	if (move_uploaded_file($_FILES["hochschulzugangsberechtigung"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["hochschulzugangsberechtigung"]["name"]). " has been uploaded.</br>";
		//File aus Ablageordner entnehmen		
		$data = file_get_contents($target_file);
		//Encode String der Datei zu dem Format Base64 für die Camunda REST Schnittstelle
		$encoded = base64_encode($data);
		//Erstellung des REST-Variable zum Push an Camunda REST Schnittstelle
		if(empty($filegelump)){
			$filegelump .= '"uHochschulzugangsberechtigung": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'", "mimeType": "application/pdf"}}';
		}else{
			$filegelump .= ', "uHochschulzugangsberechtigung": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'", "mimeType": "application/pdf"}}';
		}
		
	}
	//Wenn Dokument fehlt, dann Fehlermeldung
	else {
		echo "Sorry, es gab ein Problem beim Upload der Hochschulberechtigung.</br>";
		exit();
	}
}

//Beglaubigtes Abschlusszeugnis Sekundarstufe I & Berufsausbildung
//Encode und POST an Camunda REST, wenn Abschlusszeugnis oder Berufsausbildung erwartet wird
if (file_exists($_FILES['schulzeugnis']['tmp_name'])){
	//Der Name der Datei im lokalen Ablageordner
	$filename = "zeug".$id."-".generateRandomString(5).".pdf";
	//Der Pfad des Ablageorts des Dokuments + Dokumentenname
	$target_file = "uploads/".$filename;
	// ???
	if (move_uploaded_file($_FILES["schulzeugnis"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["schulzeugnis"]["name"]). " has been uploaded.</br>";
		//File aus Ablageordner entnehmen
		$data = file_get_contents($target_file);
		//Encode String der Datei zu dem Format Base64 für die Camunda REST Schnittstelle
		$encoded = base64_encode($data);
		//Erstellung des REST-Variable zum Push an Camunda REST Schnittstelle
		if(empty($filegelump)){
			$filegelump .= '"uSchulzeugnis": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'", "mimeType": "application/pdf"}}';
		}else{
			$filegelump .= ', "uSchulzeugnis": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'", "mimeType": "application/pdf"}}';
		}
		
	}
	//Wenn Dokument fehlt, dann Fehlermeldung
	else {
		echo "Sorry, es gab ein Problem beim Upload von 'Beglaubigtes Abschlusszeugnis Sekundarstufe I & Berufsausbildung'.</br>";
		exit();
	}
}

//Krankenkassenbescheinigung
//Encode und POST an Camunda REST, wenn Krankenkassenbescheinigung erwartet wird
if (file_exists($_FILES['krankenkassenbescheinigung']['tmp_name'])){
	//Der Name der Datei im lokalen Ablageordner
	$filename = "krank".$id."-".generateRandomString(5).".pdf";
	//Der Pfad des Ablageorts des Dokuments + Dokumentenname
	$target_file = "uploads/".$filename;
	// ???
	if (move_uploaded_file($_FILES["krankenkassenbescheinigung"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["krankenkassenbescheinigung"]["name"]). " has been uploaded.</br>";
		//File aus Ablageordner entnehmen
		$data = file_get_contents($target_file);
		//Encode String der Datei zu dem Format Base64 für die Camunda REST Schnittstelle
		$encoded = base64_encode($data);
		//Erstellung des REST-Variable zum Push an Camunda REST Schnittstelle
		if(empty($filegelump)){
			$filegelump .= '"uKrankenkassenbescheinigung": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'","mimeType": "application/pdf"}}';
		}else{
			$filegelump .= ', "uKrankenkassenbescheinigung": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'","mimeType": "application/pdf"}}';
		}
		
	}
	//Wenn Dokument fehlt, dann Fehlermeldung
	else {
		echo "Sorry, es gab ein Problem beim Upload der Krankenkassenbescheinigung.</br>";
		exit();
	}
}

//Passbild
//Encode und POST an Camunda REST, wenn Passbild erwartet wird
if (file_exists($_FILES['passbild']['tmp_name'])){
	//Der Name der Datei im lokalen Ablageordner
	$filename = "bild".$id."-".generateRandomString(5).".pdf";
	//Der Pfad des Ablageorts des Dokuments + Dokumentenname
	$target_file = "uploads/".$filename;
	// ???
	if (move_uploaded_file($_FILES["passbild"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["passbild"]["name"]). " has been uploaded.</br>";
		//File aus Ablageordner entnehmen
		$data = file_get_contents($target_file);
		//Encode String der Datei zu dem Format Base64 für die Camunda REST Schnittstelle
		$encoded = base64_encode($data);
		//Erstellung des REST-Variable zum Push an Camunda REST Schnittstelle
		if(empty($filegelump)){
			$filegelump .= '"uPassbild": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'", "mimeType": "application/pdf"}}';
		}else{
			$filegelump .= ', "uPassbild": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'", "mimeType": "application/pdf"}}';
		}
		
	}
	//Wenn Dokument fehlt, dann Fehlermeldung
	else {
		echo "Sorry, es gab ein Problem beim Upload des Passbildes.</br>";
		exit();
	}
}

//Nachweis Studiennachweis Bachelor
//Encode und POST an Camunda REST, wenn Studiennachweis Bachelor erwartet wird
if (file_exists($_FILES['bachelor']['tmp_name'])){
	//Der Name der Datei im lokalen Ablageordner
	$filename = "nachw".$id."-".generateRandomString(5).".pdf";
	//Der Pfad des Ablageorts des Dokuments + Dokumentenname
	$target_file = "uploads/".$filename;
	// ???
	if (move_uploaded_file($_FILES["bachelor"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["bachelor"]["name"]). " has been uploaded.</br>";
		//File aus Ablageordner entnehmen
		$data = file_get_contents($target_file);
		//Encode String der Datei zu dem Format Base64 für die Camunda REST Schnittstelle
		$encoded = base64_encode($data);
		//Erstellung des REST-Variable zum Push an Camunda REST Schnittstelle
		if(empty($filegelump)){
			$filegelump .= '"uBachelor": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'", "mimeType": "application/pdf"}}';
		}else{
			$filegelump .= ', "uBachelor": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'", "mimeType": "application/pdf"}}';
		}
		
	}
	//Wenn Dokument fehlt, dann Fehlermeldung
	else {
		echo "Sorry, es gab ein Problem beim Upload des Bachelor Nachweises.</br>";
		exit();
	}
}

//Leistungsnachweis für Studienwechsler
//Encode und POST an Camunda REST, wenn Leistungsnachweis für Studienwechsler erwartet wird
if (file_exists($_FILES['leistungsnachweis']['tmp_name'])){
	//Der Name der Datei im lokalen Ablageordner
	$filename = "nachw".$id."-".generateRandomString(5).".pdf";
	//Der Pfad des Ablageorts des Dokuments + Dokumentenname
	$target_file = "uploads/".$filename;
	// ???
	if (move_uploaded_file($_FILES["leistungsnachweis"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["leistungsnachweis"]["name"]). " has been uploaded.</br>";
		//File aus Ablageordner entnehmen
		$data = file_get_contents($target_file);
		//Encode String der Datei zu dem Format Base64 für die Camunda REST Schnittstelle
		$encoded = base64_encode($data);
		//Erstellung des REST-Variable zum Push an Camunda REST Schnittstelle
		if(empty($filegelump)){
			$filegelump .= '"uLeistungsnachweis": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'", "mimeType": "application/pdf"}}';
		}else{
			$filegelump .= ', "uLeistungsnachweis": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'", "mimeType": "application/pdf"}}';
		}
		
	}
	//Wenn Dokument fehlt, dann Fehlermeldung
	else {
		echo "Sorry, es gab ein Problem beim Upload des Leistungsnachweises.</br>";
		exit();
	}
}

//Nachweis Sprachzeugnis
//Encode und POST an Camunda REST, wenn Sprachzeugnis erwartet wird
if (file_exists($_FILES['sprachzeugnis']['tmp_name'])){
	//Der Name der Datei im lokalen Ablageordner
	$filename = "nachw".$id."-".generateRandomString(5).".pdf";
	//Der Pfad des Ablageorts des Dokuments + Dokumentenname
	$target_file = "uploads/".$filename;
	// ???
	if (move_uploaded_file($_FILES["sprachzeugnis"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["sprachzeugnis"]["name"]). " has been uploaded.</br>";
		//File aus Ablageordner entnehmen
		$data = file_get_contents($target_file);
		//Encode String der Datei zu dem Format Base64 für die Camunda REST Schnittstelle
		$encoded = base64_encode($data);
		//Erstellung des REST-Variable zum Push an Camunda REST Schnittstelle
		if(empty($filegelump)){
			$filegelump .= '"uSprachzeugnis": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'", "mimeType": "application/pdf"}}';
		}else{
			$filegelump .= ', "uSprachzeugnis": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'", "mimeType": "application/pdf"}}';
		}
		
	}
	//Wenn Dokument fehlt, dann Fehlermeldung
	else {
		echo "Sorry, es gab ein Problem beim Upload des Sprachzeugnises.</br>";
		exit();
	}
}

//Print der der vollständigen REST-Variable
echo "<pre>";
print_r($filegelump);
echo "</pre>";  


$data = '{"modifications": { '.$filegelump.'}}';   

echo "<pre>";
print_r($data);
echo "</pre>";  
  
//Nach localVariables muss eigentlich der Name dynamisch vergeben werden, für meinen Testversuch jedoch erstmal nicht
$cupdatefile = curl_init('http://localhost:8080/engine-rest/execution/'.$_POST['key'].'/localVariables');   
curl_setopt($cupdatefile, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($cupdatefile, CURLOPT_POSTFIELDS, $data);
curl_setopt($cupdatefile, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cupdatefile, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json')          
);  
$result = curl_exec($cupdatefile);
curl_close($cupdatefile);  

echo "<pre>";
print_r($result);
echo "</pre>"; 

                                                                            

$mData = '{"messageName": "updateDokumente", "processInstanceId": "'.$_POST['key'].'"}';   
echo "<pre>";
print_r($mData);
echo "</pre>";    
$cupdate = curl_init('http://localhost:8080/engine-rest/message');
curl_setopt($cupdate, CURLOPT_CUSTOMREQUEST, "POST");                    
curl_setopt($cupdate, CURLOPT_POSTFIELDS, $mData);    
curl_setopt($cupdate, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cupdate, CURLOPT_HTTPHEADER, array(                              
    'Content-Type: application/json')                  
);  
$result2 = curl_exec($cupdate);
curl_close($cupdate);  

echo "<pre>";
print_r($result2);
echo "</pre>";  


?>