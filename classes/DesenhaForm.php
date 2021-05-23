<?php

class DesenhaForm{

    function cabecalho(){
        echo "
            <div class='container mt-5 pt-5'  style = 'width: 50%;'>
                <div class='row'>
                    <div class='col-md-12'>
                        <form>
                            <fieldset>
                                <legend>Endereço</legend>
        ";
    }

    function desenhaLinhaGrupo($label, $placeholder , $value){

        echo "
            <div class='form-group mt-3'>
                <label for='". $label ."'>". $placeholder ."</label>
                <input
                    type='text'
                    class='form-control'
                    id='" . $label . "'
                    name='" . $label . "'
                    placeholder='" ."Informe ". $placeholder . "'
                    required='required'
                    disabled
                    value='". $value . "'
                />
            </div>
        ";

    }

    function cabecalhoMaisItens(){
        echo "
            <div class='form-row mt-3'>
        ";
    }

    function desenhaLinhaItem($label, $placeholder , $value, $col){
        echo "
            <div class='col-md-".$col."'>
                <label for='". $label ."'>". $placeholder . "</label>
                <input
                    type='text'
                    class='form-control'
                    id='" . $label . "'
                    name='" . $label . "'
                    placeholder='" ."Informe " . $placeholder . "'
                    required='required'
                    disabled
                    value='".$value."'
                />
            </div>
        ";
    }

    function fechaDiv(){
        echo "
            </div>
        ";
    }

    function rodape(){
        echo "
                                <button class='btn btn-outline-dark btn-lg my-2 mt-3'><a href='index.php'>Nova Pesquisa</a></button>                  
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        ";
    }

}