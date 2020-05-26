<?php

echo $this->Form->create($this, ['url' => ['action' => 'adminSight']]);
echo $this->Form->button('Retour');
echo $this->Form->end();

echo $this->Form->create($this, ['url' => ['action' => 'createUser']]);
echo $this->Form->control('name', ['label' => 'Nom de joueur', 'required' => 'true', 'placeholder' => 'ex: user01']);

echo $this->Form->button('Terminer');
echo $this->Form->end();