<?php
/**
 * Created by PhpStorm.
 * User: nhh21
 * Date: 3/21/2018
 * Time: 11:01 AM
 */


namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
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
        $data = [];
        $content = "";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.lazada.vn/dien-thoai-di-dong/samsung/?page=4&sort=priceasc",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Postman-Token: 6474336c-800f-d4e8-46c1-8ef97c6d0fb2",
                "cookie: anon_uid=d39f628621bc1459d12c8729bd2b8dd2; fbm_1503824746501801=base_domain=.lazada.vn; fast-delivery-promote-popup-clicked=true; lzd_deliveryAddressInfo=%7B%22province_id%22%3A%22232%22%2C%22city_id%22%3A%22396%22%2C%22ward_id%22%3A%220%22%2C%22zip%22%3A%22%22%7D; fd_location_entered=Product+detail+page; sid=0.41144332397579; _vwo_uuid=C2A5E236D9E395AA87A7D5907C542DBA; lzd_visitor_type=returning; __utmx=234641283.yPVFvYy-QMa9j9XKzXTTcA$0:-1.1Ti-ZdWQTVK3NdFnrqKx4w$0:-1._r2A41u3RbSZFtpxjay3kg$0:-1.jEjlA0ZySHSw-X-xLr_WiA$0:-1.iw4H4CySR9qk-Fd5eAHsUg$0:2.UypbYCgwT16z6v4CJ84D3w$0:0.l61LTbvpRqyKwhkwyZyoqw$0:-1.1Am6pwIyT3GhjeeyBL3zmA$0:-1.etMaPAkmT_2fcVolBD8HKg$0:-1.wnknAYE4TcWJrys91hlF_g$0:-1.DRZGEpehTreW8acTJXgBxg$0:-1; __utmxx=234641283.yPVFvYy-QMa9j9XKzXTTcA$0:1498324350:8035200:.1Ti-ZdWQTVK3NdFnrqKx4w$0:1505102968:8035200:._r2A41u3RbSZFtpxjay3kg$0:1505102968:8035200:.jEjlA0ZySHSw-X-xLr_WiA$0:1505102968:8035200:.iw4H4CySR9qk-Fd5eAHsUg$0:1500182563:8035200:.UypbYCgwT16z6v4CJ84D3w$0:1505102968:8035200:.l61LTbvpRqyKwhkwyZyoqw$0:1503287758:8035200:.1Am6pwIyT3GhjeeyBL3zmA$0:1505102968:8035200:.etMaPAkmT_2fcVolBD8HKg$0:1506075000:8035200:.wnknAYE4TcWJrys91hlF_g$0:1506075000:8035200:.DRZGEpehTreW8acTJXgBxg$0:1506075000:8035200; cna=a1HQEeLMoywCASpyCk6Q21Lt; _vwo_uuid_v2=7C5ED67A101E2408FF5383F98EED8E4D|eecf2125ac96da772089c7caac8b4d6e; _ga=GA1.2.406154971.1497981803; rsk=es2srjqpstr1q6bf8inql34376; __utmc=234641283; s_cc=true; ga_exp_leila=New_Products_Sept_21||0; sessionid=1518275985040; t_fv=1518275985337; t_uid=d39f628621bc1459d12c8729bd2b8dd2; cto_lwid=89b2ab42-0458-4af9-8dd1-9fd4ede5543e; lzd_cid=3e0f35af-4466-4d60-f129-3d83405f540a; lzd_sid=1ca1086a87c0d6ec3258e3e9634abb59; _bl_uid=2djXpd0kzmeub9hCOh9RgzO6034p; _tb_token_=635bb4e785b5; cto_axid=LHFIU57ZSaLmt4zRej0CYUraIjr4zMZV; SnapABugHistory=1#; SnapABugVisit=1#1520857998; __utmz=234641283.1521465819.19.15.utmcsr=websosanh_vn|utmccn=(not%20set)|utmcmd=lazada_affiliate_program|utmctr=271|utmcct=4799; prod_multi_group=SE955ELAA2SH2ZVNAMZ; ki_r=; G_ENABLED_IDPS=google; 0ee66e160049abdbfe35edbbdaa14e2e=30a1d1659d9cd86453b03fc79707022adfab7c875bd9aad9a8c76ecc9c9b9918eaf07f185c272b16f783824c0248a9c2d443501de4200d961fdca1cabab4390a%3Ad4d43cfb47f358e2d91b4532cebfbeeb6fdda83585c818f5525c2dc53632fb43; lzd_first_purchase=0; t_lid=3640803; t_fpd=2018-03-17; t_lpd=2018-03-17; rr_rcs=eF4FwcERgCAMBMAPL3s5J4GQm3RgGyAw48OfWr-7abu_5xo7TaA1qzkZhW4IATS95yFFZ_WVkY0O8wgsGQ2TlUWbDev6A1hJEQI; ki_t=1497981810113%3B1521465826099%3B1521470968980%3B10%3B18; hng=VN|vi|VND|704; userLanguageML=vi; ho_lastclick_value=271%7CVN+Data-feed%7C61062%7CVN_Masoffer%7C1024bacc31f895b7dd2e4f21aca25a%7C%7C20180402103111%7Cd2047198572fd87b3955fa8b48a9d3ac11ef5dcf%7Cmo_wc7xKQEZtmJiFjx_42cJA8IXdOMJrQxABN2ePLqELKA; browserDetection=eyJ0eXBlIjoiYnJvd3NlciIsIm5hbWUiOiJDaHJvbWUiLCJjc3NDbGFzcyI6ImNocm9tZSIsInZlcnNpb24iOiI2NSIsIm9zIjoid2luZG93cyJ9; PHPSESSID_9660cdb704026c618a09bd6ad453be3f=8pjbsrjbo9j0k1gc357p41m7a0; 0ee66e160049abdbfe35edbbdaa14e2e=30a1d1659d9cd86453b03fc79707022adfab7c875bd9aad9a8c76ecc9c9b9918eaf07f185c272b16f783824c0248a9c2d443501de4200d961fdca1cabab4390a%3Ad4d43cfb47f358e2d91b4532cebfbeeb6fdda83585c818f5525c2dc53632fb43; _m_h5_tk=755ff70048c424e6e619423eb2a65be8_1522652382963; _m_h5_tk_enc=300fa99be3e655ea0c320820cc59692a; AMCV_126E248D54200F960A4C98C6%40AdobeOrg=-1506950487%7CMCMID%7C23713181687274652670315693475363898928%7CMCAAMLH-1523248906%7C3%7CMCAAMB-1523248906%7CRKhpRz8krg2tLO6pguXWp5olkAcUniQYPHaMWWgdJ3xzPWQmdj0y%7CMCAID%7CNONE; s_sq=%5B%5BB%5D%5D; t_sid=DBTzaeZVR1MUhNdwGKS0zWmT1Xc2oLNk; __utma=234641283.406154971.1497981803.1522644105.1522651082.23; gpv_pn=category%3A; s_vnum=1529517804028%26vn%3D22; s_invisit=true; _tsm=m%3DDirect%2520%252F%2520Brand%2520Aware%253A%2520Typed%2520%252F%2520Bookmarked%2520%252F%2520etc%7Cs%3Dlazada.vn%7Crp%3D%252F%7Crd%3Dlazada.vn; cookietest=1; JSESSIONID=F51B54EB6B2F4769BC4F76F7E3E56EF9; __utmt=1; __utmb=234641283.5.10.1522651082; isg=BMfHKiGdUZ82Itab6pRDsyKXVntRZJEEunU52Zm049Z9COfKoZwr_gXKrtBW-3Mm; s_ppvl=D%253Dch%2B%2522%253A%2522%2C18%2C18%2C647%2C724%2C647%2C1366%2C768%2C1%2CP; _uetsid=_uetcd4735c0; _ceg.s=p6jpwz; _ceg.u=p6jpwz; s_ppv=D%253Dch%2B%2522%253A%2522%2C21%2C18%2C747%2C724%2C647%2C1366%2C768%2C1%2CP",
                "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //echo $response;
        }
        $content = $response;
        preg_match("#<script>window.pageData=(.*)</script>#", $content, $match);
        $result = [];
        if($match && isset($match[1])){
            $result = json_decode($match[1] , true);
        }
//        echo "<pre>";
        dd($result['mods']['listItems']);


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
        $url = 'https://tiki.vn/dien-thoai-smartphone/c1795?order=price%2Casc';
        $this->getUrlTiki($url);
    }

    public function getUrlTiki($url)
    {
        $client = new Client();
        $header = [
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/68.4.154 Chrome/62.4.3202.154 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
        ];
        $reponse2 = $client->request('GET',$url, ['headers' => $header]);
        $respon = $reponse2->getBody()->getContents();
//        file_put_contents(storage_path('html/tiki.txt'),$reponse2->getBody()->getContents());
//        $content = file_get_contents(storage_path('html/tiki.txt'));
//        $partOfContent = [];
        $partOfContent = preg_split('<!--  BEGIN GOOGLE TAGMANAGER -->',$respon);
        file_put_contents(storage_path('html/tiki-head.html'),$partOfContent[0]);

        $partOfContentBody = [];
        $partOfContentBody =  preg_split('</nav>',$partOfContent[1]);
        file_put_contents(storage_path('html/tiki-body.html'),$partOfContentBody[1]);

        $html = HtmlDomParser::file_get_html(storage_path('html/tiki-head.html'));
        $htmlBody = HtmlDomParser::file_get_html(storage_path('html/tiki-body.html'));
        $str =  $html->find('link[rel=\'next\']');

        $listProduct = $htmlBody->find('div[class="product-item"]');
        $price = 'data-price';
        $title = 'data-title';
        $price = 'data-price';
        foreach ($listProduct as $listPr)
        {
            echo $listPr->children[0]->href . '<br>';
            if(isset($listPr->children(0)->children(0)->children(0)->src))
            {
                echo $img =  ($listPr->children(0)->children(0)->children(0))->src . '<br>';
            }
            echo $listPr->$title. '<br>';
            echo $listPr->$price. '<br>';
        }

        if(isset($str))
        {
            if( isset($str['0']))
            {
                echo  $newUrl =$str['0']->attr['href'] . '<br>';
                $this->getUrlTiki($newUrl);
            }
        }


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

        $url = 'https://www.lazada.vn/dien-thoai-di-dong/apple--huawei--samsung--xiaomi--masstel--nokia--oppo/?sort=priceasc';
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

    public  static  function getPriceHoangHa2()
    {

        $url = "https://hoanghamobile.com/dien-thoai-di-dong-c14.html?sort=11&p=2";
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
                "Cache-Control: no-cache",
                "Postman-Token: 9ef7209a-8bb7-b1fe-cf05-7578d1aadaba"
            ),
        ));

        $response = curl_exec($curl);

            echo $response;

        }


}