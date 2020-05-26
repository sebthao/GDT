<?php


namespace App\Controller;


class TeamsController extends AppController
{


    public function beforeCreateTeam()

    {
    }
    public function createTeam()

    {
        $nbSportif=$this->getRequest()->getData('nbSportif');
        $this->getRequest()->getSession()->write('nbSportif',$nbSportif);
        $allSportifs=$this->Teams->Users
            ->find()
            ->toArray();
        $arraySportif=array();
        foreach($allSportifs as $sportif){
            array_push($arraySportif,$sportif->login);
        }
        $this->set(compact('arraySportif','nbSportif'));

    }


    public function watchTeams()
    {
        $allTeams=$this->Teams
            ->find()
            ->toArray();

        $this->set('allTeams',$allTeams);
    }

    public function suppressTeam($idTeamToDelete){
        $allTeams=$this->Teams
            ->find()
            ->toArray();

        foreach ($allTeams as $team){


            if($idTeamToDelete==$team->id){
                $this->User->delete($this->User->get($team->id));
                $this->Flash->success('l\'utilisateur '. $team->teamname.' a bien été supprimé');
            }
        }
        $this->setAction('returnAdmin');
    }
    public function teamVerification()
    {
        $newArray=$this->getRequest()->getData();

        $nbJoueur=$this->getRequest()->getSession()->read('nbSportif');
        for ($iteratorNbJoueur=1;$iteratorNbJoueur<$nbJoueur;$iteratorNbJoueur++){
            for ($iteratorNbJoueur2=1;$iteratorNbJoueur2<$nbJoueur;$iteratorNbJoueur2++){
                if($iteratorNbJoueur!=$iteratorNbJoueur2 && ($_POST['Joueur_'.$iteratorNbJoueur]=='Joueur_'.$iteratorNbJoueur)){
                    $this->Flash->error('veuillez mettre des joueurs différents');
                    $this->setAction('adminSight');
                }
            }
        }
        $this->setAction('createTeam');
    }

    public function returnAdmin()
    {
        $this->redirect(['controller' => 'users', 'action' => 'adminSight']);
    }
}