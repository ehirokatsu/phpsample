<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])
  <title>Document</title>
</head>
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<body>

  <div id="T1"></div>
<header class="header">
  <div class="header__wrap">
    <div class="header__logo">
      <a href=""><img src="{{asset('storage/header_logo.svg')}}" alt=""></a>
    </div>
    <nav class="header__menu">
      <ul>
        <li class="active"><a href="/hello" class="">hello</a></li>
        <li><a href="/index_db" class="">CRUD</a></li>
        <li><a href="/helloMiddle" class="">ミドルウェア</a></li>
        <li><a href="/validator" class="">validator</a></li>
        <li><a href="/section" class="">section</a></li>
        <li><a href="/include-each" class="">include-each</a></li>
        <li><a href="/question" class="">question</a></li>
      </ul>
    </nav>
  </div>
</header>
<form>
<input type="button" value="データの取得" id="getBtn">
<input type="button" value="データの送信" id="postBtn">
</form>
<div id="getResult"></div>
<div id="postResult"></div>
<div id="mouse">マウステスト</div>
<input type="button" value="ー" id="menu1MinusBtn">
<input type="button" value="＋" id="menu1PlusBtn">
<input type="button" value="ー" id="menu2MinusBtn">
<input type="button" value="＋" id="menu2PlusBtn">
<input type="button" value="ー" id="menu3MinusBtn">
<input type="button" value="＋" id="menu3PlusBtn">
<div id="menu1CountLabel"></div>
<div id="menu2CountLabel"></div>
<div id="menu3CountLabel"></div>
<div id="totalAmountLabel"></div>
<main class="main">
  <section class="main__kv">
    <div class="test111">難しいことを簡単に</div><br>
  </section>
  <section class="main__about">
    <h1 class="main__about--ttl">h1 title</h1>
    <div class="main__about--logo"><img src="{{asset('storage/header_logo.svg')}}" alt=""></div>
    <p class="main__about--txt">text</p>
  </section>
  <section class="main__service">
    <div class="main__service--message">
      <h2>h2 title</h2>
      <p>text</p>
    </div>
    <ul class="main__service--list">
      <li>
        <a href="">
          <img src="{{asset('storage/top_service01.jpg')}}" alt="">
          <h3>title</h3>
          <p>text</p>
        </a>
      </li>
      <li>
        <a href="">
          <img src="{{asset('storage/top_service02.jpg')}}" alt="">
          <h3>title</h3>
          <p>text</p>
        </a>
      </li>
      <li>
        <a href="">
          <img src="{{asset('storage/top_service03.jpg')}}" alt="">
          <h3>title</h3>
          <p>text</p>
        </a>
      </li>
    </ul>
  </section>
  <section class="main__news">
    <h2 class="main__news--ttl">h2 title</h2>
    <ul class="main__news--list">
      <li>
        <a href="">
          <dl class="main__news--item">
            <dt class="main__news--day">2017</dt>
            <dd class="main__news--data">text</dd>
          </dl>
        </a>
      </li>
      <li>
        <a href="">
          <dl class="main__news--item">
            <dt class="main__news--day">2018</dt>
            <dd class="main__news--data">text</dd>
          </dl>
        </a>
      </li>
      <li>
        <a href="">
          <dl class="main__news--item">
            <dt class="main__news--day">2019</dt>
            <dd class="main__news--data">text</dd>
          </dl>
        </a>
      </li>
      <li>
        <a href="">
          <dl class="main__news--item">
            <dt class="main__news--day">2019</dt>
            <dd class="main__news--data">text</dd>
          </dl>
        </a>
      </li>
      <li>
        <a href="">
          <dl class="main__news--item">
            <dt class="main__news--day">2019</dt>
            <dd class="main__news--data">text</dd>
          </dl>
        </a>
      </li>
    </ul>
  </section>
</main>
<footer class="footer">
  <div class="footer__logo"><img src="{{asset('storage/header_logo.svg')}}" alt=""></div>
  <div class="footer__copyright">copy</div>
</footer>
</body>
</html>



