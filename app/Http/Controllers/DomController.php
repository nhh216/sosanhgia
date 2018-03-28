<?php
/**
 * Created by PhpStorm.
 * User: nhh21
 * Date: 3/21/2018
 * Time: 11:01 AM
 */

namespace App\Http\Controllers;
use function simplehtmldom_1_5\file_get_html;
use Sunra\PhpSimple\HtmlDomParser;
use GuzzleHttp\Client;

class DomController extends  Controller
{

    public function getPrice()
    {
//        $url = 'https://www.lotte.vn/category/637/dien-thoai?order=name%20ASC&product_brand=Xiaomi';
//        $html = HtmlDomParser::file_get_html($url);
//        $price = $html->find('.final-price ');
//        dd($html);
//        foreach ($price as $value)
//        {
//            echo $value;
//        }
//
//      curl "https://www.lotte.vn/catalogsearch/result/?q=apple^%^20iphone^%^207" -H "Accept-Encoding: gzip, deflate, br" -H "Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5" -H "Upgrade-Insecure-Requests: 1" -H "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/68.4.154 Chrome/62.4.3202.154 Safari/537.36" -H "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8" -H "Cache-Control: max-age=0" -H "Cookie: fbcsrf_1048246871937461=7141b226781d1efc9f76387d92886e48; geoData=^%^7B^%^22lastDate^%^22^%^3A^%^222018-3-21^%^22^%^7D; cto_lwid=29adb36e-9227-45f6-8e7d-6446fa0e1e12; lt-es-storage=^%^7B^%^7D; mage-cache-storage=^%^7B^%^7D; mage-cache-storage-section-invalidation=^%^7B^%^7D; mage-translation-storage=^%^7B^%^7D; mage-translation-file-version=^%^7B^%^7D; aimtell=aimtell; mage-cache-sessid=true; PHPSESSID=po7o2lp8n2ipqejjuqhhadc310; first_time_logged=0; _aimtellSubscriberID=e390e5a5-1ef3-1c30-7f89-a89c76496260; _aff_network=masoffer; _aff_tracking=masoffer; section_data_ids=^%^7B^%^22directory-data^%^22^%^3A1521620029^%^7D; private_content_version=4d7014a3fc84e33f5feef361516641c0; lotte_current_page=lotte; SHOW_POPUP_1MUASAMV17=true; form_key=1dhcteR0Bs4XAZiS; _ga=GA1.2.1451379096.1521620018; _gid=GA1.2.1576269138.1521620018; spUID=1521603563673041736488a.85a5338a" -H "Connection: keep-alive" --compressed

//        $query = 'apple iphone 7';
        $page = 'page=3';
        $client = new Client();
        $header = [
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/68.4.154 Chrome/62.4.3202.154 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            //'Cache-Control' => 'max-age=0'
        ];
        $reponse2 = $client->request('GET','https://www.lazada.vn/dien-thoai-di-dong/?'.$page, ['headers' => $header]);
        //dd($reponse2);
        //echo $reponse2->getStatusCode();die;
        $result = $reponse2->getBody()->getContents();
//        dd($result) ;
//        $file = file_put_contents(storage_path('test.html'),$result);
//
//        $html = HtmlDomParser::file_get_html(storage_path('test.html'));
//        echo $html;
        $content = $result;

        preg_match("#<script>window.pageData=(.*)</script>#", $content, $match);

        $data = [];
        if($match && isset($match[1])){
            $data = json_decode($match[1] , true);
        }

        echo "<pre>";
        dd($data);



    }

    public function getProductsLotte()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://els.lotte.vn/api/v1/categories/687/products",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"params\":{\"page\":0,\"hitsPerPage\":3000,\"facets\":[\"categories\",\"product_brand\",\"color\",\"size\",\"vendor\",\"product_brand_id\",\"vendor_id\"]}}",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Content-Type: application/json",
                "Postman-Token: d64f9340-e3f6-438c-ba42-b3dc558db4d8"
            ),
        ));

        $response = curl_exec($curl);
//         echo $response;
         $obj = json_decode($response,true);
//         dd($obj);
          $data =  array($obj);
//         dd($data);
//         foreach ($arr as $value)
//         {
//             echo $value['name']. '<br>';
//             echo $value['thumbnail_url'] . '<br>';
//             echo $value['price_default'] . '<br>';
//             echo $value['url'] . '<br>';
//             echo $value['product_brand'] . '<br>';
//         }


            for($i =0 ; $i< count($data[0]['hits']); $i++)
            {
                echo $i. '<br>' . ($data[0]['hits'][$i]['name']) . '<br>';
            }

    }

    public  function getDataLazada()
    {
        $url = 'https://www.lazada.vn/dien-thoai-di-dong/samsung/?page=2';
        $client = new Client();
        $reponse2 = $client->request('GET',$url);

        echo($reponse2->getBody());


    }

    public function  getPriceTGDD()
    {


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.thegioididong.com/aj/CategoryV5/Product",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "Category=42&Manufacture=0&PriceRange=0&Feature=0&Property=0&OrderBy=0&PageSize=3000&Others=&ClearCache=0",
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate, br",
                    "Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                    "Postman-Token: 935ab680-cf41-4565-958b-9a218857ee0b",
                    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36",
                    "X-Requested-With: XMLHttpRequest"
                ),
            ));

            $response = curl_exec($curl);

                echo $response;

    }


    public function getPriceHoangHa()
    {
        $content = array();
        $data =  array();
        $baseUrl = 'https://hoanghamobile.com';
        for ($i=1; $i<14;$i++)
        {
            $url = 'https://hoanghamobile.com/dien-thoai-di-dong-c14.html?sort=11&p='.$i;
            $html = HtmlDomParser::file_get_html($url);
            foreach ($html->find('.list-item') as $element)
            {
//                $content['name'] = $
                echo $content['name'] = $element->find('div.product-name',0)->text() . '<br>';
                echo $content['price'] = $element->find('div.product-price',0)->text(). '<br>';
                echo $content['link'] = $baseUrl . $element->find('a',0)->getAttribute('href') .'<br>';
                echo $content['image'] = $element->find('div.mosaic-backdrop img',0)->getAttribute('src') . '<br>';
                array_push($data,$content);
            }

        }
        dd($data);

    }

    public function  getPriceTiki()
    {
        $url = 'https://tiki.vn/dien-thoai-smartphone/c1795?src=tree&page=1';
//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL =>  $url,
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 30,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => "GET",
//            CURLOPT_HTTPHEADER => array(
//                "Cache-Control: no-cache",
//                "Postman-Token: 61884b9d-687e-41f7-a1fc-a65da82b35e2"
//            ),
//        ));
//
//        $response = curl_exec($curl);
//
//            echo $response;
        $client = new Client();
        $header = [
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/68.4.154 Chrome/62.4.3202.154 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            //'Cache-Control' => 'max-age=0'
        ];
        $reponse2 = $client->request('GET',$url, ['headers' => $header]);
        echo $reponse2->getBody()->getContents();
    }

    public  function getPriceNguyenKim()
    {
        $url = 'https://www.nguyenkim.com/dien-thoai-di-dong/page-1/';
        $client = new Client();
        $header = [
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/68.4.154 Chrome/62.4.3202.154 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            //'Cache-Control' => 'max-age=0'
        ];
        $reponse2 = $client->request('GET',$url, ['headers' => $header]);
        echo $reponse2->getBody()->getContents();
    }

    public function  getPriceNhatCuong()
    {
        $url = 'https://www.dienthoaididong.com/ProductList/ListData?linkseo=/dien-thoai-di-dong&type=nganhhang&pagestart='. 40 .'&pagesize='. 20 .'&include=&ordertype=';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept-Encoding: gzip, deflate, br",
                "Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
                "Cache-Control: no-cache",
                "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                "Postman-Token: 1b2e1ed6-8ec0-4b0a-9556-62e1c231f143",
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36",
                "X-Requested-With: XMLHttpRequest"
            ),
        ));

        $response = curl_exec($curl);

        echo $response;
    }

    public  function getPriceCellPhone()
    {
        $url = 'https://cellphones.com.vn/mobile.html?p=1';
        $client = new Client();
        $header = [
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/68.4.154 Chrome/62.4.3202.154 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            //'Cache-Control' => 'max-age=0'
        ];
        $response = $client->request('GET',$url, ['headers' => $header]);
        $result = $response->getBody()->getContents();
       file_put_contents(storage_path('html/cellphone.html'),$result);
       $html = HtmlDomParser::file_get_html(storage_path('html/cellphone.html'));

       foreach ( $html->find('ul[class=\'cols cols-5\']') as $element)
       {
           echo $element;

       }

    }

    public  function getPriceHnam()
    {

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.hnammobile.com/dien-thoai/?page=2",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Postman-Token: 5ae15195-2694-43f7-b1d8-91665fc5089b"
        ),
    ));
    $response = curl_exec($curl);

    echo $response;

    }

    public  function getPriceAdayroi()
    {

        $url = 'https://www.adayroi.com/dien-thoai-android-c325?q=%3Arelevance&page=0';
        $html = HtmlDomParser::file_get_html($url);
        echo $html;


    }

    public  function  getPriceDienMayXanh()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.dienmayxanh.com/dien-thoai?page=6",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
                "Accept-Encoding: gzip, deflate, br",
                "Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Postman-Token: a72fb434-254c-4dc3-b3e8-6747daf690d4",
                "Upgrade-Insecure-Requests: 1",
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36"
            ),
        ));

        $response = curl_exec($curl);
            echo $response;

    }




}