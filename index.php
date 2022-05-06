<!DOCTYPE>
<html>
<head>
    <title>MLDM-Lab4-ShortestPathOnTheGraph</title>
    <script
            src = "https://code.jquery.com/jquery-3.6.0.js"
            integrity = "sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossOrigin = "anonymous" >
    </script>
    <script src = "js/index.js"></script>
</head>
<body>
    <textarea id = "matrix_adjacency" cols = "30" rows = "10"></textarea><br>
    <br>
    <input type = "text" id = "input_source" size = "9">
    <input type = "text" id = "input_destination" size = "9"><br><br>
    <button id = "getShortestPath" onclick = "
    let matrix_adjacency = document.getElementById('matrix_adjacency').value;
    let source = document.getElementById('input_source').value;
    let destination = document.getElementById('input_destination').value;

    let message = {
        'matrix_adjacency': matrix_adjacency,
        'source'          : source,
        'destination'     : destination
    }

    send(message);
    ">Get shortest path</button><br><br>
    <p class = "output"></p>

    <div id = "divForOutput"></div>



</body>
</html>