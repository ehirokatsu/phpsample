//import { first } from 'lodash';
//import './bootstrap';
//'use strict';

//https://b-risk.jp/blog/2022/09/random-quiz/


//即時実行関数
//(function ($) {

//ドキュメント準備完了イベント
$(function () {
    //合計問題数
    let $questionTotalNum = 5;

    //問題（オブジェクト形式）
    const prefecturalCapital = [
        {
          id: "01",
          question: "北海道の県庁所在地は？",
          answer01: "札幌",
          answer02: "福島",
          answer03: "前橋",
          answer04: "秋田",
        },
        {
          id: "02",
          question: "青森県の県庁所在地は？",
          answer01: "青森",
          answer02: "前橋",
          answer03: "秋田",
          answer04: "札幌",
        },
        {
          id: "03",
          question: "岩手県の県庁所在地は？",
          answer01: "盛岡",
          answer02: "福島",
          answer03: "仙台",
          answer04: "山形",
        },
        {
          id: "04",
          question: "宮城県の県庁所在地は？",
          answer01: "仙台",
          answer02: "札幌",
          answer03: "前橋",
          answer04: "水戸",
        },
        {
          id: "05",
          question: "秋田県の県庁所在地は？",
          answer01: "秋田",
          answer02: "盛岡",
          answer03: "青森",
          answer04: "札幌",
        },
    ];

    //質問をランダムにする
    function shuffleQuiz (array) {

        //配列の最後の要素と、ランダムで選んだ要素を交換する。配列要素1になるまで繰り返す
        for (let i = (array.length - 1); 0 < i; i--) {
            let random = Math.floor(Math.random() * (i + 1));
            //console.log("i="+ i);
            //console.log(random);
            let selected = array[i];
            array[i] = array[random];
            array[random] = selected;
        }

        return array;

    }
    let quizId = ["01","02","03","04","05"];
    shuffleQuiz(quizId);
    //console.log(quizId);

    //現在の質問数
    let $currentQuestionNum = 0;

    //得点
    let $pointPerCorrect = 10;

    //即時実行関数を使うとクラスのようになる
    //Objがコンストラクタ、プロトタイプがメンバメソッドとなる
    let questionObject = (function () {

        //コンストラクタ
        let Obj = function ($target) {

            //クイズの番号
            this.$questionNumber = $target.find('.quiz-question-number');

            //クイズの問題文
            this.$questionName = $target.find('.quiz-question');

            //選択肢ボタン
            this.$questionButton = $target.find('.quiz-button');
            //選択肢1〜4
            this.$button01 = $target.find('.button01');
            this.$button02 = $target.find('.button02');
            this.$button03 = $target.find('.button03');
            this.$button04 = $target.find('.button04');
        
            //選択肢のテキスト文
            this.$answer01 = $target.find('.quiz-text01');
            this.$answer02 = $target.find('.quiz-text02');
            this.$answer03 = $target.find('.quiz-text03');
            this.$answer04 = $target.find('.quiz-text04');

            //score
            this.$score = $target.find('.score-wrap .score');

            this.init();
        };
        //オブジェクトリテラルでプロトタイプを定義
        Obj.prototype = {

            init:function () {
                this.event();
            },
            event:function () {

                let _this = this;
                let score = 0;

                //ウインドウ読み込み時
                $(window).on('load', function () {

                    //クイズID取得
                    let value = quizId[$currentQuestionNum];

                    //次の質問を取得
                    let nextQuestion = _this.searchQuestion(value);

                    //次の質問に切り替える
                    _this.changeQuestion(nextQuestion);

                    //回答をシャッフルする
                    _this.shuffleAnswer($('.quiz-answer'));
                });

                //button クリック
                this.$questionButton.on("click", function () {
 
                    if ($(this).hasClass('button01')) {
                      $(this).parents('.quiz-answer').addClass('is-correct');
                      score = score + $pointPerCorrect;
                    } else {
                      $(this).parents('.quiz-answer').addClass('is-incorrect');
                    }
           
                    $(this).addClass('is-checked');
           
                    if ($currentQuestionNum + 1 == $questionTotalNum) {
                      setTimeout(function () {
                        $('.finish').addClass('is-show');
                        $('.score-wrap .score').text(score);
                      }, 1000);
                    } else {
                      setTimeout(function () {
                        //現在の数字の更新
                        $currentQuestionNum = $currentQuestionNum + 1;
           
                        //次の質問番号を取得
                        let value = quizId[$currentQuestionNum];
           
                        //次の質問を取得
                        let nextQuestion = _this.searchQuestion(value);
           
                        //次の質問に切り替える
                        _this.changeQuestion(nextQuestion);
           
                        //クラスを取る
                        _this.$questionButton.removeClass('is-checked');
                        $('.quiz-answer').removeClass('is-correct').removeClass('is-incorrect');
           
                        //回答のシャッフル
                        _this.shuffleAnswer($('.quiz-answer'));
           
                      }, 1000);
                    }
                    return false;
                  });


                return false;
            },
            searchQuestion: function (questionId) {

                let nextQuestion = null;
                prefecturalCapital.forEach(function (item) {
                    if (item.id == questionId) {
                        nextQuestion = item;
                    }
                });
                return nextQuestion;
            },
            changeQuestion: function (nextQuestion) {

                let _this = this;

                //質問文の入れ替え
                _this.$questionName.text(nextQuestion.question);

                //質問番号を1つ増やす
                let numPlusOne = $currentQuestionNum + 1;
                _this.$questionNumber.text('質問' + numPlusOne);

                //選択肢のテキストの入れ替え
                _this.$answer01.text(nextQuestion.answer01);
                _this.$answer02.text(nextQuestion.answer02);
                _this.$answer03.text(nextQuestion.answer03);
                _this.$answer04.text(nextQuestion.answer04);

            },
            shuffleAnswer: function (container) {
                let content = container.find("> *");
                let total = content.length;
                content.each(function () {
                    content.eq(Math.floor(Math.random() * total)).prependTo(container);
                });
            },
        };
        return Obj;

    })();

    let quiz = $('.quiz');
    if (quiz[0]) {
        let queInstance = new questionObject(quiz);
    }
});
//})(jQuery);
