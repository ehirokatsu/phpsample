<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hello</h1>
    <!---->
    <pre>{{$req}}</pre>
    <pre>{{$res}}</pre>
    <pre>{{$req->url()}}</pre>
    <pre>{{$req->fullUrl()}}</pre>
    <pre>{{$req->path()}}</pre>
    <pre>{{$res->status()}}</pre>

    <!--クエリーパラメータの表示-->
    <pre>{{$id}}</pre>
    <pre>{{$tmp}}</pre>

    <!--GETでクエリーパラメータを送信-->
    <form method="GET" action="/">
        @csrf
        <input type="hidden" name="id" value="123">
        <input type="submit" name="button1" value="ボタン1">
    </form>

    <!--POSTでフォーム内容を送信-->
    <form method="POST" action="/">
        @csrf
        <input type="text" name="txt_empty">
        <input type="text" name="txt_isset">
        <input type="submit">
    </form>

    <!--emptyの使い方。issetとは異なり0を空判定する-->
    @empty($txt_empty)
    <p>空なのでテキスト入力してください。</p>
    @else
    <p>{{$txt_empty}}</p>
    @endempty
    
    <!--issetの使い方。Get時は未使用、POST時に使用する変数の時に-->
    @isset($txt_isset)
    <p>{{$txt_isset}}</p>
    @else
    <p>未定義なのでテキスト入力してください。</p>
    @endisset
</body>
</html>