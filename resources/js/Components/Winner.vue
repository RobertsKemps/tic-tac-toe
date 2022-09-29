<template>
    <h2 v-if="winner && winner !== 'Tie'" class="text-3xl mb-8">Player <b>{{ winner }}</b> has won!</h2>
    <h2 v-else-if="winner && winner === 'Tie'" class="text-3xl font-bold mb-8">{{ winner }}</h2>
</template>
<script>

export default {
    props: {
        winner: {
            type: [String, null],
            required: true,
            default: null,
        },
    },
};
</script>
