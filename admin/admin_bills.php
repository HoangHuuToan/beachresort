<div class="name_site_admin">
    <h1>    Trang Quản Lý Bills  </h1>
</div>
<div class="container">
    <?php
        include("../controller/connect.php");
        $DB = new connect_DB("localhost", "root", "","beachresort"); 

        $data = $DB->get_list("SELECT bills.id,bills.date,bills.sum_price,user.user_name,user.phone,bills.status FROM `bills`,user WHERE user.id_user = bills.id_user");

        $list_fields = null;

        foreach($data[0] as $key => $value)
        {
            $list_fields[] =$key;
        }

    ?>
    <table>
        
        <tr>
            <th>ID</th>
            <th>Ngày Tháng</th>
            <th>Tổng Số Tiền</th>
            <th>Tên Khách Hàng</th>
            <th>Số Điện Thoại</th>
            <th>Tình Trạng</th>
            <th>Confirm</th>
        </tr>

        <?php
            foreach($data as $value){
        ?>
            <tr>
                <th><?php echo $value['id']?></th>
                <th><?php echo $value['date']?></th>
                <th><?php echo $value['sum_price']?></th>
                <th><?php echo $value['user_name']?></th>
                <th><?php echo $value['phone']?></th>
                <th><?php echo $value['status']  ?  "<i class='fa-solid fa-check-to-slot'></i>": "<i class='fa-solid fa-rectangle-xmark'></i>" ;?></th>

                <?php if($value['status'] == 0){?>
                <th> <a href='./logic/check_status.php?id=<?php echo $value['id']."&slug=bills&status=1"."'"?> >Xác Nhận Đã Thanh Toán</a> </th>
                <?php }?>
            </tr>

        <?php
             }?>

    </table>
</div>