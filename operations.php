<?php

/*
*
* Reusable code for dynamic insert query
*
*/
function insert_data($table_name, $data, $conn)
{
    $key = array_keys($data);  //get key( column name)

    $value = array_values($data);  //get values (values to be inserted)

    $query = mysqli_query($conn, "INSERT INTO $table_name ( " . implode(',', $key) . ") VALUES('" . implode("','", $value) . "')");

    return $query;
}


/*
*
* Reusable code for dynamic select query
*
*/
function select_data($table_name, $rows = null, $where = null, $limit = null, $conn)
{
    $sql = "SELECT $rows FROM $table_name ";
    if ($where != null) {
        $sql .= " WHERE $where ";
    }
    if ($limit != null) {
        $sql .= " LIMIT 0, $limit ";
    }

    $query = mysqli_query($conn, $sql);

    return $query;
}


/*
*
* Reusable code for dynamic update query
*
*/
function update_data($table_name, $param = array(), $where = null, $conn)
{

    $args = array();
    foreach ($param as $key => $value) {
        $args[] = " $key = '$value' ";
    }
    $sql = "UPDATE $table_name SET  " . implode(', ', $args) . "WHERE $where";

    $query = mysqli_query($conn, $sql);

    return $query;
}


/**
 * 
 * This method is used to run raw query or custom query
 * 
 */

function query($query, $conn)
{
    $query = mysqli_query($conn, $query);

    return $query;
}




//function safe string
function safe_val($conn, $string)
{
    $data = htmlentities(mysqli_real_escape_string($conn, $string));
    return $data;
}
