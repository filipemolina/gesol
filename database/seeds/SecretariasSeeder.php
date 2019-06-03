<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class SecretariasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
/*       factory(App\Models\Secretaria::class, 3)
           ->create()
           ->each(function ($secretaria) {

            // Endereço
                $secretaria->endereco()->save(factory(App\Models\Endereco::class)->make());
            // Telefones
                $secretaria->telefones()->saveMany(factory(App\Models\Telefone::class, rand(1,5))->make());                             
            });*/

          //$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Gabinete Prefeito','secretario' => 'Jorge Lúcio Ferreira Miranda','sigla' => 'GABPRE']); 
          ////====================================================================================================================================================================
          //$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Gabinete Vice-Prefeito' ,'secretario' => 'Walter de Almeida Paixão' ,'sigla' => 'GABVICE']); 
          ////====================================================================================================================================================================
			$secretariaID =  DB::table('secretarias')->insertGetId(['nome'=>'Controladoria Geral do Município'  ,'secretario' => 'Nicola Fabiano Palmier' ,'sigla' => 'CGM']);

			DB::table('cargos')->insert(['nome' => 'Assessor Técnico da Controladoria','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Auditor De Controle Interno','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Apoio Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Controlador Geral do Município','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Auditoria','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Controle de Adiantamento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Controle de Sigfis','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Controle de Subvenção','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Controle Interno','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subcontrolador Geral do Município','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assessor do Prefeito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assessor do Vice-Prefeito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assessor Especial do Vice-Prefeito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe de Expediente do Gabinete do Vice-Prefeito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe de Gabinete do Prefeito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe de Patrimônio','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Publicações','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Apoio Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Cerimonial','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Imprensa','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Cerimonial','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Prefeito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Secretário Executivo do Gabinete do prefeito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Vice Prefeito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);

			


			//====================================================================================================================================================================
			//$secretariaID = DB::table('secretarias')->inertGetId(['nome'=>'Instituto de Previdência - Mesquitaprev' ,'secretario'=> 'Murilo Sanches Rodrigues' ,'sigla' => 'PREV']); 
			
			//====================================================================================================================================================================
			
			$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Procuradoria Geral do Município' ,'secretario' => 'Gilmar Brunizi' ,'sigla' => 'PGM']); 
			DB::table('cargos')->insert(['nome' => 'Chefe de Acomp. de Processos e Atos Oficiais','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor da Dívida Ativa','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Expediente','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Serviços Jurídicos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Tramitação de Processos e Documentos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Apoio Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Controle de Contratos e Convênios','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Dívida Ativa','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Divida Ativa','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Tramitação Processual e Documentação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Setor de Coordenação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Procurador Assessor','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Procurador Chefe','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Procurador Do Município','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Procurador Geral','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Procurador Geral Adjunto','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);

			//====================================================================================================================================================================
			
			$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Assistência Social','secretario' => 'Luiza Cristina Quaresma de Oliveira ','sigla' => 'SEMAS']);
			$setorID = DB::table('setores')->insertGetId(['nome' => 'Pessoas em Situação de Risco'  ,'secretaria_id' => $secretariaID    , 'icone' =>  'mdi-account-multiple', 'cor' => '#CD853F'  ]);
			DB::table('servicos')->insert(['nome' => 'Acolhimento De Pessoas Em Situação De Risco'  ,'setor_id' => $setorID ,'prazo' =>10  ]);
			
			DB::table('cargos')->insert(['nome' => 'Advogado','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assistente Social','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assistente Técnico de Polo Social','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assistente Técnico do Programa Padaria Escola','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Patrimônio','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador da CMPM','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador da CORDEF','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Assuntos Religiosos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Diversidade Sexual','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Políticas de Direitos Humanos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador Municipal da Juventude','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador Municipal de Programa da Igualdade Racial e Direitos Humanos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Apoio Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Oficinas de Inclusão Produtiva','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Projetos e Programas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do CREAS','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Apoio Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Desenvolvimento Social e Combate à Fome','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Programas de Transferência de Rendas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Proteção Social Básica','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Proteção Social Especial','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento Técnico','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Casa da Mulher','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Casa Abrigo p/ Adultos e Idosos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Casa Abrigo para Crianças','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Gestão do Trabalho','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Apoio Administrativo da COMJU','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Apoio Operacional de Programas Sociais','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Articulação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Centro POP','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => '"Gerente de CRAS Referência da Assistência Social)"','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Políticas de Proteção Social','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Polo Social','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Programa Economia Solidária','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Programas de Inclusão Produtiva','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Programas de Qualificação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Programas de Segurança Alimentar e Banco de Alimentos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Programas para Crianças e Adolescentes','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Programas para Pessoa Idosa','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Secretaria do CAMM','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Sistemas de informação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Suporte Operacional','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente dos Conselhos Municipais','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente Financeiro','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente Operacional de Centros de Referência','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => '"Secretário Municipal de Assistência Social"','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subcoordenador da CORDEF','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => '"Subsecretário Municipal Adjunto de Assistência Social"','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => '"Subsecretário Municipal de Assistência Social"','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);

			
			//====================================================================================================================================================================

			$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Educação' ,'secretario' => 'Thaís dos Santos de Lima'  ,'sigla' => 'SEMED']);
			DB::table('cargos')->insert(['nome' => 'Assessor Contábil dos Fundeb','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assessor do Secretário','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Auxiliar Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Auxiliar de Creche','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Auxiliar de Secretaria','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe de Prestação de Contas do Almoxarifado','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Alimentação Escolar','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Adjunto da Escola Municipal Deoclécio Dias Machado Filho','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Adjunto da Escola Municipal Ernesto Che Guevara','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Adjunto da Escola Municipal Expedito Miguel','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Adjunto da Escola Municipal Genair Ramos Gabriel','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Adjunto da Escola Municipal Governador Roberto Silveira','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Adjunto da Escola Municipal Machado de Assis','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Adjunto da Escola Municipal Presidente Castelo Branco','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Adjunto da Escola Municipal Professor Marcos Gil','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Adjunto da Escola Municipal Rotariano Arthur Silva','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Adjunto da Escola Municipal Vereador Américo dos Santos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Adjunto do CIEP431 Municipal Padre Nino Miraldi','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Adjunto do Colégio Estadual Municipalizado Professor Quirino','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor da Divisão de Formação Continuada','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor da Divisão de Matrícula Escolar','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Arquitetura Educacional','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Captação de Recursos e Programas Federais','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Educação Especial','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Educação Infantil','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Ensino Fundamental - Anos Iniciais','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Patrimônio e Almoxarifado','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Planejamento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Centro Cultural','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Administração','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Supervisão Educacional','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento Educação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Creche Municipal Cora Coralina','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Creche Municipal Herbert José de Souza','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Creche Municipal Tetracampeã','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Estadual Municipalizada Santos Dumont','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Cruzeiro do Sul','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal de Educação Infantil Cássia Valéria Marques Furtado','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal de Educação Infantil Cecilia Meireles','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal de Educação Infantil Maria Clara Machado','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal de Educação Infantil Pedrinho','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal de Educação Infantil Professora Maria Candida Poubel','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal de Educação Infantil Tarsila do Amaral','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal de Educação Infantil Tiago Prado Santos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Deoclécio Dias Machado Filho','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Doutor Ely Baiense Vailante','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Doutor Manoel Reis','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Ernesto Che Guevara','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Expedito Miguel','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Genair Ramos Gabriel','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Governador Roberto Silveira','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Hélio Mendes do Amaral','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Irena Sendler','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Lourdes Ferreira Campos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Machado de Assis','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Maria Dolores de Mello Porto','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Ondina Couto','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Presidente Castelo Branco','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Professor Marcos Gil','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Professor Samuel de Souza Maciel','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Rotariano Arthur Silva','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Rubem Alves','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Vereador Américo dos Santos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipal Vinícius de Moraes','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Escola Municipalizada Professor Marcio Caulino Soares','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral do Centro Municipal de Educação Infantil Carmem Montes Paixão','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral do Centro Municipal de Educação Infantil Curumin de Jacutinga','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral do Centro Municipal de Educação Infantil Margarida da Silva Duarte','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral do Centro Municipal de Educação Infantil Paulo Freire','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral do Centro Municipal de Educação Infantil Professora Marlene Peres Costa','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral do Centro Municipal de Educação Infantil Vereador Nilo Dias','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral do CIEP431 Municipal Padre Nino Miraldi','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral do Colégio Estadual Municipalizado Professor Quirino','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Dirigente de Turno','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Conselhos da Educação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Orientação Educacional','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Orientação Pedagógica','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Patrimônio','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Recursos Humanos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Almoxarifado','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Departamento Financeiro','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Inspetor de Alunos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Merendeira','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Orientador Educacional','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Orientador Pedagógico','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Pedagogo Social','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Prof Ed Artist - Artes Cenicas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Prof. de Ciencias','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Prof. Ed. Art.-Artes Plasticas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'PROF. ED. ARTISTICA','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Prof. Ed. Artistica - Danca','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Prof. Educ. Artistica - Musica','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Prof. Espanhol','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Prof. Geografia','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Prof. Historia','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Prof. Ii - Anos Iniciais','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Prof. Ingles','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Prof. Lingua Portuguesa','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Professor De Educacao Especial','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Professor De Educacao Fisica','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Professor De Educacao Infantil','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Professor De Matematica','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Psicólogo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Secretário Escolar','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Secretário Municipal de Educação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal de Educação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Supervisor Educacional','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);

			//====================================================================================================================================================================
			$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Esporte, Cultura, Lazer e Turismo' ,'secretario' => 'Luis Kleber Rodrigues Farias'  ,'sigla' => 'SEMCELT']);
			DB::table('cargos')->insert(['nome' => 'Diretor de Esporte','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão Artes','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Bibliotecas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Cinema, Teatro e Equipamentos Culturais','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Esporte na Escola','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Memória','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Tradições','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Turismo Religioso','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Controle Administrativo e Gestão de Projetos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Esportes','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Projetos de Esporte e Lazer','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Secretário Municipal de Cultura, Esporte, Lazer e Turismo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal de Cultura, Esporte, Lazer e Turismo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);

			//====================================================================================================================================================================

			//$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Fazenda' ,'secretario' => 'Eduardo José Costa de Oliveira'  ,'sigla' => 'SEMEF']);

			//====================================================================================================================================================================
			$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Meio Ambiente e Urbanismo','secretario' => 'Luney Martins de Almeida','sigla' => 'SEMMURB']);
			
			$setorID = DB::table('setores')->insertGetId(['nome' => 'Fiscalização Ambiental'        ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-nature-people', 'cor' => '#228B22']);
			DB::table('servicos')->insert(['nome' => 'Fiscalização Urbanismo'                       ,'setor_id' => $setorID ,'prazo' =>10  ]);
			DB::table('servicos')->insert(['nome' => 'Fiscalização Ambiental/poluição Sonora'       ,'setor_id' => $setorID ,'prazo' =>10  ]);
			
			$setorID = DB::table('setores')->insertGetId(['nome' => 'Poda de Árvore'                ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-tree', 'cor' => '#7CFC00'  ]);
			DB::table('servicos')->insert(['nome' => 'Poda De Árvore'                               ,'setor_id' => $setorID ,'prazo' =>10  ]);

			$setorID = DB::table('setores')->insertGetId(['nome' => 'Coleta Seletiva'               ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-recycle', 'cor' => '#32CD32'  ]);
			DB::table('servicos')->insert(['nome' => 'Coleta Seletiva'                               ,'setor_id' => $setorID ,'prazo' =>10  ]);

			DB::table('cargos')->insert(['nome' => 'Agente Ambiental','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Agrônomo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Analista Ambiental','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Arquiteto','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assessor Técnico de Licenciamento e Controle Ambiental','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Biólogo Ambiental','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Edificações','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Educação para Gestão de Resíduos recicláveis','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Licenciamento e Controle Ambiental','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Engenheiro Florestal','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Fiscal Ambiental','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Coleta Seletiva','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Informações','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Projeto Técnico Social','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Análise Orçamentária','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Educação Ambiental','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Fiscalização de Edificações','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Projetos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Projetos de Urbanismo e Arquitetura','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Departamento Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Secretário Municipal de Meio Ambiente e Urbanismo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal de Meio Ambiente e Urbanismo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Técnico Ambiental','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);


			//====================================================================================================================================================================
			
			$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Obras, Serviços Públicos e Defesa Civil','secretario' => 'César Marian','sigla' => 'SEMOSPDEC' ]); //11

			$setorID = DB::table('setores')->insertGetId(['nome' => 'Iluminação Pública'            ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-ceiling-light', 'cor' => '#6495ED' ]);
			DB::table('servicos')->insert(['nome' => 'Troca de Lâmpadas (Iluminação Pública)'      ,'setor_id'  =>  $setorID ,'prazo' =>10 ]);
			DB::table('servicos')->insert(['nome' => 'Novo ponto de Iluminação Pública'            ,'setor_id'  =>  $setorID ,'prazo' =>10 ]);
			DB::table('servicos')->insert(['nome' => 'Manutenção do Ponto de Iluminação Pública'   ,'setor_id'  =>  $setorID ,'prazo' =>10 ]);

			$setorID = DB::table('setores')->insertGetId(['nome' => 'Asfaltamento'                  ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-road-variant', 'cor' => '#0000CD'  ]);
			DB::table('servicos')->insert(['nome' => 'Buracos Na Rua (pavimentação)'                ,'setor_id' => $setorID ,'prazo' =>10 ]);

			$setorID = DB::table('setores')->insertGetId(['nome' => 'Esgoto'                        ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-pipe-disconnected', 'cor' => '#6495ED'  ]);
			DB::table('servicos')->insert(['nome' => 'Manutenção De Esgoto'                         ,'setor_id' => $setorID ,'prazo' =>10 ]);
			DB::table('servicos')->insert(['nome' => 'Manutenção De Bueiros'                        ,'setor_id' => $setorID ,'prazo' =>10 ]);

			$setorID = DB::table('setores')->insertGetId(['nome' => 'Limpeza Urbana'                ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-delete', 'cor' => '#696969'  ]);
			DB::table('servicos')->insert(['nome' => 'Retirada De Entulhos'                         ,'setor_id' => $setorID ,'prazo' =>10 ]);
			DB::table('servicos')->insert(['nome' => 'Coleta De Lixo'                               ,'setor_id' => $setorID ,'prazo' =>10 ]);
			DB::table('servicos')->insert(['nome' => 'Limpeza Urbana'                               ,'setor_id' => $setorID ,'prazo' =>10 ]);

			$setorID = DB::table('setores')->insertGetId(['nome' => 'Patrimônio Público'            ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-city', 'cor' => '#8A2BE2'  ]);
			DB::table('servicos')->insert(['nome' => 'Conservação'                                  ,'setor_id' => $setorID ,'prazo' =>10 ]);

			DB::table('cargos')->insert(['nome' => 'Agente De Proteção E Defesa Civil','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe de Planejamento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Acompanhamento de Projetos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Ensino e Instrução','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Fiscalização de Obras','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Minimização de Desastre','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Obras','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Apoio Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Operacional da Defesa Civil','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Engenheiro Civil','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Fiscal De Obras','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da APA Mesquita','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Apoio Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Arboricultura','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Conservação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Iluminação Pública','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Prestação de Contas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Serviços Públicos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Secretário Municipal de Obras, Serviços Públicos e Defesa Civil','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subsecretário Adjunto de Obras, Serviços Públicos e Defesa Civil','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subsecretário de Defesa Civil','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal de Obras, Serviços Públicos e Defesa Civil','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Técnico De Edificações','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);


			//====================================================================================================================================================================
			
			$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Saúde','secretario' => 'Emerson Trindade da Costa','sigla' => 'SEMUS'     ]); //12
			$setorID = DB::table('setores')->insertGetId(['nome' => 'Vigilância Sanitária'            ,'secretaria_id' =>    $secretariaID, 'icone' =>  'mdi-food-fork-drink', 'cor' => '#1E90FF'  ]);
			DB::table('servicos')->insert(['nome' => 'Fiscalização Vigilância Sanitária'            ,'setor_id' => $setorID ,'prazo' =>10 ]);
			DB::table('servicos')->insert(['nome' => 'Fiscalização Epidemiológica'                  ,'setor_id' => $setorID ,'prazo' =>10  ]);

			DB::table('cargos')->insert(['nome' => 'Agente Comunitário De Saúde','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assessor do Gabinete do Secretário','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assessor Técnico','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Biólogo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Área Técnica de Fisioterapia','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Seção Unidade Básica de Saúde Alto Uruguai','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Seção Unidade Básica de Saúde Banco de Areia','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Seção Unidade Básica de Saúde BNH','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Seção Unidade Básica de Saúde Chatuba','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Seção Unidade Básica de Saúde Coréia','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Seção Unidade Básica de Saúde Cosmorama','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Seção Unidade Básica de Saúde Edson Passos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Seção Unidade Básica de Saúde Juscelino','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Seção Unidade Básica de Saúde Parque Ludolf','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Seção Unidade Básica de Saúde Santa Terezinha','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Seção Unidade Básica de Saúde Santo Elias','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Seção Unidade Básica de Saúde Vila Norma','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe de Análise Clínicas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe de Serviço Alimentação e Nutrição','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe de Serviço Diabetes Hipertensão','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Programa de Saúde Mental','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Serviço de PAIMSCA','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Serviço de Verificação de Óbito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Apoio Institucional','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Assistência Farmacêutica','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Fiscalização das Unidades Básicas de Saúde','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Gestão do Trabalho','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Imunização','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Recursos Humanos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Vigilância e Prevenção de Violência e Acidentes','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador do Programa de Assistência Domiciliar','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Administrativo da Unidade Mário Bento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor da Divisão de Regulação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Almoxarifado','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Patrimônio','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Vigilância Ambiental, Sanitária e Controle de Zoonozes','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Vigilância Epidemiológica e Serviço DST/AIDS','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Fundo Municipal de Saúde','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Geral da Unidade Mário Bento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Enfermeiro','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Farmaceutico','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Fiscal De Inspeção Sanitária','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Fisioterapeuta','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Controle e Contas Médicas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Finanças','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Saúde Bucal','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Almoxarifado','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Departamento de Recursos Humanos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Serviço de Vigilância Sanitária','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Médico','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Médico Sanitarista','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Nutricionista','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Odontólogo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Sanitarista','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Secretário Municipal de Saúde','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal Adjunto de Saúde','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal de Saúde','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Técnico De Enfermagem','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Técnico De Higiene Dental','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Técnico De Laboratório','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Técnico Em Radiologia','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Terapeuta Ocupacional','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);



			//====================================================================================================================================================================

			$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Segurança, Ordem Pública e Cidadania','secretario' => 'Sérgio Luis Mendes Afonso','sigla' => 'SEMSOP'    ]); //13
			$setorID = DB::table('setores')->insertGetId(['nome' => 'Guarda Municipal'              ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-security', 'cor' => '#4169E1'  ]);
			DB::table('servicos')->insert(['nome' => 'Fiscalização Ordem Pública'                   ,'setor_id' => $setorID ,'prazo' =>10 ]);
			DB::table('servicos')->insert(['nome' => 'Policiamento'                                 ,'setor_id' => $setorID ,'prazo' =>10 ]);

			DB::table('cargos')->insert(['nome' => 'Assessor de Correção','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assessor Especial','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Controle e Ocupação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Comandante Geral da Guarda Civil','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Ensino e Instrução','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Meio Ambiente','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Ordem Pública','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Patrulha Escolar','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador Distrital','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Inteligência','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Logística','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Operações','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Pessoal','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Fiscal De Posturas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Fiscalização de Feiras Livres','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Guarda Municipal','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Secretário Municipal de Segurança, Ordem Pública e Cidadania','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subcomandante Geral da Guarda Civil','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);

			DB::table('cargos')->insert(['nome' => 'Subsecretário Adjunto de Segurança','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal Administrativo de  Segurança','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal Operacional de  Segurança','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);


			//====================================================================================================================================================================          
			$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Trabalho, Desenvolvimento Econômico e Agricultura' ,'secretario' => 'Janyr Fernandes de Menezes' ,'sigla' => 'SETRADE'   ]); 

			DB::table('cargos')->insert(['nome' => 'Chefe de Gabinete do Secretário','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Agricultura','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do setor de Expediente','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Desenvolvimento Econômico','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Trabalho','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Agricultura','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de CTPS','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Desenvolvimento Econômico','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Secretário Municipal de Trabalho, Desenvolvimento Econômico e Agricultura','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal de Trabalho, Desenvolvimento Econômico e Agricultura','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);

			
			//====================================================================================================================================================================            
			$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Transporte e Trânsito' ,'secretario' => 'Fernando Gonzalez dos Santos' ,'sigla' => 'SETRANS'   ]); //15
			$setorID = DB::table('setores')->insertGetId(['nome' => 'Trânsito'                      ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-car', 'cor' => '#00CED1'  ]);
			DB::table('servicos')->insert(['nome'=>'Denúncia De Trânsito'                           ,'setor_id' => $setorID  ,'prazo' =>10  ]);
			DB::table('servicos')->insert(['nome'=>'SoLicitação De Redutor De Velocidade'           ,'setor_id' => $setorID  ,'prazo' =>10  ]);
			DB::table('servicos')->insert(['nome'=>'SoLicitação De Agente De Trânsito'              ,'setor_id' => $setorID  ,'prazo' =>10  ]);
			DB::table('servicos')->insert(['nome'=>'SoLitação De Reboque'                           ,'setor_id' => $setorID  ,'prazo' =>10  ]);
			DB::table('servicos')->insert(['nome'=>'Estacionamento Irregular'                       ,'setor_id' => $setorID  ,'prazo' =>10  ]);

			$setorID = DB::table('setores')->insertGetId(['nome' => 'Semáforo'                      ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-traffic-light', 'cor' => '#FFA500'  ]);
			DB::table('servicos')->insert(['nome'=>'Manutenção De Semáforo'                         ,'setor_id' => $setorID  ,'prazo' =>10  ]);

			$setorID = DB::table('setores')->insertGetId(['nome' => 'Transporte Público'            ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-bus-side', 'cor' => '#FF00FF'  ]);
			DB::table('servicos')->insert(['nome'=>'Denúncia Transporte Público Municipal'          ,'setor_id' => $setorID ,'prazo' =>10   ]);


			DB::table('cargos')->insert(['nome' => 'Agente De Trânsito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assessor do Secretário','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Educação para o Trânsito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Trânsito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Transporte','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Transporte','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Apoio Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Estudos e Projetos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Recursos Humanos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Setor de Fiscalização de Trânsito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Motorista','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Secretário Municipal Adjunto de Transporte e Trânsito ','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Secretário Municipal de Transporte e Trânsito ','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subcoordenador de Trânsito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subcoordenador de Trânsito','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal de Transporte e Trânsito ','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);


			//====================================================================================================================================================================            
			$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Secretaria Municipal de Governo, Administração, Planejamento e Fazenda','secretario' => 'Sergio Renato Ferreira Miranda','sigla' => 'SEMGAP'    ]); //16
			
			DB::table('cargos')->insert(['nome' => 'Agente Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Agente Fiscal','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			
			DB::table('cargos')->insert(['nome' => 'Arquivista','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assessor do Diretor de Orçamento e Finanças','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assessor do Diretor do Departamento de Pagamento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assessor do Secretário','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Assessor do Secretário','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Bibliotecário','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe da Central de Atendimento ao Contribuinte','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Alvará','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Arquivo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de IPTU','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de ISS','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de ITBI','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Logística','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Protocolo e Controle','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Serviços','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Chefe do Setor de Taxas Diversas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Comunicador Social','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Contador','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Compras','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Coordenador de Frota de Veículos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor da Central de Atendimento ao Contribuinte','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Análise de Processos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Análise Documental','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Cadastro Imobiliário','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Controle de Licitação e Pregão','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Planejamento de Compras','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Planejamento em Compras','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor de Zeladoria e Manutenção','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Arquivo Público Municipal','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Arrecadação e Receita','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Compras, Serviços e Logística','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Contabilidade','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Controle de Frota','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Material e Patrimônio','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Orçamento e Finanças','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Pagamento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Planejamento e Análise Econômica','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Recursos Humanos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor do Departamento de Tesouraria','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Diretor Presidente do PROCON','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Fiscal De Tributos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente Administrativo','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Contabilidade','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Inscrições Cadastrais','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Pagamentos','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Patrimônio','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Divisão de Planejamento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente da Zeladoria da Dinâmica','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Acompanhamento Funcional e Estágio Probatório','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Atendimento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Comunicação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Controle de Contas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Controle de Licitações','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Controle de Pregão','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Controle e Movimentação Processual','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Divisão de Almoxarifado','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Divisão de Pessoal','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Divisão de Rendas Imobiliárias','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Divisão de Rendas Mobiliárias','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Fiscalização de Cadastro Técnico','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Infraestrutura de Redes','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Infraestrutura de Redes','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Patrimônio','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Perícia Médica','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Planejamento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Protocolo Geral','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Serviços','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Treinamento e Desenvolvimento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Departamento de Arrecadação e Receita','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Setor de Carga Patrimonial','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Setor de Controle de Bens Imóveis','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Setor de Expediente - Perícia Médica/RH','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Setor de Folha de Pagamento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Setor de Registros Funcionais','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
          
         DB::table('cargos')->insert(['nome' => 'Ouvidor Geral do Município','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
         DB::table('cargos')->insert(['nome' => 'Presidente da CPL','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
         DB::table('cargos')->insert(['nome' => 'Secretário da Junta de Alistamento Militar (JSM)','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
         DB::table('cargos')->insert(['nome' => 'Secretário Municipal Adjunto de Planejamento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
         DB::table('cargos')->insert(['nome' => 'Secretário Municipal de Fazenda','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
         DB::table('cargos')->insert(['nome' => 'Secretário Municipal de Governo, Administração, Planejamento e Fazenda','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
         DB::table('cargos')->insert(['nome' => 'Subcoordenador de Diversidade Sexual','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal de Fazenda','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Técnico De Contabilidade','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
         DB::table('cargos')->insert(['nome' => 'Técnico Tributarista','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);

          //====================================================================================================================================================================  

         $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Subsecretaria Municipal de Administração','secretario' => 'Alexandre Alves Ferraz' ,'sigla' => 'SEMGAP'    ]); //17
			DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal de Administração','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			//====================================================================================================================================================================  

			$secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Subsecretaria Municipal  Adjunto de Planejamento' ,'secretario' => 'Bruno Bondarovsk'  ,'sigla' => 'SEMGAP'    ]); //18
			DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal de Planejamento','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);

          //====================================================================================================================================================================  

          $secretariaID = DB::table('secretarias')->insertGetId(['nome'=>'Subsecretaria de Defesa Cívil' ,'secretario' => 'Ronaldo Vilazio','sigla' => 'DEFCIV'    ]); //19
          $setorID = DB::table('setores')->insertGetId(['nome' => 'Fiscalização'                  ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-magnify', 'cor' => '#A9A9A9'  ]);
            DB::table('servicos')->insert(['nome' => 'Fiscalização Defesa Civil'                    ,'setor_id' => $setorID ,'prazo' =>10  ]);
            DB::table('servicos')->insert(['nome' => 'Vistoria De Estrutura'                        ,'setor_id' => $setorID ,'prazo' =>10  ]);

          $setorID = DB::table('setores')->insertGetId(['nome' => 'Captura de Abelhas'            ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-bug', 'cor' => '#FFD700'  ]);
            DB::table('servicos')->insert(['nome' => 'Captura De Abelha'                            ,'setor_id' => $setorID ,'prazo' =>10  ]);


          //====================================================================================================================================================================  

			$secretariaID =  DB::table('secretarias')->insertGetId(['nome'=>'Subsecretaria Municipal de Tecnologia da Informação' ,'secretario' => 'Ronald Henrique Ferreira de Almeida'  ,'sigla' => 'STI']); //20
			$setorID = DB::table('setores')->insertGetId(['nome' => 'Desenvolvimento'               ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-puzzle', 'cor' => '#000000'  ]);
			$cargoID = DB::table('cargos')->insertGetId(['nome' => 'Técnico Em Informática','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Analista De Sistemas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Administração de Banco de Dados','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Desenvolvimento de Sistemas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Redes','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Segurança da Informação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Suporte à Sistemas','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Suporte de Intranet','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente de Suporte em TI','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			DB::table('cargos')->insert(['nome' => 'Gerente do Setor de TI - Dinâmica','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);
			 
         DB::table('cargos')->insert(['nome' => 'Subsecretário Municipal de Tecnologia da Informação','secretaria_id' => $secretariaID ,'tipo' =>'E' ]);

         $funcionario = DB::table('funcionarios')->insertGetId([  'nome'      => 'Administrador',
                                              'setor_id' 	=> $setorID,
															 'cargo_id' 	=> $cargoID,
															 'cpf'			=> '123.456.789-09',
															 'matricula'	=> '1',
															 'role_id'  	=> 10,
															 'tipo'   		=> 'Sistema',
         ]);
          
			$user = new User;
			$user->email        = 'gesol@mesquita.rj.gov.br';
			$user->password     =  '$2y$10$IV5BxV2wXnW7yswbZPnbd.QJTqUYL2Zkwq972PQXCxOlXfIdIbGUC';
			$user->status       = 'Ativo';
			// Associar user ao funcionario
			$user->funcionario()->associate($funcionario);
			$user->save();


			$setorID = DB::table('setores')->insertGetId(['nome' => 'Servidores'                    ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-server', 'cor' => '#000000'  ]);
			$setorID = DB::table('setores')->insertGetId(['nome' => 'Rede'                          ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-close-network', 'cor' => '#000000'  ]);
			$setorID = DB::table('setores')->insertGetId(['nome' => 'Manutenção'                    ,'secretaria_id' => $secretariaID, 'icone' =>  'mdi-mouse-variant', 'cor' => '#000000'  ]);

			





	}
}

