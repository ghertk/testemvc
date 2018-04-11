<?php
class Core {
    public function run() {
        $url = (isset($_GET['url']) ? $_GET['url'] : '');

        $params = array();
        if(!empty($url) && $url != '') {
            $url = explode('/', $url);
            $currentController = $url[0].'Controller';

            array_shift($url);
            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
            } else {
                $currentAction = 'index';
            }

            array_shift($url);
            if (count($url) > 0) {
                $params = $url;
            }
        } else {
            $currentController = 'homeController';
            $currentAction = 'index';
        }
        $controller = new $currentController();
        call_user_func_array(array($controller, $currentAction), $params);
    }
}