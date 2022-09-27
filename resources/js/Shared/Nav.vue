<template>
    <nav id="header" class="bg-gray-100 fixed w-full header-z-index top-0">
        <div class="w-full mx-auto flex flex-wrap items-center justify-between mt-0 py-3">
            <div class="pl-4">
                <Link :href="route('index')"
                      class="text-gray-900 text-base no-underline hover:no-underline font-extrabold text-xl"
                >
                    Tic tac toe
                </Link>
            </div>
        </div>
    </nav>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue3';

export default {
    components: {Link},
};
</script>
<style scoped>
.header-z-index {
    z-index: 10000;
}
</style>
