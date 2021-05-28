<?php

require_once("DB". DIRECTORY_SEPARATOR ."Sql.php");
require_once("DesenhaForm.php");


class Cep{

    function cunsultaCep($cep){
       
        try{
            $cep = preg_replace("/[^0-9]/", "", $cep);
            $sql = new Sql();
            $results = $sql->select("SELECT * FROM endereco WHERE cep = :cep", array(
                "cep" => preg_replace("/[^0-9]/", "", $cep)
            ));

            if(count($results)===0){

                $this->validaXML($cep);            
                
            }else{
                $ceptratado = substr($results[0]['cep'], 0, 5) . "-" . substr($results[0]['cep'], 5, 3);
                
                $desenhaForm = new DesenhaForm();
                $desenhaForm->cabecalho();
                $desenhaForm->desenhaLinhaGrupo('rua/av','Rua / Avenida',$results[0]['logradouro']);
                $desenhaForm->cabecalhoMaisItens();
                $desenhaForm->desenhaLinhaItem('cep', 'Cep', $ceptratado, 4);
                $desenhaForm->desenhaLinhaItem('bairro', 'Bairro', $results[0]['bairro'], 8);
                $desenhaForm->fechaDiv();
                $desenhaForm->cabecalhoMaisItens();
                $desenhaForm->desenhaLinhaItem('cidade', 'Cidade', $results[0]['cidade'], 4);
                $desenhaForm->desenhaLinhaItem('uf', 'Estado', $results[0]['Estado'], 4);
                $desenhaForm->desenhaLinhaItem('ddd', 'DDD', $results[0]['ddd'], 4);
                $desenhaForm->fechaDiv();
                $desenhaForm->rodape();
            }
        }catch(Exception $e){
            if($e->getCode()==1049){
                echo "Não foi possivel acessar o Banco de dados, entre em com o administrador!";
            }else if($e->getCode()==1045){
                echo "Acesso ao Banco de dados negado!";
            }else if($e->getCode()==2054){
                echo "Acesso ao Banco de dados negado!";
            }else{
                echo "Erro desconhecido, contate o administrador do sistema";
            }
        }
        
    }    
    

    function validaXML($cepp){

        try{
            $cepp = !preg_match('/^[0-9]{8,8}?$/', $cepp)? "00000000" : $cepp;
            $cepp = preg_replace("/[^0-9]/", "", $cepp);        
            $url = "http://viacep.com.br/ws/$cepp/xml/";

            $xml = simplexml_load_file($url);        
            if($xml->erro == "true"){               
            
                $desenhaForm = new DesenhaForm();
                $desenhaForm->cabecalho();
                $desenhaForm->desenhaLinhaGrupo('rua/av','Rua / Avenida',$xml->logradouro);
                $desenhaForm->cabecalhoMaisItens();
                $desenhaForm->desenhaLinhaItem('cep', 'Cep', $xml->cep, 4);
                $desenhaForm->desenhaLinhaItem('bairro', 'Bairro', $xml->bairro, 8);
                $desenhaForm->fechaDiv(); 
                $desenhaForm->cabecalhoMaisItens();
                $desenhaForm->desenhaLinhaItem('cidade', 'Cidade', $xml->localidade, 4);
                $desenhaForm->desenhaLinhaItem('uf', 'Estado', $xml->uf, 4);
                $desenhaForm->desenhaLinhaItem('ddd', 'DDD', $xml->ddd, 4);
                $desenhaForm->fechaDiv();
                $desenhaForm->rodape();

                throw new Exception('Não foi possivel relizar a busca verifique se o CEP existe!', 400);

            } else if($xml->cep == 0){                
            
                $desenhaForm = new DesenhaForm();
                $desenhaForm->cabecalho();
                $desenhaForm->desenhaLinhaGrupo('rua/av','Rua / Avenida',$xml->logradouro);
                $desenhaForm->cabecalhoMaisItens();
                $desenhaForm->desenhaLinhaItem('cep', 'Cep', $xml->cep, 4);
                $desenhaForm->desenhaLinhaItem('bairro', 'Bairro', $xml->bairro, 8);
                $desenhaForm->fechaDiv();
                $desenhaForm->cabecalhoMaisItens();
                $desenhaForm->desenhaLinhaItem('cidade', 'Cidade', $xml->localidade, 4);
                $desenhaForm->desenhaLinhaItem('uf', 'Estado', $xml->uf, 4);
                $desenhaForm->desenhaLinhaItem('ddd', 'DDD', $xml->ddd, 4);
                $desenhaForm->fechaDiv();
                $desenhaForm->rodape();

                throw new Exception('Não foi possivel relizar a busca verifique se o CEP existe!', 401);

            } else {
                $sql = new Sql();
                $res = $sql->query("INSERT INTO endereco(logradouro, cep, bairro, cidade, Estado, ddd) VALUES(:ENDERECO, :CEP, :BAIRRO, :CIDADE, :ESTADO, :DDD)", array(
                    ":ENDERECO" => $xml->logradouro,
                    ":CEP" => preg_replace("/[^0-9]/", "", $xml->cep),
                    ":BAIRRO" => $xml->bairro,
                    ":CIDADE" => $xml->localidade,
                    ":ESTADO" => $xml->uf,
                    ":DDD" => $xml->ddd
                ));

                $desenhaForm = new DesenhaForm();
                $desenhaForm->cabecalho();
                $desenhaForm->desenhaLinhaGrupo('rua/av','Rua / Avenida',$xml->logradouro);
                $desenhaForm->cabecalhoMaisItens();
                $desenhaForm->desenhaLinhaItem('cep', 'Cep', $xml->cep, 4);
                $desenhaForm->desenhaLinhaItem('bairro', 'Bairro', $xml->bairro, 8);
                $desenhaForm->fechaDiv();
                $desenhaForm->cabecalhoMaisItens();
                $desenhaForm->desenhaLinhaItem('cidade', 'Cidade', $xml->localidade, 4);
                $desenhaForm->desenhaLinhaItem('uf', 'Estado', $xml->uf, 4);
                $desenhaForm->desenhaLinhaItem('ddd', 'DDD', $xml->ddd, 4);
                $desenhaForm->fechaDiv();
                $desenhaForm->rodape();
            }
        }catch(Exception $e){
            if($e->getCode()==1049){
                $this->alertErro("Não foi possivel acessar o Banco de dados, entre em com o administrador!");                
            }else if($e->getCode()==1045){
                $this->alertErro("Acesso ao Banco de dados negado!");                
            }else if($e->getCode()==2054){
                $this->alertErro("Acesso ao Banco de dados negado!");               
            }else if($e->getCode()==400){
                $this->alertErro($e->getMessage());                
            }else if($e->getCode()==401){
                $this->alertErro($e->getMessage());
            }else{
                echo "Erro desconhecido, contate o administrador do sistema";
            }
        }
    }
    
    function alertErro($msg){
        echo "
            <div class='alert alert-danger fixed-top mt-5' id='cepNull' style='display: none;' role='alert'>
                ". $msg ."
            </div>
        ";  
    }
}