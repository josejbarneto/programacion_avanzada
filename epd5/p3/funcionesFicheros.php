<?php

function leerFichero($file, $campos) {
    $rows = array_map(function($v) {
        return str_getcsv($v, ";");
    }, file($file));

    $csv = [];
    foreach ($rows as $row) {
        $csv[] = array_map('trim',array_combine($campos, $row));
    }
    return $csv;
}
