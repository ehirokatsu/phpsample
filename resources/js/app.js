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

window.onload = function() {
    setInterval(function() {
      var dd = new Date();
      document.getElementById("T1").innerHTML = dd.toLocaleString();
    }, 1000);
  }