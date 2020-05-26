<?php

echo $this->Form->create($this, ['url' => ['action' => 'returnAdmin']]);
echo $this->Form->button('Retour');
echo $this->Form->end();

foreach ($allSports as $sport){
    echo "id: ".$sport->id." Nom du sport: ". $sport->sportname.
        " nombre de set: ".$sport->nsSet.
        " nombre de point max: ".$sport->ptsMax.
        " nombre d\'équipes se faisant face: ".$sport->nbEquipe;
    echo $this->Form->create($this, ['url' => ['action' => 'suppressSport',$sport->id]]);
    echo $this->Form->button('Supprimer');
    echo $this->Form->end();

    echo $this->Form->create($this, ['url' => ['action' => 'modifySport',$sport->id]]);
    echo $this->Form->button('Modifier');
    echo $this->Form->end();
}
?>