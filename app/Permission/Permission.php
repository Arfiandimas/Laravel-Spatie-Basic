<?php

namespace App\Permission;

use Illuminate\Routing\Controller as BaseController;

class Permission extends BaseController
{
    public function product ($param1, $param2)
    {
        foreach ($param2 as $key => $value) {
            $this->middleware('permission:'. $param1 .'-'. $value , ['only' => [$value]]);
        }
    }
}