<?php
echo $this->Form->create($this, ['url' => ['action' => 'watchUsers']]);
echo $this->Form->button('Retour');
echo $this->Form->end();


echo $this->Form->create($this, ['url' => ['action' => 'verifyModifyUser',$idUserToModify]]);
echo $this->Form->control('name', ['label' => 'Nouveau nom', 'required' => 'true', 'placeholder' => 'ex: user01']);
echo $this->Form->control('password', ['label' => 'Nouveau Mot de passe', 'required' => 'true', 'placeholder' => 'ex: 1234']);
echo $this->Form->control('role', ['label' => 'Nouveau role', 'required' => 'true', 'placeholder' => '1= Sportif 2= Administrateur']);
echo $this->Form->button('Terminer');