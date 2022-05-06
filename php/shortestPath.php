<?php

//$start, $end - просто числа, которые содержат номера точек
//$short - массив, содержащий кратчайшие длины пути до точки. С самого начала должен быть заполнен -1
function findShortestPath($matrix, $start, $end, $short)
{
    if($start == $end)
        return [0, $short];

    $short[$end] = -2;
    $sizeMatrix = count($matrix);

    $isFind = false;
    $min = 99999999; //Потом поменять желательно
    for($x = 0; $x < $sizeMatrix; $x++)
    {
        if($matrix[$end][$x] != 0) {
            if($short[$x] != -2) {
                if ($short[$x] == -1) {
                    $result = findShortestPath($matrix, $start, $x, $short);
                    $short = $result[1];
                    $short[$x] = $result[0];
                }
                $path = $matrix[$end][$x] + $short[$x];

                if ($path < $min) $min = $path;
                $isFind = true;
            }
        }
    }

    if($isFind) {
        $short[$end] = $min;
        return [$min, $short];
    } else{
        return [-1, $short];
    }
}

function findShort($matrix, $start, $end)
{
    $sizeMatrix = count($matrix);
    $short = array($sizeMatrix);
    for($x = 0; $x < $sizeMatrix; $x++)
        $short[$x] = -1;
    return findShortestPath($matrix, $start, $end, $short)[1];
}

function findPath($matrix, $short, $start, $end)
{
    $sizeMatrix = count($short);

    $way = array($sizeMatrix);
    $sizeWay = 0;

    while($end != $start) {
        $min = 999999;
        $idMin = -1;
        for ($x = 0; $x < $sizeMatrix; $x++) {
            if ($matrix[$end][$x] != 0 && $short[$x] >= 0) {
                $path = $matrix[$end][$x] + $short[$x];
                if ($path < $min) {
                    $min = $path;
                    $idMin = $x;
                }
            } else {
//Ошибка: нет ни одного пути ведущего в узел
            }
        }

        $way[$sizeWay] = $end;
        $sizeWay++;

        $end = $idMin;
    }

    $way[$sizeWay] = $end;
    $sizeWay++;

    for($x = $sizeWay - 1; $x >= 0; $x--){
        echo $way[$x];
        if($x != 0)
            echo "->";
    }
}


$message = $_POST['matrix'];
$start = $_POST['start'];
$end = $_POST['end'];

$matrixElements = preg_split('/[ \n]/', $message);
$sizeMatrix = sqrt(count($matrixElements));

if(($start >= 0 && $start < $sizeMatrix) && ($end >= 0 && $end < $sizeMatrix)) {
    $isFormat = true;
    for ($x = 0; $x < $sizeMatrix * $sizeMatrix; $x++) {
        if ($matrixElements[$x] != '0' && !ctype_digit($matrixElements[$x]) && !is_int($matrixElements[$x])) {

            $isFormat = false;
            break;
        }
    }

    if ($isFormat) {
        if ($sizeMatrix - (int)$sizeMatrix == 0) {
            $matrix = array($sizeMatrix);
            for ($x = 0; $x < $sizeMatrix; $x++) {
                $matrix[$x] = array($sizeMatrix);
                for ($y = 0; $y < $sizeMatrix; $y++)
                    $matrix[$x][$y] = $matrixElements[$x + $y * $sizeMatrix];
            }

            $short = findShort($matrix, $start, $end);
            $countBreak = 0;
            for ($x = 0; $x < $sizeMatrix; $x++)
                if ($short[$x] > 0)
                    $countBreak++;

            if ($countBreak > 0) {
                echo "Кратчайшая длина пути: " . $short[$end];
                echo "<br> Путь: ";
                findPath($matrix, $short, $start, $end);
            } else {
                echo "Не возможно найти путь.";
            }
        } else {
            echo "Матрица должна быть квадратной.";
        }
    } else {
        echo "Не верный формат данных. Таблица должна состоять из звёздочек и натуральных чисел.";
    }
} else {
    echo "Номера начальной или конечной точки введены не верно. <br> Они должны быть больше или равны 0 и меньше размера матрицы.";
}