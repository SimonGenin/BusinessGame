<template>
    <layout>


        <h2 class="text-3xl my-8">Launch a session</h2>


        <div class="flex flex-wrap sm:justify-center md:justify-start">

            <game-launcher></game-launcher>
            <two-third-of-the-mean-game-launcher></two-third-of-the-mean-game-launcher>
            <repeated-inmate-dilemma-game-launcher></repeated-inmate-dilemma-game-launcher>
            <cournot-game-launcher></cournot-game-launcher>
        </div>


    </layout>
</template>

<script>
    import Layout from '../Shared/Layout'
    import GameLauncher from '../Components/GameLauncher'
    import TwoThirdOfTheMeanGameLauncher from '../Components/TwoThirdOfTheMeanGameLauncher'
    import RepeatedInmateDilemmaGameLauncher from '../Components/RepeatedInmateDilemmaGameLauncher'
    import CournotGameLauncher from "../Components/CournotGameLauncher";

    export default {
        components: {
            Layout,
            GameLauncher,
            TwoThirdOfTheMeanGameLauncher,
            RepeatedInmateDilemmaGameLauncher,
            CournotGameLauncher
        },

        data() {
            return {

            }
        },



    }
</script>

