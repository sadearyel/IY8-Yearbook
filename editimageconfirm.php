<!-- Dumping code here, completely incomplete --!>
<?php
// Adding tagged individuals
$sql_names = "SELECT * FROM names";
$results_names = $mysql -> query($sql_names);

// Run through all of the checkbox names and see if they were checked, if they were, add to the associative table
while($currentrow = $results_names -> fetch_assoc()) {
    if(isset($_GET['checkbox'])) {
        $sql_check = "INSERT INTO images_x_names
                        (image_id, name_id)
                        VALUES 
                        ($currentrow[''])
                        ";
    }
}
?>