<?php


$loginUser = $this->request->getData('loginUser');
echo $this->Form->create($this, ['url' => ['action' => 'verification']]);

echo "Bonjour " . $loginUser;
echo "<legend class=\"mid\">Que souhaitez-vous faire?</legend>";
echo "<img src=\"http://ehn.ens-lyon.fr/images/logo-lyon1.png\">" . "<br>";
echo $this->Form->end();


echo $this->Form->create($this, ['url' => ['action' => 'CreateUser']]);
echo $this->Form->button('Creer Joueur');
echo $this->Form->end();

echo $this->Form->create($this, ['url' => ['action' => 'CreateTeam']]);
echo $this->Form->button('Creer groupe');
echo $this->Form->end();
echo $this->Form->end();

echo $this->Form->create($this, ['url' => ['action' => 'CreateSport']]);
echo $this->Form->button('Creer Sports');
echo $this->Form->end();

echo $this->Form->create($this, ['url' => ['action' => 'CreateTournament']]);
echo $this->Form->button('Creer Tournois');
echo $this->Form->end();

echo $this->Form->create($this, ['url' => ['action' => 'WatchUsers']]);
echo $this->Form->button('Voir Joueurs');
echo $this->Form->end();

echo $this->Form->create($this, ['url' => ['action' => 'WatchTeams']]);
echo $this->Form->button('Voir groupes');
echo $this->Form->end();

echo $this->Form->create($this, ['url' => ['action' => 'WatchSports']]);
echo $this->Form->button('Voir Sports');
echo $this->Form->end();

echo $this->Form->create($this, ['url' => ['action' => 'WatchTournaments']]);
echo $this->Form->button('Voir Tournois');
echo $this->Form->end();


?>
