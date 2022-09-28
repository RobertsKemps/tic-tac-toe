//Minimax algorithm is not quite working as it should
import {calculateWinner} from "./BoardLogicService";

export const minimax = (board, player, depth = 1) => {
    let hasGameEnd = calculateWinner(board._value.flat());
    if (hasGameEnd && hasGameEnd !== 'Tie') {
        return {
            score: player === 'X' ? 10 : -10,
            move: null
        }
    }

    if (hasGameEnd === 'Tie') {
        return {
            score: 0,
            move: null
        }
    }

    // The 'o' player wants to maximize its score, the 'x' player wants to minimize its score.
    let bestScore = player === 'O' ? -Infinity : Infinity;
    let bestMove = null;
    let moves = getPossibleMoves(board);

    for (let i = 0; i < moves.length-1; i++) {
        let move = moves[i];
        let newBoard = JSON.parse(JSON.stringify(board));

        if (newBoard._value[move.x][move.y] === '') {
            newBoard._value[move.x][move.y] = player;
        }

        // Recursively call the minimax function for the new board.
        const score = minimax(newBoard, player === 'X' ? 'O' : 'X', depth + 1).score;

        // If the score is better than the best saved score update the best saved score to this move.
        if ((player === 'O' && score > bestScore) || (player === 'X' && score < bestScore)) {
            bestScore = score;
            bestMove = move;
        }
    }

    // Return the best found score & move!
    return {
        score: bestScore,
        move: bestMove
    }
}

const getPossibleMoves = (aiMoveBoard) => {
    let moves = [];

    for (let i = 0; i < 3; i++) {
        for (let j = 0; j < 3; j++) {
            if (aiMoveBoard._value[i][j] === '') {
                moves.push({x: i, y: j});
            }
        }
    }

    return moves;
}
