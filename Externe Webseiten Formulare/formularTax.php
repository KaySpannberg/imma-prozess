<?php
//--Schlüsselwörter zur Darstellung der Uploadfenster--
//nachw = Nachweis Studiengebühr / Kontoauszug
//betr = Zu zahlende Betrag
?>

<html>
<head>
<title>Dokumentenupload</title>
</head>
<body>

    <form action="fileSaveTax.php" method="POST" enctype="multipart/form-data">
        <div id="fileSection">
            <h1>Dokumentenupload</h1>
			Bitte überweisen sie den folgenden Betrag an das Konto der Hochschule.</p>
			Betrag/Studiengebühr: <?php echo $_GET['betr'];?></br>
			Empfänger:Landeshauptkasse / TH Brandenburg</br>
			Kreditinstitut: Landesbank Hessen-Thüringen(Helaba)</br>
			IBAN: DE 13 3005 0000 7110 402869<br>
			BIC/Swift: WELADEDDXXX</p>
            <table>
			<input type="hidden" name="key" value="<?php echo $_GET['key'];?>">
				<?php 
	
				if (isset($_GET['nachw']))
				{
					if ($_GET['nachw'] == 'true')
					{
						?>
						<tr>
							<td>Nachweis Kontoauszug</td>
							<td><input type="file" name="studiengebuehr" size="45" accept="application/pdf"></td>
						</tr>
						<?php
					}
				}
				
				?>
            </table>
        </div>
        <p />
        <input type="submit" value="Senden" />
    </form>
</body>
</html>