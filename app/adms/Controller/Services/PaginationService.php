<?php

namespace App\adms\Controller\Services;


class PaginationService
{

    public static function generatePagination(int $totalRecords, int $limitResults, int $currentPage, string $urlController): array
    {
        //Calcular o numero total de paginas
        // var_dump($totalRecords);
        $lastPage = (int) ceil($totalRecords / $limitResults);

        return ['amount_records' => $totalRecords, 'last_page' => $lastPage, 'current_page' => $currentPage, 'url_controller' => $urlController];
    }
}
