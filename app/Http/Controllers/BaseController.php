<?php 

namespace App\Http\Controllers;

use View;
use App\Models\Funcionario;

//You can create a BaseController:

class BaseController extends Controller {

    public $funcionario_logado = "I am Data";

    public function __construct() {

    	// Obter o funcionário logado
      $this->$funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

      // COmpartilhar essa variável com todas as views
      View::share ( 'funcionario_logado', $this->funcionario_logado );
       
    }  

}