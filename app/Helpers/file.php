<?php

use App\Models\File;

/**
* Returns URL or avatar (or temp avatar) image for given user_id and size
*
* @param  $is_url: TRUE = URL, FALSE = Full file path
*/
if ( !function_exists('avatar_url') ) {
    function avatar_url($user, $size = '', $is_temp = false) {
        if ( !$user ) {
            return anonymous_img_url();
        }

        $size = intval($size);

        if (is_object($user)) {
            $user_id = $user->id;
        } else {
            $user_id = $user["id"];
        }

        $file = File::getAvatar($user_id);

        if (empty($file))
            return anonymous_img_url();

        return file_url($file);
    }
}

/**
 * Generate the file name automatically by checking duplicated name in the directory
 */
if ( !function_exists('generateFileName') ) {
    function generateFileName($dir, $original_name, $new_name = '', $index = 0) {
        $original_name = str_replace(' ', '_', $original_name);
        if ( !$new_name ) {
            $new_name = $original_name;
        }

        $fullpath = $dir . '/' . $new_name;
        if ( !file_exists( $fullpath ) ) {
            return $new_name;
        }

        $index++;
        $fileinfo = pathinfo($original_name);
        $new_name = $fileinfo['filename'] . '_' . $index . '.' . $fileinfo['extension'];

        return generateFileName($dir, $original_name, $new_name, $index);
    }
}

if ( !function_exists('anonymous_img_url') ) {
    function anonymous_img_url() {
        return config('app.url') . '/assets/images/default/avatar.png';
    }
}

if ( !function_exists('anonymous_img_path') ) {
    function anonymous_img_path() {
        return 'assets/images/default/avatar.png';
    }
}

/**
 * @param $mode "get" OR "download"
 */
if ( !function_exists('file_url') ) {
    function file_url($file, $mode = 'get', $thumb = null) {
        if (!$file)
            return asset('images/commons/no-image.jpg');

        if (!$file->hash) {
            $file->hash();
            $file->save();
        }

        $route_name = 'file.';
        if ($file->type == File::TYPE_USER_AVATAR)
            $route_name = 'avatar.';

        if ($thumb)
            $route_name .= 'thumb.';

        $route_name .= $mode;        

        $file_path = $file->getPath();
        if (file_exists($file->getPath()))
            $fm = filemtime($file_path);
        else
            $fm = rand(1, 2);

        return route($route_name, ['hash' => encode_file_hash($file)]).'?fm='.$fm;
    }
}

/**
 * @author KCG
 * @since Feb 2, 25
 * @param download uploaded files...
 */
if ( !function_exists('file_download_url') ) {
    function file_download_url($file) {
        return file_url($file, 'download');
    }
}

if ( !function_exists('encode_file_hash') ) {
    function encode_file_hash($file) {
        return substr($file->hash, 0, 14) . $file->id . substr($file->hash, 14); 
    }
}

if ( !function_exists('decode_file_hash') ) {
    function decode_file_hash($hash) {
        if (strlen($hash) < 32 || strlen($hash) > 40)
            return null;

        $id = substr($hash, 14, strlen($hash) - 32);
        if ( !is_numeric($id) )
            return null;

        $file = File::find($id);
        $type = $file->type;
        $hash = substr($hash, 0, 14) . substr($hash, 14 + strlen($hash) - 32);

        if ( !$file->isCorrect($hash) )
            return null;

        return $file;
    }
}

if ( !function_exists('get_upload_prefix') ) {
    /**
    * Generate two-level subdirectory where each level has 2000 directories to hold plengty of
    * files with quick access speed.
    *
    * 20001 => 0/10
    */
    function get_upload_prefix($idv)
    {
        $deep1 = floor($idv / (2000 * 2000));
        $deep2 = floor(($idv - ($deep1 * (2000 * 2000))) / 2000);

        return $deep1 . '/' . $deep2;
    }
}


if ( !function_exists('get_upload_dir')) {
  /**
  * Get full path to the upload directory for given type
  *
  */
  function get_upload_dir($id, $prefix, $filesystem = null)
  {
    // $prefix = get_upload_prefix(rand(0, 99) % rand(0, 99));
    $dir = getRoot(). "/uploads";

    $dir = 'uploads/';
    if ($filesystem == 'local') // temporary code
        $dir = 'uploads/';

    $dir .= "$prefix/" . get_upload_prefix($id) . "/$id/";
    
    return $dir;
  }
}

/**
 * Create directory.
 *
 * @param  string $path The path string to create directory.
 * @return boolean
 */
if ( !function_exists("createDir") ) {
    function createDir($path)
    {
        $old_umask = umask(0);
        if ( !is_dir($path) ) {
            if ( !mkdir($path, 0777, true) ) {
                return false;
            }
        }
        umask($old_umask);

        return true;
    }
}


/**
* Recursively remove a directory when it is not empty
*/
if ( !function_exists("rrmdir") ) {
    function rrmdir($dir) {
        if (!is_dir($dir)) {
            return false;
        }

        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
            }
        }

        reset($objects);
        rmdir($dir);
    }
}

if ( !function_exists("removeDir") ) {
    function removeDir($dir) {
    //if (isWindows()) {
        return rrmdir($dir);
    //} else {
      // # remove dir by command "rm -rf [DIR]"
    //}
    }
}

if ( !function_exists('get_file_size_string') ) {
    function get_file_size_string($size) {
        if ($size < 1024)
            return $size . ' Bytes';

        if ($size < 1024 * 1024)
            return $size / 1024 . ' KBytes';

        if ($size < 1024 * 1024 * 1024)
            return $size / (1024 * 1024) . ' MBytes';

        if ($size < 1024 * 1024 * 1024 * 1024)
            return $size / (1024 * 1024 * 1024) . ' GBytes';
    }
}

/**
 * Render file elements
 */
if ( !function_exists('render_file_element') ) {
    function render_file_element($type, $uploaded_files = []) {
        $me = Auth::user();

        $html  = '';
        $html .= '<div class="file-upload-container">';

            $sub_html = '';

            $uploaded_files = $uploaded_files?$uploaded_files:[];

            $unused_files = [];//File::getUnusedFiles($type);
            $unused_files = $unused_files?$unused_files:[];

            $file_names = "";
            foreach ([$uploaded_files, $unused_files] as $files) {
                foreach ($files as $file) {
                    $sub_html .= '<div class="file '.(!$file->isApproved()?'unused':'').'">';
                        $sub_html .= '<a class="link-delete" data-id="'.$file->id.'" href="' . route('files.delete', ['hash' => encode_file_hash($file)]) . '"><i class="fa fa-trash-o"'.(!$file->isApproved()?'data-toggle="tooltip" title="Unused"':'').'></i></a>';
                        $sub_html .= '&nbsp;&nbsp;&nbsp;';
                        $sub_html .= '<a href="' . file_download_url($file) . '" class="link-file" target="_blank">' . $file->name . '</a>';
                    $sub_html .= '</div>';

                    if (!$file->isApproved())
                        $file_names .= "[$file->id]";
                }
            }

            $html .= '<div class="fileinput fileinput-new" data-provides="fileinput">';
                $html .= '<span class="btn btn-success green btn-file">';
                    $html .= '<span class="fileinput-new '.($me->isSuspended()?'disabled':'').'"><i class="icon-cloud-upload"></i><span>&nbsp;&nbsp;Add Files </span></span>';
                    $html .= '<span class="fileinput-exists">Change </span>';
                    $html .= '<input type="file" name="attached_files[]" multiple class="form-control" '.render_file_validation_options($type).' />';
                    $html .= '<input type="hidden" name="file_ids" value="'.$file_names.'" />';
                $html .= '</span>';
                $html .= '<a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"></a>';
                $html .= '&nbsp;&nbsp;&nbsp;';
                $html .= '<img src="/assets/images/common/loading-spinner-grey.gif" class="loading" width="15" style="display: none" />';
            $html .= '</div>';
            $html .= '<div class="attachments">';
            $html .= $sub_html;
            $html .= '</div>';
            $html .= '<input name="file_type" type="hidden" value="' . $type . '" />';
        $html .= '</div>';
        
        return $html;
    }
}

/**
 * Render file validation options
 */
if ( !function_exists('render_file_validation_options') ) {
    function render_file_validation_options($type) {
        $file_options = File::getOptions($type);

        if (!array_key_exists($type, $file_options))
            return '';

        $file_option = $file_options[$type];

        return 'data-max-size="' . $file_option['file_size'] . '" data-error-file-size="' . trans('job.error_file_size', ['max_upload_file_size' => get_file_size_string($file_option['file_size'])]) . '" data-error-file-type="' . trans('job.error_file_type', ['valid_file_extensions' => implode(', ', $file_option['file_types'])]) . '" data-file-types="' . implode(',', $file_option['file_types']) . '"';
    }
}

/**
 * Render files.
 */
if ( !function_exists('render_files') ) {
    function render_files($files, $empty_html = '') {
        if (!$files || $files->isEmpty())
            return $empty_html;

        $html = '<div class="attached-files">';

        foreach ($files as $file)
            $html .= '
                <div class="file">
                    <i class="fa ' . $file->icon() . '"></i>&nbsp;&nbsp;<a href="' . file_download_url($file) . '" target="_blank"><span class="file-name">' . str_replace('.' . $file->ext, '', $file->name) . '</span><span class="file-ext">.' . $file->ext . '</span></a>
                </div>
            ';
        $html .= '</div>';

        return $html;                   
    }
}

if ( !function_exists('getRoot') ) {
    function getRoot()
    {
        $root = dirname(dirname(dirname(__FILE__)));
        return $root;
    }
}

if ( !function_exists('getMimeType') ) {
    function getMimeType($filename)
    {
        preg_match("|\.([a-z0-9]{2,4})$|i", $filename, $fileSuffix);

        switch(strtolower($fileSuffix[1]))
        {
            case "js" :
            return "application/x-javascript";

            case "json" :
            return "application/json";

            case "jpg" :
            case "jpeg" :
            case "jpe" :
            return "image/jpg";

            case "png" :
            case "gif" :
            case "bmp" :
            case "tiff" :
            return "image/".strtolower($fileSuffix[1]);

            case "css" :
            return "text/css";

            case "xml" :
            return "application/xml";

            case "doc" :
            case "docx" :
            return "application/msword";

            case "xls" :
            case "xlsx" :
            case "xlt" :
            case "xlm" :
            case "xld" :
            case "xla" :
            case "xlc" :
            case "xlw" :
            case "xll" :
            return "application/vnd.ms-excel";

            case "ppt" :
            case "pps" :
            return "application/vnd.ms-powerpoint";

            case "rtf" :
            return "application/rtf";

            case "pdf" :
            return "application/pdf";

            case "html" :
            case "htm" :
            case "php" :
            return "text/html";

            case "txt" :
            return "text/plain";

            case "mpeg" :
            case "mpg" :
            case "mpe" :
            return "video/mpeg";

            case "mp3" :
            return "audio/mpeg3";

            case "wav" :
            return "audio/wav";

            case "aiff" :
            case "aif" :
            return "audio/aiff";

            case "avi" :
            return "video/msvideo";

            case "wmv" :
            return "video/x-ms-wmv";

            case "mov" :
            return "video/quicktime";

            case "zip" :
            return "application/zip";

            case "tar" :
            return "application/x-tar";

            case "swf" :
            return "application/x-shockwave-flash";

            default :

        }

        return "application/octet-stream";
    }
}

/**
 * Get FontAwesome Icon Class from filename.
 *
 * @param  string $filename
 * @return string
 */
if ( !function_exists("getFileIconClass") ) {
    function getFileIconClass($filename)
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $ext = strtolower($ext);

        switch ($ext) {
        // Code
            case "c": case "cpp": case "rb":
            $c = 'fa-file-code-o';
            break;

        // Word
            case "doc": case "docx":
            $c = 'fa-file-word-o';
            break;

        // Excel
            case "xls": case "xlsx":
            $c = 'fa-file-excel-o';
            break;

        // PowerPoint
            case "ppt": case "pptx":
            $c = 'fa-file-powerpoint-o';
            break;

        // PDF
            case "pdf":
            $c = 'fa-file-pdf-o';
            break;

        // Image
            case "jpg": case "png": case "bmp":
            case "jpeg": case "gif": case "psd":
            $c = 'fa-file-image-o';
            break;

        // Audio
            case "mp3": case "wma": case "wav":
            $c = 'fa-file-audio-o';
            break;

        // Video
            case "mp4": case "mpg": case "avi":
            case "vob":
            //$c = 'fa-file-video-o';
            $c = 'fa-video-camera';
            break;

        // Text
            case "txt": case "log":
            $c = 'fa-file-text-o';
            break;

        // Zip
            case "zip": case "7z": case "rar":
            $c = 'fa-file-zip-o';
            break;

            default:
            $c = 'fa-file-archive-o';
        }

        return $c;
    }
}