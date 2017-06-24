<?php namespace App\Http\Controllers\FileManagement;

use Unisharp\Laravelfilemanager\traits\LfmHelpers;
use Illuminate\Http\Request;


use App\activity;
use DB;
/**
 * Class LfmController
 * @package Unisharp\Laravelfilemanager\controllers
 */
class LfmController extends Controller
{
    use LfmHelpers;

    protected static $success_response = 'OK';

    public function __construct()
    {
        $this->applyIniOverrides();
    }

    /**
     * Show the filemanager
     *
     * @return mixed
     */
    public function show(Request $request)
    {
        $page_title = trans('general.text.welcome');
        $page_description = "This is registry File Management Page";
		$activity = DB::select('select * from activities');	
        $request->session()->flash('status', 'Welcome to registry File Management Area.');
        return view('registry.index', compact('page_description', 'page_title', 'activity'));
    }

    public function getErrors()
    {
        $arr_errors = [];

        if (! extension_loaded('gd') && ! extension_loaded('imagick')) {
            // @cpnwaugha: c-e: remember to use the en/registry/lfm language file
            array_push($arr_errors, trans('laravel-filemanager::lfm.message-extension_not_found'));
        }

        $type_key = $this->currentLfmType();
        $mine_config = 'lfm.valid_' . $type_key . '_mimetypes';
        $config_error = null;

        if (!is_array(config($mine_config))) {
            array_push($arr_errors, 'Config : ' . $mine_config . ' is not a valid array.');
        }

        return $arr_errors;
    }
}
