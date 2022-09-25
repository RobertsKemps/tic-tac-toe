<template>
    <Layout>
        <div class="text-center">
            <h1 class="display-4">Tic tac toe game</h1>
            <h3 class="display-6 pt-2">Player <b>{{ player }}</b> turn</h3>
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
            <h2 v-if="winner" class="text-6xl font-bold mb-8">Player '{{ winner }}' wins!</h2>
            <button @click="resetGame"
                    class="px-4 py-2 bg-green-500 rounded uppercase font-bold hover:bg-green-700 duration-300"
            >
                Reset
            </button>
        </div>
    </Layout>
</template>

<script>
import {ref, computed} from 'vue';
import {Link} from '@inertiajs/inertia-vue3';
import Layout from "../Shared/Layout";

export default {
    components: { Link, Layout },
    setup() {
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
        };

        const resetGame = () => {
            board.value = [
                ['', '', ''],
                ['', '', ''],
                ['', '', ''],
            ];
            player.value = 'X';
        };

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
