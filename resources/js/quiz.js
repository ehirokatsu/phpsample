
//https://b-risk.jp/blog/2022/09/random-quiz/


//即時実行関数
(function ($) {

//ドキュメント準備完了イベント
//$(function () {
//上記だと、$(window).on('load', function ()内が実行されず質問1がHTMLに反映されない。

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

    //現在のクイズ番号
    let $currentQuestionNum = 0;

    //得点
    let $pointPerCorrect = 10;

    //即時実行関数を使うとクラスのようになる
    //Objがコンストラクタ、プロトタイプがメンバメソッドとなる
    let questionObject = (function () {

        //コンストラクタ
        let Obj = function ($target) {

            //クイズの番号
            this.$questionNumberElement = $target.find('.quiz-question-number');

            //クイズの問題文
            this.$questionSentenceElement = $target.find('.quiz-question');

            //選択肢ボタン
            this.$questionButtonElement = $target.find('.quiz-button');

            //選択肢1〜4
            this.$button01Element = $target.find('.button01');
            this.$button02Element = $target.find('.button02');
            this.$button03Element = $target.find('.button03');
            this.$button04Element = $target.find('.button04');
        
            //選択肢のテキスト文
            this.$answer01Element = $target.find('.quiz-text01');
            this.$answer02Element = $target.find('.quiz-text02');
            this.$answer03Element = $target.find('.quiz-text03');
            this.$answer04Element = $target.find('.quiz-text04');

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

                    //現在のクイズ番号からクイズIDを取得
                    let value = quizId[$currentQuestionNum];

                    //最初のクイズオブジェクトを取得
                    let firstQuestionObject = _this.searchQuestion(value);

                    //クイズの内容をHTMLにセットする
                    _this.setQuestionToHtml(firstQuestionObject);

                    //HTMLの選択肢をランダムにセットする
                    _this.shuffleAnswer($('.quiz-answer'));
                });

                //選択肢をクリックした時の処理
                this.$questionButtonElement.on("click", function () {
 
                    //クリックした選択肢がbutton01の正解だった場合
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

                        //現在のクイズ番号の更新
                        $currentQuestionNum = $currentQuestionNum + 1;
           
                        //次のクイズIDを取得
                        let value = quizId[$currentQuestionNum];
           
                        //次の質問を取得
                        let nextQuestionObject = _this.searchQuestion(value);
           
                        //次の質問に切り替える
                        _this.setQuestionToHtml(nextQuestionObject);
           
                        //クラスを取る
                        _this.$questionButtonElement.removeClass('is-checked');
                        $('.quiz-answer').removeClass('is-correct').removeClass('is-incorrect');
           
                        //回答をシャッフル
                        _this.shuffleAnswer($('.quiz-answer'));
           
                      }, 1000);
                    }
                    return false;
                  });


                return false;
            },

            //クイズIDからクイズオブジェクト（質問文と回答）を取得する
            searchQuestion: function (questionId) {

                //戻り値用変数の初期化
                let QuestionObject = null;

                //arrayオブジェクトが持つforeachメソッドを使用
                //クイズIDに対応するクイズオブジェクトを取得する
                prefecturalCapital.forEach(function (item) {
                    if (item.id == questionId) {
                        QuestionObject = item;
                    }
                });
                return QuestionObject;
            },

            //クイズオブジェクトからHTMLへ次のクイズ内容を反映する
            setQuestionToHtml: function (nextQuestionObject) {

                let _this = this;

                //クイズの質問文の入れ替え
                _this.$questionSentenceElement.text(nextQuestionObject.question);

                //質問番号を1つ増やす
                _this.$questionNumberElement.text('質問' + ($currentQuestionNum + 1));

                //選択肢のテキストの入れ替え
                _this.$answer01Element.text(nextQuestionObject.answer01);
                _this.$answer02Element.text(nextQuestionObject.answer02);
                _this.$answer03Element.text(nextQuestionObject.answer03);
                _this.$answer04Element.text(nextQuestionObject.answer04);

            },


            //引数の要素の子要素をランダムで配置し直す
            shuffleAnswer: function (container) {

                //引数の子要素を取得。この場合は4つの<li>となる。
                let content = container.find("> *");

                //<li>の個数。今回は4になる
                let total = content.length;

                //4つの<li>からランダムに1つを選択して<ul>の最初に追加する。
                //これを<li>の数だけ（4回）繰り返す。
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
//});
})(jQuery);
