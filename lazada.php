<?php
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


//$content = file_get_contents('lazada.txt');
$content = $response;

preg_match("#<script>window.pageData=(.*)</script>#", $content, $match);

$data = [];
if($match && isset($match[1])){
  $data = json_decode($match[1] , true);
}

echo "<pre>";
print_r($data);


