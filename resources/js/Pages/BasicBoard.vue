<template>
    <div class="text-center">
        <h1 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-2 text-3xl md:text-4xl">Tic tac toe game</h1>
        <p class="text-sm md:text-base font-normal text-gray-900 pb-2">Player <b>{{ player }}</b> turn</p>
    </div>

    <div class="flex flex-col items-center mb-8">
        <div v-for="(row, x) in board" :key="x" class="flex">
            <div
                v-for="(cell, y) in row" :key="y"
                @click="makeMove(x, y)"
                :class="`border border-black w-24 h-24 hover:bg-gray-200 flex items-center justify-center material-icons-outlined text-4xl cursor-pointer> ${cell === 'X' ? 'text-red-500' : 'text-blue-400'}`"
            >
                {{ cell === 'X' ? 'X' : cell === 'O' ? 'O' : '' }}
            </div>
        </div>
    </div>

    <div class="text-center">
        <h2 v-if="winner" class="text-3xl font-bold mb-8">Player {{ winner }} wins!</h2>
        <button @click="resetGame"
                class="px-4 py-2 bg-green-500 rounded uppercase font-bold hover:bg-green-700 duration-300"
        >
            Reset
        </button>
    </div>
</template>

<script>
import {ref, computed} from 'vue';
import {Link} from '@inertiajs/inertia-vue3';
import Layout from "../Shared/Layout";

export default {
    components: { Link },
    layout: Layout,
    props: {
        versusBot: Boolean,
    },

    setup(props) {
        const player = ref('X');
        const board = ref([
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ]);

        const calculateWinner = (squares) => {
            //All possible winning combinations
            const lines = [
                [0, 1, 2],
                [3, 4, 5],
                [6, 7, 8],
                [0, 3, 6],
                [1, 4, 7],
                [2, 5, 8],
                [0, 4, 8],
                [2, 4, 6],
            ];

            for (let i = 0; i < lines.length; i++) {
                const [a, b, c] = lines[i];

                //Return the value that is found in the winning square
                if (squares[a] && squares[a] === squares[b] && squares[a] === squares[c]) {
                    return squares[a];
                }
            }

            return null;
        }

        const winner = computed(() => calculateWinner(board.value.flat()));

        const makeMove = (x, y) => {
            //If there is a winner then do nothing
            if (winner.value) return;

            //Return if a symbol is already placed on the square
            if (board.value[x][y] !== '') return;

            board.value[x][y] = player.value;

            //Change who's turn it is after making a move
            player.value = player.value === 'X' ? 'O' : 'X';

            if (props.versusBot) {
                //Change who's turn it is after making a move
                let botMove = minimax(JSON.parse(JSON.stringify(board)), player.value);

                if (botMove.move) {
                    board.value[botMove.move.x][botMove.move.y] = player.value;
                }

                player.value = player.value === 'X' ? 'O' : 'X';
            }
        };

        const resetGame = () => {
            board.value = [
                ['', '', ''],
                ['', '', ''],
                ['', '', ''],
            ];
            player.value = 'X';
        };

        const minimax = (board, player, depth = 1) => {
            // The 'o' player wants to maximize its score, the 'x' player wants to
            // minimize its score.
            let bestScore = player === 'O' ? -10000 : 10000;
            let bestMove = null;
            let moves = getPossibleMoves(board);
            for (let i = 0; i < moves.length; i++) {
                let move = moves[i];
                let newBoard = board;
                makeAiMove(move.x, move.y, player, newBoard);
                // Recursively call the minimax function for the new board.
                const score = minimax(newBoard, player === 'x' ? 'O' : 'X', depth).score;
                // If the score is better than the best saved score update the best saved
                // score to this move.

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

            console.log(moves);

            return moves;
        }

        const makeAiMove = (x, y, player, aiMoveBoard) => {
            if (aiMoveBoard._rawValue[x][y] !== '') {
                return false;
            }

            aiMoveBoard._rawValue[x][y] = player;
            return true;
        }

        return {
            player,
            board,
            calculateWinner,
            winner,
            makeMove,
            resetGame,
        }
    },

}
</script>
