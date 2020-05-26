<?php

echo $this->Form->create($this, ['url' => ['action' => 'watchtournaments']]);
echo $this->Form->button('Retour');
echo $this->Form->end();


echo "
    <table>
        <th>
            <tr>
                <td>
                    Equipe 1
                </td>
                <td>
                    Score
                </td>
                <td>
                    Equipe 2
                </td>
                
            </tr>
        </th>
     ";


foreach ($allMatchsInTournament as $match){
    if ($match->tournament_id==$idTournament){
        foreach($allMatchsTeams as $matchTeams){
            if($match->id==$matchTeams->match_id){

                echo "<tr><td>".$matchTeams->team_id."</td>";
            }
        }
        echo "<td>"."-"."</td></tr>";
    }
    
}

echo "</table>";