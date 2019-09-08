<template>
    <layout>


        <h2 class="text-3xl my-8">Launch a session</h2>


        <div class="flex flex-wrap sm:justify-center md:justify-start">

            <game-launcher></game-launcher>
            <game-launcher></game-launcher>
            <game-launcher></game-launcher>
            <game-launcher></game-launcher>

        </div>


    </layout>
</template>

<script>
    import Layout from '../Shared/Layout'
    import GameLauncher from '../Components/GameLauncher'

    export default {
        components: {
            Layout,
            GameLauncher
        },

        data() {
            return {

            }
        },



    }
</script>

