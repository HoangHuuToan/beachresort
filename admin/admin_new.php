
<div class="name_site_admin">
    <h1>    Trang Quản Lý Bài Viết   </h1>
</div>
<div  class="container">
    <table>
            <tr>
                <th>ID</th>
                <th>Tiêu Đề Bài Viết</th>
                <th>Ngày Viết</th>
                <th>Tóm Tắt</th>
                <th>Chi Tiết</th>
                <th>Tên Tác Giả</th>
                <th>Delete</th>
                <th>Update</th>
                <th colspan="2">Status</th>
            </tr>
            
            <?php
                    include "../controller/connect.php";     
                            $DB = new connect_DB("localhost", "root", "","beachresort");
                            $cn = new mysqli("localhost", "root", "","beachresort");
            
                            $data_tmp = $cn->query("SELECT news.id,title_new,`date`,summary_new,`description`,name_author FROM news,authors WHERE news.id_author = authors.id_author");
                            
                            $list_fields=null;
                            for ( ; $fields_info = $data_tmp->fetch_field() ;)
                            {
                                $list_fields[] = $fields_info->name;
                            }
                            $data = $DB->get_list("SELECT news.id,title_new,`date`,summary_new,`description`,name_author,news.status FROM news,authors WHERE news.id_author = authors.id_author");
            
                    foreach($data as $value) {
                        echo "<tr> ";
                        foreach($list_fields as $key)
                        {
                            echo "<td>".$value[$key]."</td>";
                        }
                        echo "<td class='btn_delete'><a href='./logic/delete.php?id=".$value[$list_fields[0]]."&slug=news'/>DELETE</td>";
                        echo "<td class='btn_update'><a href='./logic/update.php?id=".$value[$list_fields[0]]."&slug=news'/>UPDATE</td>";

                        //confirm status
                        echo "<td class='btn_update'><a href='./logic/check_status.php?id=".$value[$list_fields[0]]."&slug=news&status=1'/>APPROVE</td>";
                        echo "<td class='btn_delete'><a href='./logic/check_status.php?id=".$value[$list_fields[0]]."&slug=news&status=0'/>SKIP</td>";

                        echo "</tr>";
                    }
            ?>
    </table>
</div>
