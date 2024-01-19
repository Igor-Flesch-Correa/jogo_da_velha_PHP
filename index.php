<?php

/*      
abrir container com imagem 

docker cp /home/imply/Área\ de\ Trabalho/jogo_da_velha/index.php objective_roentgen:/var/www/html/index.php   

docker exec -it objective_roentgen php /var/www/html/index.php
  21:38 */

   require_once __DIR__.'/variaveis.php';
   require_once __DIR__.'/constantes.php';
   require_once __DIR__.'/getPlayersName.php';
   require_once __DIR__.'/buildBoard.php';
   require_once __DIR__.'/showBoard.php';
   require_once __DIR__.'/isPosictionCorrect.php';
   require_once __DIR__.'/validate.php';
   require_once __DIR__.'/isBoardFull.php';
   require_once __DIR__.'/swapPlayer.php';
   require_once __DIR__.'/showWinner.php';
   require_once __DIR__.'/playAgain.php';


#cuidar ondem de chamada por causa das dependencias

do {
    $players = getPlayersName();
    $player = 'X';

    $board = buildBoard();

    $winner = null;

    while ($winner === null) {
        echo showBoard($board);

        $position = (int) readline("Player {$player}, digite a sua posição: ");

        if (!isPositionCorreact($position, $board)) {
            continue;
        }

        $board[$position] = $player;

        if (validate($board, $player)) {#fiz diferente do exemplo, checar só o atual em vez dos 2 é mais pratico
            $winner = $player;
        }else {
            $winner = null;
        }


        if (isBoardFull($board)) {#se tabuleiro cheio, break
            break;
        }

        $player = swapPlayer($player);
    }

    echo showBoard($board);

    echo showWinner($winner,$players);

    $playAgain = playAgain();

    echo "\n";
} while ($playAgain === true);
