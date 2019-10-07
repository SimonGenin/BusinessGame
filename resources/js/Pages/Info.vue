<template>
    <layout>


        <h1 class="text-3xl mt-8 mb-4 text-semibold text-gray-800">Links for the session</h1>

        <div class=" bg-white rounded shadow p-8 text-base">

            <h2 class="text-2xl mb-4 text-semibold text-gray-800">Professor Link</h2>
            <p>{{ $page.url_start + '/' + gameUrls.professor_url }}</p>

            <h2 class="text-2xl mt-8 mb-4 text-semibold text-gray-800">Player links</h2>
            <p class="mb-2" v-for="playerIndex in $page.game.number_of_players">
                <span class="text-gray-600">Player {{ playerIndex - 1 }}: </span><br> {{ $page.url_start + '/' +  gameUrls['student_urls']['player-' + (playerIndex - 1)] }}
            </p>

        </div>


    </layout>
</template>

<script>
    import Layout from '../Shared/Layout'

    export default {
        components: {
            Layout,
        },

        data() {
            return {
                gameUrls : this.$page.game_urls
            }
        },

        created() {

            // console.log(this.gameUrls['student_urls']['player-' + 0])

        }


    }
</script>
