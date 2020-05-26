<?php
echo $this->Form->create($this, ['url' => ['action' => 'returnAdmin']]);
echo $this->Form->button('Retour');
echo $this->Form->end();


echo $this->Form->create($this, ['url' => ['action' => 'verifyModifySport',$idSportToModify]]);
echo $this->Form->control('sportname', ['label' => 'Nouveau nom', 'required' => 'true', 'placeholder' => 'ex: user01']);
echo $this->Form->control('nbSet', ['label' => 'Nouveau nombre de set', 'required' => 'true', 'placeholder' => 'ex: 1234']);
echo $this->Form->control('ptsMax', ['label' => 'Nouveau nombre de point max', 'required' => 'true', 'placeholder' => 'ex: 42']);
echo $this->Form->control('nbEquipe', ['label' => 'Nouveau nombre d\'équipe se faisant face', 'required' => 'true', 'placeholder' => '3']);

echo $this->Form->button('Terminer');