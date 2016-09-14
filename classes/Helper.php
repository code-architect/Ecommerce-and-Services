<?php

/**
 * Class Helper
 */


class Helper {
	
	public static function encodeHTML($string, $case = 2) {
		switch($case) {
			case 1:
			return htmlentities($string, ENT_NOQUOTES, 'UTF-8', false);
			break;			
			case 2:
			$pattern = '<([a-zA-Z0-9\.\, "\'_\/\-\+~=;:\(\)?&#%![\]@]+)>';
			// put text only, devided with html tags into array
			$textMatches = preg_split('/' . $pattern . '/', $string);
			// array for sanitised output
			$textSanitised = array();			
			foreach($textMatches as $key => $value) {
				$textSanitised[$key] = htmlentities(html_entity_decode($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
			}			
			foreach($textMatches as $key => $value) {
				$string = str_replace($value, $textSanitised[$key], $string);
			}			
			return $string;			
			break;
		}
	}

//---------------------------------------------------------------------------------------//


    /**
     * Getting the active page link
     * @param null $page
     * @return null|string
     */
    public static function getActive($page = null)
    {
        // check if not empty
        if(!empty($page))
        {
            //check if it's an array
            if(is_array($page))
            {
                $error = [];
                foreach($page as $key => $value)
                {
                    // if it doesn't exists put this key into this error array
                    if(Url::getParam($key) != $value)
                    {
                        array_push($error, $key);
                    }
                }
                return empty($error) ? " class=\"act\"" : null;
            }
        }
        return $page == Url::cPage()? " class=\"act\"" : null;
    }


//--------------------------------------------------------------------------------//


    /**
     * Return Image size
     * @param $image
     * @param $case
     * @return mixed
     */
    public static function getImgSize($image, $case)
    {
        // check if the file exists
        if(is_file($image))
        {
            // 0 => width, 1 => height, 2 => type, 3 => attributes
            $size = getimagesize($image);
            return $size[$case];
        }
    }


	
}