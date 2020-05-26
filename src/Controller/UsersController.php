<?php

namespace App\Controller;

use App\Model\Table\TeamsUsersTable;
use Cake\Controller\Controller;
use PHPUnit\Framework\Assert;
use Cake\ORM\TableRegistry;


class UsersController extends AppController
{

    public function index()
    {

    }

    public function watchTournaments()
    {
        $this->redirect(['controller' => 'tournaments', 'action' => 'watchtournaments']);
    }

    public function createTournament()
    {
        $this->redirect(['controller' => 'tournaments', 'action' => 'createtournament']);
    }

    public function watchSports()
    {
        $this->redirect(['controller' => 'sports', 'action' => 'watchsports']);
    }

    public function createSport()
    {
        $this->redirect(['controller' => 'sports', 'action' => 'createsport']);
    }

    public function watchTeams()
    {
        $this->redirect(['controller' => 'teams', 'action' => 'watchteams']);
    }

    public function createTeam()
    {
        $this->redirect(['controller' => 'teams', 'action' => 'beforeCreateTeam']);
    }

    public function watchUsers()
    {
        $allUsers = TableRegistry::getTableLocator()->get('Users')->find();
        $allRoles = TableRegistry::getTableLocator()->get('Roles')->find();
        $this->set(compact('allUsers', 'allRoles'));

    }

    public function suppressUser($idUserToDelete)
    {
        $allUsers = $this->Users
            ->find()
            ->toArray();
        $allTeamsUsers = TableRegistry::getTableLocator()->get('TeamsUsers')->find();

        $allRolesUsers = TableRegistry::getTableLocator()->get('RolesUsers')->find();

        foreach ($allUsers as $user) {
            if ($idUserToDelete == $user->id) {
                if ($this->Users->delete($this->Users->get($user->id))) {
                    $this->Flash->success('l\'utilisateur ' . $user->login . ' a bien été supprimé dans les utilisateurs');
                } else {
                    $this->Flash->error('l\'utilisateur ' . $user->login . ' n\'a pas été supprimé dans les utilisateurs');
                }

            }
        }
        foreach ($allTeamsUsers as $teamUser) {
            if ($idUserToDelete == $teamUser->user_id) {
                if ($this->Users->TeamsUsers->delete($teamUser->id)) {
                    $this->Flash->success('l\'utilisateur ' . $user->login . ' a bien été supprimé dans son groupe');
                } else {
                    $this->Flash->error('l\'utilisateur ' . $user->login . ' n\'a pas été supprimé dans son groupe');
                }
            }
        }
        foreach ($allRolesUsers as $roleUser) {
            if ($idUserToDelete == $roleUser->user_id) {
                if ($this->Users->RolesUsers->delete($roleUser->id)) {
                    $this->Flash->success('le role de \'utilisateur ' . $user->login . ' a bien été supprimé');
                } else {
                    $this->Flash->error('le role de l\'utilisateur ' . $user->login . ' n\'a pas été supprimé');
                }
            }
        }
        $this->setAction('adminSight');

    }


    public function beforeCreateUser()
    {

    }

    public function createUser()
    {

    }

    public function verifyCreateUser()
    {
        $newUser = $this->Users->newEntity();
        $newUser->login = $this->getRequest()->getData('login');
        $newUser->password = $this->getRequest()->getData('password');
        $allUsers = $this->Users
            ->find()
            ->toArray();
        $canCreate = true;
        foreach ($allUsers as $user) {
            if ($user->login == $newUser->login && !is_null($newUser->login)) {
                $canCreate = false;
            }
        }
        if ($canCreate) {
            if ($this->Users->save($newUser)) {
                $this->Flash->success('Nouveau utilisateur ' . $newUser->login . ' créé');
                $this->setAction('adminSight');
            } else {
                $this->Flash->error('Erreur lors de la sauvegarde de l\'utilisateur' . $newUser->login);
                $this->setAction('createUser');
            }
        } else {
            $this->Flash->error('L\'identifiant ' . $newUser->login . ' existe déjà, veuillez le remplacer par un autre');
            $this->setAction('createUser');
        }


    }


    public function modifyUser($idUserToModify)
    {
        $this->set('idUserToModify', $idUserToModify);
    }

    public function verifyModifyUser($idUserToModify)
    {
        $allUsers = $this->Users
            ->find()
            ->toArray();

        foreach ($allUsers as $user) {
            if ($idUserToModify == $user->id) {
                $userAfterModify = $this->Users->get($idUserToModify);
                $userAfterModify->id = $idUserToModify;
                $userAfterModify->login = $this->getRequest()->getData('login');
                $userAfterModify->password = $this->getRequest()->getData('password');
                $userAfterModify->role_id = $this->getRequest()->getData('role');
                if ($this->Users->save($userAfterModify)) {
                    $this->Flash->success('User bien modifié');
                    return $this->redirect(['controller' => 'Users', 'action' => 'adminSight']);
                }else{
                    $this->Flash->success('User non modifié, retour à la page d\'accueil');
                    return $this->redirect(['controller' => 'Users', 'action' => 'adminSight']);
                }
            }
        }
    }

    public function home()
    {
    }

    public function adminSight()
    {

        $teams = $this->Users->Teams
            ->find()
            ->toArray();

        $sports = $this->Users->Teams->Sports
            ->find()
            ->toArray();

        $loginUser = $this->request
            ->getData("loginUser");

        if (!is_null($teams) && !is_null($loginUser) && !is_null($sports)) {
            $this->set(compact('loginUser', 'teams', 'sports'));
        }


    }

    public function userSight()
    {
        $listTeamId = array();
        $listTeam = array();
        $listTournamentId = array();
        $listTournament = array();
        $listCurrentTournamentId = array();
        $listCurrentTournament = array();

        $loginUser = $this->request
            ->getData("loginUser");

        $teamsTournois = TableRegistry::getTableLocator()
            ->get('TeamsTournaments');
        $usersTeams = TableRegistry::getTableLocator()
            ->get('TeamsUsers');
        $tournaments = TableRegistry::getTableLocator()
            ->get('Tournaments');
        $teams = TableRegistry::getTableLocator()
            ->get('Teams');
        $users = TableRegistry::getTableLocator()
            ->get('Users');

        $queryUser = $users->find()->select(['id'])->where(['login' => $loginUser])->toArray();
        foreach ($queryUser as $val) {
            $userId = $val->id; //$userId contient l'id de l'user connecté
        }

        $queryTeamUser = $usersTeams->find()->where(['user_id'=>$userId]);
        foreach ($queryTeamUser as $val) {
            array_push($listTeamId,$val->team_id); //$listTeamId contient l'ID des teams de l'user connecté
        }

        for($i = 0; $i<sizeof($listTeamId); $i++){
            $queryTeam = $teams->find()->select()->where(['id' => $listTeamId[$i]])->toArray();
            foreach($queryTeam as $val){
                array_push($listTeam, $val); //$listTeam contient le nom des teams de l'user connecté
            }
        }

        for($i = 0; $i<sizeof($listTeamId); $i++){
            $queryTeamTournament = $teamsTournois->find()->select('tournament_id')->where(['team_id' => $listTeamId[$i]])->toArray();
            foreach($queryTeamTournament as $val){
                array_push($listTournamentId, $val->tournament_id); //$listTeamId contient l'ID des tournois où participe une team de l'user connecté
            }
        }

        for($i = 0; $i<sizeof($listTournamentId); $i++){
            $queryTournament = $tournaments->find()->select()->where(['id' => $listTournamentId[$i]])->toArray();
            foreach($queryTournament as $val){
                array_push($listTournament, $val); //$listTeamId contient le nom des tournois où participe une team de l'user connecté
            }
        }

        $queryCurrentTournament = $tournaments->find()->select(['tournamentname'])->toArray();
        foreach ($queryCurrentTournament as $currentTournament) {
            array_push($listCurrentTournament, $currentTournament);
        }



        $this->set(compact('loginUser','listTournament', 'listTeam'));
    }

    public function verification()
    {
        $loginUser = $this->request
            ->getData("loginUser");

        $passwordUser = $this->request
            ->getData("password");

        $listUsers = $this->Users
            ->find()
            ->where(['login' => $loginUser])
            ->where(['password' => $passwordUser])
            ->toArray();

        $loginUser = $this->request
            ->getData("loginUser");
        $this->set('loginUser', $loginUser);
        if (empty($listUsers)) {
            echo "Veuillez entrer une population dans la base";
            $this->setAction('home');
        } else {

            if ($loginUser === "admin" && $passwordUser === "admin") {

                $this->setAction('adminSight');
            } else {
                $this->setAction('userSight');
            }
        }


    }


}
