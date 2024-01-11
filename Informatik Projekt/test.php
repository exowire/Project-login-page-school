<?php
function de($data, $var_dump = false, $exit = true)
{
    $debugTrace = debug_backtrace();


    $file = null;

    if ($debugTrace[1]['file'] == null) {
        $file = $debugTrace[0]['file'];
    } else {
        $file = $debugTrace[1]['file'];
    }

    $line = null;

    if ($debugTrace[1]['line'] == null) {
        $line = $debugTrace[0]['line'];
    } else {
        $line = $debugTrace[1]['line'];
    }

    $styles = '
    .debug-wrapper {
        display: flex;
        justify-content: center;
    }
    
    .debug {
        font-size: 13px;
        font-family: sans-serif;
        color: #fff;
        background-color: #686868;
        border: solid #000;
        border-radius: 15px;
        margin: 50px;
        padding: 20px;
        max-height: 60%;
        height: fit-content;
        max-width: 80%;
        width: fit-content;
        overflow: auto;
        z-index: 99;
    }
    
    .indicator {
        font-size: 15px;
        font-weight: bold;
    }
    
    .data {
        font-weight: normal;
    }';

    echo '<style>' . $styles . '</style>';

    echo '<div class="debug-wrapper">';
    echo '<pre class="debug">';
    echo '<span class="indicator">' . $file . ' | Line: ' . $line . '</span>';
    echo '<br><br>';
    if ($var_dump) {
        echo gettype($data) . '(' . (is_string($data) || (is_numeric($data)) ? strlen($data) : count($data)) . ') ';
        print_r('<text class="data">' . print_r($data, true) . '</text>');
    } else {
        print_r('<text class="data">' . print_r($data, true) . '</text>');
    }
    echo '</pre>';
    echo '</div>';
    if ($exit) {
        exit();
    }
}

function getProjectFromDatabase() {
    // create connection to mysql with host user pass and database name
    $pdo = new PDO('mysql:host=localhost;dbname=exowire;charset=utf8', 'exowire', 'iP1-SVPm!1)_iPYz');
    // create a query
    $query = 'SELECT * FROM projekt1';


    // prepare the query for execution
    $statement = $pdo->prepare($query);
    // execute the query
    $statement->execute();

    // $statement is now the return value of the query and with ->fetchAll(PDO::FETCH_ASSOC) the return value is put into a normal array.
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exowire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is a cool website.">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <script href="/bootstrap/js/bootstrap.js"></script>
</head>
<body class="container">
<div class="row">
    <div class="col-sm-12">
        <h1>Exowire</h1>
    </div>
    <?php
    if(getProjectFromDatabase()[0]['email'] == 'exowire@gmail.com') {
        echo '<div class="col-sm-12">';
        echo '<h2>Admin</h2>';
        echo '</div>';
    }

    de(getProjectFromDatabase()[0]['email']);
    ?>
</div>
</body>
</html>