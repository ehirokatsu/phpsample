<?php
namespace App\Http\Composers;

use Illuminate\View\View;

class HelloComposer
{
    //HelloServiceProvider.phpにて、どのビューが呼ばれたら以下を実行するか定義
   public function compose(View $view)
   {
       $view->with('view_message', 'this view is "' 
            . $view->getName() . '"!!');
   }
}