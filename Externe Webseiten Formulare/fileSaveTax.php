
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

//Nachweis Studiengebühr
//Encode und POST an Camunda REST, wenn Studiengebühr erwartet wird
if (file_exists($_FILES['studiengebuehr']['tmp_name'])){
	//Der Name der Datei im lokalen Ablageordner
	$filename = "nachw".$id."-".generateRandomString(5).".pdf";
	//Der Pfad des Ablageorts des Dokuments + Dokumentenname
	$target_file = "uploads/".$filename;
	// ???
	if (move_uploaded_file($_FILES["studiengebuehr"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["studiengebuehr"]["name"]). " has been uploaded.</br>";
		//File aus Ablageordner entnehmen
		$data = file_get_contents($target_file);
		//Encode String der Datei zu dem Format Base64 für die Camunda REST Schnittstelle
		$encoded = base64_encode($data);
		//Erstellung des REST-Variable zum Push an Camunda REST Schnittstelle
		$filegelump .= '"uStudiengebuehr": { "value": "'.$encoded.'", "type": "File", "valueInfo": {"filename": "'.$filename.'"}}';
	}
	//Wenn Dokument fehlt, dann Fehlermeldung
	else {
		echo "Sorry, es gab ein Problem beim Upload des Nachweises für die Studiengebuehr.</br>";
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
    CURLOPT_URL => 'http://127.0.0.1:8080/engine-rest/task?processInstanceId='.$_POST['key'].'&taskDefinitionKey=uploadTax'
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