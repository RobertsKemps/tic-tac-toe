<template>
    <BoardHeader :board-status="'Player ' + player + ' turn'"/>

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

        <Winner :winner="winner" />
        <button @click="resetGame"
                class="px-4 py-2 bg-green-500 rounded uppercase font-bold hover:bg-green-700 duration-300"
        >
            Reset
        </button>
    </div>
</template>

<script>
import {ref, computed} from 'vue';
import Layout from '../Shared/Layout';
import {minimax} from '../Services/AiLogicService';
import {calculateWinner} from '../Services/BoardLogicService';
import Winner from '../Components/Winner';
import BoardHeader from '../Components/BoardHeader';

export default {
    components: {Winner, BoardHeader},
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
                let botMove = minimax(JSON.parse(JSON.stringify(board)), player.value);

                if (botMove.move) {
                    board.value[botMove.move.x][botMove.move.y] = player.value;
                }

                //Change who's turn it is after making a move
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

        return {
            player,
            board,
            winner,
            makeMove,
            resetGame,
        }
    },
}
</script>
