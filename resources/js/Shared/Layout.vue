<template>
    <section class="pt-6">
        <Nav />
    </section>

    <section class="pt-6">
        <div class="md:max-w-4xl mx-auto p-4 ">
            <slot />
        </div>
    </section>
</template>
<script>
import Nav from './Nav';

export default {
    components: {Nav},
};
</script>
