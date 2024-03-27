<?php
class HitCounter
{
    private $conn;
    private $tab;

    function __construct($host, $user, $pwd, $db, $table)
    {
        $this->tab = $table;
        $this->conn = new mysqli($host, $user, $pwd, $db);

        if (!$this->conn) {
            throw new Exception("Cannot connect, please set up again");
        }
    }

    function startOver()
    {
        $res = $this->conn->query("UPDATE " . $this->tab . " SET hits = 0 WHERE id = 1");
        return $res;
    }

    function getHits()
    {
        $res = $this->conn->query("SELECT * FROM  " . $this->tab . " ;");
        return mysqli_fetch_assoc($res)["hits"];
    }


    function setHits()
    {
        $res = $this->conn->query("UPDATE  " . $this->tab . "  SET hits = hits + 1 WHERE id = 1");
        return $res;
    }

    function closeConnection()
    {
        $this->conn->close();
    }
}
?>