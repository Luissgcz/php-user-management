<?php

namespace App\adms\Controller\Services\Validation;

use App\adms\Helpers\GenerateLog;
use Rakit\Validation\Rule;
use App\adms\Models\Repository\UniqueValueRepository;
use Exception;

class UniqueRule extends Rule
{
    protected $message = ":value já esta em uso";
    protected $fillableParams = ['table', 'column'];

    public function check($value): bool
    {
        try {
            // make sure required parameters exists
            $this->requireParameters(['table', 'column']);

            // getting parameters
            //Pega os Parametros que passei na classe de ValidationUserRakitService, quando defini as regras
            $column = $this->parameter('column');
            $table = $this->parameter('table');

            $verifyUniqueData = new UniqueValueRepository();
            if ($verifyUniqueData->verifyUniqueData($table, $column, $value)) {
                //Se for Unico, retorna true e deixa cadastrar
                return true;
            }
            return false;
            //Se tiver registro retorna false
        } catch (Exception $err) {
            GenerateLog::generateLog('error', 'Usuário não cadastrado', ["error" => $err->getMessage()]);
            return false;
        }
    }
}
