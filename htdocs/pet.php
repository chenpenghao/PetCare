<!DOCTYPE html>

<head>
    <title>Pet Info</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>li {
            list-style: none;
        }</style>

</head>
<body>

<li><a class="active" href="index.php">Home</a></li>
  <li><a href="pet_owner.php">Pet Owner</a></li>
  <li><a href="care_taker.php">Care Taker</a></li>
  <li><a href="pet.php">Pet</a></li>
  <li><a href="request.php">Request</a></li>


<h4>Supply your pet id and enter</h4>


<form name="display" action="pet.php" method="POST">
    <li>Search from Pet ID:</li>
    <li><input type="number" name="petid"/></li>
    <li><input type="submit" name="submit"></li>
    <li><input type="submit" name="create" value='Create New Pet'/></li>

</form>




<?php
// Connect to the database. Please change the password in the following line accordingly
$db = pg_connect("host=localhost port=5432 dbname=PetCare user=postgres password=12345678");



if (isset($_POST['create'])) {    // Submit the delete pet SQL command
    echo "<ul><form name='signup' action='pet.php' method='POST'>  
        <li>Owner ID:</li>  
        <li><input type='text' name='new_ownerid' /></li>   
        <li>Pet Category ID</li>  
        <li><input type='text' name='new_pcatid' /></li> 
        <li><input type='submit' name='createpet' value='Create Pet'/></li>  

        </form>  
        </ul>";

}


if (isset($_POST['createpet'])) {
    $result = pg_query($db, "INSERT INTO pet(owner_id, pcat_id) VALUES ('$_POST[new_ownerid]','$_POST[new_pcatid]');");
    if (!$result) {
        die('Query failed: ' . pg_last_error());
        echo "Creation failed!!";
    } else {
        echo "Creation successful!";
    }

}



if (isset($_POST['submit'])) {
    $result = pg_query($db, "SELECT * FROM pet WHERE pets_id = '$_POST[petid]'");   // Query template
    $row = pg_fetch_assoc($result);    // To store the result row
    echo "<ul><form name='update' action='pet.php' method='POST' >  
        <li>Pet ID:</li>  
        <li><input type='number' name='pets_id_updated' value='$row[pets_id]' /></li>  
        <li>Owner ID</li>  
        <li><input type='number' name='owner_id_updated' value='$row[owner_id]' /></li>  
        <li>Pet Category:</li>  
        <li><input type='number' name='pcat_id_updated' value='$row[pcat_id]' /></li>  
        <li><input type='submit' name='updatepet' value='Update Pet'/></li>
        <li><input type='submit' name='deletepet' value='Delete Pet'/></li>


        </form>
        </ul>";

}

if (isset($_POST['updatepet'])) {    // Submit the update pet SQL command
    $result = pg_query($db, "UPDATE pet SET (owner_id, pcat_id) = ('$_POST[owner_id_updated]', '$_POST[pcat_id_updated]') WHERE pets_id ='$_POST[pets_id_updated]'");
    if (!$result) {
        die('Query failed: ' . pg_last_error());
        echo "Update failed!!";
    } else {
        echo "Update successful!";
    }
}

if (isset($_POST['deletepet'])) {    // Submit the delete pet SQL command
    $result = pg_query($db, "DELETE FROM pet  WHERE pets_id ='$_POST[pets_id_updated]'");
    if (!$result) {
        die('Query failed: ' . pg_last_error());
        echo "Delete failed!!";
    } else {
        echo "Delete successful!";
    }
}


?>
</body>
</html>