const ListSP1 = document.getElementById('ListSP1');
const ListSP2 = document.getElementById('ListSP2');
const ListSP3 = document.getElementById('ListSP3');

var xep = 0;

// danh sach gom: link anh, tieu de, gia, link.
function DanhSachTimKiem(danhsach, key, web, an, giaSua, ListSP){
    L
        nut.appendChild(document.createTextNode('Link'));
        nut.id = 'Link';
        if(an == 1){
            nut.setAttribute('href', '' + web + danhsach[i][3]);
        } else{
            nut.setAttribute('href', danhsach[i][3]);
        }
        nut.setAttribute('target', '_blank');
        divv.appendChild(nut);
        divv.innerHTML += "</br>";
        
        ListSP.appendChild(divv);
        
        ListSP.innerHTML += "</br>";
        ListSP.innerHTML += "</br>";
    }
    $.ajax({
        url:"index.php",
        method:"POST",
        data:{search1: keyy, sort: sort},
        dataType: "text",
        success : function (result){
            var newData = JSON.stringify(result);
           // console.log(newData);
            
            var data = JSON.parse(JSON.parse(newData)); // parse 2 lan do cai 'price'
            var web = 'https://tiki.vn/';
            //console.log(data);
            
            if(xep != 0){
                for (var i = 0; i < data.length - 1; i++) {
                    for (var j = i+1; j < data.length; j++) {
                        var gia1 = parseInt(data[i][2].replace('.',''));
                        var gia2 = parseInt(data[j][2].replace('.',''));
                     
                        if(xep == 1){
                        if(gia1 > gia2){
                            var itemTT = data[i];
                            data[i] = data[j];
                            data[j] = itemTT;
                        }} else{
                        if(gia1 < gia2){
                            var itemTT = data[i];
                            data[i] = data[j];
                            data[j] = itemTT;
                        }
                        }
                    }
                }
            }
            
            if(data.length == 0){
                alert('Tim kiem tu khoa khac');
            } else{
             //   var link = web + data[0];
            //    window.open(link, '_blank');
             //   console.log(data[0]);   
              DanhSachTimKiem(data, keyy, web, 1, 0, ListSP1);
            }
        }
    })
}

function GetShopee(keyy, sort) {
    $.ajax({
        url:"index.php",
        method:"POST",
        data:{search2: keyy, sort: sort},
        dataType: "text",
        success : function (result){
            var newData = JSON.stringify(result);
            var data = JSON.parse(JSON.parse(newData));
            
            if(data.length == 0){
                alert('Tim kiem tu khoa khac');
            } else{
                
            var items = data['items'];
            //console.log(items[0]);
            var data2 = [];
            var webAnh = 'https://cf.shopee.vn/file/';
            var web = 'https://shopee.vn/';
            
            if(xep != 0){
                for (var i = 0; i < items.length - 1; i++) {
                    for (var j = i+1; j < items.length; j++) {
                        var gia1 = parseInt(items[i]['item_basic']['price']/100000);
                        var gia2 = parseInt(items[j]['item_basic']['price']/100000);
                     
                        if(xep == 1){
                        if(gia1 > gia2){
                            var itemTT = items[i];
                            items[i] = items[j];
                            items[j] = itemTT;
                        }} else{
                        if(gia1 < gia2){
                            var itemTT = items[i];
                            items[i] = items[j];
                            items[j] = itemTT;
                        }
                        }
                    }
                }
            }
            
            for (var i = 0; i < items.length; i++) {
                var itemID = items[i]['item_basic']['itemid'];
                var shopID = items[i]['item_basic']['shopid'];
                var nameTD = items[i]['item_basic']['name'];
                var imageID = '' + webAnh + items[i]['item_basic']['image'];
                var gia = '' + items[i]['item_basic']['price']/100000;
                gia = GoldToString(gia);
                
                let link = nameTD.replaceAll(/[&\/\\#,+()$~%.'":*?<>{}]/g,'');
                link = link.replaceAll('[','');
                link = link.replaceAll(']','');
                link = link.replaceAll('-','');
                link = link.replaceAll(/\s+/g,'');
                link = link + '-i.' + shopID + '.' + itemID;
                
                //console.log(imageID);
                var mau = [];
                
                mau.push(imageID);
                mau.push(nameTD);
                mau.push(gia);
                mau.push(link);
                
                data2.push(mau);
            } 
            
            if(items.length > 0){
                DanhSachTimKiem(data2, keyy, web, 1, 0, ListSP2);
            }
            }
        }
    })
}



function GetLazada(keyy, sort) {
    $.ajax({
        url:"index.php",
        method:"POST",
        data:{search3: keyy, sort: sort},
        dataType: "text",
        success : function (result){
           // console.log(result);
            var newData = JSON.stringify(result);
            //console.log(newData);
            
            var data = JSON.parse(JSON.parse(newData)); // parse 2 lan do cai 'price'
            var web = 'https://www.lazada.vn/';
            //console.log(data);
            if(xep != 0){
                for (var i = 0; i < data.length - 1; i++) {
                    for (var j = i+1; j < data.length; j++) {
                        var gia1 = parseInt(data[i][2]);
                        var gia2 = parseInt(data[j][2]);
                     
                        if(xep == 1){
                        if(gia1 > gia2){
                            var itemTT = data[i];
                            data[i] = data[j];
                            data[j] = itemTT;
                        }} else{
                        if(gia1 < gia2){
                            var itemTT = data[i];
                            data[i] = data[j];
                            data[j] = itemTT;
                        }
                        }
                    }
                }
            }
            
            if(data.length == 0){
                alert('Tim kiem tu khoa khac');
            } else{
             //   var link = web + data[0];
            //    window.open(link, '_blank');
             //   console.log(data[0]);   
              DanhSachTimKiem(data, keyy, web, 0, 1, ListSP3);
            }
        }
    })
}

function TimAll(sort){
    ListSP1.innerHTML = '';
    ListSP2.innerHTML = '';
    ListSP3.innerHTML = '';
    var keyy = document.getElementById('search-input').value;
    
    console.log(keyy);
    console.log(sort);
    
    //GetShopee(keyy, sort);
    GetLazada(keyy, sort);
    //GetTiki(keyy, sort);
}

$(document).on('click', "#timKiem", function (){
    TimAll(0);
});

$(document).on('click', "#KoSort", function (){
    xep = 0;
    TimAll(0);
});

$(document).on('click', "#ASC", function (){
    xep = 1;
    TimAll(0);
});

$(document).on('click', "#DESC", function (){
    xep = 2;
    TimAll(0);
});