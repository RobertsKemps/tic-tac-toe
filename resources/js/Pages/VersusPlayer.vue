<template>
    <BoardHeader :board-status="boardStatus"/>

    <div class="flex flex-col items-center mb-8">
        <loading v-model:active="isLoading"
                 :can-cancel="false"
                 :is-full-page="fullPage"/>

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
        <Link :href="route('game.versus.player')"
                class="px-4 py-2 bg-green-500 rounded uppercase font-bold hover:bg-green-700 duration-300"
        >
            New game
        </Link>
    </div>
</template>

<script>
import {ref, computed} from 'vue';
import {Link} from '@inertiajs/inertia-vue3';
import Layout from '../Shared/Layout';
import loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import {calculateWinner} from '../Services/BoardLogicService';
import Winner from '../Components/Winner';
import BoardHeader from '../Components/BoardHeader';

export default {
    components: {Link, loading, Winner, BoardHeader},
    layout: Layout,
    props: {
        playerId: String,
        matchId: Number,
    },

    setup(props) {
        const winner = computed(() => calculateWinner(board.value.flat()));

        let isLoading = ref(true);
        let fullPage = ref(true);
        let boardStatus = ref('Waiting for player O to connect');
        let player = ref('O');
        let board = ref([
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ]);

        window.Echo.channel('channel')
            .listen('GameStarted', (e) => {
                if (e.playerXId === props.playerId && props.matchId === e.matchId) {
                    player.value = 'X';
                    isLoading.value = false;
                    boardStatus.value = 'Player O has connected, player X`s turn';
                }
            });

        window.Echo.channel('channel')
            .listen('MoveMade', (e) => {
                board.value = e.board;

                if (calculateWinner(board.value.flat())) {
                    isLoading.value = false;

                    return;
                }

                if (props.matchId == e.matchId) {
                    boardStatus.value = 'Player`s ' + e.nextPlayerMove + ' move';

                    if (player.value == e.nextPlayerMove) {
                        isLoading.value = false;
                    }
                }
            });

        const makeMove = (x, y) => {
            //If there is a winner then do nothing
            if (winner.value) return;

            //Return if a symbol is already placed on the square
            if (board.value[x][y] !== '') return;

            board.value[x][y] = player.value;
            isLoading.value = true;

            addNewMove(x, y, player);
        };

        const addNewMove = (x, y, player) => {
            window.axios
                .post('/versus/player/move-made', {
                    matchId: props.matchId,
                    playerValue: player.value,
                    playerId: props.playerId,
                    board: board.value,
                });
        }

        return {
            player,
            board,
            boardStatus,
            winner,
            isLoading,
            fullPage,
            makeMove,
        }
    },
}
</script>
