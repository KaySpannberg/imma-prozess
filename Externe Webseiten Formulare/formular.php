<?php
//perso = Personalausweis
//zuga = Beglaubigte Hochschulzugangsberechtigung
//zeug = Beglaubigtes Abschlusszeugnis Sekundarstufe I & Berufsausbildung
//krank = Krankenkassenbescheinigung
//bild = Passbil
//ba = Studiennachweis Bachelor
//leist = Leistungsnachweis für Studienwechsler
//spra = Sprachzeugnis
//key = ProcessInstanceId
?>

<html>
<head>
<title>Dokumentenupload</title>
</head>
<body>

    <form action="fileSave.php" method="POST" enctype="multipart/form-data">
        <div id="fileSection">
            <h1>Dokumentenupload</h1>
			Bitte laden sie die folgenden Dokumenten in PDF-Format hoch (Andere Formate werden nicht akzeptiert), drücken Sie danach auf "Senden".</p>
            <table>
			<input type="hidden" name="key" value="<?php echo $_GET['key'];?>">
				<?php 
				if (isset($_GET['perso']))
				{
					if ($_GET['perso'] == 'true')
					{
						?>
						<tr>
							<td>Personalausweis</td>
							<td><input type="file" name="personalausweis" size="45" accept="application/pdf"></td>
						</tr>
						<?php
					}
				}
				
				if (isset($_GET['zuga']))
				{
					if ($_GET['zuga'] == 'true')
					{
						?>
						<tr>
							<td>Beglaubigte Hochschulzugangsberechtigung </td>
							<td><input type="file" name="hochschulzugangsberechtigung" size="45" accept="application/pdf"></td>
						</tr>
						<?php
					}
				}
				
				if (isset($_GET['zeug']))
				{
					if ($_GET['zeug'] == 'true')
					{
						?>
						<tr>
							<td>Beglaubigtes Abschlusszeugnis Sekundarstufe I & Berufsausbildung</td>
							<td><input type="file" name="schulzeugnis" size="45" accept="application/pdf"></td>
						</tr>
						<?php
					}
				}
				
				if (isset($_GET['krank']))
				{
					if ($_GET['krank'] == 'true')
					{
						?>
						<tr>
							<td>Krankenkassenbescheinigung</td>
							<td><input type="file" name="krankenkassenbescheinigung" size="45" accept="application/pdf"></td>
						</tr>
						<?php
					}
				}
				
				if (isset($_GET['bild']))
				{
					if ($_GET['bild'] == 'true')
					{
						?>
						<tr>
							<td>Passbild</td>
							<td><input type="file" name="passbild" size="45" accept="application/pdf"></td>
						</tr>
						<?php
					}
				}
				
				if (isset($_GET['ba']))
				{
					if ($_GET['ba'] == 'true')
					{
						?>
						<tr>
							<td>Studiennachweis Bachelor</td>
							<td><input type="file" name="bachelor" size="45" accept="application/pdf"></td>
						</tr>
						<?php
					}
				}
				
				if (isset($_GET['leist']))
				{
					if ($_GET['leist'] == 'true')
					{
						?>
						<tr>
							<td>Leistungsnachweis für Studienwechsler</td>
							<td><input type="file" name="leistungsnachweis" size="45" accept="application/pdf"></td>
						</tr>
						<?php
					}
				}
				
				if (isset($_GET['spra']))
				{
					if ($_GET['spra'] == 'true')
					{
						?>
						<tr>
							<td>Sprachzeugnis</td>
							<td><input type="file" name="sprachzeugnis" size="45" accept="application/pdf"></td>
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