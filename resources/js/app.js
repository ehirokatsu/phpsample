import './bootstrap';

console.log("Hello world!!");

window.onload = function() {
    setInterval(function() {
      var dd = new Date();
      document.getElementById("T1").innerHTML = dd.toLocaleString();
    }, 1000);
  }