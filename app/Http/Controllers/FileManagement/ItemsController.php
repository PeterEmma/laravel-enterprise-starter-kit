<?php namespace App\Http\Controllers\FileManagement;

use Illuminate\Support\Facades\File;

use App\activity;
use DB;

/**
 * Class ItemsController
 */
class ItemsController extends LfmController
{
    /**
     * Get the images to load for a selected folder
     *
     * @return mixed
     */
    public function getItems()
    {
        $path = parent::getCurrentPath();
        $sort_type = request('sort_type');

        $keyword = '%'.request('keyword').'%';

		$folders = DB::select('select * from folders where fold_name like ? ', [$keyword]);
        // $count = DB::select('select count(*) from folders where fold_name like ? ', [$keyword]);

        // $temp = array();
        // foreach($count_array as $field => $val ){
        //     $temp[$field] = $val;
        // }
        // $count = $temp['count(*)'];

        $files = parent::sortFilesAndDirectories(parent::getFilesWithInfo($path), $sort_type);
        $directories = parent::sortFilesAndDirectories(parent::getDirectories($path), $sort_type);
        $working_dir = parent::getInternalPath($path);


        return [
            'html' => (string)view($this->getView())->with([
                'files'       => $files,
                'directories' => $directories,
				'folders'     => $folders,
                // 'count'       => $count,
                'items'       => array_merge($directories, $files)
            ]),
            'working_dir' => $working_dir,
            'pages' => 1
        ];
    }


    private function getView()
    {
        $view_type = 'grid';
        $show_list = request('show_list');

        if ($show_list === "3") {
            $view_type = 'search';
            return 'registry.' . $view_type . '-view';
        }  
        if ($show_list === "2") {
            $view_type = 'search';
            return 'registry.' . $view_type . '-list';
        } 
        elseif ($show_list === "1") {
            $view_type = 'list';
        } elseif (is_null($show_list)) {
            $type_key = parent::currentLfmType();
            $startup_view = config('lfm.' . $type_key . 's_startup_view');

            if (in_array($startup_view, ['list', 'grid'])) {
                $view_type = $startup_view;
            }
        }

        return 'registry.' . $view_type . '-view';
    }
}
