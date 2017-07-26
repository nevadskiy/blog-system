<?php 

class Uploader {
	private static function moveUploadedFile($name, $path, $key = 0) {
		if (strpos($_FILES[$name]['type'][$key], 'image') === false) {
			throw new Exception('Uploaded file is not image!');
		}
		$tmp_name = $_FILES[$name]["tmp_name"][$key];
		$name = basename($_FILES[$name]['name'][$key]);
		$format = stristr($name, '.');
		$name = Hash::salt(16) . $format;
		$path =  $path . $name;
		move_uploaded_file($tmp_name, $path);
		return $path;
	}

	public static function save($name, $path) {
		if (isset($_FILES[$name])) {
			$filesCount = count($_FILES);
			if ($filesCount == 1) {
				return self::moveUploadedFile($name, $path);
			} else if ($filesCount > 1) {
				$pathes = [];
				foreach ($_FILES[$name]["error"] as $key => $error) {
					if ($error == UPLOAD_ERR_OK) {
						$pathes[] = self::moveUploadedFile($name, $path, $key);
					}
				}	
				return $pathes;
			}
		}
		throw new Exception('Wrong file name');
	}
}