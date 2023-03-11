<div class="name_site_admin">
    <h1>    Trang Quản Lý Contact  </h1>
</div>
<div class="container">


    <table>
            <tr>
                <th>ID</th>
                <th>Họ Tên</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            
                <?php
                include "./logic/show_data.php";
                show_data_to_table('beachresort', 'contact');
                ?>
    </table>
    
</div>


