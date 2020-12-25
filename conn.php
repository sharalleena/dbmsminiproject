<?php

$username="root";
$password="";
$server='localhost';
$db='test';

$con=mysqli_connect($server,$username,$password,$db);
if($con){
    ?>
    <script>
    alert('connection successful')
   </script>


<?php
}
else
{
    echo "no connection";
}

?>
