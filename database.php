<?php

class Database
{
    private $hostname = "127.0.0.1";
    private $username = "root";
    private $password = "toor";
    private $dbname;
    private $dblink;
    private $result;
    private $records;
    private $affected;

    function __construct($par_dbname)
    {
        $this->dbname = $par_dbname;
        $this->connect();
    }

    function connect()
    {
        $this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
        if ($this->dblink->connect_errno) {
            printf("Konekcija neuspešna: %s\n", $this->dblink->connect_error);
            exit();
        }
        $this->dblink->set_charset("utf8");
    }

    function executeQuery($query)
    {
        $this->result = $this->dblink->query($query);
        if ($this->result) {
            if (isset($this->result->num_rows)) {
                $this->records = $this->result->num_rows;
            }
            if (isset($this->result->affected_rows)) {
                $this->affected = $this->result->affected_rows;
            }
            return true;
        } else {
            return false;
        }
    }

    function getResult()
    {
        return $this->result;
    }

    function select($table, $rows = "*", $where = null, $order = null)
    {
        $q = 'SELECT ' . $rows . ' FROM ' . $table;
        if ($where != null) {
            $q .= ' WHERE ' . $where;
        }
        if ($order != null) {
            $q .= ' ORDER BY ' . $order;
        }

        $this->executeQuery($q);
    }

    function insert($table, $rows, $values)
    {
        $query_values = implode(',', $values);
        $q = 'INSERT INTO ' . $table;
        if ($rows != null) {
            $q .= '(' . $rows . ')';
        }
        $q .= " VALUES($query_values)";
        // echo($q);
        if ($this->executeQuery($q)) {
            return true;
        } else {
            return false;
        }
    }

    function update($table, $id, $keys, $values)
    {
        $query_values = "";
        $set_query = array();
        for ($i = 0; $i < sizeof($keys); $i++) {
            $set_query[] = "$keys[$i] = $values[$i]";
        }
        $query_values = implode(",", $set_query);
        $q = "UPDATE $table SET $query_values WHERE id=$id";
        if ($this->executeQuery($q) && $this->affected > 0) {
            return true;
        } else {
            return false;
        }
    }

    function delete($table, $id, $id_value)
    {
        $q = "DELETE FROM $table WHERE $table.$id=$id_value";
        // echo $q;
        if ($this->executeQuery($q)) {
            return true;
        } else {
            return false;
        }
    }
}