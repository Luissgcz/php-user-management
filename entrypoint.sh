#!/bin/bash
set -e

# echo "Rodando migrations..."
# php vendor/bin/phinx migrate -c database/phinx.php

# echo "Rodando seeds..."
# php vendor/bin/phinx seed:run -c database/phinx.php

echo "Iniciando Apache..."
apache2-foreground