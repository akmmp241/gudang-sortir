<?php

namespace Akmalmp\GudangSortir\Controller;

use Akmalmp\GudangSortir\App\View;

class ErrorDocumentController
{
    public static function notFound(): void
    {
        View::render('ErrorDocument/not-found', []);
    }

    public function forbidden(): void
    {
        View::render('ErrorDocument/forbidden', []);
    }

}