<?php

echo $this->Form->create($this, ['url' => ['action' => 'watchtournaments']]);
echo $this->Form->button('Retour');
echo $this->Form->end();


echo $this->Form->create($this, ['url' => ['action' => 'beforeModifyTournament',$idTournamentToModify]]);
echo $this->Form->control('tournamentname', ['label' => 'Nouveau nom du tournoi', 'required' => 'true', 'placeholder' => 'ex: Tournoi']);
echo $this->Form->button('Terminer');
echo $this->Form->end();

?>