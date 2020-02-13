<?php
session_start();

require_once ('core/init.php');
$method=$_SERVER['REQUEST_METHOD'];

if ($method=="GET")
{
    if($_GET['url'] == "checkcompany"){
        $postBody = file_get_contents("php://input");
        $usercompany=$_GET['usercompany'];
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        $query = db::getInstance('portal')->get('clients',array('client_name','=', $usercompany));

        if ($query->count())
        {
        $reponse = array(
        "status" => "OK",
        "client_id" => $query->first()->client_id);
        echo json_encode($reponse);

            http_response_code(200);

        } else {
            echo '{"Status": "NotOk"}';
            http_response_code(401);
        }

    } else if ($_GET['url'] == "auth"){
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');

        $usermail=$_GET['usermail'];
        $userpw=$_GET['userpw'];
        $client_id = $_GET['client_id'];
        $user = new user();
        $remember = ($_GET['remember'] === 'true') ? true : false;
        $login = $user->login($usermail,$userpw,$remember);
        
        if ($login){
            
	        $query = db::getInstance($client_id)->get('users',array('usermail','=', $usermail));
                if ($query->count()){

                    $client_id = $query->first()->client_id;
	                $fistname =  $query->first()->firstname;
                    $surname =  $query->first()->surname;
                    $id_check = db::getInstance($client_id)->get('groups',array('group_id','=',$query->first()->group_id ));
	                $response = array(
                                "status" => "OK",
                                "client_id" => $client_id);
                    echo json_encode($response);
                    http_response_code(200);

                }
        }else {
            $reponse = array(
            "status" => "NotOK");
            echo json_encode($reponse);
            http_response_code(401);
        }
    } else if ($_GET['url'] == "userdata"){
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        $client_id = $_GET['client_id'];


        require_once ('core/check.php');
        $user = new user();
        if ($user->isLoggedIn()){
            
            
                $id_check = db::getInstance($client_id)->get('groups',array('group_id','=',$user->data()->group_id));
                $response = array(
                            "status" => "OK",
                            "firstname" => utf8_encode($user->data()->firstname),
                            "surname" =>  utf8_encode($user->data()->surname),
                            "groupname" => utf8_encode($id_check->first()->name),
                            "client_id" => $client_id);
                echo json_encode($response);
                http_response_code(200);

            
        }else{
            echo "No Login";
        }

    }else if ($_GET['url'] == "scrauth") {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');

        $usermail=$_GET['usermail'];
        $userpw=$_GET['screen_id'];
        $client_id = $_GET['client_id'];
        $user = new user();
        $remember = ($_GET['remember'] === 'true') ? true : false;
        $login = $user->login($usermail,$userpw,$remember);
        
        if ($login){
            
	        $query = db::getInstance($client_id)->get('users',array('usermail','=', $usermail));
                if ($query->count()){

                    $client_id = $query->first()->client_id;
	                $fistname =  $query->first()->firstname;
                    $surname =  $query->first()->surname;
                    $id_check = db::getInstance($client_id)->get('groups',array('group_id','=',$query->first()->group_id ));
	                $response = array(
                                "status" => "OK",
                                "client_id" => $client_id);
                    echo json_encode($response);
                    http_response_code(200);

                }
        }else {
            $reponse = array(
            "status" => "NotOK");
            echo json_encode($reponse);
            http_response_code(401);
        }
    }else if ($_GET['url'] == "getscreens") {
        $client_id = $_GET['client_id'];
              

        require_once ('core/check.php');
        $user =new user();
        if ($user->isLoggedIn()){
        
            $screens = client_db::getInstance($client_id)->query("SELECT * FROM screen");
            
            if($screens->count()){
               print(json_encode($screens->results()));
            }

        }else{
            echo "NO";
        }

    }else if ($_GET['url'] == "getscrloc") {
        $client_id = $_GET['client_id'];
              

        require_once ('core/check.php');
        $user =new user();
        if ($user->isLoggedIn()){
            
        
            $screens = client_db::getInstance($client_id)->query("SELECT COUNT(screen_id) as screensum  FROM screen");
            $len = $screens->first()->screensum;
           
            $i=0;
            foreach( $scrlocations = db::getInstance($client_id)->query("SELECT * FROM screen")->results() as $item){
                if($item->screen_id){
                   
                   /* if ($i == 0){
                        $test="[{latLng: [".$item->location_lang.", ".$item->location_lati."], name: '".$item->locationname."'},";
                    $test=  json_encode($test);
                    $output = trim($test, '[]"');
                    }else if ($i == $len-1){
                        $test="{latLng: [".$item->location_lang.", ".$item->location_lati."], name: '".$item->locationname."'}]";
                    $test=  json_encode($test);
                    $output = trim($test, '[]"');
                    }else{
                        $test="{latLng: [".$item->location_lang.", ".$item->location_lati."], name: '".$item->locationname."'},";
                    $test=  json_encode($test);
                    $output = trim($test, '[]"');
                    }
                    echo $output;*/
                    $response[] = array(
                        "latLng" => array( $item->location_lang,
                                           $item->location_lati),
                        "name" => $item->locationname);
            
                   // $test='{"latLng": , "name": "'.$item->locationname.'"}';
                   // $output[]= $test;
                   // {latLng: [48.187134, 16.402495], name: 'VIENNA'}
                      
                }else{
                    $items = array(
                    "Status" => "No Screen"
                    );
                    echo json_encode($items);
                    http_response_code(200);
                }	
            }
            echo json_encode($response);
         //   $output=  json_encode($output);
          //  echo $output;

        }else{
            echo "NO";
        }

    }else if ($_GET['url'] == "getscreen") {
        $client_id = $_GET['client_id'];
        $screen_id = $_GET['screen_id'];     

 
      
        require_once ('core/check.php');
        $user =new user();
        if ($user->isLoggedIn()){
        
            $screens = client_db::getInstance($client_id)->query("SELECT * FROM screen WHERE screen_id=$screen_id");
            
            if($screens->count()){

               $output = json_encode($screens->results());
               $output = trim($output, '[]');
               echo $output;
                 // use this for location details
              // $location_lang=$screens->first()->location_lang;
              // $location_lati=$screens->first()->location_lati;
              // $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($location_lang).','.trim($location_lati).'&sensor=false&key=AIzaSyA3-1hY1lPoTXW9-SQWHMwvtf8rY7naC1A'); 
             //  $output = json_decode($geocodeFromLatLong);
               //$status = $output->status;
              // $location = ($status=="OK")?$output->results[1]->formatted_address:'';
              // print_r ($output);
            }

        }else{
            echo "NO";
        }

    }else if ($_GET['url'] == "getscreentags") {
        $client_id = $_GET['client_id'];
        $screen_id = $_GET['screen_id'];     

        require_once ('core/check.php');
        $user =new user();
        if ($user->isLoggedIn()){

            foreach($screens = db::getInstance('portal')->query("SELECT tag_id FROM cust_tags WHERE client_id=$client_id and screen_id=$screen_id ")->results() as $tag_id){
					
                if($tag_id->tag_id){
					foreach( $tags = db::getInstance('portal')->query("SELECT tag_name FROM tags WHERE tag_id in ('$tag_id->tag_id')")->results() as $item){
						if($item->tag_name){
							$items[]=$item;
						}else{
							$items = array(
							"tag_name" => "No Tags"
							);
							echo json_encode($items);
							http_response_code(200);
						}	
					}
				}else{
					$items = array(
                    "tag_name" => "No Tags"
                    );
                    echo json_encode($items);
                    http_response_code(200);
				}
            }
            if (empty($items)) {
                $items[] = array(
                    "tag_name" => "No Tags"
                    );
           }
				echo  json_encode($items);
    }else{
            echo "NO";
        }

}else if ($_GET['url'] == "gettags") {
    $client_id = $_GET['client_id']; 

    require_once ('core/check.php');
    $user =new user();
    if ($user->isLoggedIn()){
                
                foreach( $tags = db::getInstance('portal')->query("SELECT tag_name FROM tags")->results() as $item){
                    if($item->tag_name){
                        $items[]=$item;
                    }else{
                        $items = array(
                        "tag_name" => "No Tags"
                        );
                        echo json_encode($items);
                        http_response_code(200);
                    }	
                }
            
       
            echo  json_encode($items);
}else{
        echo "NO";
    }

}else if ($_GET['url'] == "dashoverview") {
    $client_id = $_GET['client_id']; 

    require_once ('core/check.php');
    $user =new user();
    if ($user->isLoggedIn()){
                
        $screens = client_db::getInstance($client_id)->query("SELECT COUNT(screen_id) as screensum FROM screen");
            
        if($screens->count()){

          
           $output = json_encode($screens->results());
           $output = trim($output, '[]');
           echo $output;
        }
            
}else{
        echo "NO";
    }

}else if ($_GET['url'] == "scrauth") {
        $client_id = $_GET['client_id'];
              

        $auth = hash::token($date,$license_key,$client_id);
        require_once ('core/reghelp.php');
        $user =new user();
        if ($user->isLoggedIn()){
        
            $screens = client_db::getInstance($client_id)->query("SELECT * FROM screen");
            
            if($screens->count()){
               print(json_encode($screens->results()));
            }

        }else{
            echo "NO";
        }
}else if ($_GET['url'] == "logout") {
    $client_id = $_GET['client_id'];
    $query = db::getInstance('portal')->get('clients',array('client_id','=', $client_id));

    if ($query->count())
    {
    require_once ('core/check.php');
    $user = new user();
    $user->logout();

} else{
    echo "NO CLIENT";
}
}

}else if ($method=="POST"){
   
    if($_GET['url'] == "register"){
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $postBody = file_get_contents("php://input");

        $postBody = json_decode($postBody);
        $usercompany = $postBody->company;
        $user_firstname = $postBody->firstname;
        $user_surname = $postBody->surname;
        $useremail = $postBody->email;
        $userpassword = $postBody->password;
        $token = $postBody->token;
        
        if ($token){
            $client = new client();
            //create client in portal DB

            try{
                 $client->create(array(
                  'client_name'=> $usercompany,
                  'firstname'=>  $user_firstname,
                  'surname'=> $user_surname,
                  'email'=> $useremail,
                  'folder'=> $usercompany,
                  'date'=> date('Y-m-d H:i:s')
                  ));
            } catch (Exception $e) {
                die ($e->getMessage());
            }
            // get client ID
            $query = db::getInstance('portal')->get('clients',array('client_name','=', $usercompany));

            if ($query->count()){
                $client_id = $query->first()->client_id; 
                // CREATE CLIENT DB AND CLIENT FOLDERS
                $client->folder($client_id);
                $client->clientdb($client_id);
                require_once ('core/reghelp.php');
                //CREATE USER
                $user = new user();
                $salt = hash::salt(32);

                try{
                    $user->create(array(
                    'username'=>$useremail,
                    'userpass'=>hash::make($userpassword,$salt),
                    'salt'=>$salt,
                    'firstname'=> $user_firstname,
                    'surname'=> $user_surname,
                    'usermail'=> $useremail,
                    'client_id'=> $client_id,
                    'group_id'=> 1,
                    'date'=> date('Y-m-d H:i:s')
                    ));

                } catch (Exception $e) {
                    die ($e->getMessage());
                }
                //CREATE SUPPORT USER
                try{
                    $user->create(array(
                    'username'=>'support',
                    'userpass'=>hash::make(config::get('owner/system'),$salt),
                    'salt'=>$salt,
                    'firstname'=> 'Support',
                    'surname'=> 'Support',
                    'usermail'=> 'support@sharad.io',
                    'client_id'=> $client_id,
                    'group_id'=> 3,
                    'date'=> date('Y-m-d H:i:s')
                    ));
                } catch (Exception $e) {
                    die ($e->getMessage());
                }
                $reponse = array(
                    "status" => "done",
                    "customer" => $client_id);
                echo json_encode($reponse);
                http_response_code(200);
            }else {
                foreach ($validation->errors() as $error){
                    echo $error, '<br>';
                }
            }
        } else {
            echo '{"Status": "No Data Found"}';
            http_response_code(200);
        }
    }  
   else if($_GET['url'] == "regscr"){
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $postBody = file_get_contents("php://input");

        $postBody = json_decode($postBody);
        $client_id = $postBody->client_id;
        $location_lang = $postBody->location_lang;
        $location_lati = $postBody->location_lati;
        $token = $postBody->token;
        $location = "New";
        


        require_once ('core/reghelp.php');
        $user = new user();
        if ($user->isLoggedIn()){
            $user_id = $user->data()->user_id;
            
            if ($token){
                $license = new license();
                $license->generate($user_id,$client_id);
                $license_key=$license->data();
                
                $display = new display();
                try{
                  $display->create(array(
                        'license_key'=>$license_key,
                        'date'=> date('Y-m-d H:i:s'),
                        'user_id'=> $user_id,
                        'screen_name'=> 'display',
                        'status'=> 'NEW',
                        'location_lang'=> $location_lang,
                        'location_lati'=> $location_lati,
                        'locationname'=> $location
                        ));
                        
                  $update = client_db::getInstance($client_id);
                  $update->get('screen', array('license_key','=',$license_key));
                  if($update->count()){
                     $display_id = $update->results();
                     print(json_encode($display_id));
                  }
                  } catch (Exception $e) {
                     die ($e->getMessage());
                  }
    
            }else{
                echo 'Not allowed';
            }
            
        }else{
            echo "No Login";
        }

           
    }else if($_GET['url'] == "upscr"){
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $postBody = file_get_contents("php://input");

        $postBody = json_decode($postBody);
        $client_id = $postBody->client_id;
        $screen_id = $postBody->screen_id;
        $player_id = $postBody->player_id;
        $screen_name = $postBody->screen_name;
        $status = $postBody->status;
        $locationname=$postBody->locationname;
        $location_lang = $postBody->location_lang;
        $location_lati = $postBody->location_lati;
        $dim=$postBody->dim;
        $license_key=$postBody->license_key;
        $token = $postBody->token;
        $date = $postBody->date;
        echo $token;
        echo "<br>";
        $auth = hash::token($date,$license_key,$client_id);
        require_once ('core/reghelp.php');
        $screen = new screen($token);
        if ($screen->isLoggedIn()){
            
            
            if ($token){
                $display = new display();
                try{
                    $display->update($screen_id,array(
                        'screen_name'=>$screen_name,
                        'player_id'=>$player_id,
                        'status'=>$status,
                        'locationname'=>$locationname,
                        'location_lang'=> $location_lang,
                        'location_lati'=> $location_lati,
                        'dim'=> $dim,
                        'license_key' => $license_key,
                        'date'=> $date
                        ));
          
                        $update = client_db::getInstance($client_id);
                        $update->get('screen', array('screen_id','=',$screen_id));
                        if($update->count()){
                           $display_id = $update->results();
                           print(json_encode($display_id));
                        }
            } catch (Exception $e) {
                die ($e->getMessage());
            }
    
            }else{
                echo 'Not allowed';
            }
            
        }else{
            echo "No Login";
        }

           
    }
}else if ($method=="DELETE"){
    if($_GET['url'] == "auth"){
        if (isset($_GET['token'])){
            echo '{"Status": "Success"}';
            http_response_code(200);
        }else {
            echo '{"Error": "Mal-formed request"}';
            http_response_code(400);
        }
    }else {
        echo '{"Error": "Method Not Allowed"}';
        http_response_code(405);
    }
}else {
    http_response_code(405);
}