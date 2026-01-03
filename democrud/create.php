<form method="POST" action="index.php">
    <input name="naam" placeholder="naam" type="text"/>
    <input name="leeftijd" placeholder="leeftijd" type="number"/>
    <input name="email" placeholder="email@mail.com" type="email"/>
    <input name="telefoonnummer" placeholder="telefoonnummer" type="text"/>
    <!-- de name/value van create geven we mee zodat we kunnen controleren of de formdata afkomstig is van deze pagina -->
    <button type="submit" name="create" value="create">Create</button>
</form>