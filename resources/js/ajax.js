import { first } from 'lodash';
import './bootstrap';
//'use strict';

function getAllData(){

    fetch('ajax/showAll', { // 第1引数に送り先
    })
        .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
        .then(res => {
         /*--------------------
              PHPからの受取成功
             --------------------*/
            // 取得したレコードをeachで順次取り出す
            res.forEach(elm =>{
                var insertHTML = "<tr class=\"target\"><td>" + elm['id'] + "</td><td>" + elm['name'] + "</td><td>"  + elm['mail'] + "</td><td>" + elm['age'] + "</td></tr>"
                var all_show_result = document.getElementById("all_show_result");
                all_show_result.insertAdjacentHTML('afterend', insertHTML);
            })
            console.log("通信成功");
            console.log(res); // 返ってきたデータ
        })

        .catch(error => {
            console.log(error); // エラー表示
        })
}

// 関数を実行
getAllData();

var ajax_show = document.getElementById("ajax_show");
ajax_show.addEventListener('click', () => {

    console.log("イベント発火");

    /*--------------------
     POST送信
     -------------------*/
    const postData = new FormData; // フォーム方式で送る場
    postData.set('id', document.getElementById('id_number').value); // set()で格納する

    fetch('ajax/show', { // 第1引数に送り先
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}, // CSRFトークン対策
        body: postData
    })
        .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
        .then(res => {
            console.log('res: '+res[0].id); // やりたい処理
            document.getElementById("result").innerHTML = "ID番号" + res[0].id + "は「" + res[0].name + "」です。年齢は「" + res[0].age+"」です。";
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
});

var ajax_add = document.getElementById("ajax_add");

ajax_add.addEventListener('click', () => {

    /*--------------------
       POST送信
       -------------------*/
      const postData = new FormData; // フォーム方式で送る場
      postData.set('name', document.getElementById('name').value);   // set()で格納する
      postData.set('mail', document.getElementById('mail').value); // set()で格納する
      postData.set('age', document.getElementById('age').value); // set()で格納する

      fetch('ajax/add', { // 第1引数に送り先
          method: 'POST', // メソッド指定
          headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}, // CSRFトークン対策
          body: postData
      })
          .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
          .then(res => {
              console.log('res: '+res[0].name); // やりたい処理
              // やりたい処理
              document.getElementById("add_result").innerHTML = "<p>" + res[0].name + "が" + res[0].age + "のデータを登録しました。</p>";

              res.forEach(elm =>{
                  var insertHTML = "<tr class='target'><td>" + elm['id'] + "</td><td>" + elm['name'] + "</td><td>" + elm['mail'] + "</td><td>" + elm['age'] + "</td></tr>"
                  var all_show_result = document.getElementById("all_show_result");
                  all_show_result.insertAdjacentHTML('afterend', insertHTML);
              })

          })
          .catch(error => {
              console.log(error); // エラー表示
          });

});

/*************************
 指定したidのレコードを削除
 ************************/
var ajax_del = document.getElementById("ajax_del");
ajax_del.addEventListener('click', () => {

    console.log("イベント発火");

    /*--------------------POST送信　セット-------------------*/
    const postData = new FormData; // フォーム方式で送る場
    postData.set('id', document.getElementById('id_number_del').value); // set()で格納する

    /*-----------------------POST送信----------------------*/
    fetch('ajax/del', { // 第1引数に送り先
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}, // CSRFトークン対策
        body: postData
    })
        .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
        .then(res => {

            //---------------------------
            // 通信成功（やりたい処理を記述）
            //---------------------------
            document.getElementById("del_result").innerHTML = "" + res.del_list[0].name + "が" + res.del_list[0].age + "のデータを削除しました。";

            // 一旦全部削除
            const elements = document.getElementsByClassName('target')
            while (elements.length) {
                elements.item(0).remove()
            }

            // TABLE一覧表示
            res.all_list.forEach(elm =>{
                var insertHTML = "<tr class=\"target\"><td>" + elm['id'] + "</td><td>" + elm['name'] + "</td><td>"  + elm['mail'] + "</td><td>" + elm['age'] + "</td></tr>"
                var all_show_result = document.getElementById("all_show_result");
                all_show_result.insertAdjacentHTML('afterend', insertHTML);
            })

        })
        .catch(error => {
            console.log(error); // エラー表示
        });
    });