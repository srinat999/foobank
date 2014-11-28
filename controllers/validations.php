<?php

class validations{
	
	public function usernameMatch($user)
	{
		if(preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.]{8,20}$/",$user)) {
			return 1;
		}
		else 
		{
			return 0;;
		}
	}
	public function passwordMatch($password)
	{
		if(preg_match("/^(?=.*[0-9])(?=.*[a-z])(\S+)$/i",$user)) {
			return 1;
		}
		else
		{
			return 0;;
		}
	}
	public function emailMatch($email)
	{
		
		$regex = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/"; 
		if ( preg_match( $regex, $email ) ) 
		{ 
			return 1; 
		} 
		else 
		{ 
			return 0; 
		}
	}
	
		
}

?>