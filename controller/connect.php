<?php
    class connect_DB {
        private $servername ;
        private $username ;
        private $password ;
        private $databasename ;
        private $conn;

        public function __construct($serverName, $userName, $passWord, $databaseName)
        {
            $this->servername = $serverName;
            $this->username = $userName; 
            $this->password = $passWord;
            $this->databasename = $databaseName;   
        }

        public function connect ()
        {
            $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
            if($this->conn->connect_errno)
            {
                echo "<script>alert('Kết nối không thành công')</script>";
            }
            mysqli_query($this->conn,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

        }

        public function dis_connect ()
        {
            if($this->conn)
            {
                mysqli_close($this->conn);
                
            }
        }

        public function insert($table,$data)
        {
            $this->connect();

            $list_fields='';
            $list_values='';
            //lặp qua data để lấy dữ liệu insert vào
            foreach($data as $key => $value)
            {
                $list_fields = $list_fields. ",$key";
                $list_values = $list_values.",'".mysqli_real_escape_string($this->conn,$value)."'";
            }

            $sql = "INSERT INTO ".$table ."(".trim($list_fields,",").")"." VALUES( ".trim($list_values,",").")";

            return mysqli_query($this->conn,$sql);

        }

        public function update($table, $data, $where)
        {
            $this->connect();
            $sql='';

            //lập qua data tạo chuỗi sql
            foreach($data as $key => $value)
            {
                $sql = $sql."$key = '".mysqli_real_escape_string($this->conn,$value)."',";
            }
            $sql = "UPDATE ".$table." set ".trim($sql,","). " WHERE ".$where;

            return mysqli_query($this->conn,$sql);
        }

        public function delete($table, $where)
        {
            $this->connect();
            $sql = "DELETE FROM $table WHERE $where";
            $result = mysqli_query($this->conn,$sql);
            if(!$result)
            {
                echo ('Không tồn tại dữ liệu bạn muốn xóa');
            }
            return $result;
        }
        public function get_list($sql)
        {
            $this->connect();
            $result = mysqli_query($this->conn, $sql);
            if(!$result)
            {
                die('câu truy vấn sai');
            }
            $return = [];
            while($row = mysqli_fetch_assoc($result))// mysqli_fetch_assoc($result) lặp qua kết quả trả về của query mỗi lần trả về 1 mảng liên kết là 1 row  
            {
                $return[] = $row;
            }

            mysqli_free_result($result);
            return $return;
        }


        public function get_row($sql)
        {
            // Kết nối
            $this->connect();

            $result = mysqli_query($this->conn, $sql);

            if (!$result) {
                die('Câu truy vấn bị sai');
            }

            //duyệt kết quả thành mảng liên kết
            $row = mysqli_fetch_assoc($result);

            // Xóa kết quả khỏi bộ nhớ
            mysqli_free_result($result);

            if ($row) {
                return $row;
            }

            return false;
        }
        public function get_list_fields($table_name)
        {   

            //Thực hiện load tất cả các tên trường dữ liệu vào 1 mảng tránh nhập sai tên trường dữ liệu
            $cn = new mysqli($this->servername, $this->username,$this->password, $this->databasename);
            $data_tmp = $cn->query("SELECT * FROM ".$table_name);
            $list_fields=[];

            for ( ; $fields_info = $data_tmp->fetch_field() ;)
            {
                $list_fields[] = $fields_info->name;
            }
        return $list_fields;
        }

    }
