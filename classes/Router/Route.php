<?php

namespace Router;

class Route
{

    public function setRoute($route, $callback)
    {

        $request_uri = $_SERVER['REQUEST_URI'];

        $has_query = Request :: has_query($request_uri);

        if ($has_query) {

            $url_components = Request :: get_url_components($request_uri);
            $request_uri = $url_components['path'];

            $a = Request :: paramsArray($route);
            $b = Request :: paramsArray($request_uri);

            if(sizeof($a)==sizeof($b)) {

                $request = new Request($route, $request_uri);

                if ($request -> paramsMatch()) {
                    $route = $request_uri;
                }

                $response = new Response();

                if ($request_uri==$route) {
                    return $callback($request, $response);
                }
            }

        } else {

            $a = Request :: paramsArray($route);
            $b = Request :: paramsArray($request_uri);

            if(sizeof($a)==sizeof($b)) {

                $request = new Request($route, $request_uri);
                $response = new Response();

                if (Request :: routeQueryNumber($route)===0) {

                    if (sizeof($request->paramsMatch())>0) {

                        if($a===$b){

                            return $callback($request, $response);

                        }

                    }

                } else if (Request :: routeQueryNumber($route)>0) {

                    if (sizeof($request->paramsMatch())===0) {

                        $urlOk = false;
                        $counter = 0;

                        foreach ($a as $key => $value) {

                            if(!(strpos($value, ":")===0)){

                                $counter+=1;

                            }

                        }

                        if ($counter===1) {

                            return $callback($request, $response);

                        }

                    } else if (sizeof($request->paramsMatch())>0) {

                        $urlOk = false;
                        $counter = 0;
                        $arrBool = [];

                        foreach ($a as $key => $value) {

                            if(!(strpos($value, ":")===0)){

                                $counter+=1;
                                if ($key>0&&$b[$key]===$value) {
                                    $urlOk = true;
                                    array_push($arrBool, $urlOk);
                                } else if ($key>0&&$b[$key]!=$value){
                                    $urlOk = false;
                                    array_push($arrBool, $urlOk);
                                }

                            }

                        }

                        $isFalse = array_search("false", $arrBool);

                        if($isFalse){
                            $urlOk = false;
                        }

                        if ($urlOk===true&&$counter>1) {

                            return $callback($request, $response);

                        }

                    }

                }

            }

        }

    }

}
