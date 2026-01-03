<?php
// Het is vaak handig om een var_dump te gebruiken van de doorgestuurde data, zodat je weet welke data je beschikbaar hebt
//var_dump($_POST);
?>
<form action="index.php" method="POST">
    <input type="hidden" name="gebruikerId" value="<?= $_POST['gebruikerId'] ?>">
    <input type="text" name="naam" value="<?= $_POST['naam'] ?>">
    <input type="number" name="leeftijd" value="<?= $_POST['leeftijd'] ?>">
    <input type="text" name="email" value="<?= $_POST['email'] ?>">
    <input type="text" name="telefoonnummer" value="<?= $_POST['telefoonnummer'] ?>">
    <button type="submit" name="edit">Edit</button>
</form>