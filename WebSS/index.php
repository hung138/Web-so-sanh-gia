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
 <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="stylesheet" href="frontend/style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
      crossorigin="anonymous"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
      rel="stylesheet"
    />
    <title>Web so sanh gia</title>
  </head>
  <body>
    <section class="header">
      <div style="flex: 1" class="logo">
        <img
          height="100%"
          src="Anh/logo.png"
          alt=""
        />
      </div>
      <div
        style="flex: 4; display: flex; align-items: center"
        class="searchbar"
      >
        <input  name="search" id="search-input"
          placeholder="Tìm sản phẩm bạn muốn ..."
          style="width: 70%; height: 50%; padding: 0 20px"
          type="text"
        />
        <button
          style="
            border: none;
            width: 100px;
            height: 49%;
            background-color: rgb(13, 92, 182);
            color: white;
            " id="timKiem"
        >
          <i class="fas fa-search"></i>
          Tìm kiếm
        </button>
      </div>
    </section>
    <section class="main">
      <div class="main__cover">
        <img
          style="width: 100%"
          src="https://salt.tikicdn.com/cache/w824/ts/banner/f5/db/f6/e8d1a190d76918e545e8b6eb0bc6258a.png.jpg"
          alt=""
        />
      </div>
      <div class="main__content">
          <div class="giua">
              <div>
              <button id ="KoSort" type="button">Không xếp</button>
              
              <button id ="ASC" type="button">Giá thấp đến cao</button>

              <button id ="DESC" type="button">Giá cao đến thấp</button>
              </div>
          </div>
        <div class="content__product">
          <h2 style="padding: 8px 8px">Tiki</h2>
          <hr style="color: grey" />
          <div class="product__detail" id="ListSP1">
        <!--    <div class="product__card">
              <img
                src="https://salt.tikicdn.com/cache/280x280/ts/product/0a/05/27/ace058ffe6aa2cd63b57c91535fce62c.jpg"
                alt=""
              />
              <span>Tên</span>
              <span>Giá</span>
              <span><a href="#">Link</a></span>
            </div>  -->
       
          </div>
        </div>
        <div class="content__product">
          <h2 style="padding: 8px 8px">Shopee</h2>
          <hr style="color: grey" />
          <div class="product__detail" id="ListSP2">
         
          </div>
        </div>
        <div class="content__product">
            <h2 style="padding: 8px 8px">Lazada</h2>
            <hr style="color: grey" />
            <div class="product__detail" id="ListSP3">
          </div>
      </div>
    </section>
  <!--     <input type="text" name="search" id="search-input" placeholder="tim ...">
       <button id ="timKiem" type="button" style="width: 50px; height: 20px; margin: 0;position: absolute;">Search</button>
       <br>
       
       <button id ="KoSort" type="button" style="width: 150px; height: 20px; margin: 0;position: absolute;">Ko xep</button>
       <br>
       <button id ="ASC" type="button" style="width: 150px; height: 20px; margin: 0;position: absolute;">Gia thap den cao</button>
       <br>
       <button id ="DESC" type="button" style="width: 150px; height: 20px; margin: 0;position: absolute;">Gia cao den thap</button>
    <div id="ListSP1"></div>
    <div id="ListSP2"></div>
    <div id="ListSP3"></div>  -->
    </body>
    <script src="PluginJS/jquery.js"></script>
    <script src="index.js"></script>
</html>
