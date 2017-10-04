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
    <form name="display" action="pets.php" method="POST">
        <li>Book ID:</li>
        <li><input type="text" name="pets_id"/></li>
        <li><input type="submit" name="submit"/></li>
    </form>
</ul>
<?php
// Connect to the database. Please change the password in the following line accordingly
$db = pg_connect("host=localhost port=5432 dbname=PetCare user=postgres password=12345678");
$result = pg_query($db,
    "SELECT p.pets_id AS pid, u.name AS uname, pc.size AS pcsize, pc.age AS pcage, pc.name AS pcname
         FROM pet AS p, user AS u, petcategory AS pc,
         WHERE p.pets_id = '$_POST[pets_id]'
         AND u.user_id = p.pets_id
         AND pc.pcat_id = p.pcat_id");        // Query template
$row = pg_fetch_assoc($result);        // To store the result row
if (isset($_POST['submit'])) {
    echo "<ul><form name='update' action='pets.php' method='POST' >  
    	<li>Pets ID:</li>  
    	<li><input type='text' name='petid_updated' value='$row[pid]' /></li>  
    	<li>User Name</li>  
    	<li><input type='text' name='user_name_updated' value='$row[uname]' /></li>  
    	<li>Pet Category Size:</li><li><input type='text' name='size_updated' value='$row[pcsize]' /></li>  

    	</form>  
    	</ul>";
}
if (isset($_POST['new'])) {    // Submit the update SQL command
    $result = pg_query($db, "UPDATE pet SET pets_id = '$_POST[petid_updated]'");
    if (!$result) {
        echo "Update failed!!";
    } else {
        echo "Update successful!";
    }
}
?>