<?php

class DbHandler
{
    // De verbinding naar de juiste database en host
    private $dataSource = "mysql:dbname=democrud;host=localhost;";

    // De login gegevens voor je database
    private $userName = "root";
    private $password = "";

    public function SelecteerGebruikers()
    {
        // PDO is het object waarmee we een verbinding naar de database hebben
        $pdo = new PDO($this->dataSource, $this->userName, $this->password);

        // Prepare maakt een query waar we eventueel parameters aan toe kunnen voegen.
        $statement = $pdo->prepare("SELECT * FROM gebruikers");

        // Execute voert de query uit
        $statement->execute();

        // Fetch haalt de informatie op uit het resultaat van de query, in dit geval is dat een associatieve array
        // Vandaar Fetch_Assoc
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function MaakGebruiker(string $naam, int $leeftijd, string $email, string $telefoon){
        $pdo = new PDO($this->dataSource, $this->userName, $this->password);

        // :naam en dergelijke zijn Parameters, door de bindParam worden deze vervangen met onze variabelen.
        // Let op dat je altijd evenvaak bindParam doe als de hoeveelheid parameters in je query anders krijg je errors
        // Bij bindParam dien je ook het juiste type op te geven van de parameter.
        $statement = $pdo->prepare("INSERT INTO gebruikers(naam,leeftijd,email,telefoonnummer) VALUES(:naam, :leeftijd, :email, :telefoonnummer)");
        $statement->bindParam("naam", $naam, PDO::PARAM_STR);
        $statement->bindParam("leeftijd", $leeftijd, PDO::PARAM_INT);
        $statement->bindParam("email", $email, PDO::PARAM_STR);
        $statement->bindParam("telefoonnummer", $telefoon, PDO::PARAM_STR);
        $statement->execute();
    }

    public function VerwijderGebruiker(int $gebruikersId){
        try{
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("DELETE FROM gebruikers WHERE gebruikerId = :gebruikerId");
            $statement->bindParam("gebruikerId", $gebruikersId, PDO::PARAM_STR);
            $statement->execute();
        }
        catch(PDOException $e){
            // Als er een foutmelding op treedt, of je ziet niets gebeuren, var dump de foutmelding zodat je
            // hem kunt lezen.
            // var_dump($e);
        }
    }

    public function WijzigGebruiker($gebruikersId, $naam, $leeftijd, $email, $telefoon){
        $pdo = new PDO($this->dataSource, $this->userName, $this->password);

        // :naam en dergelijke zijn Parameters, door de bindParam worden deze vervangen met onze variabelen.
        // Let op dat je altijd evenvaak bindParam doe als de hoeveelheid parameters in je query anders krijg je errors
        // Bij bindParam dien je ook het juiste type op te geven van de parameter.
        $statement = $pdo->prepare("UPDATE gebruikers SET naam=:naam, leeftijd=:leeftijd, email=:email, telefoonnummer=:telefoonnummer WHERE gebruikerId = :id");
        $statement->bindParam("naam", $naam, PDO::PARAM_STR);
        $statement->bindParam("leeftijd", $leeftijd, PDO::PARAM_INT);
        $statement->bindParam("email", $email, PDO::PARAM_STR);
        $statement->bindParam("telefoonnummer", $telefoon, PDO::PARAM_STR);
        $statement->bindParam("id", $gebruikersId, PDO::PARAM_INT);
        $statement->execute();
    }
}
