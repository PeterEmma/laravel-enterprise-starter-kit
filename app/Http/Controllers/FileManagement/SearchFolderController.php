<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchFolderController extends Controller
{

    /**
     * @var Directory
     */
    protected $dir;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->dir = public_path()."/docs/files/1";
    }

    public function scandir(Request $request)
    {
        echo array("apple"=> 1);

    }
    
}



