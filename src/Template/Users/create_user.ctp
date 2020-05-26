<?php

echo $this->Form->create($this, ['url' => ['action' => 'adminSight']]);
echo $this->Form->button('Retour');
echo $this->Form->end();

echo $this->Form->create($this, ['url' => ['action' => 'verifyCreateUser']]);
echo $this->Form->control('login', ['label' => 'nom de l\'utilisateur', 'required' => 'true', 'placeholder' => 'ex: user01']);
echo $this->Form->control('password', ['label' => 'Mot de passe', 'required' => 'true', 'placeholder' => 'ex: motdepasse']);
echo $this->Form->button('Terminer');
echo $this->Form->end();