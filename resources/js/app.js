import { first } from 'lodash';
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

let sum2 = function (x, y) {
    return x+y;
};
console.log(sum2(10, 20));

let sum3 = (x, y) => {
    return x+y;
};
console.log(sum3(10, 20));

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

//Ajax GET
function getData(){
    //Ajax
    let request = new XMLHttpRequest();

    //結果を格納するHTML要素を追加
    let node = document.getElementById("getResult");
    
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


function getData2() {

    let request = new XMLHttpRequest();

    let node = document.getElementById("getResult");
    
    request.addEventListener('loadstart', function(){
        node.textContent = '通信中';
    }, false);
    request.addEventListener('progress', function(){
        node.textContent = '通信中2';
    }, false);
    request.addEventListener('load', function(){
        node.textContent = request.responseText;
    }, false);

    //HTTPリクエストを初期化
    request.open('GET', 'http://127.0.0.1:8000/storage/test.txt', true);
    //HTTPリクエストを送信
    request.send(null);
}




function EncodeHTMLForm( data )
{
    let params = [];

    for( let name in data )
    {
        let value = data[ name ];
        let param = encodeURIComponent( name ) + '=' + encodeURIComponent( value );

        params.push( param );
    }

    //「application/x-www-form-urlencoded」では半角スペースが「+」でなければならないため、
    //エンコード結果の「%20」を「+」に修正しています。
    return params.join( '&' ).replace( /%20/g, '+' );
}


//Ajax POST
function sendData(){

    let request = new XMLHttpRequest();

    //post送信したいデータ
    let send_string = { name: 'test1', mail: 'mail@a', age: 10};

    //HTTPリクエストを初期化
    request.open('POST', 'http://127.0.0.1:8000/add', true);
    //request.open('POST', 'add', true);

    //Content-Typeヘッダーの指定
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    //HTTPリクエストを送信
    request.send(EncodeHTMLForm(send_string));
}


//HTMLのボタン要素を取得
const getBtn = document.getElementById('getBtn');
//クリックした時にAjax発動（getData()だとページロード後に呼び出されてしまう）
getBtn.addEventListener('click', getData2);

const postBtn = document.getElementById('postBtn');
postBtn.addEventListener('click', sendData);



//クラス（関数ベース）
let Member = function ( firstName, lastName ) {
    this.firstName = firstName;
    this.lastName = lastName;
    this.getName = function () {
        return this.firstName + '' + this.lastName;
    }
}

let mem = new Member( 'Yamada', 'Ichiro');
console.log(mem.getName());
console.log(mem.firstName);

//クラス（ES2015）
class Meibo {
    constructor ( firstName, lastName ) {
        this.firstName = firstName;
        this.lastName = lastName;
    }

    get firstName () {
        return this._firstName;
    }
    set firstName ( value ) {
        this._firstName = value;
    }
    get lastName () {
        return this._lastName;
    }
    set lastName ( value ) {
        this._lastName = value;
    }

    getName () {
        return this.firstName + this.lastName;
    }
}

let meibo = new Meibo( 'Yamada', 'Ichiro');
console.log(meibo.getName());
console.log(meibo.firstName);


//クラス継承
class WorkMeibo extends Meibo {

    getWork () {
        return this.firstName + this.lastName + 'Manager';
    }
}

let workMeibo = new WorkMeibo( 'Yamada', 'Ichiro');
console.log(workMeibo.getWork());
console.log(workMeibo.firstName);



//マウスイベント
//反映するHTMLを取得
let mouse = document.getElementById('mouse');

//マウスダウン
function mouseDown (event) {
    mouse.textContent = 'mousedown';
    console.log(event);
}
//マウスアップ
function mouseUp (event) {
    mouse.textContent = 'mouseUp';
    console.log(event);
}

//プロパティでイベントハンドラ
//mouse.onmousedown = mouseDown;
//mouse.onmouseup = mouseUp;
 
//イベントリスナ
mouse.addEventListener('mousedown', mouseDown)
mouse.addEventListener('mouseup', mouseUp)


