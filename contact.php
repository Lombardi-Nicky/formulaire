<?php
    $array = array("firstname" => "", "name" => "","email" => "","phone" => "","message" => "",
    "firstnameError" => "","nameError" => "","emailError" => "","phoneError" => "","messageError" => "","isSuccess" => false);
    $emailTo = "karistanfoyou65@gmail.com";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $array["firstname"] =  verifyInput($_POST["firstname"]);
        $array["name"] =  verifyInput($_POST["name"]);
        $array["email"] =  verifyInput($_POST["email"]);
        $array["phone"] =  verifyInput($_POST["phone"]);
        $array["message"] =  verifyInput($_POST["message"]);
        $array["isSuccess"] = true;
        $emailText = "";

        if(empty($array["firstname"])){

            $array["firstnameError"] = "Votre prenom est important !";
            $array["isSuccess"] = false;
        }
        else
        {
            $emailText .= "Firstname: {$array["firstname"]}\n";
        }
            
        if(empty($array["name"])){

            $array["nameError"] = "Votre nom egalement l'est tout autant !";
            $array["isSuccess"] = false;
        }
        else
        {
            $emailText .= "Name: {$array["name"]}\n";
        }
            
        if(empty($array["message"])){

            $array["messageError"] = "Dite moi votre preocupation !";
            $array["isSuccess"] = false;
        }
        else
        {
            $emailText .= "Message: {$array["message"]}\n";
        }
            
        if(!isEmail($array["email"])){
            $array["emailError"] = "votres email est incoretc";
            $array["isSuccess"] = false;
        }
        else
        {
            $emailText .= "Email: {$array["email"]}\n";
        }
           
        if(!isPhone($array["phone"]){
            $array["phoneError"] = "Que des chiffres et des espaces s'il vous plait...";
            $array["isSuccess"] = false;
        }
        else
        {
            $emailText .= "Phone: {$array["phone"]}\n";
        }
           

        if($array["isSuccess"]){
            $headers = "From: {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReply-To: {$array["email"]}";
            mail($emailTo, "Un message de votre site", $emailText, $headers);
        }

        echo json_encode(array);
    }

    function isPhone($var) {
        return preg_match("/^[0-9 ]*$/", $var);
    }

    function isEmail($var){
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function verifyInput($var){

        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }

?>