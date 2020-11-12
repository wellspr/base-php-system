<?php

namespace Router;

class Route
{

    public function setRoute($route, $callback)
    {

        $request_uri = $_SERVER['REQUEST_URI'];
        $request = new Request($route, $request_uri);
        $response = new Response();

        $my_route = Request :: paramsArray($route);
        $my_request = Request :: paramsArray($request_uri);

        if ( sizeof($my_route) == sizeof($my_request) ) {

            $n = 0;
            $case1 = true;
            $case2 = false;
            foreach($my_route as $item) {
                if ($item != $my_request[$n]) {
                    $case1 = false;
                    if (strpos($item, ":") === 0) {
                        $case2 =true;
                    }
                }
                $n++;
            }
            if ($case1) {
                return $callback($request, $response); 
            } else if ($case2) {
                return $callback($request, $response); 
            }
            
        }

    }

}
