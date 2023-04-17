import './bootstrap';
//'use strict';

//変数とコンソール出力
let x,y;
x = 10 * 20;
y = "test";
console.log(x);
console.log(y);

//関数
function cal ( a, b ) {
    let sum = a + b;
    return sum;
}
console.log(cal(10, 20));


//配列とfor文
let array = new Array(1,2,3);
let sum = 0;
for ( let i = 0; i < array.length; i++ ) {
    sum = sum + array[i];
}
console.log(sum);

//多次元配列と二重for文
let manyArray = [
    ['yamada', 28, 'Tokyo'],
    ['tanaka', 41, 'Osaka'],
    ['ogura', 33, 'Nagoya'],
    ['qqq', 33, 'rrr'],
];
for ( let i = 0; i < manyArray.length; i++ ) {
    for ( let j = 0; j< manyArray[0].length; j++) {
        console.log(manyArray[i][j]);
    }
}


//Object
let mybox = {
    'width':400,
    'height':300 * 2,
};
console.log(mybox.height);
console.log(mybox['width']);
let aaa = 'height';
console.log(mybox[aaa]);


//デジタル時計を表示
window.onload = function() {
    setInterval(function() {
      var dd = new Date();
      document.getElementById("T1").innerHTML = dd.toLocaleString();
    }, 1000);
  }

function getData(){
    //Ajax
    let request = new XMLHttpRequest();

    //XMLHttpRequest オブジェクトが状態変化した時の処理
    request.onreadystatechange = function () {
        //状態番号を出力
        console.log(request.readyState);
        //レスポンス受信が完了した場合
        if (request.readyState == 4) {
            console.log("完了(レスポンスの受信完了)");
            //レスポンスが正常だった場合
            if (request.status == 200) {
                //let data = request.responseText;
                //console.log(data);
                let node = document.getElementById("result");
                node.innerHTML = request.responseText;
            }
        } else if (request.readyState == 0) {
            console.log("未初期化(openメソッドが呼ばれていない)");
        }
        else if (request.readyState == 1) {
            console.log("ロード中(openメソッドは済み、sendメソッドが未)");
        }
        else if (request.readyState == 2) {
            console.log("ロード済(sendメソッドは済みでレスポンス待ち)");
        }
        else if (request.readyState == 3) {
            console.log("受信中(レスポンス受信中)");
        }
    }
    //HTTPリクエストを初期化
    request.open('GET', 'http://127.0.0.1:8000/storage/test.txt', true);
    //HTTPリクエストを送信
    request.send(null);
}

function EncodeHTMLForm( data )
{
    var params = [];

    for( var name in data )
    {
        var value = data[ name ];
        var param = encodeURIComponent( name ) + '=' + encodeURIComponent( value );

        params.push( param );
    }

    return params.join( '&' ).replace( /%20/g, '+' );
}


function sendData(){
    //Ajax
    let request = new XMLHttpRequest();

   let send_string = { name: 'test1', mail: 'mail@a', age: 10};
    //HTTPリクエストを初期化
    request.open('POST', 'http://127.0.0.1:8000/add', true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    //HTTPリクエストを送信
    request.send(EncodeHTMLForm(send_string));
}


//HTMLのボタン要素を取得
const btn = document.getElementById('testBtn');
//クリックした時にAjax発動（getData()だとページロード後に呼び出されてしまう）
btn.addEventListener('click', sendData);



