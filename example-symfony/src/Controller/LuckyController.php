<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class LuckyController
{
#[Route('/number')]
    public function number()
{
    $number = 100;

    return new Response(
        '<html><body>Lucky number: '.$number.'</body></html>'
    );
}
}