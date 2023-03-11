<?php 
    
    include "../form/form_new.php";   
    
    $table_name = $_GET['slug'];    

    if(isset($_POST['btn_submit']))
    {
        $txt_title = $_POST['txt_title'];
        $txt_date = $_POST['txt_date'];
        $txt_summary = $_POST['txt_summary'];
        $txt_description = $_POST['txt_desciption'];
        $id_author = $_POST['txt_name_author'];
        
        if( empty($txt_title) || empty($txt_date) || empty($txt_summary) || empty($txt_description) ||empty($id_author) )
        {
            die("<script> alert('Bạn chưa nhập đầy đủ dữ liệu xin mời nhập lại'); </script>"); 
        }
        else
        {
            $list_fields = $DB->get_list_fields($table_name);
            $data_values = array(null,$txt_title,$txt_date,$txt_summary,$txt_description,$id_author,null);
            $data_insert = array_combine($list_fields, $data_values);

            $result = $DB->insert($table_name,$data_insert);

            if($result)
            {   
                $_SESSION['status_insert'] = true;
                header("Location: ../index.php?slug=news");
            }
            else {
                echo "<script> alert('Nhập Không Thành Công !!!') </script>";
            }
        }



    }

?>