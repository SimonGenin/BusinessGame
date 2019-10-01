<template>
    <layout>


        <h1 class="text-3xl mt-8 mb-4 text-semibold text-gray-800">You are the {{ $page.player.split("-").join(' ')
            }}</h1>

        <div class=" bg-white rounded shadow p-8 text-base">

            <div v-for="turnIndex in $page.game.number_of_turns" :key="turnIndex"
                 class="w-full flex justify-between items-center p-4 border border-gray-200"
                 :class="{ 'bg-gray-100' : (turnIndex - 1) == currentTurn}">

                <div class="w-full flex justify-center" v-if="(turnIndex - 1) == currentTurn"
                     v-for="index in $page.game.number_of_players" :key="index">


                    <div v-if="$page.player !== 'player-' + (index - 1)">
                        <p class="font-bold tracking-tight text-gray-500 text-sm uppercase">Hidden</p>
                    </div>

                    <div v-else>

                        <p class="font-semibold" v-if="plays['turn-' + (turnIndex-1)][$page.player]">
                            Waiting ({{ plays['turn-' +(turnIndex-1)][$page.player] }})
                        </p>

                        <input v-else class="form-input border-gray-300 border-2 text-center" v-model="value"
                               name="value" type="number" placeholder="Enter your value" required>
                    </div>

                </div>

                <div class="w-full flex justify-center" v-else-if="(turnIndex - 1) < currentTurn">

                    <p v-if="plays['turn-' + (turnIndex - 1)]['player-' + (index - 1)]"> {{ payoffs['turn-' +
                        (turnIndex-1)]['player-' + (index-1)] }}</p>
                    <p v-else>Error Missing</p>

                </div>

                <div class="w-full flex justify-center" v-else>

                    Not played yet

                </div>

            </div>


            <div class="flex justify-end mt-4">

                <button
                    v-if="$page.game.number_of_turns != currentTurn"
                    @click="submit"
                        class="px-6 py-3 text-sm tracking-tight uppercase bg-gray-700 hover:bg-gray-600 font-semibold text-gray-100 rounded "
                        :class="{'cursor-not-allowed opacity-25' : !this.value || this.value.length === 0 }"
                >
                    Validate
                </button>

                <button
                    v-else
                    class="px-6 py-3 text-sm tracking-tight uppercase bg-green-700 hover:bg-green-600 font-semibold text-green-100 rounded "
                >
                    Export for Excel
                </button>

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
                value: '',
                currentTurn: this.$page.game.plays.current_turn,
                plays: this.$page.game.plays,
                payoffs: this.$page.payoffs
            }
        },

        methods: {

            submit() {

                if (!this.value || this.value.length === 0) return;

                // Redirect
                window.axios.post('/play', {
                    game_id: this.$page.game.id,
                    player: this.$page.player,
                    value: this.value,
                    url: document.location.href
                }).then( response => {
                    this.$inertia.visit(response.data)
                } )
            },

        },


    }
</script>




