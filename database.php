<?php

class Database
{
    private $hostname = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $dbname;
    private $dblink;
    private $result;
    private $records;
    private $affected;
    private $error;

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
                $this->records = $this->result->num_rows; //koliko postoji redova-num_rows
            }
            if (isset($this->result->affected_rows)) {
                $this->affected = $this->result->affected_rows; //promena-affected_rows
            }
            return true;
        } else {
            $this->error = $this->dblink->error;
            return false;
        }
    }
    

    function getResult()
    {
        return $this->result;
    }

    function getError() {
        return $this->error;
    }

    function getInsertId() {
        return $this->dblink->insert_id;
    }

    function select($table, $columns= "*", $where = null, $order = null)
    {
        $q = 'SELECT ' . $columns. ' FROM ' . $table;
        if ($where != null) {
            $q .= ' WHERE ' . $where;
        }
        if ($order != null) {
            $q .= ' ORDER BY ' . $order;
        }

        $this->executeQuery($q);
    }

    function insert($table, $columns, $values)
    {
        $q = 'INSERT INTO ' . $table;
        if ($columns != null) {
            $q .= '(' . implode(', ', $columns) . ')';
        }
        $query_values = "'" . implode("', '", $values) . "'";
        $q .= " VALUES($query_values)";
        // echo($q);
        if ($this->executeQuery($q)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($table, $id_value)
    {
        $q = "DELETE FROM $table WHERE $table.id = $id_value";
        // echo $q;
        if ($this->executeQuery($q)) {
            return true;
        } else {
            return false;
        }
    }
}
