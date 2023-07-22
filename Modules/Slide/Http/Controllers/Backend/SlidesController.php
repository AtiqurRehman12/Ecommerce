<?php

namespace Modules\Slide\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Illuminate\Support\Facades\DB;

class SlidesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Slides';

        // module name
        $this->module_name = 'slides';

        // directory path of the module
        $this->module_path = 'slide::backend';

        // module icon
        $this->module_icon = 'fab fa-slideshare';

        // module model name, path
        $this->module_model = "Modules\Slide\Models\Slide";
    }
    public function force($id)
    {
        $module_name = $this->module_name;    
        $category = DB::table('slides')->where('id', $id)->delete();
    
        return redirect("admin/$module_name");
    }

}
