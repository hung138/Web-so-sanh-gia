<?php
session_start();

require 'xuly.php';    
if(isset($_POST['search'])){
    TimKiem();
    exit();
}


if(isset($_POST['search2'])){
    TimKiem2();
    exit();
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Web so sanh gia</title>
        
        
    </head>
    <body>
       <input type="text" name="search" id="search-input" placeholder="tim Tiki...">
       <button id ="timKiem" type="button" style="width: 50px; height: 20px; margin: 0;position: absolute;">Search</button>
       <br>
       <input type="text" name="search" id="search-input2" placeholder="tim Shopee...">
       <button id ="timKiem2" type="button" style="width: 50px; height: 20px; margin: 0;position: absolute;">Search</button>
    <div id="ListSP">
                    
                </div>
    </body>
    <script src="PluginJS/jquery.js"></script>
    <script src="index.js"></script>
</html>
