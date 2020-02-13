<?php
require_once 'core/init.php';   

if (input::exists()){


    
	
      //create user
      $apiuser = new apiuser();
      $salt = "f8e07fa2b70fe50566621f7895188cf5";
      
      $encrypted_id = base64_encode(input::get('username') . $salt);
      
      echo  '{"encoded" : "'.$encrypted_id.'"}';
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
					<label class="control-label">Username</label>
					<input class="form-control" type="text" name="username" id="username" value="<?php echo escape(input::get('username')); ?>">
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