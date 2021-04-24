<?php

include 'simple_html_dom.php';
function TimKiem() {  // tiki
    $ll = [];
    
    if(!empty($_POST['search'])){
        $key = $_POST['search'];
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
        
        $web = 'https://tiki.vn/';
        $link = 'https://tiki.vn/search?q='.$tu_khoa.'&ref=searchBar&sort=price%2Casc';
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
            if($tt > 10){
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
 /*   if(!empty($_POST['search'])){
        $key = $_POST['search'];
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
        }*/
    $url = 'https://shopee.vn/api/v4/search/search_items?by=relevancy&keyword=iphone&limit=10&newest=0&order=desc&page_type=search&version=2';
    $cURLConnection = curl_init();

    curl_setopt($cURLConnection, CURLOPT_URL, $url);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $phoneList = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    $Response = json_decode($phoneList);
    
    $list = (array) $Response;
    $list = objectToArray($Response);
    
    echo json_encode($list);
  //  }
}
?>

