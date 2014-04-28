<?php
if (!function_exists('json_encode')) {
	echo 'NO FUNCTION';
} else {
	echo 'FUNCTION EXITT';
}
if (!function_exists('json_encode')) {

    function json_encode($content) {
    	echo 'CALLED IT'
        require_once 'classes/JSON.php';
        $json = new Services_JSON;
        return $json->encode($content);
    }
   
}
 $content ('a' => 'b');
// header('Content-Type: application/json');
	echo json_encode($data);
// $data ('a' => 'b');
// header('Content-Type: application/json');
// echo json_encode($data);
?>