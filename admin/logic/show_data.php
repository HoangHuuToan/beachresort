<?php
    include "../controller/connect.php";
    function    show_data_to_table($db_name,$tb_name)
    {   
                
        $DB = new connect_DB("localhost", "root", "", $db_name);
        $list_fields = $DB->get_list_fields($tb_name);
        $data = $DB->get_list("SELECT * FROM $tb_name");

        foreach($data as $value) {
            echo "<tr> ";
            foreach($list_fields as $key)
            {
                echo "<td>".$value[$key]."</td>";
            }
            echo "<td class='btn_delete'><a href='./logic/delete.php?id=".$value[$list_fields[0]]."&slug=".$tb_name."'/>DELETE</td>";
            echo "<td class='btn_update'><a href='./logic/update.php?id=".$value[$list_fields[0]]."&slug=".$tb_name."'/>UPDATE</td>";
            echo "</tr>";
        }
    }
