<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#Pasa de formato x:x:x a milisegundos

function pasarATiempo($tiempo) {
    if ($tiempo == '::')
        return FALSE;
    else {
        $tiempo = preg_split("/[:]/", $tiempo);
        $milisegundos = ((int) $tiempo[0]) * 3600 + ((int) $tiempo[1]) * 60 + ((int) $tiempo[2]);
        return $milisegundos;
    }
}

#Pasa de formato milisegundos a x:x:x

function pasarATiempoFormato($tiempo) {
    $minutos = (int) ($tiempo / 3600);
    $milisegundos = (int) ($tiempo % 3600);

    $segundos = (int) ($milisegundos / 60);
    $milisegundos = (int) ($milisegundos % 60);

    return "$minutos:$segundos:$milisegundos";
}

function matrizContenido($contenido) {
    $arrayContenido = preg_split("/[\n]/", $contenido);
    foreach ($arrayContenido as $value) {
        $value = preg_split("/[;]/", $value);

        $aux['id'] = $value[0];
        $aux['nombre'] = $value[1];
        $aux['equipo'] = $value[2];

        $tiempo = pasarATiempo($value[3]);

        if (!$tiempo) {
            $aux['retirado'] = 1;
            $aux['tiempo'] = 0;
        } else {
            $aux['retirado'] = 0;
            $aux['tiempo'] = $tiempo;
        }

        $matrizContenido[] = $aux;
    }

    return $matrizContenido;
}

function imprimirVueltaRapida($vuelta, $nombreCarrera, $fecha) {

    $tiempo = pasarATiempoFormato($vuelta['tiempo']);

    echo '<table>';

    echo '<tr>';
    echo "<td>$nombreCarrera</td>";
    echo '</tr>';

    echo '<tr>';
    echo "<td>$fecha</td>";
    echo '</tr>';

    echo '<tr>';
    echo "<td>{$vuelta['id']}</td>"; #numero de vuelta
    echo "<td>{$vuelta['nombre']}</td>"; #nombre del piloto
    echo "<td>{$vuelta['equipo']}</td>"; #nombre del equipo
    echo "<td>$tiempo</td>"; #tiempo
    echo '</tr>';

    echo '</table>';
}

function imprimirVencedor($vencedor, $nombreCarrera, $fecha) {

    $tiempo = pasarATiempoFormato($vencedor['tiempo']);
    echo '<table>';

    echo '<tr>';
    echo "<td>$nombreCarrera</td>";
    echo '</tr>';

    echo '<tr>';
    echo "<td>$fecha</td>";
    echo '</tr>';

    echo '<tr>';
    echo "<td>{$vencedor['nombre']}</td>"; #nombre del piloto
    echo "<td>{$vencedor['equipo']}</td>"; #nombre del equipo
    echo "<td>$tiempo</td>"; #milisegundos
    echo '</tr>';

    echo '</table>';
}

function imprimirEquipoVencedor($vencedor, $nombreCarrera, $fecha) {
    $tiempo = pasarATiempoFormato($vencedor['tiempo']);

    echo '<table>';

    echo '<tr>';
    echo "<td>$nombreCarrera</td>";
    echo '</tr>';

    echo '<tr>';
    echo "<td>$fecha</td>";
    echo '</tr>';

    echo '<tr>';
    echo "<td>{$vencedor['equipo']}</td>"; #nombre del equipo
    echo "<td>$tiempo</td>"; #milisegundos
    echo '</tr>';

    echo '</table>';
}

function sortPorTiempo($a, $b) {
    if ($a['retirado'] == TRUE) {
        return 1;
    } elseif ($b['retirado'] == TRUE) {
        return 0;
    } else
        return $a['tiempo'] > $b['tiempo'];
}

function sortPorNombre($a, $b) {
    if ($a['nombre'] > $b['nombre'])
        return 0;
    elseif ($a['nombre'] < $b['nombre'])
        return 1;
    else
        return $a['id'] > $b['id'];
}

function sortPorEquipo($a, $b) {
    return $a['equipo'] > $b['equipo'];
}

function vueltaRapida($matrizContenido) {
    usort($matrizContenido, "sortPorTiempo");
    return $matrizContenido[0];
}

function filtroNumeroVueltas($matrizContenido) {
    usort($matrizContenido, "sortPorNombre");

    $cont = 1;
    $numeroVueltas = FALSE;
    $retirado = 0;
    $correcto = TRUE;

    foreach ($matrizContenido as $v) {
        if ($v['id'] == $cont) {
            $cont++;
        } elseif ($v['id'] == 1 && !$retirado) {
            if (!$numeroVueltas) {
                $numeroVueltas = $cont - 1;
                if ($numeroVueltas < 1 || $numeroVueltas > 50) {
                    $correcto = FALSE;
                    break;
                }
            } elseif ($numeroVueltas != $cont - 1) {
                $correcto = FALSE;
                break;
            }
            $cont = 2;
        } elseif ($v['id'] == 1 && $retirado) {
            $cont = 2;
        } else {
            $correcto = FALSE;
            break;
        }

        $retirado = $v['retirado'];
    }

    if (!$numeroVueltas) {
        if ($v['retirado']) {
            $correcto = FALSE;
        } elseif ($cont - 1 < 1 || $cont - 1 > 50) {
            $correcto = FALSE;
        }
    }

    return $correcto;
}

function filtroEquipo($matrizContenido) {
    usort($matrizContenido, "sortPorEquipo");
    $correcto = TRUE;

    foreach ($matrizContenido as $v) {
        if (empty($arrayEquipos[$v['equipo']])) {
            $arrayEquipos[$v['equipo']] = [$v['nombre']];
        } elseif (!in_array($v['nombre'], $arrayEquipos[$v['equipo']])) {
            $arrayEquipos[$v['equipo']][] = $v['nombre'];
        }

        if (count($arrayEquipos[$v['equipo']]) > 2) {
            $correcto = FALSE;
            break;
        }
    }

    foreach ($arrayEquipos as $equipo) {
        if (count($equipo) != 2) {
            $correcto = FALSE;
            break;
        }
    }

    return $correcto;
}

function vencedor($matrizContenido) {

    foreach ($matrizContenido as $vuelta) {

        if ($vuelta['retirado']) {
            $arrayTiempos[$vuelta['nombre']]['retirado'] = 1;
        } elseif (isset($arrayTiempos[$vuelta['nombre']]['tiempo'])) {
            $arrayTiempos[$vuelta['nombre']]['tiempo'] += $vuelta['tiempo'];
        } else { //inicializacion
            $arrayTiempos[$vuelta['nombre']]['tiempo'] = $vuelta['tiempo'];
            $arrayTiempos[$vuelta['nombre']]['retirado'] = 0;
            $arrayTiempos[$vuelta['nombre']]['nombre'] = $vuelta['nombre'];
            $arrayTiempos[$vuelta['nombre']]['equipo'] = $vuelta['equipo'];
        }
    }

    usort($arrayTiempos, "sortPorTiempo");
    return $arrayTiempos[0];
}

function equipoVencedor($matrizContenido) {
    foreach ($matrizContenido as $vuelta) {

        if ($vuelta['retirado']) {
            $arrayTiempos[$vuelta['equipo']]['retirado'] = 1;
        } elseif (isset($arrayTiempos[$vuelta['equipo']]['tiempo'])) {
            $arrayTiempos[$vuelta['equipo']]['tiempo'] += $vuelta['tiempo'];
        } else { //inicializacion
            $arrayTiempos[$vuelta['equipo']]['tiempo'] = $vuelta['tiempo'];
            $arrayTiempos[$vuelta['equipo']]['retirado'] = 0;
            $arrayTiempos[$vuelta['equipo']]['equipo'] = $vuelta['equipo'];
        }
    }

    usort($arrayTiempos, "sortPorTiempo");
    return $arrayTiempos[0];
}
?>

