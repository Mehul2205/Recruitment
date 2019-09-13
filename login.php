<?php
    require 'server.php';
    session_start();
    if(isset($_POST['lemail']) && isset($_POST['lpass']))
    {
        $sql="SELECT id,password,firstname,lastname,department,post from details WHERE email='".$_POST['lemail']."';";
        $result = $conn->query($sql);
        $result=$result->fetch_assoc();
        if($result['password']==$_POST['lpass'])
        {
            $_SESSION['id']=$result['id'];
            $_SESSION['name']=$result['firstname'];
            $_SESSION['lastname']=$result['lastname'];
            $_SESSION['department']=$result['department'];
            $_SESSION['post']=$result['post'];
            header('Location:detail.php');
        }

    }

?>