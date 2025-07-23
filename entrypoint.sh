#!/bin/bash
set -e

echo "Rodando migrations..."
vendor/bin/phinx migrate -c database/phinx.php

echo "Rodando seeds..."
vendor/bin/phinx seed:run -c database/phinx.php

echo "Iniciando Apache..."
apache2-foreground