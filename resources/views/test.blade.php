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
$sets = ReturnJSON("http://bsgsmash.test/json");

if(is_array($sets['data']['entities']['sets']))
{
    $player1 =  $sets['data']['entities']['sets'][0]["entrant1Id"];
    $player2 =  $sets['data']['entities']['sets'][0]["entrant2Id"];
    echo $sets['data']['entities']['sets'][0]['fullRoundText'].'<br/>'; 
}
else
{
    $player1 =  $sets['data']['entities']['sets']["entrant1Id"];
    $player2 =  $sets['data']['entities']['sets']["entrant2Id"]; 
    echo $sets['data']['entities']['sets']['fullRoundText'].'<br/>';
}

echo ReturnPlayerName($player1, $sets);
echo '<br/>';
echo ReturnPlayerName($player2, $sets);
