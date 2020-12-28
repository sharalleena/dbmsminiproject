<html>
    <head>
        <title>Resources for student's academics</title>
        
    </head>
    <body>
<?php
 include 'conn.php';
 #include 'errors.php';
 if(isset($_POST['submit']))
 {     
         
        $username=mysqli_real_escape_string($con, $_POST['username']) ;
        $email= mysqli_real_escape_string($con, $_POST['email']) ;
        $password= mysqli_real_escape_string($con, $_POST['password']) ;
        $cpassword=mysqli_real_escape_string($con, $_POST['cpassword']) ;
    
        $pass = password_hash($password,PASSWORD_BCRYPT);
        $cpass = password_hash($cpassword,PASSWORD_BCRYPT);
    
        $emailquery = "select * from ad_register where email ='$email'";
        $query  = mysqli_query($con,$emailquery);
        $emailcount = mysqli_num_rows($query);

        $usernamequery = "select * from ad_register where username ='$username'";
        $userquery  = mysqli_query($con,$usernamequery);
        $usernamecount = mysqli_num_rows($userquery);
        
        if($emailcount>0 or $usernamecount>0){echo "email or username already exists or cannot enter blank username";}
        
        #if($usernamecount>0){echo "username already taken";}
        else
          {if($password === $cpassword)
            {
             $insertquery = "insert into ad_register(username,email,password,cpassword)
             values('$username','$email','$pass','$cpass')";
             $iquery = mysqli_query($con,$insertquery);
             if($iquery)
                {
                  echo " inserted  sucessful";
                 
                }
               else
                {
                    echo "insertion not sucessful";
                }
            }
         }
               
            
}
        

?>        <div class="registration-page">
            <div class="form">
                <p ><font size="+4" color="#29b10e" font-style="oblique">Sign Up</font> </p>
                 <form class="register-form"action.="" method ="POST">
                    <input type="text" name="username" placeholder="USERNAME" required/>
                    <input type="email" name="email" placeholder="EMAIL ID" required/>
                    <input type="password" name="password" placeholder="PASSWORD" required/>
                    <input type="password" name="cpassword" placeholder="CONFIRM PASSWORD" required/>
                    <button type="submit" class="but" name="submit" >Register</button>

                </form>
                
            </div>
        </div>
    </body>
</html>
