    <?php

//Haal de DBhandlers op en maak een object van de class DbHandler
include "includes/dbHandler.php";
$db = new DbHandler();

//Check of create/edit/delete in de post zit zodat we niet gaan createn als je wilt editten o.i.d.
if (isset($_POST["create"])) {
    $db->MaakGebruiker($_POST["naam"], $_POST["leeftijd"], $_POST["email"], $_POST["telefoonnummer"]);
} elseif (isset($_POST["delete"])) {
    $db->VerwijderGebruiker($_POST["gebruikerId"]);
} elseif (isset($_POST["edit"])) {
    $db->WijzigGebruiker($_POST["gebruikerId"], $_POST["naam"], $_POST["leeftijd"], $_POST["email"], $_POST["telefoonnummer"]);
}

$gebruikerData = $db->SelecteerGebruikers();


?>
<table>
    <tr>
        <th>Id</th>
        <th>Naam</th>
        <th>Leeftijd</th>
        <th>Email</th>
        <th>Telefoonnummer</th>
        <th>Wijzigen</th>
        <th>Verwijderen</th>
    </tr>
    <?php
    //We loopen door elke buitenste array als zijnde elke rij van data uit de database
    foreach ($gebruikerData as $gebruiker) {
        echo "<tr>";
        foreach ($gebruiker as $kolom) {
            echo "<td>" . $kolom . "</td>";
        }


    ?>
        <td>
            <!-- Hier maken we een formulier met verborgen velden, zodat we de informatie door kunnen sturen naar de update pagina. -->
            <form action="update.php" method="POST">
                <input type="hidden" name="gebruikerId" value="<?= $gebruiker['gebruikerId'] ?>">
                <input type="hidden" name="naam" value="<?= $gebruiker['naam'] ?>">
                <input type="hidden" name="leeftijd" value="<?= $gebruiker['leeftijd'] ?>">
                <input type="hidden" name="email" value="<?= $gebruiker['email'] ?>">
                <input type="hidden" name="telefoonnummer" value="<?= $gebruiker['telefoonnummer'] ?>">
                <button type="submit">Edit</button>
            </form>
        </td>
        <td>
            <!-- action # ververst de huidige pagina, maar stuurt wel de data van het formulier (geberuikerId en delete) mee. -->
            <form action="#" method="POST">
                <input type="hidden" name="gebruikerId" value="<?= $gebruiker['gebruikerId'] ?>" />
                <button name="delete">Delete</button>
            </form>
        </td>
    <?php
        echo "</tr>";
    }
    ?>
</table>
<!-- We zetten de button in een form zodat hij hem doorstuurt naar de juiste pagina, een link o.i.d. zou ook kunnen natuurlijk -->
<form method="POST" action="create.php">
    <button type="submit">Create</button>
</form>