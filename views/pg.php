<?php
    if(isset($_GET['p']))
    {
        $file="$p.php";

        if (!file_exists($file))
        {
            include ("views/$p.php");
        }
        else
        {
            echo '<script>window.location.href = "?p=index";</script>';            
        }
    }    
?>