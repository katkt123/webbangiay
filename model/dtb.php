<?php
class DTB
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $databaseName = "shoestore";
    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        try {
            if ($this->connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->databaseName)) {
                return $this->connection;
            } else {
                throw new Exception("Khong the ket noi den CSDL <br>");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function disconnect()
    {
        mysqli_close($this->connection);
    }

    public function getConnection() {
        return $this->connection;
    }

    public function executeQuery($query)
    {
        // Thực thi câu truy vấn
        if (!($data = mysqli_query($this->connection, $query))) {
            echo "Khong the thuc thi cau truy van";
        }
        while ($result = mysqli_fetch_assoc($data)) {
            $arr[] = $result;
        }
        return $arr;
    }

    public function query($sql = '', $return = true)
    {
        mysqli_query($this->connection, "set names 'utf8");
        if ($result = mysqli_query($this->connection, $sql)) {
            if ($return === true) {
                while ($row = mysqli_fetch_array($result)) {
                    $data[] = $row;
                }
                mysqli_free_result($result);
                return $data;
            } else
                return true;
        } else
            return false;
    }

    public function insert_update_delete($sql) {
        if (!mysqli_query($this->connection, $sql)) {
            echo "<br>" . mysqli_error($this->connection) . "<br>";
            return false;
        }
        return true;
    }

}
?>