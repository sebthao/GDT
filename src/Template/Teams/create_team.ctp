<?php

echo $this->Form->create($this, ['url' => ['action' => 'returnAdmin']]);
echo $this->Form->button('Retour');
echo $this->Form->end();


echo $this->Form->create($this, ['url' => ['action' => 'teamVerification']]);
for ( $iteratorNbSportif=0 ;$iteratorNbSportif < $nbSportif;$iteratorNbSportif++){

    echo $this->Form->control('Joueur '.($iteratorNbSportif+1),array('type'=>'select','options'=>$arraySportif));
}

echo $this->Form->button('Terminer');
echo $this->Form->end();

?>