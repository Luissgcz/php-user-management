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
            $exists = $verifyUniqueData->verifyUniqueData($table, $column, $value);

            // Se existir no banco → NÃO é único → retorna false
            return !$exists;
        } catch (Exception $err) {
            GenerateLog::generateLog('error', 'Erro na validação Unique', ["error" => $err->getMessage()]);
            return false;
        }
    }
}
