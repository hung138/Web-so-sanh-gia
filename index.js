const ListSP = document.getElementById('ListSP');

// danh sach gom: link anh, tieu de, gia, link.
function DanhSachTimKiem(danhsach, key, web, an, giaSua){
    ListSP.innerHTML = '';
    ListSP.innerHTML += "<h3>Danh sách san pham tu: </h3>";
    ListSP.innerHTML += "<h3>" + web +"</h3>";
    
    ListSP.innerHTML += "</br>";
    
    for (var i = 0; i < danhsach.length; i++) {
        var divv = document.createElement('div');
        
        var imgg = document.createElement('img');
        imgg.setAttribute('src', danhsach[i][0]);
        imgg.setAttribute('style', 'width: 200px; height: 200px;');
        divv.appendChild(imgg);
        divv.innerHTML += "</br>";
        
        var pp = document.createElement('h3');
        pp.appendChild(document.createTextNode(danhsach[i][1]));
        divv.appendChild(pp);
        divv.innerHTML += "</br>";
        
        var pp2 = document.createElement('h3');
        if(giaSua == 0){
            pp2.appendChild(document.createTextNode(danhsach[i][2] + ' đ'));
        } else{
            pp2.appendChild(document.createTextNode(GoldToString(danhsach[i][2]) + ' đ'));
        }
        divv.appendChild(pp2);
        divv.innerHTML += "</br>";
        
        var nut = document.createElement('a');
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
}

$(document).on('click', "#timKiem", function () {
    var keyy = document.getElementById('search-input').value;
    //console.log(keyy);
    $.ajax({
        url:"index.php",
        method:"POST",
        data:{search: keyy},
        dataType: "text",
        success : function (result){
            var newData = JSON.stringify(result);
           // console.log(newData);
            
            var data = JSON.parse(JSON.parse(newData)); // parse 2 lan do cai 'price'
            var web = 'https://tiki.vn/';
            //console.log(data);
            
            if(data.length == 0){
                alert('Tim kiem tu khoa khac');
            } else{
             //   var link = web + data[0];
            //    window.open(link, '_blank');
             //   console.log(data[0]);   
              DanhSachTimKiem(data, keyy, web, 1, 0);
            }
        }
    })
});

$(document).on('click', "#timKiem2", function () {
    var keyy = document.getElementById('search-input2').value;
    //console.log(keyy);
    $.ajax({
        url:"index.php",
        method:"POST",
        data:{search2: keyy},
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
                DanhSachTimKiem(data2, keyy, web, 1, 0);
            }
            }
        }
    })
});

function GoldToString(G){
    var gg = G;
    var dai = gg.length;
    if(dai > 6){
	var g1 = gg.slice(0, dai - 6);
        var g2 = gg.slice(g1.length, dai - 3);
        var g3 = gg.slice(g2.length + g1.length, dai);
        
        gg = g1 + '.' + g2 + '.' + g3;
    } else if(dai > 3){
        var g1 = gg.slice(0, dai - 3);
        var g2 = gg.slice(g1.length, dai);
        
	gg = g1 + '.' + g2;
    }
    //console.log(gg);
    return gg;
}

$(document).on('click', "#timKiem3", function () {
    var keyy = document.getElementById('search-input3').value;
    //console.log(keyy);
    $.ajax({
        url:"index.php",
        method:"POST",
        data:{search3: keyy},
        dataType: "text",
        success : function (result){
           // console.log(result);
            var newData = JSON.stringify(result);
            //console.log(newData);
            
            var data = JSON.parse(JSON.parse(newData)); // parse 2 lan do cai 'price'
            var web = 'https://www.lazada.vn/';
            console.log(data);
            
            if(data.length == 0){
                alert('Tim kiem tu khoa khac');
            } else{
             //   var link = web + data[0];
            //    window.open(link, '_blank');
             //   console.log(data[0]);   
              DanhSachTimKiem(data, keyy, web, 0, 1);
            }
        }
    })
});