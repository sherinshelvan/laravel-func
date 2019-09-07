<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\CommonFunctionModel;
class Controller extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $page_headding, $commonFunctionModel, $table_name, $pagination_limit;
    function __construct(){
		$this->commonFunctionModel = new CommonFunctionModel();
		$this->pagination_limit    = 1;
    }
}
