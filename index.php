<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=form;charset=utf8', 'root', '');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naiss = $_POST['date_naiss'];
    $adresse = $_POST['adresse'];
    $canton = $_POST['canton'];
    $assurance = $_POST['assurance'];
    $assure_depuis = $_POST['assure_depuis'];

    // Préparer et exécuter la requête SQL pour insérer les données dans la table
    $sql = "INSERT INTO articles (nom, prenom, date_naiss, adresse, canton, assurance, assure_depuis)
    VALUES (:nom, :prenom, :date_naiss, :adresse, :canton, :assurance, :assure_depuis)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':date_naiss', $date_naiss);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':canton', $canton);
    $stmt->bindParam(':assurance', $assurance);
    $stmt->bindParam(':assure_depuis', $assure_depuis);

    if ($stmt->execute()) {
        echo "Les données ont été insérées avec succès dans la table 'formulaires'.";
    } else {
        echo "Erreur: " . $stmt->errorInfo()[2];
    }
}
?>
<script>
        function validateForm() {
            // Regex pour valider les champs
            let nomPrenomRegex = /^[a-zA-Z\s'-]+$/;
            let adresseRegex = /^[a-zA-Z0-9\s,'/-]+$/;
            let cantonRegex = /^[a-zA-Z\s'-]+$/;
            let assuranceRegex = /^[a-zA-Z0-9\s'-]+$/;

            // Récupération des valeurs des champs
            let nom = document.getElementById("nom").value;
            let prenom = document.getElementById("prenom").value;
            let dateNaissance = document.getElementById("date_naiss").value;
            let adresse = document.getElementById("adresse").value;
            let canton = document.getElementById("canton").value;
            let assurance = document.getElementById("assurance").value;
            let assureDepuis = document.getElementById("assure_depuis").value;

            // Validation des champs
           
            if (!nomPrenomRegex.test(nom)) {
                alert("Le nom doit contenir uniquement des lettres, des espaces et des traits d'union.");
                return false;
            }

            if (!nomPrenomRegex.test(prenom)) {
                alert("Le prénom doit contenir uniquement des lettres, des espaces et des traits d'union.");
                return false;
            }

            if (!adresseRegex.test(adresse)) {
                alert("L'adresse doit contenir uniquement des lettres, des chiffres, des espaces, des virgules, des traits d'union et des slashs.");
                return false;
            }

            if (!cantonRegex.test(canton)) {
                alert("Le canton doit contenir uniquement des lettres, des espaces et des traits d'union.");
                return false;
            }

            if (!assuranceRegex.test(assurance)) {
                alert("L'assurance doit contenir uniquement des lettres, des chiffres, des espaces et des traits d'union.");
                return false;
            }

            // Si toutes les validations sont réussies, on soumet le formulaire
            return true;
        }
    </script>
<!DOCTYPE html>
<html>
<head>
    <title>Formulaire d'informations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Formulaire d'informations</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validateForm()">
       

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="date_naissance">Date de naissance :</label>
        <input type="date" id="date_naiss" name="date_naiss" required><br><br>

        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" required><br><br>

        <label for="canton">Canton :</label>
        <input type="text" id="canton" name="canton" required><br><br>

        <label for="assurance">Assurance :</label>
        <input type="text" id="assurance" name="assurance" required><br><br>

        <label for="assure_depuis">Assuré depuis :</label>
        <input type="date" id="assure_depuis" name="assure_depuis" required><br><br>

        <input type="submit" value="Envoyer">
    </form>

    <script>
        function validateForm() {
            // Regex pour valider les champs
            let nomPrenomRegex = /^[a-zA-Z\s'-]+$/;
            let adresseRegex = /^[a-zA-Z0-9\s,'/-]+$/;
            let cantonRegex = /^[a-zA-Z\s'-]+$/;
            let assuranceRegex = /^[a-zA-Z0-9\s'-]+$/;

            // Récupération des valeurs des champs
            let nom = document.getElementById("nom").value;
            let prenom = document.getElementById("prenom").value;
            let dateNaissance = document.getElementById("date_naiss").value;
            let adresse = document.getElementById("adresse").value;
            let canton = document.getElementById("canton").value;
            let assurance = document.getElementById("assurance").value;
            let assureDepuis = document.getElementById("assure_depuis").value;

            // Validation des champs
            if (!nomPrenomRegex.test(nom)) {
                alert("Le nom doit contenir uniquement des lettres, des espaces et des traits d'union.");
                return false;
            }

            if (!nomPrenomRegex.test(prenom)) {
                alert("Le prénom doit contenir uniquement des lettres, des espaces et des traits d'union.");
                return false;
            }

            if (!adresseRegex.test(adresse)) {
                alert("L'adresse doit contenir uniquement des lettres, des chiffres, des espaces, des virgules, des traits d'union et des slashs.");
                return false;
            }

            if (!cantonRegex.test(canton)) {
                alert("Le canton doit contenir uniquement des lettres, des espaces et des traits d'union.");
                return false;
            }

            if (!assuranceRegex.test(assurance)) {
                alert("L'assurance doit contenir uniquement des lettres, des chiffres, des espaces et des traits d'union.");
                return false;
            }

            // Si toutes les validations sont réussies, on soumet le formulaire
            return true;
        }
    </script>

</body>
</html>