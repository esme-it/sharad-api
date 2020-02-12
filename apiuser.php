<?php
require_once 'core/init.php';   

if (input::exists()){

echo 'passed';
        
      $client_id = rand(10000,99999);
      //create user
      $apiuser = new apiuser();
      $salt = hash::salt(32);
      try{
 	         $apiuser->create(array(
                  'username'=>input::get('username'),
                  'userpass'=>hash::make(input::get('password'),$salt),
                  'salt'=>$salt,
                  'firstname'=> input::get('firstname'),
                  'surname'=> input::get('surname'),
                  'usermail'=> input::get('email'),
                  'secret' =>  hash::secret(input::get('username'),input::get('password'),$client_id),
                  'client_id'=> $client_id,
                  'date'=> date('Y-m-d H:i:s')
                  ));
		echo 'done';
      } catch (Exception $e) {
          die ($e->getMessage());
      }
  } 
      
?>

    <body class="sing-up-page">
      <!--======= log_in_page =======-->
      <div id="log-in" class="site-form log-in-form">
      
      	<div id="log-in-head">
        	<h1>Sing Up API USER</h1>
            <div id="logo"><a href="index.php"><img src="img/logo.png" alt=""></a></div>
        </div>
        
        <div class="form-output">
        	<form action="" method="post">
                                <div class="form-group label-floating">
					<label class="control-label" >Clientname</label>
					<input class="form-control" type="text" name="clients_name" id="clients_name" value="<?php echo escape(input::get('clients_name')); ?>">
				</div>
                                <div class="form-group label-floating">
					<label class="control-label">Firstname</label>
					<input class="form-control"type="text" name="firstname" id="firstname" value="<?php echo escape(input::get('firstname')); ?>">
				</div>
                                <div class="form-group label-floating">
					<label class="control-label">Surname</label>
					<input class="form-control" type="text" name="surname" id="surname" value="<?php echo escape(input::get('surname')); ?>">
				</div>
                                        <div class="form-group label-floating">
					<label class="control-label">Email</label>
					<input class="form-control" type="email" name="email" id="email" value="<?php echo escape(input::get('email')); ?>">
				</div>
				<div class="form-group label-floating">
					<label class="control-label">Address</label>
					<input class="form-control" type="text" name="address" id="address" value="<?php echo escape(input::get('address')); ?>">
				</div>
                                <div class="form-group label-floating">
					<label class="control-label">Username</label>
					<input class="form-control" type="text" name="username" id="username" value="<?php echo escape(input::get('username')); ?>">
				</div>
				<div class="form-group label-floating">
					<label class="control-label">Your Password</label>
					<input class="form-control" type="password" name="password" id="password" value="">
				</div>
                
				<div class="form-group label-floating">
					<label class="control-label"> Password</label>
					<input class="form-control" type="password" name="password_again" id="password_again" value="">
				</div>
				<div class="remember">
					<div class="checkbox">
						<label>
							<input name="optionsCheckboxes" type="checkbox">
							I accept the <a href="#">Terms and Conditions</a> of the website
                                                        <input type="submit" value="Register" class="btn btn-lg btn-primary full-width"> 
                                                        <input type="hidden" name="token" value="<?php echo token::generate();  ?>">
                            <input type="hidden" name="id" value="<?php $id = new systemid(); echo $id->generate('clients','clients_id');  ?>">   
                            
						</label>
					</div>
				</div>
    
                            
   

			  <div class="or"></div>

                          <p>you have an account? <a href="log_in_page.php"> Sing in !</a> </p>
            </form>
        </div>
      </div>
      <!--======= // log_in_page =======-->
	</body>


</html>