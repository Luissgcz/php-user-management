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
            $this->requireParameters(['table', 'column']);
            
            $column = $this->parameter('column');
            $table = $this->parameter('table');

            $verifyUniqueData = new UniqueValueRepository();
            if ($verifyUniqueData->verifyUniqueData($table, $column, $value)) {
                return true;
            }
            return false;
        } catch (Exception $err) {
            GenerateLog::generateLog('error', 'Usuário não cadastrado', ["error" => $err->getMessage()]);
            return false;
        }
    }
}
