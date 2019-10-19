<template>
    <layout>

        <div class="my-8">


            <div class="bg-white rounded shadow p-8 text-base">


                <div class="mb-8">
                    <div v-if="payoffs">
                        <div v-for="(payoff, index) in payoffs" class="mb-2">
                            You took {{ payoff[player]['payoff'] }} years.
                            <span v-if="plays[index][player]['play'] == null">Someone didn't play.</span>
                            <span v-else>You played {{ (plays[index][player]['play']) ? 'Cooperate' : 'Defect'}}.</span>
                        </div>
                    </div>
                </div>

                <div v-if="currentTurn < this.$page.game.number_of_turns" class="flex justify-between items-center my-4">


                    <input type="text" placeholder="Type your name" class="form-input flex-1 mr-8" v-model="name"><br>

                    <div class="flex justify-center items-center">

                        <button @click="cooperate" class="px-3 py-2 bg-green-500 text-white rounded mx-4">Cooperate
                        </button>
                        <button @click="defect" class="px-3 py-2 bg-red-500 text-white rounded mx-4">Defect</button>

                    </div>

                </div>

                <div class="flex justify-center">
                    <span v-if="value === true">Your current choice is <span class="text-green-500 font-semibold">Cooperate</span>.</span>
                    <span v-else-if="value === false">Your current choice is <span class="text-red-500 font-semibold">Defect</span>.</span>
                    <span v-else>You haven't chosen anything yet.</span>
                </div>

                </div>


            </div>
            <div class="flex justify-end mt-4">

                <button
                    v-if="$page.game.number_of_turns == currentTurn"
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

        data: function () {
            return {
                name: this.$page.game.plays['turn-' + this.$page.game.plays.current_turn][this.$page.player]['name'] || '',
                currentTurn: this.$page.game.plays.current_turn,
                plays: this.$page.game.plays,
                payoffs: this.$page.payoffs,
                player: this.$page.player,
                value: this.$page.game.plays['turn-' + this.$page.game.plays.current_turn][this.$page.player]['play'], // defect (false) vs cooperate (true)
            }

        },

        methods: {

            cooperate() {

                if (!this.name || this.name.length === 0) return;


                this.value = true;
                this.submit();

            },

            defect() {

                if (!this.name || this.name.length === 0) return;


                this.value = false;
                this.submit();

            },

            submit() {

                if (!this.name || this.name.length === 0) return;

                // Redirect
                window.axios.post('/play/dilemma', {
                    game_id: this.$page.game.id,
                    name: this.name,
                    value: this.value,
                    url: document.location.href,
                    player: this.$page.player,
                }).then(response => {
                    this.$inertia.visit(response.data)
                })
            },

        },


    }
</script>




