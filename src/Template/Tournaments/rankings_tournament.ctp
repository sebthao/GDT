<?php

echo $this->Form->create($this, ['url' => ['action' => 'watchtournaments']]);
echo $this->Form->button('Retour');
echo $this->Form->end();

echo "
    <table>
        <th>
            <tr>
                <td>
                    Nom de l'équipe
                </td>
                <td>
                    Position
                </td>
            </tr>
        </th>
     ";
foreach($allTeams as $team){
    foreach($teamsInTournament as $idTeamTournament){
        if ($team->id == $idTeamTournament){

            echo "<tr><td>".$team->teamname."</td><td>";
            foreach($allTeamTournaments as $teamTournament){
                if($idTeamTournament==$teamTournament->team_id) {
                    echo $teamTournament->ranking."</td></tr>";
                }
            }
        }
    }
}

echo "</table>";
