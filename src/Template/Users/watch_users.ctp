<?php

echo $this->Form->create($this, ['url' => ['action' => 'adminSight']]);
echo $this->Form->button('Retour');
echo $this->Form->end();

foreach ($allUsers as $user){
        echo "Id: ".$user->id." Name: ". $user->login." password: ". $user->password." role: ";
        if ($user->role_id==1){
            echo "sportif";
        }else if($user->role_id==2){
            echo "administrateur";
        }
    echo $this->Form->create($this, ['url' => ['action' => 'suppressUser',$user->id]]);
    echo $this->Form->button('Supprimer');
    echo $this->Form->end();
    echo $this->Form->create($this, ['url' => ['action' => 'modifyUser',$user->id]]);
    echo $this->Form->button('Modifier');
    echo $this->Form->end();
}
?>