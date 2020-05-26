<?php


namespace App\Controller;
use Cake\ORM\TableRegistry;



class SportsController extends AppController
{
    public function createSport()
    {
        $session = $this->getRequest()->getSession();
        $write0OkSession=$session->write('okSession',0);
        $readOkSession=$session->read('okSession');
    }

    public function watchSports()
    {
        $allSports=$this->Sports
            ->find()
            ->toArray();
        $this->set('allSports',$allSports);
    }

    public function suppressSport($idSportToDelete){
        $allSports=$this->Sports
            ->find()
            ->toArray();

        foreach ($allSports as $sport){
            if($idSportToDelete==$sport->id){
                $this->Sports->delete($this->Sport->get($sport->id));
                $this->Flash->success('le sport '. $sport->sportname.' a bien été supprimé');
            }
        }
        $this->setAction('adminSight');
    }

    public function modifySport($idSportToModify){
        $this->set('idSportToModify',$idSportToModify);
    }
    public function verifyModifySport($idSportToModify)
    {

        $allSports = $this->Sports
            ->find()
            ->toArray();

        foreach ($allSports as $sport) {
            if ($idSportToModify == $sport->id) {
                $sportAfterModify = $this->Sports->get($idSportToModify);
                $sportAfterModify->id = $idSportToModify;
                $sportAfterModify->sportname = $this->getRequest()->getData('sportname');
                $sportAfterModify->nbSet = $this->getRequest()->getData('nbSet');
                $sportAfterModify->ptsMax = $this->getRequest()->getData('ptsMax');
                $sportAfterModify->nbEquipe = $this->getRequest()->getData('nbEquipe');
                if($this->Sports->save($sportAfterModify)){
                    $this->Flash->success('sport bien modifié');
                    return $this->redirect(['controller' => 'sports', 'action' => 'returnAdmin']);
                }
            }
        }
    }


    public function sportsVerification()
    {
        $dataFromNewSport=$this->request;
        $sportname=$dataFromNewSport->getData('sportname');
        $nbSet=$dataFromNewSport->getData('nbSet');
        $ptsMax=$dataFromNewSport->getData('ptsMax');
        $nbEquipe=$dataFromNewSport->getData('nbEquipe');

        var_dump($dataFromNewSport->getData());echo "<br>";

        $newSport = $this->Sports->NewEntity();
        $newSport->sportname = $sportname;
        $newSport->nbSet = (int)$nbSet;
        $newSport->ptsMax = (int)$ptsMax;
        $newSport->nbEquipe = (int)$nbEquipe;
        var_dump($newSport);echo "<br>";
        $session=$this->getRequest()->getSession();
        $session->write('okSession',1);
        $session->write('poster',1);

        if ((int)$nbSet>999 || (int)$nbSet<1){
            $this->Flash->error('Veuillez inscrire un nombre set valide');
            $this->setAction('createSport');
            $session->write('poster',0);
        }
        if ((int)$ptsMax>999 || (int)$ptsMax<1){
            $this->Flash->error('Veuillez inscrire un nombre de point maximum valide');
            $this->setAction('createSport');
        }else{
            $session->write('poster'," ");
        }
        if ((int)$nbEquipe>999 || (int)$nbEquipe<1){
            $this->Flash->error('Veuillez inscrire un nombre d\'équipe se faisant face valide');
            $this->setAction('createSport');
        }else{
            $session->write('poster'," ");
        }

        if ($session->read('poster')<>0){
            if($this->Sports->save($newSport)){
                $this->setAction('returnAdmin');
                $this->Flash->success('un nouveau sport: '.$sportname.' a été ajouté.');
            }

        }else{
            $this->setAction('createsport');
            $this->Flash->error('le sport: '.$sportname.' n\'a pas été ajouté.');
        }


    }

    public function returnAdmin()
    {
        $this->redirect(['controller' => 'users', 'action' => 'adminSight']);
    }
}