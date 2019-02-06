<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*   //usado na USERS
        DB::statement(" CREATE TYPE tp_status AS ENUM ('Ativo','Inativo') ");

        //usado na CARGOS
        DB::statement(" CREATE TYPE tp_tipo_cargos AS ENUM ('E','C') ");//E = Efetivo, C = Comissionado 

        //usado na ENDERECOS
        DB::statement(" CREATE TYPE tp_uf AS ENUM ('AC','AL','AM','AP','BA','CE','DF','ES','GO','MA','MG','MS','MT','PA','PB','PE','PI','PR','RJ','RN','RO','RR','RS','SC','SE','SP','TO') ");

        //usado na FUNCIONARIOS
        DB::statement(" CREATE TYPE tp_tipo_funcionario AS ENUM ('Efetivo','Comissionado','Externo','Sistema') ");

        //usado na MOVIMENTOS
        DB::statement(" CREATE TYPE tp_andamento AS ENUM ('Liberou','Bloqueou','Redirecionou','Fechou','Respondeu','Alterou','Recusou','Leu') ");

        //usado na SEMSOP_RELATORIOS
        DB::statement(" CREATE TYPE tp_origem AS ENUM ('Ordem de servico','Disque denuncia','Ouvidoria','Dever de oficio','Ordem imediata') ");

        DB::statement(" CREATE TYPE tp_acao_gcmm AS ENUM ('Apoio em colisão de veiculos S/ vitima','Apoio em colisão de veiculos C/ vitima','Apoio em vitimas de atropelamento','Autos de infrações lavrados','Apoio div. a transeuntes em via/comercio','Apresentação de fantoches','Apresentação de palestra','Atendimentos extraordinarios(S/ oficio)','Atendimentos via oficios','Combate a incêndio urbano','Combate a incêndio florestal','Condução de cidadãos ao hospital','Conflito em escolas','Corte irregular de árvore','Despejos de residuos sólidos','Denuncia de maus tratos a animais','Encontro de veiculos abandonados','Furto a transeunte','Furto ao comercio','Invasão ao espaço publico','Mal súbito em via pública','Manifestação em via pública','Manifestação na prefeitura','Operação de controle de tráfego','Operações integradas PMERJ / PCERJ','Pertubação do sossego público','Resgate a animais selvagens','Roubo a transeunte','Vandalismo / Pixação ao patrimônio','Vias de fato em via pública/praças','Segurança pública em jogos/estádios') ");

        DB::statement(" CREATE TYPE tp_acao_cop AS ENUM ('Notificação de irregularidades','Apreensão de material, mercadoria ou equipamento irregular','Intimação por infração','Multa por infração','Ação noturna','Demolição de construção, equipamento ou material irregular','Fiscalização de praças','Serviços especiais (Feriados e afins)','Retirada de material de propaganda irregular') ");

        DB::statement(" CREATE TYPE tp_relatorio_semsop AS ENUM ('GCMM','COP') ");

        //usado na SOLICITACOES
        DB::statement(" CREATE TYPE tp_status_solicitacao AS ENUM ('Aberta','Em análise','Em execução','Solucionada','Recusada','Encaminhada') ");

        DB::statement(" CREATE TYPE tp_prioridade_solicitacao AS ENUM ('Baixa','Normal','Alta','Urgente') ");


        //usado na SOLICITANTES
        DB::statement(" CREATE TYPE tp_sexo AS ENUM ('Feminino','Masculino','Outros') ");
        DB::statement(" CREATE TYPE tp_status_solicitante AS ENUM ('Criado','Ativo','Inativo') ");
        DB::statement(" CREATE TYPE tp_estado_civil AS ENUM ('Solteiro(a)','Casado(a)','Divorciado(a)','Viúvo(a)','Separado(a)','União estável') ");
        DB::statement(" CREATE TYPE tp_escolaridade AS ENUM ('Fundamental - Incompleto','Fundamental - Completo','Médio - Incompleto','Médio - Completo','Superior - Incompleto','Superior - Completo','Pós-graduação - Incompleto','Pós-graduação - Completo','Mestrado - Incompleto','Mestrado - Completo','Doutorado - Incompleto','Doutorado - Completo') ");

        //usado na TELEFONES
        DB::statement(" CREATE TYPE tp_telefone AS ENUM ('Fixo','Celular') "); */

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
/*         DB::statement(" DROP TYPE tp_status ");
        DB::statement(" DROP TYPE tp_tipo_cargos "); 
        DB::statement(" DROP TYPE tp_uf "); 
        DB::statement(" DROP TYPE tp_tipo_funcionario "); 
        DB::statement(" DROP TYPE tp_andamento "); 
        DB::statement(" DROP TYPE tp_origem "); 
        DB::statement(" DROP TYPE tp_acao_gcmm "); 
        DB::statement(" DROP TYPE tp_acao_cop "); 
        DB::statement(" DROP TYPE tp_relatorio_semsop "); 
        DB::statement(" DROP TYPE tp_status_solicitacao "); 
        DB::statement(" DROP TYPE tp_prioridade_solicitacao "); 
        DB::statement(" DROP TYPE tp_sexo "); 
        DB::statement(" DROP TYPE tp_status_solicitante "); 
        DB::statement(" DROP TYPE tp_estado_civil "); 
        DB::statement(" DROP TYPE tp_escolaridade "); 
        DB::statement(" DROP TYPE tp_telefone ");  */
    }
}
