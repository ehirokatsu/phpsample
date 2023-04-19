<?php
//出力文字コード、内部文字コードを宣言
mb_http_output('UTF8');
mb_internal_encoding('UTF8');
//応答のコンテンツタイプを宣言
header('ContentType:application/json;charset=UTF8');
//はてブAPIへの問い合わせURLを組み立て
$url='http://b.hatena.ne.jp/entry/jsonlite/?url='.$_GET['url'];

//問い合わせ結果をそのまま出力
print(file_get_contents($url,false,stream_context_create(['http'=>['header'=>'UserAgent:MySample']])));

?>

