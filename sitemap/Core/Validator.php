<?php 

namespace Snowdog\SiteMap\Core;

class Validator{
	
	public static function not_empty($_file)
	{
		if(!isset($_file) || !is_array($_file)) return false;

		if($_file['error'] != UPLOAD_ERR_OK) return false;

		if(is_uploaded_file($_file['tmp_name'])) return true;

		return false;

	}
}