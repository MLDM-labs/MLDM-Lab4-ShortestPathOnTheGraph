<?php
const LARGE_NUMBER = 99999999;

function findShortestPath($matrix_adjacency, $source, $dest, $short)
{
    if($source == $dest)
        return [0, $short];

    $short[$dest] = -2;
    $sizeMatrix = count($matrix_adjacency);

    $isFind = false;
    $min = LARGE_NUMBER;
    for($x = 0; $x < $sizeMatrix; $x++)
    {
        if($matrix_adjacency[$dest][$x] != 0) {
            if($short[$x] != -2) {
                if ($short[$x] == -1) {
                    $result = findShortestPath($matrix_adjacency, $source, $x, $short);
                    $short = $result[1];
                    $short[$x] = $result[0];
                }
                $path = $matrix_adjacency[$dest][$x] + $short[$x];

                if ($path < $min) $min = $path;
                $isFind = true;
            }
        }
    }

    if($isFind) {
        $short[$dest] = $min;
        return [$min, $short];
    } else{
        return [-1, $short];
    }
}

function findShort($matrix_adjacency, $source, $dest)
{
    $sizeMatrix = count($matrix_adjacency);
    $short = array($sizeMatrix);
    for($x = 0; $x < $sizeMatrix; $x++)
        $short[$x] = -1;
    return findShortestPath($matrix_adjacency, $source, $dest, $short)[1];
}

function findPath($matrix_adjacency, $short, $source, $dest)
{
    $sizeMatrix = count($short);

    $way = array($sizeMatrix);
    $sizeWay = 0;

    while($dest != $source) {
        $min = LARGE_NUMBER;
        $idMin = -1;
        for ($x = 0; $x < $sizeMatrix; $x++) {
            if ($matrix_adjacency[$dest][$x] != 0 && $short[$x] >= 0) {
                $path = $matrix_adjacency[$dest][$x] + $short[$x];
                if ($path < $min) {
                    $min = $path;
                    $idMin = $x;
                }
            }
        }

        $way[$sizeWay] = $dest;
        $sizeWay++;

        $dest = $idMin;
    }

    $way[$sizeWay] = $dest;
    $sizeWay++;

    for($x = $sizeWay - 1; $x >= 0; $x--){
        echo $way[$x];
        if($x != 0)
            echo "->";
    }
}

$message = $_POST['matrix_adjacency'];
$source = $_POST['source'];
$dest = $_POST['destination'];

$matrix_adjacencyElements = preg_split('/[ \n]/', $message);
$sizeMatrix = sqrt(count($matrix_adjacencyElements));

if(($dest >= 0 && $dest < $sizeMatrix) && ($source >= 0 && $source < $sizeMatrix) ) {
    $isFormat = true;
    for ($x = 0; $x < $sizeMatrix * $sizeMatrix; $x++) {
        if ($matrix_adjacencyElements[$x] != '0' && !ctype_digit($matrix_adjacencyElements[$x]) && !is_int($matrix_adjacencyElements[$x])) {

            $isFormat = false;
            break;
        }
    }

    if ($isFormat) {
        if ($sizeMatrix - (int)$sizeMatrix == 0) {
            $matrix_adjacency = array($sizeMatrix);
            for ($x = 0; $x < $sizeMatrix; $x++) {
                $matrix_adjacency[$x] = array($sizeMatrix);
                for ($y = 0; $y < $sizeMatrix; $y++)
                    $matrix_adjacency[$x][$y] = $matrix_adjacencyElements[$x + $y * $sizeMatrix];
            }

            $short = findShort($matrix_adjacency, $source, $dest);
            $countBreak = 0;
            for ($x = 0; $x < $sizeMatrix; $x++)
                if ($short[$x] > 0)
                    $countBreak++;

            if ($countBreak > 0) {
                echo "Shortest path length: " . $short[$dest];
                echo "<br> Path: ";
                findPath($matrix_adjacency, $short, $source, $dest);
            } else {
                echo "It is not possible to find the path";
            }
        } else {
            echo "The matrix must be squared";
        }
    } else {
        echo "Invalid data format. The table must consist of zeros and natural digits";
    }
} else {
    echo "The numbers of starting or ending points is entered wrong <br> They must be more or equals to zero and less than the size of matrix";
}