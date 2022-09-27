<template>
    <div class="container w-full md:max-w-3xl mx-auto">
        <h1 class="font-bold font-sans break-normal text-gray-900 pb-6 text-3xl md:text-4xl">What is it?</h1>
        <p class="text-sm md:text-base font-normal text-gray-600">
            Tic-tac-toe is a paper-and-pencil game for two players who take turns marking the spaces in a
            three-by-three grid with X or O. The player who succeeds in placing three of their marks in a horizontal,
            vertical, or diagonal row is the winner. It is a solved game, with a forced draw assuming best play from
            both players
        </p>
    </div>

    <div class="pt-6 space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-6 lg:space-y-0 w-full">

        <div class="flex flex-col max-w-lg lg:min-w-full p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8">
            <h3 class="mb-4 text-2xl font-semibold">Basic version</h3>
            <p class="font-light text-gray-500 sm:text-lg">Two players, single browser</p>
            <Link :href="route('game.basic')"
                  class="mt-4 text-white bg-purple-500 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            >
                Play game
            </Link>
        </div>

        <div class="flex flex-col max-w-lg lg:min-w-full p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8">
            <h3 class="mb-4 text-2xl font-semibold">Player vs minimax</h3>
            <p class="font-light text-gray-500 sm:text-lg">Single player vs a BOT</p>
            <Link :href="route('game.versus.bot')"
                  class="mt-4 text-white bg-purple-500 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            >
                Play game
            </Link>
        </div>

        <div class="flex flex-col max-w-lg lg:min-w-full p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8">
            <h3 class="mb-4 text-2xl font-semibold">Multiplayer</h3>
            <p class="font-light text-gray-500 sm:text-lg">Play vs a fellow human</p>
            <Link :href="route('game.versus.player')"
                  class="mt-4 bottom-0 text-white bg-purple-500 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            >
                Play game
            </Link>
        </div>
    </div>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue3';
import Layout from "../Shared/Layout";

export default {
    components: { Link },
    layout: Layout,
};
</script>
