<?php 

    function SecurizeString_ForSQL($string) {
        $string = trim($string);
        $string = stripcslashes($string);
        $string = addslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }


    function __sendDataUser($first_name,$last_name,$age,$birthday,$email,$password,$pseudo,$db){
        $sql = "INSERT INTO user(first_name,last_name,age,birthday,email,password,pseudo) VALUES (?,?,?,?,?,?,?)";
        $query = $db->prepare($sql);
        $query->execute(array($first_name, $last_name, $age, $birthday, $email,$password,$pseudo));
    }
?>