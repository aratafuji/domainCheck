<?php
require_once "Net/DNS2.php";

// ドメインタイプ
$types = array(
    "com" => "192.48.79.30",  // j.gtld-servers.net
    "net" => "192.48.79.30",  // j.gtld-servers.net
    "org" => "199.249.112.1", // a2.org.afilias-nst.info
    "jp"  => "203.119.1.1",   // a.dns.jp
);

$q = $_GET['q'];
$output = array();

// 時間測定開始
$s = microtime(true);

$i = 0;
foreach($types as $type => $dns) {
    // ドメイン名
    $name = $q . '.' . $type;
    $output['domain'][$i]['name'] = $name;

    // DNSサーバ設定
    $net_dns = new Net_DNS2_Resolver(
        array(
            'nameservers' => array($dns)
        )
    );

    try {
        // SOAレコードが存在するかDNSサーバに問い合わせ
        $r = $net_dns->query($name, "SOA");
        // 存在する(取得済み)
        $output['domain'][$i]['available'] = "-"; 
        $output['domain'][$i]['record'] = $r; 
    }
    catch(Exception $e) {
        // 存在しない(未取得)
        $output['domain'][$i]['available'] = "+"; 
        $output['domain'][$i]['record'] = ""; 
    }
    $i++;
}

// 時間測定終了
$e = microtime(true);
// 実行時間(ms)
$output['time'] = (($e - $s) * 1000);

// JSONP出力
header( 'Content-Type: text/javascript; charset=utf-8' );
echo $_GET['callback'] . "(" . json_encode($output) . ")";

?>
