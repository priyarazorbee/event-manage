<?php

require 'Slim/Slim.php';
require 'config.php';
require 'helper.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();


$app->post('/file', 'fileGet');
$app->post('/login','login'); /* User login */
$app->post('/image','image'); 
$app->get('/viewImage', 'getImages');
$app->run();

/************************* USER LOGIN *************************************/
/* ### User login ### */
function login() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
   
    try {
        
        $db = getDB();
        $userData ='';
        $sql = "SELECT * FROM users WHERE (username=:username or email=:username) and password=:password ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("username", $data->username, PDO::PARAM_STR);
        $password=hash('sha256',$data->password);
        $stmt->bindParam("password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $mainCount=$stmt->rowCount();
        $userData = $stmt->fetch(PDO::FETCH_OBJ);
        
        if(!empty($userData))
        {
            $user_id=$userData->user_id;
            $userData->token = apiToken($user_id);
        }
        
        $db = null;
         if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            } else {
               echo '{"error":{"text":"Bad request wrong username and password"}}';
            }           
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function fileGet() {
 $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $email=$data->email;
    $username=$data->username;
    $password=$data->password;
    $name=$data->name;
    try {
            $db = getDB();
            $userData = '';
            $sql = "SELECT user_id FROM users WHERE username=:username or email=:email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("username", $username,PDO::PARAM_STR);
            $stmt->bindParam("email", $email,PDO::PARAM_STR);
            $stmt->execute();
            $mainCount=$stmt->rowCount();
            $created=time();
            if($mainCount==0)
            {
                /*Inserting user values*/
                $sql1="INSERT INTO users(username,password,email,name)VALUES(:username,:password,:email,:name)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("username", $username,PDO::PARAM_STR);
                $password=hash('sha256',$data->password);
                $stmt1->bindParam("password", $password,PDO::PARAM_STR);
                $stmt1->bindParam("email", $email,PDO::PARAM_STR);
                 $stmt1->bindParam("name", $name,PDO::PARAM_STR);
                $stmt1->execute();
                $userData=internalUserDetails($email);
                $db = null;
            if($userData){
                   $userData = json_encode($userData);
                    echo '{"userData": ' .$userData . '}';
                } else {
                   echo '{"error":{"text":"System error!"}}';
                }
            }else {
                echo '{"error":{"text":"email or username already registered!"}}';
            }
   }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function image() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
   try {
        $db = getDB();
        $name	= $_REQUEST['txt_name'];
	    $description	= $_REQUEST['description'];		
		$image_file	= $_FILES["txt_file"]["name"];
		$type		= $_FILES["txt_file"]["type"];		
		$size		= $_FILES["txt_file"]["size"];
		$temp		= $_FILES["txt_file"]["tmp_name"];
		
		$path="upload/".$image_file; 	
		if(empty($name)){
			$errorMsg="Please Enter Name";
		}
		else if(empty($image_file)){
			$errorMsg="Please Select Image";
		}
		else if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif') 
		{	
			if(!file_exists($path))
			{
				if($size < 5000000) 
				{
					move_uploaded_file($temp, "upload/" .$image_file); //move upload file temperory directory to your upload folder
				}
				else
				{
					$errorMsg="Your File To large Please Upload 5MB Size"; //error message file size not large than 5MB
				}
			}
			else
			{	
				$errorMsg="File Already Exists...Check Upload Folder"; //error message file not exists your upload folder path
			}
		}
		else
		{
			$errorMsg="Upload JPG , JPEG , PNG & GIF File Formate.....CHECK FILE EXTENSION"; //error message file extension
		}
		
		if(!isset($errorMsg))
		{
			$insert_stmt=$db->prepare('INSERT INTO images(name,description,image) VALUES(:name,:description,:image)'); //sql insert query					
			$insert_stmt->bindParam(':name',$name);	
            $insert_stmt->bindParam(':description',$description);	
			$insert_stmt->bindParam(':image',$image_file);	  //bind all parameter 
		     move_uploaded_file($temp, "upload/" .$image_file); 
			if($insert_stmt->execute())
			{
				$insertMsg="File Upload Successfully........"; //execute query success message
				header("refresh:3;home.html"); //refresh 3 second and redirect to index.php page
			}
		}
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}

function getImages() {
        $request = \Slim\Slim::getInstance()->request();
        $data = json_decode($request->getBody()); 
            try {
                $db = getDB();
                $sql = "select * FROM images";
                $stmt = $db->query($sql);
                $images = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                echo json_encode($images);
                $app->render('view.php', array('names' => $names));
                }
            catch(PDOException $e) {
                echo json_encode($e->getMessage());
                }
}
function internalUserDetails($input) {
    
    try {
        $db = getDB();
        $sql = "SELECT user_id, email, username FROM users WHERE username=:input or email=:input";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("input", $input,PDO::PARAM_STR);
        $stmt->execute();
        $usernameDetails = $stmt->fetch(PDO::FETCH_OBJ);
        $usernameDetails->token = apiToken($usernameDetails->user_id);
        $db = null;
        return $usernameDetails;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

    ?>
