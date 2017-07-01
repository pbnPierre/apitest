<?php
namespace Deezer\Controller;

use Deezer\HTTP\HTMLResponse;
use Deezer\HTTP\Response;

class Front {
    protected function getTemplatePath() {
        return __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR;
    }

    public function index() : Response {
        ob_start();
        require($this->getTemplatePath().'index.html.php');
        $content = ob_get_contents();
        ob_get_clean();
        return new HTMLResponse($content);
    }

}