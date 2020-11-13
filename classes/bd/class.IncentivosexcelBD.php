<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Incentivosexcel.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.IncentivosexcelMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.IncentivosexcelBDBase.php');

class IncentivosexcelBD extends IncentivosexcelBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function inserirLinha($vetor){
        $cnpj = Util::limpaCampo($vetor[2]);
        $capital_fixo = Util::formataMoeda($vetor[18]);
        $capital_giro = Util::formataMoeda($vetor[19]);
        $recursos_proprios = Util::formataMoeda($vetor[25]);
        $sudam_irpj = Util::formataMoeda($vetor[26]);
        $acionistas = Util::formataMoeda($vetor[27]);
        $total = Util::formataMoeda($vetor[28]);
        $empresa = addslashes($vetor[1]);
        $municipio = addslashes($vetor[4]);
        $objetivo = addslashes($vetor[10]);
        $procurador = addslashes($vetor[15]);
        $unidade = addslashes($vetor[12]);

        $cap_instalada = $vetor[11];
        if(is_numeric($cap_instalada)){
            $cap_instalada = number_format($cap_instalada, 0, ',', '.');
        }
        $enq = addslashes($vetor[20]);
        $data_laudo = ($vetor[16]);
        $declaracao_data = ($vetor[21]);
        $resolucao_data = ($vetor[23]);

        $sql = "
				insert into incentivosexcel(idIncentivo,
				sudam_numero,empresa,cnpj,situacao,municipio,uf,setor,mob_di,mob_in,
				mob_real,objetivo,cap_instalada,unidade,incentivo,modalidade,procurador,data_laudo,numero_laudo,
				capital_fixo,capital_giro,enq,declaracao_data,declaracao_numero,resolucao_data,resolucao_numero,
				recursos_proprios,sudam_irpj,acionistas,total				
				)
				values(NULL,
				'$vetor[0]',
				'$empresa',
				'$cnpj', 
				'$vetor[3]',
				'$municipio',
				'$vetor[5]',
				'$vetor[6]',
				'$vetor[7]',
				'$vetor[8]',
				'$vetor[9]',
				'$objetivo',
				'$cap_instalada',
				'$unidade',
				'$vetor[13]',
				'$vetor[14]',
				'$procurador',
				'$data_laudo', 
				'$vetor[17]',
				'$capital_fixo',
				'$capital_giro',
				'$enq',
				'$declaracao_data', 
				'$vetor[22]',
				'$resolucao_data', 
				'$vetor[24]',
				'$recursos_proprios',
				'$sudam_irpj',
				'$acionistas',
				'$total'
				)";
//Util::trace($vetor,false);
        try{
            $this->oConexao->executePrepare($sql);
            if($this->oConexao->msg != ""){
                $this->msg = $this->oConexao->msg;
                Util::trace($sql,false);
                return false;
            }
            return $this->oConexao->lastID();
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }



    function truncateExcel(){

        $sql = "truncate table incentivosexcel";
        try{
            $this->oConexao->executePrepare($sql);
            if($this->oConexao->msg != ""){
                $this->msg = $this->oConexao->msg;
                //Util::trace($sql,false);
                return false;
            }
            return $this->oConexao->lastID();
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }


}