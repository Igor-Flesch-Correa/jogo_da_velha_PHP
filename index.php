<?php

/*      
abrir container com imagem php:8.3.1-apache

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

        if (validate($board, $player)) {#fiz diferente
            $winner = $player;
        }else {
            $winner = null;
        }


        if (!in_array(BLANK_ICON, $board)) {#se tabuleiro cheio, break
            break;
        }

        if ($player === 'X') {
            $player = 'O';
        } else {
            $player = 'X';
        }
    }

    echo showBoard($board);

    if ($winner === 'X') {
        echo "VENCEDOR: {$playerOne}.\n";
    } elseif ($winner === 'O') {
        echo "VENCEDOR: {$playerTwo}.\n";
    } else {
        echo "EMPATE.\n";
    }

    $playAgain = filter_var(
        readline("\nDeseja jogar novamente? (true/false): "),
        FILTER_VALIDATE_BOOLEAN
    );

    echo "\n";
} while ($playAgain === true);
