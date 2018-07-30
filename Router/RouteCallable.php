<?php

namespace Router;

/**
 * Route which call a callable action
 * Class RouteCallable
 * @package Router
 */
class RouteCallable extends Route{

    /**
     * call the action
     */
    public function call(){
      try{
        return call_user_func_array($this->callable, $this->matches);
      }
      catch(\ArgumentCountError $e){
        throw new RouterException($e->getMessage());
      }
    }
}
