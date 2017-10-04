<!DOCTYPE html>
<head>
    <title>UPDATE PostgreSQL data with PHP</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>li {
            list-style: none;
        }</style>
</head>
<body>
<?php
// Connect to the database. Please change the password in the following line accordingly
$db = pg_connect("host=localhost port=5432 dbname=PetCare user=postgres password=12345678");
$result = pg_query($db, "SELECT * FROM request");        // Query template
?>
<h2>List of requests</h2>
<table class="table table-striped">
    <tr>
        <th>Request ID</th>
        <th>Owner Name</th>
        <th>Pet Category</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Kind of Work</th>
        <th>Bids</th>
        <th>Status</th>
    </tr>
    <?php
    while ($row = pg_fetch_row($result)){// To store the result row
        $req_id = $row[request_id];
        $owner_id = $row[owner_id];
        $care_begin = $row[care_begin];
        $care_end = $row[care_end];
        $work = $row[kind_of_work];
        $bids = $row[bids];
        $pet_id = $row[pet_id];
        $status = $row[status];

        $pet_info = pg_fetch_assoc(pg_query($db, "SELECT * FROM pet WHERE pets_id = $pet_id"));
        $pcat_info = pg_fetch_assoc(pg_query($db, "SELECT * FROM petcategory WHERE pcat_id = $pet_info[pcat_id]"));
        $owner_info = pg_fetch_assoc(pg_query($db, "SELECT * FROM pet_user WHERE user_id = $owner_id"));

        $owner_name = $owner_info[name];
        $pcat_name = $pcat_info[name];

        echo "<tr style='cursor: pointer;'>";
        echo "<td>" . $req_id . "</td>";
        echo "<td>" . $owner_name . "</td>";
        echo "<td>" . $pcat_name . "</td>";
        echo "<td>" . $care_begin . "</td>";
        echo "<td>" . $care_end . "</td>";
        echo "<td>" . $work . "</td>";
        echo "<td>" . $bids . "</td>";
        echo "<td>" . $status . "</td>";
        echo "</tr>";
    }
    ?>

</table>

<?php
if (isset($_POST['new'])) {    // Submit the update SQL command
    $result = pg_query($db, "UPDATE pet SET pets_id = '$_POST[petid_updated]'");
    if (!$result) {
        echo "Update failed!!";
    } else {
        echo "Update successful!";
    }
}
?>