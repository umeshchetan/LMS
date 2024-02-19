<?php

namespace App\Traits; 


trait Responder
{
 public function respond(string $viewName, $data){
    return  request()->expectsJson() ? response()->json($data) : view($viewName, $data);
 }   
}

