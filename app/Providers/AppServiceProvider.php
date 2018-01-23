<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use App\Models\Funcionario;
use View;

class AppServiceProvider extends ServiceProvider
{
   /**
   * Bootstrap any application services.
   *
   * @return void
   */
   public function boot()
   {
      View::composer('*', "App\Http\Composers\GlobalComposer");
   }

   /**
   * Register any application services.
   *
   * @return void
   */
   public function register()
   {
      //
   }
}
