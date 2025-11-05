<?php
    include("..\\.\\db_help\\connection.php");
    include("..\\.\\db_help\\querries.php");
    $workers = retriveData($db_connection, "workers");
?>

<script> const workers = <?php echo json_encode($workers) ?>; </script>

<section id="workers-container"></section>
