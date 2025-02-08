<?php 

function run(string $url, array $routes): void
{

    $uri = parse_url($url);
    $path = $uri['path'];
    
    $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
   
    
    $relativePath = substr($path, strlen($baseUrl));
    
  
    if (array_key_exists($relativePath, $routes) === false) {
        return; 

    }

    $callback = $routes[$relativePath];
    $callback();
}


?> 