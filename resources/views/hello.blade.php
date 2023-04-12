<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <h1>クエリ文字列、GETメソッドでの値送信、POST送信、empty,issetの使い方</h1>
    <!---->
    <h2>HTTPリクエストの内容</h2>
    <pre>{{$req}}</pre>
    <h2>HTTPレスポンスの内容</h2>
    <pre>{{$res}}</pre>
    <h2>HTTPリクエストのURL</h2>
    <pre>{{$req->url()}}</pre>
    <h2>HTTPリクエストのURL（フルパス）URL末尾に？id=12を加えて使用する</h2>
    <pre>{{$req->fullUrl()}}</pre>
    <h2>HTTPリクエストのURL(ルート以下)</h2>
    <pre>{{$req->path()}}</pre>
    <h2>HTTPレスポンスのステータス</h2>
    <pre>{{$res->status()}}</pre>

    <!--クエリーパラメータの表示-->
    <h2>クエリパラメータ（id, tmp）</h2>
    <pre>id={{$id}}</pre>
    <pre>tmp={{$tmp}}</pre>

    <!--GETでクエリーパラメータを送信-->
    <h2>GETでid=123を送信</h2>
    <form method="GET" action="/hello">
        @csrf
        <input type="hidden" name="id" value="123">
        <input type="submit" name="button1" value="ボタン1">
    </form>



    <!--emptyの使い方。issetとは異なり0を空判定する-->
    <h2>emptyの動作</h2>
    @empty($txt_empty)
    <p>空なのでテキスト入力してください。</p>
    @else
    <p>{{$txt_empty}}</p>
    @endempty
    
    <!--issetの使い方。Get時は未使用、POST時に使用する変数の時に-->
    <h2>issetの動作</h2>
    @isset($txt_isset)
    <p>{{$txt_isset}}</p>
    @else
    <p>未定義なのでテキスト入力してください。</p>
    @endisset

    <!--POSTでフォーム内容を送信-->
    <h2>txt_emptyとtxt_issetを入力</h2>
    <form method="POST" action="/hello">
        @csrf
        <span>txt_empty</span>
        <input type="text" name="txt_empty">
        <br>
        <span>txt_isset</span>
        <input type="text" name="txt_isset">
        <br>
        <input type="submit">
    </form>
  
  </body>
</html>