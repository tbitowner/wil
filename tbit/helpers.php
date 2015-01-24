<?php

function server_name()
{
	return $_SERVER['SERVER_NAME'];
}

function website_url()
{
	return '/' . $_SERVER['HTTP_HOST'];
}

if ( ! function_exists('route'))
{
	/**
	 * Generate a URL to a named route.
	 *
	 * @param  string  $route
	 * @param  array   $parameters
	 * @return string
	 */
	function route($route, $parameters = array())
	{
		return app('url')->route($route, $parameters);
	}
}

/**
 * Combines a list of path components passed in as arguments into one path
 * @return string
 */
function join_paths() {
    //join all passed in arguments into one array, each element containing a component of the path
    $args = func_get_args();
    $paths = array();
    foreach($args as $arg) {
        if($arg) {
            if(is_array($arg)) {
                foreach($arg as $a) {
                    $paths = array_merge($paths, explode(DIRECTORY_SEPARATOR, $a));
                }
            } else {
                $paths = array_merge($paths, explode(DIRECTORY_SEPARATOR, $arg));
            }
        }
    }
    //remove empty elements
    $paths = array_filter($paths);
        
    $path = implode(DIRECTORY_SEPARATOR, $paths);
        
    if(mb_substr($args[0], 0, 1)==DIRECTORY_SEPARATOR) {
        //path should be absolute
        $path = DIRECTORY_SEPARATOR.$path;
    }
        
    return $path;
 }

function request_uri()
{
	return $_SERVER['REQUEST_URI'];
}