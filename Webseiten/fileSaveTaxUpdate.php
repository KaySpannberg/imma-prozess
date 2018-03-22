
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

                                                                            

$mData = '{"messageName": "updateRestbetrag", "processInstanceId": "'.$_POST['key'].'"}';   
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