//Minimax algorithm is not quite working as it should
export const minimax = (board, player, depth = 1) => {
    // The 'o' player wants to maximize its score, the 'x' player wants to minimize its score.
    let bestScore = player === 'O' ? -10000 : 10000;
    let bestMove = null;
    let moves = getPossibleMoves(board);
    for (let i = 0; i < moves.length; i++) {
        let move = moves[i];
        let newBoard = board;
        newBoard._value[move.x][move.y] = player;
        makeAiMove(move.x, move.y, player, newBoard);
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
    for (let i=0; i<3; i++) {
        for (let j=0; j<3; j++) {
            if (aiMoveBoard._rawValue[i][j] === '') {
                moves.push({x: i, y: j});
            }
        }
    }

    return moves;
}
const makeAiMove = (x, y, player, aiMoveBoard) => {
    if (aiMoveBoard._rawValue[x][y] !== '') {
        return false;
    }
    aiMoveBoard._rawValue[x][y] = player;

    return true;
}
