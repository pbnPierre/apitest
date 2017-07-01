<?php
namespace Deezer\Controller;

use Deezer\HTTP\JSONResponse;
use Deezer\HTTP\Response;

class Proxy {
    public function index() : Response {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            if (false !== parse_url($url)) {
                return new JSONResponse(json_decode(file_get_contents($_GET['url'])));
            }
        }

        throw new \InvalidArgumentException('No url get param to proxy method');
    }

}