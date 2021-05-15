<?php

include 'simple_html_dom.php';
function TimKiem() {  // tiki
    $ll = [];
    
    if(!empty($_POST['search1'])){
        $key = $_POST['search1'];
        $key_split = explode(' ', $key);
        
        $tu_khoa = '';
        $t2 = 0;
        foreach ($key_split as $k) {
            if($t2 == 0){
                $tu_khoa.=$k;
            } else {
                $tu_khoa.='+'.$k;
            }
            
            $t2++;
        }
        $sort = '';
        if(!empty($_POST['sort'])){
            $Ksort = $_POST['sort'];
            if($Ksort == 0){
                $sort = '';
            } else if($Ksort == 1){
                $sort = '&sort=price%2Casc'; //&page=1';
            } else{
                $sort = '&sort=price%2Cdesc'; //&page=1';
            }
        }
        
        $web = 'https://tiki.vn/';
        $link = 'https://tiki.vn/search?q='.$tu_khoa.$sort;
        $html = file_get_html($link);
        
        $item = '.product-item';
        $tt = 0;
        foreach ($html ->find($item) as $postDiv) {
     
            $fullpath = $postDiv ->href;
            $fullpath = substr($fullpath, 1);
            $linkPath = substr($fullpath, 0, strpos($fullpath, '?'));
        
            $html2 = file_get_html($web.$linkPath);
            $ten = $html2 ->find('div[class="container"]');
    
            foreach ($ten[0]->find('img') as $anh) {
                $anh2 = $anh->src;
                $ten2 = $anh->alt;
            }
        
            $gia = $postDiv ->find('div[class="price-discount__price"]');
            $gia2 = $gia[0]->plaintext;
            $gia[0]->href = $gia2;
            $giaT = $gia[0]->href;
            $giaTT = substr($giaT, 0, strpos($giaT, ' '));
        
            $chiTiet = [];
            $chiTiet[] = $anh2;
            $chiTiet[] = $ten2;
            $chiTiet[] = $giaTT;
            $chiTiet[] = $linkPath;
        
            $ll[] = $chiTiet;
        
            $tt++;
            if($tt > 50){
                break;
            }
        }
        
    }
    
    echo json_encode($ll);
}

function objectToArray ($object) {
    if(!is_object($object) && !is_array($object)){
    	return $object;
    }
    
    return array_map('objectToArray', (array) $object);
}

function TimKiem2() {
    if(!empty($_POST['search2'])){
        $key = $_POST['search2'];
        $key_split = explode(' ', $key);
        
        $tu_khoa = '';
        $t2 = 0;
        foreach ($key_split as $k) {
            if($t2 == 0){
                $tu_khoa.=$k;
            } else {
                $tu_khoa.='+'.$k;
            }
            
            $t2++;
        }
        
        $sort = '';
        if(!empty($_POST['sort'])){
            $Ksort = $_POST['sort'];
            if($Ksort == 0){
                $sort = '';
            } else if($Ksort == 1){
                $sort = '&order=asc';
            } else{
                $sort = '&order=desc';
            }
        }
        
    $url = 'https://shopee.vn/api/v4/search/search_items?by=relevancy&keyword='.$tu_khoa.'&limit=50&newest=0'.$sort.'&page_type=search&version=2';
    $cURLConnection = curl_init();

    curl_setopt($cURLConnection, CURLOPT_URL, $url);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $phoneList = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    $Response = json_decode($phoneList);
    
    $list = (array) $Response;
    $list = objectToArray($Response);
    
    echo json_encode($list);
    } else {
        $ll = [];
        echo json_encode($ll);
    }
}

//$url = 'https://www.lazada.vn/catalog/?ajax=true&q=tu%20lanh&sort=priceasc';

function FinalUrl($link) {
    $html = file_get_html($link);
    $div = $html->find('.driect-link')[0];
    $link = $div->find('a')[0]->href;
    return $link;
}

function TimKiem3() {
     $ll = [];
     
    if(!empty($_POST['search3'])){
        $key = $_POST['search3'];
        $key_split = explode(' ', $key);
        
        $tu_khoa = '';
        $t2 = 0;
        foreach ($key_split as $k) {
            if($t2 == 0){
                $tu_khoa.=$k;
            } else {
                $tu_khoa.='%2B'.$k;
            }
            
            $t2++;
        }
        
        $sort = '';
        if(!empty($_POST['sort'])){
            $Ksort = $_POST['sort'];
            if($Ksort == 0){
                $sort = '';
            } else if($Ksort == 1){
                $sort = '%26s0%3D1';
            } else{
                $sort = '%26s0%3D2';
            }
        }
        
    $url = 'https://websosanh.vn/Search/GetListProductRender?param=https%3A%2F%2Fwebsosanh.vn%2Fs%2F'.$tu_khoa.'%3Fmerchant%3D3502170206813664485'.$sort.'&isSearch=true&dfilter=merchant%3D3502170206813664485&isShorterSearch=false';
    $Response = file_get_contents($url);
    
    $phoneList = json_decode($Response);
    $list = (array) $phoneList;
    $list = objectToArray($phoneList);
    $kq = $list['data']['result'];
    
    $file = 'lazada.html';
    file_put_contents($file, $kq);
    
    $content = file_get_html($file);
    $listItem = $content->find('.product-item');
    
    foreach ($listItem as $item) {
        //$ten = $item->find('img')[0]->alt;
        $link = $item->find('a')[0]->href;
        $link2 = FinalUrl($link);
        $anh = $item->find('img')[0]->getAttribute('data-src');
        $gia = $item->find('.product-price')[0]->getAttribute('price');
        
        $vt1 = strpos($anh, 'images/');
        $ten = substr($anh, $vt1 + 7, -1);
        
        $vt2 = strpos($ten, '/');    
        $ten2 = substr($ten, 0, $vt2);
        
        $ten3 = str_replace('-', ' ', $ten2);
        
        if(strpos($link2, 'lazada')){
       // if (filter_var($link2, FILTER_VALIDATE_URL)){
            
        $chiTiet = [];
        $chiTiet[] = $anh;
        $chiTiet[] = $ten3;
        $chiTiet[] = $gia;
        $chiTiet[] = $link2;
        
        $ll[] = $chiTiet;
     //   }
        }
    }}
 echo json_encode($ll);
}

?>

