<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopularTabelaCamposTipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Status
        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('users', 'status', 'tp_status')");

        // Tipo de Cargo
        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('cargos', 'tipo', 'tp_tipo_cargos')");

        // UF
        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('enderecos', 'uf', 'tp_uf')");

        // Funcionário
        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('funcionarios', 'tipo', 'tp_tipo_funcionario')");

        // Movimentos
        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('movimentos', 'andamento', 'tp_andamento')");

        // Semsop Relatorios
        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('semsop_relatorios', 'origem', 'tp_origem')");

        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('semsop_relatorios', 'acao_gcmm', 'tp_acao_gcmm')");

        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('semsop_relatorios', 'acao_cop', 'tp_acao_cop')");

        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('semsop_relatorios', 'tipo', 'tp_relatorio_semsop')");

        // Solicitações

        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('solicitacoes', 'status', 'tp_status_solicitacao')");

        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('solicitacoes', 'prioridade', 'tp_prioridade_solicitacao')");

        // Solicitantes

        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('solicitantes', 'sexo', 'tp_sexo')");

        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('solicitantes', 'status', 'tp_status_solicitante')");

        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('solicitantes', 'estado_civil', 'tp_estado_civil')");

        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('solicitantes', 'escolaridade', 'tp_escolaridade')");

        // Telefones

        DB::statement("INSERT INTO campos_tipos(tabela, campo, tipo) values('telefones', 'tipo_telefone', 'tp_telefone')");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DELETE FROM campos_tipos WHERE 1=1");
    }
}
