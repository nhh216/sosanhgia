<?php
/**
 * Created by PhpStorm.
 * User: nhh21
 * Date: 3/21/2018
 * Time: 11:01 AM
 */

namespace App\Http\Controllers;
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

        $query = 'apple iphone 7';
        $client = new Client();
        $header = [
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/68.4.154 Chrome/62.4.3202.154 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            //'Cache-Control' => 'max-age=0'
        ];
        $reponse2 = $client->request('GET','https://www.lotte.vn/catalogsearch/result/?q='.$query, ['headers' => $header]);
        //dd($reponse2);
        //echo $reponse2->getStatusCode();die;
        $result = $reponse2->getBody()->getContents();
        print $result;
//        $file = file_put_contents(storage_path('test.html'),$result);
//
//        $html = HtmlDomParser::file_get_html(storage_path('test.html'));
//        echo $html;




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
         $arr = $obj['hits'];
//         dd($arr);
         foreach ($arr as $value)
         {
             echo $value['name']. '<br>';
             echo $value['thumbnail_url'] . '<br>';
             echo $value['price_default'] . '<br>';
             echo $value['url'] . '<br>';
             echo $value['product_brand'] . '<br>';
         }
    }


}