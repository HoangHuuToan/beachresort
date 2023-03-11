<div class="name_site_admin">
    <h1>    Trang Quản Lý Tác Giả   </h1>
</div>
<div  class="container">
    <table>
            
                <tr>
                    <th>ID</th>
                    <th>Tên Tác Giả</th>
                    <th>Số Điện Thoại</th>
                    <th>Email</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
                
                    <?php
                    include "./logic/show_data.php";
                    show_data_to_table('beachresort', 'authors');
                    ?>
    </table>
</div>
