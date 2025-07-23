<?php

// var_dump($this->data['pagination']);

if (($this->data['pagination']['last_page'] ?? false) && $this->data['pagination']['last_page'] != 1) {
    $totalPages = $this->data['pagination']['last_page'];
    $currentPage = $this->data['pagination']['current_page'] ?? 1;
    $baseUrl = getenv('APP_DOMAIN') . '/' . ($this->data['pagination']['url_controller'] ?? '');

    echo "Páginas: ";

    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            echo " [{$i}] ";
        } else {
            echo " <a href='{$baseUrl}/{$i}'>{$i}</a> ";
        }
    }
}
