<?php
class Weight
{
    public $cost;
    public $source;
    public $destination;

    public function __construct($cost, $source, $destination)
    {
        $this->cost = $cost;
        $this->source = $source;
        $this->destination = $destination;
    }
}

class Vertex
{
    public $id;
    public $weights;
    public $shortestPath;
    private $shortestPathDist;


    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getShortestPathDistance()
    {
        $shortestPathDist = $this->shortestPath[count($this->shortestPath) - 1]->cost + $this->shortestPath[count($this->shortestPath) - 1]->source->shortestPathDist;
    }
}

class Graph
{
    public $vertices = [];

    public function __construct($matrix_adjacency)
    {
        for($i = 0; $i < count($matrix_adjacency); $i++)
        {
            $this->vertices[$i] = new Vertex($i);
        }

        for($y = 0; $y < count($matrix_adjacency); $y++)
        {
            $weights = [];
            for($x = 0; $x < count($matrix_adjacency[$y]); $x++)
            {
                if(is_numeric($matrix_adjacency[$x][$y]))
                {
                    $cost = $matrix_adjacency[$x][$y];
                    $source = $this->vertices[$y];
                    $destination = $this->vertices[$x];
                    $weights[count($weights)] = new Weight($cost, $source, $destination);
                }
            }
            $this->vertices[$y]->weights = $weights;
        }
    }

    public function getMinPath($src, $dest)
    {
        for($i = 0; $i < count($this->vertices); $i++)
        {
            $this->vertices[$i]->shortestPath = [];
            $this->vertices[$i]->shortestPathDist = -1;
        }

        $this->vertices[$src]->shortestPathDist = 0;

        for($i = 0; $i < count($this->vertices); $i++)
        {
            if($this->vertices[$i]->shortestPathDist >= 0)
            {
                for($j = 0; $j < count($this->vertices[$i]->weights); $j++)
                {
                    /*
                    if($this->vertices[$i]->weights[$j]->destination->shortestPathDist < 0 ||
                        $this->vertices[$i]->weights[$j]->destination->shortestPathDist >= $this->vertices[$i]->weights[$j]->cost +
                    )
                    {

                    }
                    */
                }
            }
        }

    }
}



/*
class Vertex
{
    public $minPathDistance = -1;
    public $minPath = [];
    public $connectedVertices = [];

    public function __construct()
    {
    }

    public function getMinPathDistance()
    {
        $this->$minPath[count($this->$minPath) - 2]->getMinPathDistance()
    }
}
*/

$matrix_adjacency = $_POST['matrix_adjacency'];
$source = $_POST['source'];
$destination = $_POST['destination'];

$matrix_adjacency = preg_split('/[\n]/', $matrix_adjacency);
for($i = 0; $i < count($matrix_adjacency); $i++)
{
    $matrix_adjacency[$i] = preg_split('/[ ]/', $matrix_adjacency[$i]);
}

/*
$vertices = [];
for($i = 0; $i < count($matrix_adjacency); $i++)
{
    $vertices[$i] = new Vertex();
}


for($y = 0; $y < count($matrix_adjacency); $y++)
{
    $connectedVertices = [];
    for($x = 0; $x < count($matrix_adjacency[$y]); $x++)
    {
        if(is_numeric($matrix_adjacency[$x][$y]))
        {
            $connectedVertices[count($connectedVertices)] = [$vertices[$x], $matrix_adjacency[$y][$x]];
        }
    }
    $count = count($vertices[$y]->$connectedVertices);
    $vertices[$y]->$connectedVertices[$count] = $connectedVertices;
}
*/

$graph = new Graph($matrix_adjacency);


$graph->vertices[0]->weights[0]->destination->shortestPathDist = 100000;
echo $graph->vertices[1]->shortestPathDist;


/*
for($i = 0; $i < count($matrix_adjacency); $i++)
{
    for($j = 0; $j < count($matrix_adjacency[$i]); $j++)
    {
        echo $matrix_adjacency[$i][$j] . " ";
    }
    echo "<br>";
}
*/