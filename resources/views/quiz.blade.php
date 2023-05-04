<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/scss/app.scss','resources/js/jquery-3.6.4.min.js', 'resources/js/quiz.js'])
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <title>Document</title>
</head>

<body>
  <main class="quiz outer-block">
    <div class="inner-block">
      <div class="quiz content">
        <div class="finish">
          <div class="score-wrap">
            <span class="score">0</span>
            <span class="ja">点</span>
            <span class="full">／50点</span>
          </div>
          <a href="/quiz" class="goback-button">最初からやり直す</a>
        </div>
        <div class="quiz-question-number"></div>
        <h2 class="quiz-question"></h2>
        <ul class="quiz-answer">
          <li>
            <label for="" class="quiz-button button01">
              <input type="radio" name="radio" class="">
              <span class="quiz-text01"></span>
            </label>
          </li>
          <li>
            <label for="" class="quiz-button button02">
              <input type="radio" name="radio" class="">
              <span class="quiz-text02"></span>
            </label>
          </li>
          <li>
            <label for="" class="quiz-button button03">
              <input type="radio" name="radio" class="">
              <span class="quiz-text03"></span>
            </label>
          </li>
          <li>
            <label for="" class="quiz-button button04">
              <input type="radio" name="radio" class="">
              <span class="quiz-text04"></span>
            </label>
          </li>
        </ul>
      </div>
    </div>
  </main>
  </body>
</html>



