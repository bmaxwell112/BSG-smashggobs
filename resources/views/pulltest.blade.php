<?php
function ReturnPlayerName($name, $stream)
{
    foreach($stream['data']['entities']['entrants'] as $i => $v)
    {
        if($v['id'] == $name)
        {
            return $v['name'];
        }
    }
}
function ReturnJSON($url)
{
    $string = file_get_contents($url);
    $apiObject = json_decode($string, true);
    return $apiObject;
}

// This will be replaced with an input.
$tournamentSlug="pulsar-premier-league";
$tournamentUrl="https://api.smash.gg/tournament/".$tournamentSlug;
$tournament = ReturnJSON($tournamentUrl);
$tournamentID = $tournament['entities']['tournament']['id'];
echo $tournamentID;
$queueUrl ="https://api.smash.gg/station_queue/".$tournamentID;
$sets = ReturnJSON($queueUrl);

if($sets['queues'] != null)
{
    if(is_array($sets['data']['entities']['sets']))
    {
        $player1 =  $sets['data']['entities']['sets'][0]["entrant1Id"];
        $player2 =  $sets['data']['entities']['sets'][0]["entrant2Id"];    
        echo $sets['data']['entities']['sets']['fullRoundText'].'<br/>'; 
    }
    else
    {
        $player1 =  $sets['data']['entities']['sets']["entrant1Id"];
        $player2 =  $sets['data']['entities']['sets']["entrant2Id"]; 
        echo $sets['data']['entities']['sets'][0]['fullRoundText'].'<br/>';
    }
    echo ReturnPlayerName($player1, $sets);
    echo '<br/>';
    echo ReturnPlayerName($player2, $sets);
}

