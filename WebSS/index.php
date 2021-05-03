<?php
session_start();


require 'xuly.php';    
if(isset($_POST['search1'])){
    TimKiem();
    exit();
}


if(isset($_POST['search2'])){
    TimKiem2();
    exit();
}

if(isset($_POST['search3'])){
    TimKiem3();
    exit();
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Web so sanh gia</title>
        
        
    </head>
    <body>
        <input type="text" name="search" id="search-input" placeholder="tim ...">
       <button id ="timKiem" type="button" style="width: 50px; height: 20px; margin: 0;position: absolute;">Search</button>
       <br>
       
       <button id ="KoSort" type="button" style="width: 150px; height: 20px; margin: 0;position: absolute;">Ko xep</button>
       <br>
       <button id ="ASC" type="button" style="width: 150px; height: 20px; margin: 0;position: absolute;">Gia thap den cao</button>
       <br>
       <button id ="DESC" type="button" style="width: 150px; height: 20px; margin: 0;position: absolute;">Gia cao den thap</button>
    <div id="ListSP1"></div>
    <div id="ListSP2"></div>
    <div id="ListSP3"></div>
    </body>
    <script src="PluginJS/jquery.js"></script>
    <script src="index.js"></script>
</html>
