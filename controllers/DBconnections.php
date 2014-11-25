<?php

class DBconnections {
 
    public function login( $id,$pass,$type )
    {
        $mysqli = new mysqli('localhost', 'root', 'Shivguru096', 'foobank');

   if(mysqli_connect_errno()) {
      echo "Connection Failed: " . mysqli_connect_errno();
      exit();
   }

   /* Create a prepared statement */
   if($stmt = $mysqli -> prepare("SELECT user_id,role FROM users WHERE username=? AND password=? AND is_active = 1")) {
       
       /* Bind parameters
         s - string, b - blob, i - int, etc */
      $stmt -> bind_param("ss", $id, $pass);

      /* Execute it */
      $stmt -> execute();
       /* store result */
    $stmt->store_result();
       if($stmt->num_rows!=1)
       {
           return 'fail';
       }
      /* Bind results */
      $stmt -> bind_result($userid,$role);

      /* Fetch the value */
        
      while($stmt->fetch())
      {
          $_SESSION['uid']=$userid;
           if($role==$type)
           {
               if($type=='user')
               {
               return 'userlogin';
               }
               elseif($type=='employee')
               {
                   return 'employeelogin';
               }
               elseif($type=='admin')
               {
                   return 'adminlogin';
               }
           }
           else
           {
                  return 'roleerror';
           }
          
          
      }
      /* Close statement */
      $stmt -> close();
   }

   /* Close connection */
   $mysqli -> close();
        

    }
}

?>
