<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class DefaultController
{
    #[Route('/')]
    public function default()
    {
        $default = 'Hello World';
        return new Response(
            '<html><body>'.$default.'</body></html>'
        );
    }



}