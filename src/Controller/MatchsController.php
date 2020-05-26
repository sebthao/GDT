<?php


namespace App\Controller;


use Cake\ORM\TableRegistry;

class MatchsController extends AppController
{

    public function Historical($idTournament){
        $allMatchsTeams = TableRegistry::getTableLocator()->get('MatchsTeams')
            ->find()
        ;
        $allMatchsInTournament = TableRegistry::getTableLocator()->get('Matchs')
            ->find()
            ->select(['id','datematch'])
            ->where(['tournament_id'=>$idTournament]);
        $allTeamsTournaments = TableRegistry::getTableLocator()->get('TeamsTournaments')->find();
        $allTeams = TableRegistry::getTableLocator()->get('TeamsTournaments')->find();
        $arrayTeamsInTournament=array();

        foreach($allTeamsTournaments as $team){
            if ($team->tournament_id==$idTournament)
                array_push($arrayTeamsInTournament,$team->team_id);
        }

        foreach($allTeamsTournaments as $teamTournament){
            foreach($arrayTeamsInTournament as $elementTeamTournament) {
                if ($teamTournament->team_id == $elementTeamTournament) {
                    array_push($arrayAlreadyDone,$elementTeamTournament);
                }
            }
        }

        foreach($allTeams as $team){
        }

        $this->set(compact('allMatchsTeams','allMatchsInTournament','allTeams','idTournament'));

    }


    public function watchTournaments(){
        $this->redirect(['controller'=>'Tournaments' , 'action'=>'watchtournaments']);
    }
}