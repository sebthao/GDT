<?php

echo $this->Form->create($this, ['url' => ['action' => 'returnAdmin']]);
echo $this->Form->button('Retour');
echo $this->Form->end();


echo $this->Form->create($this, ['url' => ['action' => 'createTeam']]);
echo $this->Form->control('nbSportif',['label'=>'nombre de sportif','required'=>'true','placeholder'=>'max: 999']);
echo $this->Form->button('Terminer');
echo $this->Form->end();

?>