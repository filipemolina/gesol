<?php 

namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Funcionario;
use App\Models\User;

class GlobalComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        
        if(Auth::check()){

            $funcionario_logado = Funcionario::with('user', 'setor', 'setor.secretaria', 'role', 'atribuicoes','cargo')
                                              ->where('id', Auth::user()->funcionario_id)
                                              ->first();

            $view->with(compact('funcionario_logado'));

        }            

    }

}