<?php
session_start();

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>page Admin</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
<img src="http://ehn.ens-lyon.fr/images/logo-lyon1.png">

<h1>Bonjour <?= $loginUser; ?></h1>

<h3>Vos équipes : </h3>
<ul>
    <?php
    foreach ($listTeam as $team) {
        echo $this->Form->create($team);
        echo "<li>";
        echo $team->teamname . "<br>";
        echo $this->Form->button("Infos", ['type' => 'button']);
        echo "</li>";
        echo $this->Form->end();
    }

    ?>
</ul>

<h3>Vos tournois : </h3>
<ul>
    <?php
    foreach ($listTournament as $tournament) {
        echo $this->Form->create($tournament);
        echo "<li>" . $tournament->tournamentname . "</li>";
        echo $this->Form->button("Infos", ['type' => 'button']);
        echo $this->Form->end();
    }

    echo $this->Form->end();
    ?>
</ul>

</body>
</html>
