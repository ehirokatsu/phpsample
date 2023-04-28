<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/ajax.js'])
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Document</title>
</head>
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<body>
  <div class="col-sm-4">
    <div class="card mb-5">
        <div class="card-header">詳細検索</div>
        <div class="card-body">
          <p class="card-text">
            <div class="form-group row">
                <div class="col-md-4">IDを入力:</div>
                <div class="col-md-4">
                    <input class="form-control" id="id_number">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <button id="ajax_show" class="btn btn-info text-white">詳細ボタン</button>
                </div>
            </div>
            <!-- 取得したレコードを表示 -->
            <div class="col-md-12" id="result"></div>
          </p>
        </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card mb-5">
      <div class="card-header">追加</div>
      <div class="card-body">
        <p class="card-text">
          <div class="form-group row">
              <div class="col-md-5">名前を入力:</div>
              <div class="col-md-7">
                  <input class="form-control" id="name">
              </div>
          </div>
          <div class="form-group row">
              <div class="col-md-5">メールを入力:</div>
              <div class="col-md-7">
                  <input class="form-control" id="mail">
              </div>
          </div>
          <div class="form-group row">
            <div class="col-md-5">年齢を入力:</div>
            <div class="col-md-7">
                <input class="form-control" id="age">
            </div>
          </div>
          <div class="form-group row">
              <div class="col-md-12">
                  <button id="ajax_add" class="btn btn-info text-white">追加ボタン</button>
              </div>
          </div>
          <!-- 取得したレコードを表示 -->
          <div class="col-md-12" id="add_result"></div>
        </p>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card mb-5">
      <div class="card-header">削除</div>
      <div class="card-body">
        <p class="card-text">
          <div class="form-group row">
            <div class="col-md-4">IDを入力:</div>
            <div class="col-md-4">
              <input class="form-control" id="id_number_del">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12">
              <button id="ajax_del" class="btn btn-info text-white">削除ボタン</button>
            </div>
          </div>
        </p>
      </div>
      <!-- 取得したレコードを表示 -->
      <div class="col-md-12" id="del_result"></div>
    </div>
  </div>
  <table class="table table-striped">
    <tr id="all_show_result">
        <th>id</th><th>名前</th><th>メール</th><th>年齢</th>
    </tr>
  </table>
</body>
</html>



