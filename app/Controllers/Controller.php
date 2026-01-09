<?php

namespace App\Controllers;

use Database\DatabaseConnector;

class Controller {
    protected function deliverResponse($responseCode, $data = null): void
    {
        http_response_code($responseCode);

        if (! empty($data)) {
            exit(json_encode($data, 0));
        }
        exit();
    }
}