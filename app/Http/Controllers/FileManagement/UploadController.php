<?php namespace App\Http\Controllers\FileManagement;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Unisharp\Laravelfilemanager\Events\ImageIsUploading;
use Unisharp\Laravelfilemanager\Events\ImageWasUploaded;

use DB;
use App\Document;
use App\Folder;
use App\Activity;

use Illuminate\Support\Facades\Input;
/**
 * Class UploadController
 */
class UploadController extends LfmController
{
    /**
     * Upload an image/file and (for images) create thumbnail
     *
     * @param UploadRequest $request
     * @return string
     */
	 
	public function newfolder()
    {
		$new_folder = new Folder;
		$FolderName= Input::get('add-folder-input');
		$NewName= '/1/'.$FolderName;
		$new_folder->id= $NewName;
		$new_folder->fold_name= $NewName;
		$new_folder->registry= Input::get('folder_by');
		$new_folder->folder_by= 'registry@kdsg.gov.ng';
		$new_folder->clearance_level= Input::get('clearance_level');
		$new_folder->save();

        Audit::log(Auth::user()->id, trans('registry/lfm.audit-log.category'), trans('registry/lfm.audit-log.msg-newfolder', ['fold_name' => $new_folder->fold_name]));   
    }
	
	public function share()
    {
        $id = Input::get('add-folder-input');
        $fold_name = $request->input('rename-input');
        DB::update('update folders set folder_to = ? where id = ?',[$folder_to,$id]);

        Audit::log(Auth::user()->id, trans('registry/lfm.audit-log.category'), trans('registry/lfm.audit-log.msg-shared', ['fold_name' => $fold_name])); 
    }
	
    public function upload()
    {
        $files = request()->file('upload');
        $error_bag = [];
        foreach (is_array($files) ? $files : [$files] as $file) {
            $validation_message = $this->uploadValidator($file);
            $new_filename = $this->proceedSingleUpload($file);

            if ($validation_message !== 'pass') {
                array_push($error_bag, $validation_message);
            } elseif ($new_filename == 'invalid') {
                array_push($error_bag, $response);
            }
			
			
            $new_file_path = parent::getCurrentPath($new_filename);
            $new_document = new Document;
            $new_document->folder_id= Input::get('working_dir');
            $new_document->title= Input::get('name');
            if (Input::hasFile('upload')){
                $file=Input::file('upload');
                $new_document->name = $new_filename;//$new_file_path.'/'.$new_filename;
            }
            $new_document->save();
            
            $id= Input::get('working_dir');
            DB::table('folders')
                ->where('id', $id)
                ->update(array('latest_doc' => $new_filename));
            
            $new_activity = new Activity;
            $new_activity->activity_by= Input::get('comment_by');
            $new_activity->folder_id= Input::get('working_dir');
            $new_activity->activity= Input::get('activity');
            $new_activity->save();
        }

        if (is_array($files)) {
            $response = count($error_bag) > 0 ? $error_bag : parent::$success_response;
        } else { // upload via ckeditor 'Upload' tab
            $response = $this->useFile($new_filename);
        }

        Audit::log(Auth::user()->id, trans('registry/lfm.audit-log.category'), trans('registry/lfm.audit-log.msg-upload-doc', ['doc_title' => $new_document->title])); 
	
        return $response;
    }

    private function proceedSingleUpload($file)
    {
        $validation_message = $this->uploadValidator($file);
        if ($validation_message !== 'pass') {
            return $validation_message;
        }

        $new_filename  = $this->getNewName($file);
        $new_file_path = parent::getCurrentPath($new_filename);

        event(new ImageIsUploading($new_file_path));
        try {
            if (parent::fileIsImage($file) && !parent::imageShouldNotHaveThumb($file)) {
                Image::make($file->getRealPath())
                    ->orientate() //Apply orientation from exif data
                    ->save($new_file_path, 90);

                $this->makeThumb($new_filename);
            } else {
                chmod($file->getRealPath(), 0644); // TODO configurable
                File::move($file->getRealPath(), $new_file_path);
            }
        } catch (\Exception $e) {
            return parent::error('invalid');
        }
        event(new ImageWasUploaded(realpath($new_file_path)));
        Audit::log(Auth::user()->id, trans('registry/lfm.audit-log.category'), trans('registry/lfm.audit-log.msg-upload-file', ['file_name' => $new_filename])); 

        return $new_filename;
    }

    private function uploadValidator($file)
    {
        $is_valid = false;
        $force_invalid = false;

        if (empty($file)) {
            return parent::error('file-empty');
        } elseif (!$file instanceof UploadedFile) {
            return parent::error('instance');
        } elseif ($file->getError() == UPLOAD_ERR_INI_SIZE) {
            $max_size = ini_get('upload_max_filesize');
            return parent::error('file-size', ['max' => $max_size]);
        } elseif ($file->getError() != UPLOAD_ERR_OK) {
            return 'File failed to upload. Error code: ' . $file->getError();
        }

        $new_filename = $this->getNewName($file);

        if (File::exists(parent::getCurrentPath($new_filename))) {
            return parent::error('file-exist');
        }

        $mimetype = $file->getMimeType();

        // size to kb unit is needed
        $file_size = $file->getSize() / 1000;
        $type_key = parent::currentLfmType();

        if (config('lfm.should_validate_mime', false)) {
            $mine_config = 'lfm.valid_' . $type_key . '_mimetypes';
            $valid_mimetypes = config($mine_config, []);
            if (false === in_array($mimetype, $valid_mimetypes)) {
                return parent::error('mime') . $mimetype;
            }
        }

        if (config('lfm.should_validate_size', false)) {
            $max_size = config('lfm.max_' . $type_key . '_size', 0);
            if ($file_size > $max_size) {
                return parent::error('size') . $mimetype;
            }
        }

        return 'pass';
    }

    private function getNewName($file)
    {
        $new_filename = parent::translateFromUtf8(trim(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));

        if (config('lfm.rename_file') === true) {
            $new_filename = uniqid();
        } elseif (config('lfm.alphanumeric_filename') === true) {
            $new_filename = preg_replace('/[^A-Za-z0-9\-\']/', '_', $new_filename);
        }

        return $new_filename . '.' . $file->getClientOriginalExtension();
    }

    private function makeThumb($new_filename)
    {
        // create thumb folder
        parent::createFolderByPath(parent::getThumbPath());

        // create thumb image
        Image::make(parent::getCurrentPath($new_filename))
            ->fit(config('lfm.thumb_img_width', 20), config('lfm.thumb_img_height', 20))
            ->save(parent::getThumbPath($new_filename));
    }

    private function useFile($new_filename)
    {
        $file = parent::getFileUrl($new_filename);

        return "<script type='text/javascript'>

        function getUrlParam(paramName) {
            var reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
            var match = window.location.search.match(reParam);
            return ( match && match.length > 1 ) ? match[1] : null;
        }

        var funcNum = getUrlParam('CKEditorFuncNum');

        var par = window.parent,
            op = window.opener,
            o = (par && par.CKEDITOR) ? par : ((op && op.CKEDITOR) ? op : false);

        if (op) window.close();
        if (o !== false) o.CKEDITOR.tools.callFunction(funcNum, '$file');
        </script>";
    }
}
