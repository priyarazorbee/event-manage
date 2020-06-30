<?php

function custom_copy($src, $dst) {  
  
    // open the source directory 
    $dir = opendir($src);  
  
    // Make the destination directory if not exist 
    @mkdir($dst);  
  
    // Loop through the files in source directory 
    while( $file = readdir($dir) ) {  
  
        if (( $file != '.' ) && ( $file != '..' )) {  
            if ( is_dir($src . '/' . $file) )  
            {  
  
                // Recursively calling custom copy function 
                // for sub directory  
                custom_copy($src . '/' . $file, $dst . '/' . $file);  
  
            }  
            else {  
                copy($src . '/' . $file, $dst . '/' . $file);  
            }  
        }  
    }  
  
    closedir($dir); 
}  

function isImage($fileType){
    return  ($fileType === "jpg" || $fileType === "png" || $fileType === "jpeg" || $fileType === "gif");
 }
 function isVideo($fileType){
     return  ($fileType === "mp4");
  }
 
function make_thumb($src, $dest, $desired_width, $fileType) {

    if ($fileType=='png'){
        $source_image = imagecreatefrompng($src);
    }else if ($fileType == "gif"){
        $source_image = imagecreatefromgif($src);    
    }else{
        $source_image = imagecreatefromjpeg($src);  
    }
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
}





function get_unique_file_name($path, $filename) {
    $file_parts = explode(".", $filename);
    $ext = array_pop($file_parts);
    $name = implode(".", $file_parts);

    $i = 1;
    while (file_exists($path . $filename)) {
        $filename = $name . '-' . ($i++) . '.' . $ext;
    }
    return $filename;
}


function getFileList($dir, $image_url, $plid)
{

  // array to hold return value

    $returnObj = new stdClass();
    $asset = [];
    $pl = [];


  $retval = [];

  // add trailing slash if missing
  if(substr($dir, -1) != "/") {
    $dir .= "/";
  }

  // open pointer to directory and read list of files
  $d = @dir($dir) or die("getFileList: Failed opening directory {$dir} for reading");
  while(FALSE !== ($entry = $d->read())) {
    // skip hidden files
    if($entry{0} == "." || is_dir("{$dir}{$entry}")) continue;
    if(is_readable("{$dir}{$entry}")) {
        $type = mime_content_type("{$dir}{$entry}");
        $data = [
            'name' => "{$entry}",
            'type' => $type,
            'url' => "{$image_url}{$entry}",
            'size' => filesize("{$dir}{$entry}"),
            'lastmod' => date("F d, Y H:i", filemtime("{$dir}{$entry}"))
          ];
        if (endsWith($entry, '.json')){
            $pl[] = $data;
        }
        else if(strpos($type, 'image/') !== false ||strpos($type, 'video/') !== false ) {
            if (strpos($type, 'image/') !== false ){
                $data[thumb] = "{$image_url}thumb/{$entry}";
            }
            $asset[] = $data;
        }   

      /*$retval[] = [
        'name' => "{$entry}",
        'type' => mime_content_type("{$dir}{$entry}"),
        'size' => filesize("{$dir}{$entry}"),
        'lastmod' => date("F d, Y H:i", filemtime("{$dir}{$entry}"))
      ];*/
    }
  }
  $d->close();
   if (isset($plid) && $plid!==''){
        if ($pl[$plid]){
            $plurl = $pl[$plid][url];
            $plurl = str_replace(' ', '%20', $plurl);
            $json = file_get_contents(  $plurl);
            $json = json_decode(json_decode($json)) ;
            $returnObj->plobj = $json;
            $returnObj->plname = $pl[$plid][name];
        }
   }

  $returnObj->pl = $pl;
  $returnObj->asset = $asset;
  return json_encode((array)$returnObj);
}
function endsWith( $haystack, $needle ) {
    return $needle === "" || (substr($haystack, -strlen($needle)) === $needle);
}

function authCheck($data) {
    $user_id=$data->user_id;
    $token=$data->token;

    $systemToken=apiToken($user_id);
   
    return ($systemToken == $token);
}

function getip() {
    if (validip($_SERVER["HTTP_CLIENT_IP"])) {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    
    foreach (explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
        if (validip(trim($ip))) {
            return $ip;
        }
    }
    
    if (validip($_SERVER["HTTP_PC_REMOTE_ADDR"])) {
        return $_SERVER["HTTP_PC_REMOTE_ADDR"];
    } elseif (validip($_SERVER["HTTP_X_FORWARDED"])) {
        return $_SERVER["HTTP_X_FORWARDED"];
    } elseif (validip($_SERVER["HTTP_FORWARDED_FOR"])) {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    } elseif (validip($_SERVER["HTTP_FORWARDED"])) {
        return $_SERVER["HTTP_FORWARDED"];
    } else {
        return $_SERVER["REMOTE_ADDR"];
    }
    }
    
    function validip($ip) {
    if (!empty($ip) && ip2long($ip) != -1) {
        $reserved_ips = array(
            array('0.0.0.0', '2.255.255.255'),
            array('10.0.0.0', '10.255.255.255'),
            array('127.0.0.0', '127.255.255.255'),
            array('169.254.0.0', '169.254.255.255'),
            array('172.16.0.0', '172.31.255.255'),
            array('192.0.2.0', '192.0.2.255'),
            array('192.168.0.0', '192.168.255.255'),
            array('255.255.255.0', '255.255.255.255')
        );
    
        foreach ($reserved_ips as $r) {
            $min = ip2long($r[0]);
            $max = ip2long($r[1]);
            if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
        }
    
        return true;
    } else {
        return false;
    }
    }



    function getFormattedSize($sizeInBytes) {

        if($sizeInBytes < 1024) {
            return round($sizeInBytes,2) . " bytes";
        } else if($sizeInBytes < 1024*1024) {
            return round($sizeInBytes/1024 ,2). " KB";
        } else if($sizeInBytes < 1024*1024*1024) {
            return round($sizeInBytes/(1024*1024) ,2). " MB";
        } else if($sizeInBytes < 1024*1024*1024*1024) {
            return round($sizeInBytes/(1024*1024*1024),2) . " GB";
        } else if($sizeInBytes < 1024*1024*1024*1024*1024) {
            return round($sizeInBytes/(1024*1024*1024*1024) ,2). " TB";
        } else {
            return "Greater than 1024 TB";
        }

    }

    function get_dir_size($directory){
        $size = 0;
        $files= glob($directory.'/*');
        foreach($files as $path){
            is_file($path) && $size += filesize($path);
            is_dir($path) && get_dir_size($path);
        }
        return $size;
    } 

?>