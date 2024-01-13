<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Main
{
    protected Request $_request;
    protected Response $_response;

    public function index(Request $request, Response $response) {
        $body = "Enter a series of numbers and choose a method below.<br/>";
        $body .= "By default we will use the following number set.\n<br/>";
        $body .= "[0.1, 3.4, 3.5, 3.6, 7.0, 9.0, 6.0, 4.4, 2.5, 3.9, 4.5, 2.8]<br/><br/>";
        $body = $this->wrapResponseBody($body);
        $response->getBody()->write($body);
        return $response->withStatus(200);
    }

    private function wrapResponseBody(String $body): String {
        $start = "<html><head></head><body>";
        $end = "</body></html>";
        return $start.$body.$end;
    }
}