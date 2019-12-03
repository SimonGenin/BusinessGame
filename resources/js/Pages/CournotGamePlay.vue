<template>
    <layout>

        <div class="my-8">


            <div class="bg-white rounded shadow p-8 text-base">


                <div class="mb-8">
                    <div v-if="payoffs">
                        <div v-for="(payoff, index) in payoffs" class="mb-2">

                            You played {{ (plays[index][player]['play'] || 0)}}, your opponent played {{ (plays[index][opponent]['play']) || 0}}, you got {{ payoff[player]['payoff'] }} points, your opponent got {{ payoff[opponent]['payoff'] }} points.

                        </div>

                        <div>Your current total is {{ player_total(currentTurn) || 0 }} and your opponent is {{ opponent_total(currentTurn) || 0 }}</div>

                    </div>
                </div>

                <div v-if="!isFinished" class="flex justify-center items-center my-4">

<!--                    <input type="text" placeholder="Type your name" class="form-input flex-1 mr-8" v-model="name"><br>-->

                    <div class="flex justify-center items-center">

                        <input  type="number" class="form-input" v-model="value">

                    </div>

                </div>

                <div v-if="!isFinished" class="flex justify-center">
                    <span v-if="value">Your current choice is <span class="font-semibold">{{ value }}</span>.</span>
                    <span v-else>You haven't chosen anything yet.</span>
                </div>

                </div>


            </div>


            <div class="flex justify-end mt-4">

                <button
                    v-if="!isFinished"
                    @click="submit"
                    class="px-6 py-3 text-sm tracking-tight uppercase bg-gray-700 hover:bg-gray-600 font-semibold text-gray-100 rounded "
                    :class="{'cursor-not-allowed opacity-25' : !this.value || this.value.length === 0 }"
                >
                    Validate
                </button>

                <button
                    v-if="isFinished"
                    class="px-6 py-3 text-sm tracking-tight uppercase bg-green-700 hover:bg-green-600 font-semibold text-green-100 rounded "
                >
                    Export for Excel
                </button>

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
                // name: this.$page.game.plays['turn-' + this.$page.game.plays.current_turn][this.$page.player]['name'] || '',
                name: '',
                currentTurn: this.$page.game.plays.current_turn,
                plays: this.$page.game.plays,
                payoffs: this.$page.payoffs,
                player: this.$page.player,
                value: this.$page.game.plays['turn-' + this.$page.game.plays.current_turn][this.$page.player]['play'], // defect (false) vs cooperate (true)
                isFinished: this.$page.game.isFinished
            }

        },

        computed: {

            opponent() {

                let playerNumber = parseInt(this.player.split("-")[1]);

                if (playerNumber % 2 === 0) {
                    return 'player-' + (playerNumber + 1);
                }

                return 'player-' + (playerNumber - 1);

            },



        },

        methods: {

            player_total(index) {
                let total = 0;

                for (let i = 0 ; i <= index ; i++) {
                    total += parseInt(this.payoffs['turn-' + i][this.player]['payoff']);
                }

                return total;
            },

            opponent_total(index) {
                let total = 0;

                for (let i = 0 ; i <= index ; i++) {
                    total += parseInt(this.payoffs['turn-' + i][this.opponent]['payoff']);
                }

                return total;
            },


            submit() {

                // if (!this.name || this.name.length === 0) return;

                // Redirect
                window.axios.post('/play/cournot', {
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




