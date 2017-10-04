<!DOCTYPE html>
<head>
    <title>UPDATE PostgreSQL data with PHP</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>li {
            list-style: none;
        }</style>
</head>
<body>
<h2>Supply petid and enter</h2>
<ul>
    <form name="display" action="pet.php" method="POST">
        <li>Pet ID:</li>
        <li><input type="number" name="pet_id"/></li>
        <li><input type="submit" name="submit"/></li>
    </form>
</ul>
<?php
// Connect to the database. Please change the password in the following line accordingly
$db = pg_connect("host=localhost port=5432 dbname=PetCare user=postgres password=12345678");
$result = pg_query($db, "SELECT * FROM pet WHERE pet_id = '$_POST[pet_id]'");        // Query template
$row = pg_fetch_assoc($result);        // To store the result row
$pet_id = $row[pet_id];
$row_owner = pg_fetch_assoc(pg_query($db, "SELECT * FROM pet_user WHERE user_id = $row[owner_id]"));
$row_pcat = pg_fetch_assoc(pg_query($db, "SELECT * FROM petcategory WHERE pcat_id = $row[pcat_id]"));
$user_name = $row_owner[name];
$pet_cat = $row_pcat[name];
$pet_size = $row_pcat[size];
$pet_age = $row_pcat[age];
if (isset($_POST['submit'])) {
    echo "
    <table>
    <thead>
        <tr>
        <th>Pet ID</th>
        <th>Owner's Name</th>
        <th>Pet Category</th>
        <th>Pet Age</th>
        <th>Pet Size</th>
        </tr>
    </thead>
    <tbody>
    <tr>";
    echo "<td>" . $pet_id . "</td>";
    echo "<td>" . $user_name . "</td>";
    echo "<td>" . $pet_cat . "</td>";
    echo "<td>" . $pet_age . "</td>";
    echo "<td>" . $pet_size . "</td>";
    echo "
    </tr>
    </tbody>
    </table>";
}
?>
<h2>UPDATE PET DETAILS</h2>
<ul>
    <form name='update' action='pet.php' method='POST'>
        <li>Pets ID:</li>
        <li><input type='text' name='petid_updated'/></li>
        <li>Owner's Name</li>
        <li><input type='text' name='user_name_updated'/></li>
        <li>Pet Category:</li>
        <li><input type='text' name='pcat_name_updated'/></li>
        <li>Pet Age:</li>
        <li><input type='text' name='pcat_age_updated'/></li>
        <li>Pet Size:</li>
        <li><input type='text' name='pcat_size_updated'/></li>
    </form>
</ul>
<?php
if (isset($_POST['new'])) { // Submit the update SQL command
    $result = pg_query($db, "UPDATE pet SET pet_id = '$_POST[petid_updated]'");
    if (!$result) {
        echo "Update failed!!";
    } else {
        echo "Update successful!";
    }
}
?>