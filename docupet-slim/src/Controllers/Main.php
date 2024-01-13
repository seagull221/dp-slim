<?php

namespace App\Controllers;

use App\Models\MainModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Main
{
    protected String $q_numset = '';
    protected Request $_request;
    protected Response $_response;
    protected Array $numset = [0.1, 3.4, 3.5, 3.6, 7.0, 9.0, 6.0, 4.4, 2.5, 3.9, 4.5, 2.8];

    public function index(Request $request, Response $response) {
        $body = $this->getFormContent();
        $body = $this->wrapResponseBody($body);
        $response->getBody()->write($body);
        return $response->withStatus(200);
    }

    public function buckets(Request $request, Response $response) {
        $params = $request->getQueryParams();
        if(!empty($params['numset'])) {
            $this->q_numset = $params['numset'];
            $numset = explode(',',$this->q_numset);
            if(!$this->validate($numset)) {
                $params['type'] = 'Fail';
            }
        } else {
            $numset = $this->numset;
        }

        $body = $this->getFormContent() . "<h2>{$params['type']}</h2>";
        if(!empty($params['type']) && $params['type'] == 'Sort Equal Width') {
            $result = MainModel::sortEqual($numset);
            $body .= $this->wrapResponseBody("<pre>".print_r($result, true)."</pre>");
            $response->getBody()->write($body);
            return $response->withStatus(200);
        } else if(!empty($params['type']) && $params['type'] == 'Sort by Frequency'){
            $result = MainModel::sortFrequency($numset);
            $body .= $this->wrapResponseBody("<pre>".print_r($result, true)."</pre>");
            $response->getBody()->write($body);
            return $response->withStatus(200);
        } else {
            $response->getBody()->write($this->getFormContent() . '<span style="color:red">[Bad Input]</span>');
            return $response->withStatus(400);            
        }
    }

    private function getFormContent(): String {
        $body = "Enter a series of numbers separated by commas and choose a method below.<br/>";
        $body .= "By default we will use the following number set if none provided.\n<br/>";
        $body .= print_r($this->numset, true)."<br/><br/>";
        $body .= "<form action='/buckets'><input type='text' size='66' name='numset'";
        $body .= "value='{$this->q_numset}' placeholder='Enter a comma separated number set.'><br/>";
        $body .= "<input type='submit' name='type' value = 'Sort Equal Width'>&nbsp;";
        $body .= "<input type='submit' name='type' value = 'Sort by Frequency'><br/><br/>";
        return $body;
    }

    private function wrapResponseBody(String $body): String {
        $start = "<html><head></head><body>";
        $end = "</body></html>";
        return $start.$body.$end;
    }

    private function validate($numset) {
        foreach($numset as $num) {
           if(!is_numeric($num)) {
                return false;
           }
        }
        return true;
    }
}