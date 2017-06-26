<?php

namespace App\Http\Controllers\FileManagement;

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
        $this->dir = base_path("public/docs/files/1");
    }

    public function scanDirectory(Request $request)
    {

        $files = array();
        $dir = $this->dir;
        // Is there actually such a folder/file?
        if(file_exists($dir)){
            
            foreach(scandir($dir) as $f) {
                
                if(!$f || $f[0] == '.') {
                        continue; // Ignore hidden files
                    }
                if(is_dir($dir . '/' . $f)) {
                    // The path is a folder
                    $files[] = array(
                            "name" => $f,
                            "type" => "folder",
                            "path" => $dir . '/' . $f,
                            "items" => scan($dir . '/' . $f) // Recursively get the contents of the folder
                        );
                    }
                else {
                        // It is a file
                        $files[] = array(
                            "name" => $f,
                            "type" => "file",
                            "path" => $dir . '/' . $f,
                            "size" => filesize($dir . '/' . $f) // Gets the size of this file
                        );
                    }
                }
            
        }
        // return $files;

        // header('Content-type: application/json');
        $data = array(
            "name"  => "files",
            "type"  => "folder",
            "path"  => $dir,
            "items" => $files
        );
        //echo json_encode($array_to_return);

        // return response()->json($array_to_return);
        //$data = array("apple" => 1, "dir" => $this->dir);

        return response()->json($data);
    }
    
}



