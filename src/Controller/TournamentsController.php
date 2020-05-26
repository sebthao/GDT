<?php


namespace App\Controller;


use Cake\ORM\TableRegistry;

class TournamentsController extends AppController
{


    public function watchTournaments(){
        $allTournaments=$this->Tournaments
            ->find()
            ->toArray();
        $this->set('allTournaments',$allTournaments);
    }
    public function createTournament(){

    }
    public function beforeCreateTournament(){
        $newTournament=$this->Tournaments->newEntity();
        $newTournament->tournamentname=$_POST['tournamentname'];
        if($this->Tournaments->save($newTournament)){
            $this->Flash->success('le tournoi a bien été créé');

        }else{
            $this->Flash->error('le tournoi n\'a pas été créé');
        }
        $this->setAction('returnAdmin');
    }


    public function modifyTournament($idTournamentToModify){
    $this->set('idTournamentToModify',$idTournamentToModify);
    }

    public function beforeModifyTournament($idTournamentToModify){
        $TournamentToModify=$this->Tournaments->get($idTournamentToModify);
        $TournamentToModify->tournamentname = $_POST['tournamentname'];
        if($this->Tournaments->save($TournamentToModify)){
            $this->Flash->success('tournoi modifié, nouveau nom: '.$TournamentToModify->tournamentname);
            $this->setAction('returnAdmin');
        }else{
            $this->Flash->success('tournoi non modifié, retour à la page d\'acceuil');
            $this->setAction('returnAdmin');
        }
    }

    public function suppressTournament($idTournamentToSuppress){
        if($this->Tournaments->delete($this->Tournaments->get($idTournamentToSuppress))){
            $this->Flash->success('tournoi supprimé');
        }else{
            $this->Flash->error('tournoi non supprimé, reetour à la page d\'accueil');
        }
        $allTeamTournaments = TableRegistry::getTableLocator()->get('TeamsTournaments')->find();
        foreach($allTeamTournaments as $teamTournaments){
            if($teamTournaments->tournament_id == $idTournamentToSuppress){
                if($this->Tournaments->TeamsTournaments->delete($this->Tournaments->TeamsTournaments->get($teamTournaments->id))){
                    $this->Flash->success('groupe bien supprimé du tournoi');
                }else{
                    $this->Flash->error('groupe non supprimé');

                }
            }
        }
        $this->setAction('returnAdmin');

    }
    public function matchHistorical($idTournament){
        return $this->redirect(['controller' => 'Matchs', 'action'=> 'Historical',$idTournament]);
    }

    public function verifySuppressTournament(){

    }

    public function rankingsTournament($idTournament){
        $allTeamTournaments = TableRegistry::getTableLocator()->get('TeamsTournaments')->find();
        $allTeams= TableRegistry::getTableLocator()->get('Teams')->find();
        $teamsInTournament=array();
        foreach($allTeamTournaments as $team) {
            if ($team->tournament_id == $idTournament) {
                array_push($teamsInTournament, $team->team_id);
            }
        }
        $this->set(compact('teamsInTournament','allTeams','allTeamTournaments'));
    }

    public function returnAdmin()
    {
        $this->redirect(['controller' => 'users', 'action' => 'adminSight']);
    }
}