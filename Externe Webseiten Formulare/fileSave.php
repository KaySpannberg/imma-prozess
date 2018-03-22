
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
		$filegelump .= '"uPersonalausweis": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'"}}';
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
		$filegelump .= ', "uHochschulzugangsberechtigung": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'"}}';
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
		$filegelump .= ', "uSchulzeugnis": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'"}}';
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
		$filegelump .= ', "uKrankenkassenbescheinigung": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'"}}';
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
		$filegelump .= ', "uPassbild": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'"}}';
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
		$filegelump .= ', "uBachelor": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'"}}';
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
		$filegelump .= ', "uLeistungsnachweis": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'"}}';
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
		$filegelump .= ', "uSrachzeugnis": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'"}}';
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

//-->Abfrage der TaskID über die ProcessInstanceID mittel GET Befehl über CURL an die REST vom Camunda Tomcat<--
//CURL Initialsierung
$cgetid = curl_init();
//Setzen der Standardoptionen und die POST URL zum erfahren wie die TaskID lautet
curl_setopt_array($cgetid, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://127.0.0.1:8080/engine-rest/task?processInstanceId='.$_POST['key'].'&taskDefinitionKey=uploadDoc'
));
//Ergebnis der Abfrage, vollständiger JSON/Array
$result = curl_exec($cgetid);
curl_close($cgetid);
//Decode des JSON/Array um die TaskID herauszufiltern
$decoded = json_decode($result);
//Print des decodeten JSON/Array
echo "<pre>";
print_r($decoded);
echo "</pre>";  
//TaskID herausfiltern
$taskid = $decoded['0']->id;

//Print der abgefragten TaskID zur Kontrolle
echo $taskid."</br>";

//Setzen der REST-Variable, um die User-Task zu claimen
//User-Task wird durch den Benutzer "Demo" geclaimt
$data = array("userId" => "demo");  
//Encode REST-Variable in JSON für die Camunda REST                                                               
$data_string = json_encode($data);
//Print des JSON/String zum Claim der User-Task
echo "<pre>";
print_r($data_string);
echo "</pre>";                                                                                  

$cclaim = curl_init('http://localhost:8080/engine-rest/task/'.$taskid.'/claim');                                                                      
curl_setopt($cclaim, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($cclaim, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($cclaim, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($cclaim, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json')                                                                       
);                                                                                                                   

$result = curl_exec($cclaim);
curl_close($cclaim);



$data = '{"variables": { '.$filegelump.'}}';                                                                 
echo "<pre>";
print_r($data_string);
echo "</pre>";                                                                                  

$csendfile = curl_init('http://localhost:8080/engine-rest/task/'.$taskid.'/submit-form');                                                                      
curl_setopt($csendfile, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($csendfile, CURLOPT_POSTFIELDS, $data);                                                                  
curl_setopt($csendfile, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($csendfile, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json')                                                                       
);                                                                                                                   

$result = curl_exec($csendfile);
curl_close($csendfile);
echo "<pre>";
print_r($result);
echo "</pre>";  
?>