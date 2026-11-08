<?php
require_once dirname(__FILE__).'/../config.php';

$kwota = isset($_REQUEST['kwota']) ? trim((string)$_REQUEST['kwota']) : null;
$lata = isset($_REQUEST['lata']) ? trim((string)$_REQUEST['lata']) : null;
$procent = isset($_REQUEST['procent']) ? trim((string)$_REQUEST['procent']) : null;
$messages = [];



// 2. Walidacja parametrów
if (isset($kwota) && isset($lata) && isset($procent)) {

if ($kwota === '') {
    $messages[] = 'Nie podano kwoty kredytu';
}
if ($lata === '') {
    $messages[] = 'Nie podano liczby lat kredytu';
}
if ($procent === '') {
    $messages[] = 'Nie podano oprocentowania';
}

if (empty($messages)) {

    $kwota = str_replace(',', '.', $kwota);
    $lata = str_replace(',', '.', $lata);
    $procent = str_replace(',', '.', $procent);

    if (!is_numeric($kwota) || !is_finite((float)$kwota) || (float)$kwota <= 0) {
        $messages[] = 'Kwota kredytu musi być liczbą większą od zera';
    }
    if (!ctype_digit($lata) || (int)$lata <= 0 || (int)$lata > 100) {
        $messages[] = 'Liczba lat musi być liczbą całkowitą od 1 do 100';
    }
    if (!is_numeric($procent) || !is_finite((float)$procent) || (float)$procent < 0 || (float)$procent > 100) {
        $messages[] = 'Oprocentowanie musi być liczbą od 0 do 100';
    }
}

if (empty($messages)) {
    $kwota = (float)$kwota;
    $lata = (int)$lata;
    $procent = (float)$procent;

    $liczba_rat = $lata * 12;
    $oprocentowanie_miesieczne = $procent / 100 / 12;

    if ($oprocentowanie_miesieczne == 0) {
        $rata = $kwota / $liczba_rat;
    } else {
        $czynnik = pow(1 + $oprocentowanie_miesieczne, -$liczba_rat);
        $rata = $kwota * $oprocentowanie_miesieczne / (1 - $czynnik);
    }
}
}
include dirname(__FILE__).'/calc_view.php';
