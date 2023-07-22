<?php

namespace Modules\Product\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Illuminate\Support\Facades\DB;

class ProductsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Products';

        // module name
        $this->module_name = 'products';

        // directory path of the module
        $this->module_path = 'product::backend';

        // module icon
        $this->module_icon = 'fas fa-shopping-cart';

        // module model name, path
        $this->module_model = "Modules\Product\Models\Product";
    }
    public function force($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
    
        $module_action = 'force';
    
        $category = DB::table('products')->where('id', $id)->delete();
    
        return redirect("admin/$module_name");
    }

}
