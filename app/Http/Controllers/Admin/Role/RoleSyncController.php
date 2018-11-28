<?php

namespace App\Http\Controllers\Admin\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleSyncController extends Controller
{
    /**
     * RoleSyncController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    function __invoke()
    {
    }
}
