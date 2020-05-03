<?php
    $connection=mysqli_connect('localhost','root','','ninja_pizza');

    if (!$connection) {
    	echo 'connection error: '.mysqli_connect_error();
    	
    }
 ?>