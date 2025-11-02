<?php
    include("../db_help/connection.php");

    $GLOBALS["highestID"] = 0;

    function retriveData($conn) {
        $sql_querry = "SELECT * FROM tasks";

        $result = mysqli_query($conn, $sql_querry); 

        if(mysqli_num_rows($result) < 1) {
            echo("SOMETHING WENT WRONG!<br>NO ROWS AFFECTED!");
            return;
        }

        $rows = array();

        while($row = mysqli_fetch_assoc($result)) {
            array_push($rows, $row);
            $GLOBALS["highestID"] = $row["ID"];
        }
        
        $GLOBALS["highestID"] += 1;

        return $rows;
    }


    function insert($conn, $title, $desc) {
        $date = date("Y-m-d H:i:s");

        $sql_querry = "INSERT INTO tasks (ID, Title, Description, DateCreation) VALUES ('{$GLOBALS['highestID']}', '{$title}', '{$desc}', '{$date}')";

        $rows_affected = mysqli_query($conn, $sql_querry);

        // check for effect
        if($rows_affected > 0) {
            echo("inserted with success<br>");
            $GLOBALS["highestID"] += 1;
        } else {
            echo("SOMETHING WENT WRONG !!!<br>(btw a try is better)");
        }
    }


    function edit($conn, $id, $new_title, $new_desc) {
        $new_date = date("Y-m-d H:i:s");

        $sql_querry = "UPDATE tasks SET Title='{$new_title}', Description='{$new_desc}', DateCreation='{$new_date}' WHERE ID = {$id}";

        // UPDATE tasks SET product = 'new', price=6, details="modified" WHERE Id = 35;
        $rows_affected = mysqli_query($conn, $sql_querry);

        if($rows_affected > 0) {
            echo("edited with success<br>");
        } else {
            echo("SOMETHING WENT WRONG !!!<br>(btw a try is better)");
        }
    }

    function delete($conn, $id) {
        $sql_querry = "DELETE FROM tasks WHERE ID = {$id}";

        $rows_affected = mysqli_query($conn, $sql_querry);

        if($rows_affected > 0) {
            echo("deleted with success<br>");
            $GLOBALS["highestID"] -= 1;
        } else {
            echo("SOMETHING WENT WRONG !!!<br>(btw a try is better)");
        }
    }


?>