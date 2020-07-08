<?php

require 'Slim/Slim.php';
require 'config.php';
require 'helper.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();


$app->post('/file', 'fileGet');
$app->post('/login','login'); /* User login */
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
