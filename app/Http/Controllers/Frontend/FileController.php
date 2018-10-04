<?php 

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Auth;
use Storage;
use Config;
use Session;
use Exception;
use Log;

use Intervention\Image\ImageManagerStatic as Image;

// Models
use App\Models\User;
use App\Models\File;
use App\Models\Project;
use App\Models\Tribe;

class FileController extends Controller {

	protected function checkIfAccessable(Request $request, $hash, $thumb = null) {
		try {
			$file = decode_file_hash($hash);

			if (!$file)
				return false;

			$id 	= $file->id;
			$hash 	= $file->hash;
			$type 	= $file->type;

			if ( !in_array($type, array_keys(File::getOptions())) ) {
				return false;
			}

			$mime_type = $file['mime_type'];
			if ( empty($mime_type) ) {
				return false;
			}

			// Success
			return $file;
		} catch ( Exception $e ) {
			return false;
		}

		return false;
	}

	/**
	 * Output content of file to html response
	 */
	public function get(Request $request, $hash, $thumb = null) {
		$file = $this->checkIfAccessable($request, $hash, $thumb);

		if (!$file)
			abort(404);

		$file_path = $file->getPath($thumb);

		header('Cache-Control: max-age=86400');
		header('Content-Type: '. $file->mime_type);
		header('Content-Length: ' . filesize($file_path));

		readfile($file_path);
		exit;
	}

	/**
	 * Output content of file to html response
	 */
	public function get_thumb(Request $request, $hash) {
		return $this->get($request, $hash, 'thumb');
	}

	/**
	 * Download file.
	 */
	public function download(Request $request, $hash) {
		$file = $this->checkIfAccessable($request, $hash);

		if (!$file)
			abort(404);

		return response()->download($file->getPath());
	}

	/**
	 * Upload file.
	 */
	public function upload(Request $request) {
		$me = Auth::user();

        $json['success'] = true;

		$type = $request->input('file_type');
		$file_options = File::getOptions($type);

		if (!array_key_exists($type, $file_options))
			abort(404);

		$file_option = $file_options[$type];
		$files = $request->file('attached_files');

		if (!$files)
			return $json;

		if (!is_array($files))
			$files = [$files];

		// Create upload directory
		$filesystem = Config::get("filesystems.default");
		$upload_dir = get_upload_dir($me->id, $file_option['prefix'], $filesystem);
		$full_upload_dir = getRoot() . '/' . $upload_dir;

        createDir($full_upload_dir);

        $json['success'] = false;
        foreach ($files as $file) {
        	$ext = strtolower($file->getClientOriginalExtension());
        	
            // File size is larger than the limit
            if ( $file_option['file_size'] && ($file->getClientSize() == 0 || $file->getClientSize() > $file_option['file_size']) ) {
                add_message('[' . $file->getClientOriginalName() . ']: ' . trans('job.error_file_size', ['max_upload_file_size' => get_file_size_string($file_option['file_size'])]), 'danger');

                continue;
            }

            // Check file types
        	if ( ($file_option['file_types'] && !in_array($ext, $file_option['file_types'])) ||
        		 // Want to allow to upload image files...
        		 ($file_option['image'] && substr($file->getMimeType(), 0, 5) != 'image')
        	) {
        		add_message('[' . $file->getClientOriginalName() . ']: ' . trans('job.error_file_type', ['valid_file_extensions' => implode(', ', $file_option['file_types'])]), 'danger');

                continue;
            }

            $filename = generateFileName($full_upload_dir, $file->getClientOriginalName());

            $mime_type = $file->getClientMimeType();
            $file_size = $file->getClientSize();

            try {
	            if ( $file->move($full_upload_dir, $filename) ) {
	                $file_obj = new File;
	                $file_obj->user_id 		= $me->id;
	                $file_obj->name 		= $filename;
	                $file_obj->type 		= $type;
	                $file_obj->ext  		= $ext;
	                $file_obj->is_approved  = null;
	                $file_obj->mime_type 	= $mime_type;
	                $file_obj->size 		= $file_size;
	                $file_obj->path 		= $upload_dir;
	                $file_obj->hash();

	                $info = null;
	                if ($type == File::TYPE_USER_AVATAR || $type == File::TYPE_TRIBE || $type == File::TYPE_PROJECT) {
		                $image = Image::make($file_obj->getPath());
		            	$info = ['width' => $image->width(), 'height' => $image->height()];
	                }

	                if ( $file_obj->save() ) {
	                    $json['files'][] = [
	                        'id' 			=> $file_obj->id,
	                        'name' 			=> $filename,
	                        'url'			=> file_url($file_obj),
	                        'download_url'	=> file_download_url($file_obj),
	                        'delete_url' 	=> route('files.delete', ['hash' => encode_file_hash($file_obj)]),
	                        'info'			=> $info
	                    ];

	                	$json['success'] 	= true;
	                }
	            } else {
	                continue;
	            }
            } catch (Exception $e) {
            	Log::error('FileContrller@upload: '. $e->getMessage());
            }
        }

        $json['alerts'] = show_messages(true);

        return $json;
	}

	/**
	 * Delete uploaded files.
	 */
	public function delete(Request $request, $hash) {
		$user = Auth::user();

		$file = decode_file_hash($hash);

		if (!$user)
			abort(404);

		if (!$file)
			abort(404);

		if ($file->user_id != $user->id)
			abort(404);

        return ['success' => $file->remove()];
	}
}