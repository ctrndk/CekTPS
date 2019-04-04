<?php

function cek_nik($nik,$nama){

$data = array(
    'nik' => $nik,
    'nama' => $nama
);

$headers = array();
$headers[] = 'Origin: https://lindungihakpilihmu.kpu.go.id';
$headers[] = 'Accept-Encoding: gzip, deflate, br';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36';
$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
$headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
$headers[] = 'Referer: https://lindungihakpilihmu.kpu.go.id/';
$headers[] = 'X-Requested-With: XMLHttpRequest';
$headers[] = 'Connection: keep-alive';

$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://lindungihakpilihmu.kpu.go.id/index.php/dpt/proses_ceknik',
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_ENCODING => 'gzip, deflate',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => http_build_query($data),
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_RETURNTRANSFER => 1
));

$res = curl_exec($ch);
if (curl_errno($ch))
    echo '[?] Error:' . curl_error($ch);
curl_close ($ch);

$getData = json_decode($res, true);
if($getData['message']==='success'){
  echo "\033[32m[>] Success"; 
}
else{
  echo '  [?] '.$getData['message'];
}
  		if($getData['message']==='success'){
        echo "\033[1;36m";
        echo "\n[+]=========================================[+]\n";
        //substr($getData['data']['nik'],0,8)."*****"; << SENSOR NIK
        echo "    Nama : ".$getData['data']['nama']."\n";
        echo "    L/P  : ".$getData['data']['jenis_kelamin']."\n";
        echo "    TL   : ".$getData['data']['tempat_lahir']."\n";
        echo "    TPS  : ".$getData['data']['tps']."\n";
        echo "    Kel  : ".$getData['data']['namaKelurahan']."\n";
        echo "    Kec  : ".$getData['data']['namaKecamatan']."\n";
        echo "    Kab  : ".$getData['data']['namaKabKota']."\n";
        echo "    Prov : ".$getData['data']['namaPropinsi']."\n";
        echo "[+]=========================================[+]\n";
        exit();
      } 
      else { 
        echo '[-] Gagal : '.$getData["data"]["pesan"].'\n'; 
      }
}

function head(){
echo "\033[32m
  _____ _  _ ______      _____  _____             
 / ____| || |____  |___ |  __ \|  __ \            
| |    | || |_  / / __ \| |  | | |  | | _____   __
| |    |__   _|/ / / _` | |  | | |  | |/ _ \ \ / /
| |____   | | / / | (_| | |__| | |__| |  __/\ V / 
 \_____|  |_|/_/ \ \__,_|_____/|_____/ \___| \_/  
                  \____/                          \n";
echo "\033[1;36m===============================================\n";
echo "      Cek TPS Online [PHP-CLI]                 \n";
echo "      Coded by @ctrndk (github.com/ctrndk)     \n";
echo "===============================================\n";
}


head();
echo "    Masukkan Nama : ";
$nama = trim(fgets(STDIN));
echo "    Masukkan NIK  : ";
$nik  = trim(fgets(STDIN));
cek_nik($nik,$nama);
?>
