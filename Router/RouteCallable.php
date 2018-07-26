<?php

namespace Router;

class RouteCallable extends Route{

    /**
     * call the action
     */
    public function call(){
      return call_user_func_array($this->callable, $this->matches);
    }
}
