<template>
    <layout>


        <span>You are {{ $page.player.split("-").join(' ') }}</span>
        <br>
        <span>There are {{ $page.game.number_of_players }} players</span>

        <div v-for="turnIndex in $page.game.number_of_turns" :key="turnIndex" class="w-full flex justify-between">

            <div v-if="(turnIndex - 1) == currentTurn" v-for="index in $page.game.number_of_players" :key="index">

                <div v-if="$page.player !== 'player-' + (index - 1)">
                    <p >{{ index - 1 }} play is hidden</p>
                </div>

                <div v-else>
                    <input v-model="value" name="value" type="number" placeholder="Enter your value">
                </div>

            </div>

            <div v-else>

                Not this turn

            </div>

        </div>

        <button @click="submit" class="px-4 py-2 uppercase text-xs bg-gray-700 hover:bg-gray-600 font-semibold text-gray-100 rounded">
            Validate
        </button>

        {{ currentTurn }}


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
                value : null,
                currentTurn: JSON.parse(this.$page.game.plays).current_turn,
            }
        },

        methods:{

            submit() {

                // Redirect
                this.$inertia.post('/play', {
                    game_id: this.$page.game.id,
                    player: this.$page.player,
                    value: this.value,
                    url: window.location.href
                })
            },

        },



    }
</script>

