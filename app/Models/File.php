<?php 

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

namespace App\Models;

use Config;

class File extends Model {
	
	const TYPE_USER_AVATAR 	= 1;
	const TYPE_TRIBE 		= 2;
	const TYPE_PROJECT 		= 3;
	const TYPE_MESSAGE 		= 4;

	function __construct() {
        parent::__construct();
    }

    /**
     * Return file hash.
     */
    public function hash() {
		$this->hash = md5($this->user_id . '_' . $this->name . '_' . $this->type);
	}

	/**
	 * Check whether has is correct or not.
	 */
	public function isCorrect($hash) {
		return $this->hash == $hash;
	}

	/**
	 * Get type by class name.
	 */
	public static function getTypeByClass($class) {
		$options = self::getOptions();
		$types = array_keys($options);
		$classes = array_pluck($options, 'class');

		return $types[array_search($class, $classes)];
	}

	/**
	 * Get file options.
	 */
	public static function getOptions() {
		$settings = Config::get('settings');

		return [
			self::TYPE_USER_AVATAR => [
				'prefix' 			=> 'uavat',
				'file_types' 		=> $settings['uploads']['image_types'],
				'file_size' 		=> $settings['uploads']['file_size'],
				'image'				=> true,
				'class'				=> 'User'
			],
			self::TYPE_TRIBE => [
				'prefix' 			=> 'trb',
				'file_types' 		=> $settings['uploads']['image_types'],
				'file_size' 		=> $settings['uploads']['file_size'],
				'image'				=> true,
				'class'				=> 'Tribe'
			],
			self::TYPE_PROJECT => [
				'prefix' 			=> 'jb',
				'file_types' 		=> $settings['uploads']['image_types'],
				'file_size' 		=> $settings['uploads']['file_size'],
				'image'				=> true,
				'class'				=> 'Project'
			],
			self::TYPE_MESSAGE => [
				'prefix' 			=> 'msg',
				'file_types' 		=> $settings['uploads']['file_types'],
				'file_size' 		=> $settings['uploads']['file_size'],
				'image'				=> false,
				'class'				=> 'Message'
			]
		];
	}

	public function user() {
		return $this->hasOne('App\Models\User', 'id', 'user_id')->withTrashed();
	}

	/**
	 * Unused Files
	 */
	public static function getUnusedFiles($type) {
		$me = Auth::user();

		$unused_files = self::where('type', $type)
							->where('user_id', $me->id)
							->whereNull('is_approved')
							->get();

		return $unused_files;
	}

	/**
	 * Check whether current file is approved or not.
	 */
	public function isApproved() {
		return $this->is_approved == 1;
	}

	/**
	 * Remove file.
	 */
	public function remove() {
		$user = Auth::user();

		if (!$user->isAdmin() && $this->user_id != $user->id)
	        return false;

        $this->delete();

        return true;
	}

	/**
	 * Get absolute file path
	 */
	public function getPath($thumb = null, $need_orig = true) {
		$prefix = getRoot() . '/';

		if (strpos($this->path, ':') === 1 || strpos($this->path, ':') === 0)
			$prefix = '';

		$file_path = $prefix . $this->path . $this->name;
		if ($thumb) {
			$thumb_file_path = $prefix . $this->path . (str_replace('.' . $this->ext, '', $this->name) . '_thumbnail.' . $this->ext);

			if ($need_orig && !file_exists($thumb_file_path))
				$file_path = $file_path;
			else
				$file_path = $thumb_file_path;
		}

		return $file_path;
	}

	/**
	 * @param $id The user id
	 */
	public static function getAvatar($id) {
		return self::where('target_id', $id)
				   ->where('type', self::TYPE_USER_AVATAR)
				   ->orderBy('id', 'DESC')
				   ->first();
	}

	/**
	 * Icons by uploaded files.
	 */
	public function icon() {
		$icon = 'fa-file-o';

		if (strpos($this->mime_type, 'image/') !== FALSE)
			$icon = 'fa-file-image-o';

		if (strpos($this->mime_type, 'text/') !== FALSE)
			$icon = 'fa-file-text-o';

		if (strpos($this->mime_type, 'word') !== FALSE)
			$icon = 'fa-file-word-o';

		if (strpos($this->mime_type, 'sheet') !== FALSE)
			$icon = 'fa-file-excel-o';

		if (strpos($this->mime_type, 'powerpoint') !== FALSE)
			$icon = 'fa-file-powerpoint-o';

		if (strpos($this->mime_type, 'pdf') !== FALSE)
			$icon = 'fa-file-pdf-o';

		if (strpos($this->mime_type, 'zip') !== FALSE)
			$icon = 'fa-file-zip-o';

		return $icon . ' fa-file';
	}
}