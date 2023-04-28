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

//Ajax GET イベントリスナーで実装
function getData2() {

    let request = new XMLHttpRequest();

    //通信状態を表示するHTML要素を取得
    let node = document.getElementById("getResult");

    //ajax開始
    request.addEventListener('loadstart', function(){
        node.textContent = '通信中';
    }, false);

    //処理中
    request.addEventListener('progress', function(){
        node.textContent = '通信中2';
    }, false);

    //サーバから受信完了
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

//Ajax POST XMLHttpRequest
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


//Ajax POST fetch
function sendData2(){
    const postData = new FormData; // フォーム方式で送る場
    postData.set('name', 'test1'); // set()で格納する
    postData.set('mail', 'mail@a'); // set()で格納する
    postData.set('age', '10'); // set()で格納する

    fetch('add', { // 第1引数に送り先
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}, // CSRFトークン対策
        body: postData
    })
    .then(response => {
    }) 
    .catch(error => {
        console.log(error); // エラー表示
    });
}

//Ajax POST await
async function sendData3 () {
    const postData = new FormData; // フォーム方式で送る場
    postData.set('name', 'test1'); // set()で格納する
    postData.set('mail', 'mail@a'); // set()で格納する
    postData.set('age', '10'); // set()で格納する

    try {
        const response = await fetch('add', { // 第1引数に送り先
            method: 'POST',
            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}, // CSRFトークン対策
            body: postData
        });
        if (!response.ok) {
            throw new Error('Network response was not ok');  // fetchが成功したかどうかの判定
        }
    } catch(e) {
      alert(e);  // 例外（エラー）が発生した場合に実行
    } finally {
      console.log('finally');  // 処理結果の成否に関わらず実行
    }
}



//HTMLのボタン要素を取得
const getBtn = document.getElementById('getBtn');
//クリックした時にAjax発動（getData()だとページロード後に呼び出されてしまう）
getBtn.addEventListener('click', getData2);

const postBtn = document.getElementById('postBtn');
postBtn.addEventListener('click', sendData3);



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


//+ボタンとーボタンで数量をカウントし、合計金額を表示する
/*
let menu1Count = 0;
let menu2Count = 0;
let menu3Count = 0;
let totalAmount = 0;

let menu1MinusBtn = document.getElementById('menu1MinusBtn');
let menu1PlusBtn = document.getElementById('menu1PlusBtn');
let menu2MinusBtn = document.getElementById('menu2MinusBtn');
let menu2PlusBtn = document.getElementById('menu2PlusBtn');
let menu3MinusBtn = document.getElementById('menu3MinusBtn');
let menu3PlusBtn = document.getElementById('menu3PlusBtn');

let menu1CountLabel = document.getElementById('menu1CountLabel');
let menu2CountLabel = document.getElementById('menu2CountLabel');
let menu3CountLabel = document.getElementById('menu3CountLabel');
let totalAmountLabel = document.getElementById('totalAmountLabel');

function menu1CountUp () {
    menu1Count++;
    menu1CountLabel.textContent = 'A:'+menu1Count;
    totalAmount = totalAmount + 600;
    totalAmountLabel.textContent = totalAmount;
}
function menu1CountDown () {
    menu1Count--;
    menu1CountLabel.textContent = 'A:'+menu1Count;
    totalAmount = totalAmount - 600;
    totalAmountLabel.textContent = totalAmount;
}
function menu2CountUp () {
    menu2Count++;
    menu2CountLabel.textContent = 'B:'+menu2Count;
    totalAmount = totalAmount + 100;
    totalAmountLabel.textContent = totalAmount;
}
function menu2CountDown () {
    menu2Count--;
    menu2CountLabel.textContent = 'B:'+menu2Count;
    totalAmount = totalAmount - 100;
    totalAmountLabel.textContent = totalAmount;
}


menu1MinusBtn.addEventListener('click', menu1CountDown);
menu1PlusBtn.addEventListener('click', menu1CountUp);
menu2MinusBtn.addEventListener('click', menu2CountDown);
menu2PlusBtn.addEventListener('click', menu2CountUp);
*/

//上記をJqueryで記載。
$(function(){

    let menu1Count = 0;
    let menu2Count = 0;
    let menu3Count = 0;
    let totalAmount = 0;

    $('#menu1MinusBtn').click(function(){
        menu1Count--;
        $('#menu1CountLabel').text('A:'+menu1Count);
        totalAmount = totalAmount - 600;
        $('#totalAmountLabel').text(totalAmount);
    });
});


//jsonデータを定義
const json = '{"people": [{"name": "Oleg Kononenko", "craft": "ISS"}, {"name": "David Saint-Jacques", "craft": "ISS"}, {"name": "Anne McClain", "craft": "ISS"}], "number": 3, "message": "success"}';

//jsonデータの取得先を定義
const url = 'http://api.open-notify.org/astros.json';


//jsonデータの「people」箇所を取り出す
function getSpacePeople(json) {

	const people = JSON.parse(json).people;
	
    console.log(people);
}

getSpacePeople(json);

//urlからGETメソッドでjsonデータを取得する
function getSpacePeopleUrl(url) {

    const request = new XMLHttpRequest();
    
    request.addEventListener('load', () => {
        const people = JSON.parse(request.response).people;
        console.log(people);
    });
	
    request.open('GET', url);
    
    request.send();
}
getSpacePeopleUrl(url);


//setTimeout関数
function async ( arg ) {

    console.log('start');

    setTimeout(() => {
        //argミリ秒経過したら以下が実行される  
        console.log('処理2');
        console.log(Math.floor(arg/1000) + '秒経過');
        
        setTimeout(() => {
            //argミリ秒経過したら以下が実行される  
            console.log('処理B');
        }, arg );
        console.log('処理A');
    }, arg );

    console.log('処理1');

}
async(1000);

//promise
const time = 1000;
const promise = new Promise((resolve) => {
    console.log('start');
    setTimeout(() => {
        resolve(time);
    }, time );
    console.log('処理1');
});
promise.then((arg) => {
        //argミリ秒経過したら以下が実行される  
        console.log('処理2');
        console.log(Math.floor(arg/1000) + '秒経過');

});

//promiseを関数化
function asyncOri(time) {
    return new Promise((resolve) => {
        console.log('start');
        setTimeout(() => {
            resolve(time);
        }, time );
        console.log('処理1');
    });
}
const promise2 = asyncOri(1000);
promise2.then((arg) => {
        //argミリ秒経過したら以下が実行される  
        console.log('処理2');
        console.log(Math.floor(arg/1000) + '秒経過');

});


//PromiseとXmlHttpRequestを使用
function getSpacePeopleUrlPromise(url) {
    return new Promise((resolve, reject) => {
        const request = new XMLHttpRequest();
        request.addEventListener('load', () => {
            resolve(request.response);
        });
        request.addEventListener('error', (error) => {
            reject(error);
        })
        request.open('GET', url);
        request.send();
    });

}
getSpacePeopleUrlPromise(url)//;は付与しない
.then(
    (data) => {
        const people = JSON.parse(data).people;
        console.log(people);    
    },
    (error) => {
        console.error(new Error('ori error'));
    }
);

//fetch
function getSpacePeopleUrlFetch(url) {
    return fetch(url)//イベントリスナ、open、sendを行う
    .then((response) => {//fetchの戻り値がresponse。内部的にはpromise
        console.log(response.json());//jsonに変換して取得。promiseオブジェクトになる
    });
}
getSpacePeopleUrlFetch(url);

//fetch2
function getSpacePeopleUrlFetch2(url) {
    return fetch(url)//イベントリスナ、open、sendを行う
    .then((response) => {//fetchの戻り値がresponse。内部的にはpromise
        return new Promise((resolve, reject) => {
            response.json()
            .then(
                (data) => resolve(data),
                (error) => reject(error),
            );
        });
    });
}
getSpacePeopleUrlFetch2(url)
.then(
    (data) => {
        console.log(data.people);
    },
    (error) => {
        console.error(`error: ${error}`);
    }
);


fetch(url)
.then(response => response.json())
.then(data => console.log(data.people))
.catch(error => {
  alert(error);  // 例外（エラー）が発生した場合に実行
})
.finally(() => {
  console.log('finally');  // 処理結果の成否に関わらず実行
});


//async await 
async function getSpacePeopleUrlAsyncWait(url) {
    try {
        const data = await(await fetch(url)).json();
        console.log(data.people);
    } catch (error) {
        console.error(`error: ${error}`);
    }
}
getSpacePeopleUrlAsyncWait(url);




//関数の引数に関数を渡すこともできる
let testFunc1 = function ( arg1, arg2 ) {
    this.arg1 = arg1;
    this.arg2 = arg2;
    this.getSum = function () {
        return this.arg1 + this.arg2;
    }
}

function testers ( args ) {
    return args;
}

let testa = new testFunc1( 1, 2);
console.log(testa.getSum());

console.log(testers(10));

let testb = new testFunc1( testers(10), 2);
console.log(testb.arg1);
console.log(testb.getSum());



/**************************************************************** 
 * 関数の書き方
 * １．function
 * ２．アロー
 * ３．関数内が一文なら｛｝とreturnを省略
 * 
************************************************************/
fetch('https://www.jma.go.jp/bosai/forecast/data/forecast/130000.json')
.then(function(response) {
  return response.json();
})
.then(function(data) {
  return console.log(data);
});

fetch('https://www.jma.go.jp/bosai/forecast/data/forecast/130000.json')
.then((response) => {
  return response.json();
})
.then((data) => {
  return console.log(data);
});


fetch('https://www.jma.go.jp/bosai/forecast/data/forecast/130000.json')
.then(response => response.json())
.then(data => console.log(data));



/**************************************************************** 
 * 天気データを下記から取得
 * https://www.jma.go.jp/bosai/forecast/data/forecast/130000.json
 * １．XMLHttpRequestを使用
 * ２．Promiseを使用
 * ３．fetchを使用
 * ４．awaitを使用
 * 
************************************************************/

//１．XMLHttpRequestを使用
//onreadystatechangeを使用
function getForecastXml(url) {

    const request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        
        //状態番号を出力
        console.log(request.readyState);

        //レスポンス受信が完了した場合
        if (request.readyState == 4) {
            const data = JSON.parse(request.response);
            console.log(data);
        }
    }

    request.open('GET', url);
    request.send();
}
getForecastXml('https://www.jma.go.jp/bosai/forecast/data/forecast/130000.json');

//addEventListenerを使用
function getForecastXml2(url) {
    const request = new XMLHttpRequest();
    request.addEventListener('load', () => {
        const data = JSON.parse(request.response);
        console.log(data);
    });
    request.open('GET', url);
    request.send();
}
getForecastXml2('https://www.jma.go.jp/bosai/forecast/data/forecast/130000.json');


// ２．Promiseを使用
function getForecast (url) {
    return new Promise((resolve, reject) => {
        const request = new XMLHttpRequest();
        request.addEventListener('load', () => resolve(request.response));
        request.addEventListener('error', (error) => reject(error));
        request.open('GET', url);
        request.send();
    });
}
getForecast('https://www.jma.go.jp/bosai/forecast/data/forecast/130000.json')
.then(
    function(response) {
        return JSON.parse(response);

        //以下はNG
        //return response.json();
      }
)
.then(function(data) {
    console.log(data);
})
.catch((error) => {
    console.error(`error: ${error}`);
});


//３．fetchを使用
//fetchのサンプル
fetch('https://www.jma.go.jp/bosai/forecast/data/forecast/130000.json')
.then(function(response) {
  return response.json();
})
.then(function(data) {
  return console.log(data);
});


//fetchでエラー処理
fetch('https://www.jma.go.jp/bosai/forecast/data/forecast/130000.json')
.then(function (response) {
  if (!response.ok) {
    throw new Error('Network response was not ok');  // fetchが成功したかどうかの判定
  }
  return response.json();
})
.then(function(data) {
    return console.log(data);
})
.catch(error => {
  alert(error);  // 例外（エラー）が発生した場合に実行
})
.finally(() => {
  console.log('finally');  // 処理結果の成否に関わらず実行
});


//４．awaitを使用
//asyncのサンプル
(async () => {
  const response = await fetch('https://www.jma.go.jp/bosai/forecast/data/forecast/130000.json');
  const data = await response.json();
  console.log(data);
})();

//asyncでエラー処理
(async () => {
    try {
      const response = await fetch('https://www.jma.go.jp/bosai/forecast/data/forecast/130000.json');
      if (!response.ok) {
        throw new Error('Network response was not ok');  // fetchが成功したかどうかの判定
      }
      const data = await response.json();
      console.log(data);
    } catch(e) {
      alert(e);  // 例外（エラー）が発生した場合に実行
    } finally {
      console.log('finally');  // 処理結果の成否に関わらず実行
    }
})();

