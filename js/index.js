
function send(message)
{
    $.ajax({
        url: 'php/shortestPath.php',
        type: 'POST',
        data: message,
        success: function(data){
            document.getElementById('divForOutput').innerHTML = data;
            //('p.output').text('Data sent!');
        }
    })
}



function getShortestPath1()
{
    let matrix_adjacency = document.getElementById('matrix_adjacency').value;

    let start = document.getElementById('input_source').value;
    let destination = document.getElementById('input_destination').value;
    let output = document.getElementById('output');

    $.ajax({
        url: 'php/test.php',
        type: 'POST',
        data: {
            matrix_adjacency: 34534,
            source: "dssdfsdfdsfsdf",
            destination: "dsdsdfsdfsdfsdfdsfdsfdsfsdfdsf"
        }, success: function(data){
            document.getElementById('divForOutput').innerHTML = data;
            //('p.output').text('Data sent!');
        }
    })

    //output.innerText = "Hi";
}

