<?php

namespace Modules\Type\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Illuminate\Http\Request;
use Modules\Type\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TypesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Categories';

        // module name
        $this->module_name = 'types';

        // directory path of the module
        $this->module_path = 'type::backend';

        // module icon
        $this->module_icon = 'fas fa-sitemap';

        // module model name, path
        $this->module_model = "Modules\Type\Models\Type";
    }
    // public function store(Request $request){

    //     $module_name = $this->module_name;       
    //     $request->validate([
    //         'name' => 'required',
    //     ]);
    //     Type::create([
    //         'name' => $request->name,
    //     ]);
    //     return redirect()->route('backend.'.$module_name. '.index');
    // }
    public function force($id)
{
    $module_title = $this->module_title;
    $module_name = $this->module_name;
    $module_path = $this->module_path;
    $module_icon = $this->module_icon;
    $module_model = $this->module_model;
    $module_name_singular = Str::singular($module_name);

    $module_action = 'force';

    $category = DB::table('category')->where('id', $id)->delete();

    return redirect("admin/$module_name");
}


}
