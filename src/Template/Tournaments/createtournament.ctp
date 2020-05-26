<?php

echo $this->Form->create($this, ['url' => ['action' => 'returnAdmin']]);
echo $this->Form->button('Retour');
echo $this->Form->end();

echo $this->Form->create($this, ['url' => ['action' => 'beforeCreateTournament']]);
echo $this->Form->control('tournamentname', ['label' => 'Nom du tournoi', 'required' => 'true', 'placeholder' => 'ex: Tournoi']);
echo $this->Form->button('Terminer');
echo $this->Form->end();

?>