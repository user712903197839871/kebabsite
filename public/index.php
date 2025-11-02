<?php
    $title = "Turky Kebab";

    ob_start(); 
?>

<?php include("../includes/components/our_goal.php")?>

<h1>our workers</h1>

<h1>customer comments</h1>

<h1>what we offer</h1>


<?php
    $content = ob_get_clean();
    require __DIR__ . "\\..\\templates\\main.php";
?>