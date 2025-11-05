<?php
    include("../db_help/connection.php");

    $GLOBALS["highestID"] = 0;

    function retriveData($conn, $table) {
        $sql_querry = "SELECT * FROM {$table}";
        

        $result = mysqli_query($conn, $sql_querry);

        if(mysqli_num_rows($result) < 1) {
            echo("SOMETHING WENT WRONG!<br>NO ROWS AFFECTED!");
            return ["success" => false];
        }

        $rows = array();
        $rows["success"] = true;
        $rows["result"] = array();

        while($row = mysqli_fetch_assoc($result)) {
            array_push($rows["result"], $row);
            $GLOBALS["highestID"] = $row["ID"];
        }
        
        $GLOBALS["highestID"] += 1;

        return $rows;
    }


    function insert($conn, $table, $title, $desc) {
        $date = date("Y-m-d H:i:s");

        $sql_querry = "INSERT INTO {$table} (ID, Title, Description, DateCreation) VALUES ('{$GLOBALS['highestID']}', '{$title}', '{$desc}', '{$date}')";

        $rows_affected = mysqli_query($conn, $sql_querry);

        // check for effect
        if($rows_affected > 0) {
            echo("inserted with success<br>");
            $GLOBALS["highestID"] += 1;
        } else {
            echo("SOMETHING WENT WRONG !!!<br>(btw a try is better)");
        }
    }


    function edit($conn, $table, $id, $new_title, $new_desc) {
        $new_date = date("Y-m-d H:i:s");

        $sql_querry = "UPDATE {$table} SET Title='{$new_title}', Description='{$new_desc}', DateCreation='{$new_date}' WHERE ID = {$id}";

        // UPDATE tasks SET product = 'new', price=6, details="modified" WHERE Id = 35;
        $rows_affected = mysqli_query($conn, $sql_querry);

        if($rows_affected > 0) {
            echo("edited with success<br>");
        } else {
            echo("SOMETHING WENT WRONG !!!<br>(btw a try is better)");
        }
    }

    function delete($conn, $table, $id) {
        $sql_querry = "DELETE FROM {$table} WHERE ID = {$id}";

        $rows_affected = mysqli_query($conn, $sql_querry);

        if($rows_affected > 0) {
            echo("deleted with success<br>");
            if($id == $GLOBALS['highestID']) $GLOBALS['highestID']--;
        } else {
            echo("SOMETHING WENT WRONG !!!<br>(btw a try is better)");
        }
    }


?>