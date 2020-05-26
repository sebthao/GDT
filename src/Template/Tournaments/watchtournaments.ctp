<?php

echo $this->Form->create($this, ['url' => ['action' => 'returnAdmin']]);
echo $this->Form->button('Retour');
echo $this->Form->end();

foreach ($allTournaments as $tournament){
    echo "Id: ". $tournament->id. " Nom du tournoi: ". $tournament->tournamentname;
    echo $this->Form->create($this, ['url' => ['action' => 'modifyTournament', $tournament->id]]);
    echo $this->Form->button('Modifier');
    echo $this->Form->end();

    echo $this->Form->create($this, ['url' => ['action' => 'suppressTournament', $tournament->id]]);
    echo $this->Form->button('Supprimer');
    echo $this->Form->end();

    echo $this->Form->create($this, ['url' => ['action' => 'rankingsTournament', $tournament->id]]);
    echo $this->Form->button('Voir Classement');
    echo $this->Form->end();

    echo $this->Form->create($this, ['url' => ['action' => 'matchHistorical', $tournament->id]]);
    echo $this->Form->button('Historique des matchs');
    echo $this->Form->end();

}

?>