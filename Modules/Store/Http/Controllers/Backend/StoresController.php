<?php

namespace Modules\Store\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class StoresController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Stores';

        // module name
        $this->module_name = 'stores';

        // directory path of the module
        $this->module_path = 'store::backend';

        // module icon
        $this->module_icon = 'fas fa-shopping-cart';

        // module model name, path
        $this->module_model = "Modules\Store\Models\Store";
    }

}
