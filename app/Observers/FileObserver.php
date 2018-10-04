<?php

/**
 * @author Dejan
 * @since Sep 20, 2018
 */
namespace App\Observers;

use Auth;
use Log;

use App\Models\File;
use App\Models\User;
use App\Models\Tribe;
use App\Models\Project;
use Intervention\Image\ImageManagerStatic as Image;

class FileObserver {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  $model
     * @return void
     */
    public function saving($model) {
        $class_name      = get_class($model);
        $base_class_name = class_basename($class_name);
        $type = File::getTypeByClass($base_class_name);

        if ($base_class_name == 'File')
            return true;

        $me = Auth::user();
        
        // Upload files
        if (!empty($_POST['file_ids'])) {
            $file_ids = $_POST['file_ids'];

            foreach (explode_bracket($file_ids) as $file_id) {
                $file = File::find($file_id);

                if (!empty($file) && $file->user_id == $me->id && ($file->type == $type)) {
                    if (!empty($model->id) || (empty($model->id) && !$file->isApproved()))
                        continue;
                }

                Log::info("FileObserver@saving: This user have tried to upload wrong files. ID: {$me->id}, file_ids: {$file_ids}");
            }
        }

        return true;
    }

    /**
     * Handle the event.
     *
     * @param  $model
     * @return void
     */
    public function saved($model) {
        $class_name      = get_class($model);
        $base_class_name = class_basename($class_name);
        $type = File::getTypeByClass($base_class_name);

        if ($base_class_name == 'File')
            return true;

        $me = Auth::user();
        
        // Upload files
        if (!empty($_POST['file_ids'])) {
            $file_ids = $_POST['file_ids'];

            foreach (explode_bracket($file_ids) as $file_id) {
                $file = File::find($file_id);

                if (!empty($file) && !$file->isApproved() && $file->user_id == $me->id && ($file->type == $type)) {
                    $file->is_approved  = 1;
                    $file->target_id    = $model->id;
                    $file->save();

                    $file_path = $file->getPath();

                    $file_options = File::getOptions($type);

                    if (!array_key_exists($type, $file_options))
                        return false;

                    $file_option = $file_options[$type];

                    // case of portfolio, it needs to make thumbnail for portfolio
                    if ($file_option['image']) {
                        $image = Image::make($file_path);

                        if (empty($_POST['x1']))
                            $_POST['x1'] = 0;
                        
                        if (empty($_POST['y1']))
                            $_POST['y1'] = 0;

                        if (empty($_POST['width'])) {
                            if ($file->type == File::TYPE_USER_AVATAR)
                                $_POST['width'] = User::AVATAR_WIDTH;
                            elseif ($file->type == File::TYPE_TRIBE)
                                $_POST['width'] = Tribe::IMAGE_WIDTH;
                            elseif ($file->type == File::TYPE_PROJECT)
                                $_POST['width'] = Project::IMAGE_WIDTH;
                        }
                        
                        if (empty($_POST['height'])) {
                            if ($file->type == File::TYPE_USER_AVATAR)
                                $_POST['height'] = User::AVATAR_HEIGHT;
                            elseif ($file->type == File::TYPE_TRIBE)
                                $_POST['height'] = Tribe::IMAGE_HEIGHT;
                            elseif ($file->type == File::TYPE_PROJECT)
                                $_POST['height'] = Project::IMAGE_HEIGHT;
                        }

                        $image->crop(
                            $_POST['width'],
                            $_POST['height'],
                            $_POST['x1'],
                            $_POST['y1']
                        );

                        if ($file->type == File::TYPE_USER_AVATAR)
                            $image->resize(User::AVATAR_WIDTH, User::AVATAR_HEIGHT);
                        elseif ($file->type == File::TYPE_TRIBE) {
                            $image->resize(Tribe::IMAGE_WIDTH, Tribe::IMAGE_HEIGHT);
                            $file_path = $file->getPath('thumb', false);
                        } elseif ($file->type == File::TYPE_PROJECT) {
                            $image->resize(Project::IMAGE_WIDTH, Project::IMAGE_HEIGHT);
                            $file_path = $file->getPath('thumb', false);
                        }

                        $image->save($file_path);

                        // Remove old images.
                        $old_images = File::where('target_id', $model->id)
                                          ->where('type', $file->type)
                                          ->where('id', '<>', $file->id)
                                          ->get();

                        foreach ($old_images as $old_image)
                            $old_image->delete();
                    }
                }
            }
        }
	}

    public function deleted($model) {
        $class_name      = get_class($model);
        $base_class_name = class_basename($class_name);

        $me = Auth::user();

        if (in_array('withTrashed', get_class_methods(get_class($model)))) // Do not remove files if model is "Soft Delete" mode
            return;

        if ($base_class_name == 'File') {
            $file_path = $model->getPath();

            if (file_exists($file_path)) {
                unlink($file_path);
            }
        } else {
            $files = $model->files();

            foreach ($files as $file) {
                $file->delete();
            }
        }
    }
}