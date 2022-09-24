<template>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal">Tic tac toe</h5>
    </div>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Tic tac toe game</h1>
        <p class="lead">Tic-tac-toe is a paper-and-pencil game for two players who take turns marking the spaces in a three-by-three
            grid with X or O. The player who succeeds in placing three of their marks in a horizontal, vertical, or
            diagonal row is the winner. It is a solved game, with a forced draw assuming best play from both players</p>
    </div>

    <div class="container text-center">
        <div class="card-deck col-12 align-self-center">
            <div class="card col-4 offset-4 box-shadow">
                <div class="card-body">
                    <h2 class="card-title pricing-card-title pb-2">Two players single browser</h2>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary">Play game</button>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
export default {
    props: {
        test: String,
    }
}
</script>
<style scoped>
body {
    height: 100%
}
</style>
