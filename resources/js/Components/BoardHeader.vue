<template>
    <div class="text-center">
        <h1 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-2 text-3xl md:text-4xl">
            Tic tac toe game
        </h1>
        <p class="text-md md:text-base font-normal text-gray-900 pb-2">{{ boardStatus }}</p>
    </div>
</template>
<script>
export default {
    props: {
        boardStatus: {
            type: [String],
            required: true,
            default: 'X',
        },
    },
};
</script>
