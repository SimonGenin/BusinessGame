<template>
    <layout>


        <h1 class="text-3xl mt-8 mb-4 text-semibold text-gray-800">Links for the session</h1>

        <div class=" bg-white rounded shadow p-8 text-base">

            <h2 class="text-2xl mb-4 text-semibold text-gray-800">Professor Link</h2>
            <p>{{ $page.url_start + '/' + gameUrls.professor_url }}</p>

            <h2 class="text-2xl mt-8 mb-4 text-semibold text-gray-800">Players link</h2>
            <p class="mb-2">
                {{ $page.url_start + '/' +  gameUrls['student_url'] }}
            </p>

            <div class="flex justify-end">
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
                gameUrls : this.$page.game_urls
            }
        },

        methods: {

            closeRound() {
                // Redirect
                window.axios.post('/close-round', {
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
