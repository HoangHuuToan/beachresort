<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <?php $name_site = $_GET['slug'];?>
    <title>Cập Nhật Dữ Liệu <?php echo  $name_site?> </title>
</head>
<body>

    <?php
        session_start();
        if(isset($_GET['slug']))
        {
            switch($name_site)
            {
            case "news":
                include "update_new.php";
                break;
            case "authors":
                include "update_author.php";
                break;
            case "contact":
                include "update_contact.php";
                break;
            default :
                include "update_new.php";
            
            }
        }else
        {
            include "update_new.php";
        }
        
    ?>


</body>
</html>