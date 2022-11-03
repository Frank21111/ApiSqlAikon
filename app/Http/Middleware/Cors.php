<?php

namespace App\Http\Middleware;
use Closure;
class Cors
{
  public function handle($request, Closure $next)
  {
      $response = $next($request);
      if(method_exists($response, 'header')){
      
        //Url a la que se le dará acceso en las peticiones
        $response->header("Access-Control-Allow-Origin", "http://192.168.70.190:7999")
      //Métodos que a los que se da acceso
      ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE")
      //Headers de la petición
      ->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization"); 
    }else{
      $response->headers->set('Access-Control-Allow-Origin' , 'http://192.168.70.190:7999');
      $response->headers->set("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE");
    }
    
      return $response;
    
  }
}