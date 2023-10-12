<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="style.css"> <!-- Ajoutez cette ligne pour lier le fichier CSS -->
</head>
<body>

<?php
session_start();
if (isset($_POST['register'])) {
    if (isset($_POST['email']) && isset($_POST['mdp'])) {
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];

        $nom_serveur = "localhost";
        $utilisateur = "root";
        $mot_de_passe = "";
        $nom_base_donnees = "formulaire";
        $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_donnees);

        // Vérifiez si l'utilisateur existe déjà
        $check_query = "SELECT * FROM utilisateurs WHERE email = '$email'";
        $check_result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $erreur = "Cet utilisateur existe déjà. Veuillez vous connecter.";
        } else {
            // Insérer un nouvel utilisateur
            $insert_query = "INSERT INTO utilisateurs (email, mdp) VALUES ('$email', '$mdp')";
            $result = mysqli_query($con, $insert_query);

            if ($result) {
                header("Location: bienvenu.php");
                $_SESSION['email'] = $email;
            } else {
                $erreur = "Erreur lors de l'inscription : " . mysqli_error($con);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Mettez ici vos balises meta, titre et liens vers les feuilles de style -->
</head>
<body>
    <section>
        <h1>Créer un compte</h1>
        <?php
        if (isset($erreur)) {
            echo "<p class='Erreur'>" . $erreur . "</p>";
        }
        ?>
    <form action="" method="POST">
        <label>Adresse Mail</label>
        <input type="text" name="email">
        <label>Mots de Passe</label>
        <input type="password" name="mdp">
        <input type="submit" value="S'inscrire" name="register">
    </form>
    <p>Si vous avez déjà un compte, <a href="http://localhost/Formulaire/">revenez à la page d'accueil</a>.</p>
</section>
</body>
</html>
