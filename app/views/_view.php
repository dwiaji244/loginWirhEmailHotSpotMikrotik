<?php
/**
 * Created by Martin Slavov
 */
namespace App\BaseView;

/**
* Base view
*/

class View {
	
	public function renderNo($template, $reslt)
	{
		$path = "app/views/";
		$fullPath = $path . $template . ".php";

		include($fullPath);
		return $reslt;		
	}

	public function renderLayout($fileName, $variables = array()) {
        extract($variables);
		
        ob_start();
		$path = "app/views/_layouts/";
		$fullPath = $path . $fileName . ".php";
		include($fullPath);
        $renderedView = ob_get_clean();

        return $renderedView;
	
    }
	
    public function render($fileName, $variables = array()) {
        extract($variables);
		
        ob_start();
		$path = "app/views/";
		$fullPath = $path . $fileName . ".php";
		include($fullPath);
        $renderedView = ob_get_clean();

        return $renderedView;
	
    }
}

