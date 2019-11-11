<template>
    <layout>


        <h1 class="text-3xl mt-8 mb-4 text-semibold text-gray-800">Links for the session</h1>

        <div class=" bg-white rounded shadow p-8 text-base">

            <h2 class="text-2xl mb-4 text-semibold text-gray-800">Professor Link</h2>
            <p>{{ $page.url_start + '/' + gameUrls.professor_url }}</p>

            <h2 class="text-2xl mt-8 mb-2 text-semibold text-gray-800">Player links</h2>
            <p class="text-sm mb-4 text-gray-600">Player 0 plays against player 1, Player 2 plays against player 3, etc.</p>

            <p class="mb-2" v-for="(url, index) in gameUrls.student_urls" :class="{ 'border-b-4  mb-4 pb-4' : parseInt(index.split('-')[1]) % 2 != 0}" >
                <span class="text-gray-600">Player {{ index.split("-")[1]  }}: </span><br> {{ $page.url_start + '/' +  url }}

            </p>


            <div class="flex justify-end" v-if="!finished">
                <button @click="closeRound" class="px-6 py-3 text-sm tracking-tight uppercase bg-gray-700 hover:bg-gray-600 font-semibold text-gray-100 rounded"
                >Close Current round</button>
            </div>

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
                gameUrls : this.$page.game_urls,
                finished: this.$page.game.isFinished,
            }
        },

        methods: {

            closeRound() {
                // Redirect
                window.axios.post('/dilemma/close', {
                    game_id: this.$page.game.id,
                    url: document.location.href
                }).then( response => {
                    this.$inertia.visit(response.data)
                } )
            }

        },

        created() {

            // console.log(this.gameUrls['student_urls']['player-' + 0])

        }


    }
</script>
