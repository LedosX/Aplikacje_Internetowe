<?php require_once dirname(__FILE__).'/../config.php'; ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator kredytowy</title>
</head>
<body>

<form action="<?php print(_APP_URL); ?>/app/calc.php" method="post">
    <label for="id_kwota">Kwota kredytu (zł): </label>
    <input id="id_kwota" type="text" name="kwota" value="<?php echo htmlspecialchars((string)($kwota ?? ''), ENT_QUOTES, 'UTF-8'); ?>" /><br />
    <label for="id_lata">Liczba lat kredytu: </label>
    <input id="id_lata" type="text" name="lata" value="<?php echo htmlspecialchars((string)($lata ?? ''), ENT_QUOTES, 'UTF-8'); ?>" /><br />
    <label for="id_procent">Oprocentowanie roczne (%): </label>
    <input id="id_procent" type="text" name="procent" value="<?php echo htmlspecialchars((string)($procent ?? ''), ENT_QUOTES, 'UTF-8'); ?>" /><br />
    <input type="submit" value="Oblicz" />
</form>

<?php
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($rata)) { ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
    <?php echo 'Miesięczna rata: '.number_format($rata, 2, ',', ' ').' zł'; ?><br />
</div>
<?php } ?>

</body>
</html>
