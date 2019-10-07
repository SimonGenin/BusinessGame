<template>
    <layout>

        <div class="my-8">


            <div class=" bg-white rounded shadow p-8 text-base">


            <div class="" v-for="index in $page.game.number_of_turns" >

                <div class="my-2" v-if="index - 1 < currentTurn">

                    <h3 class="text-lg">Turn {{ index - 1 }}</h3>

                    <span>Two third of the mean were <span class="text-gray-600 font-semibold">{{ payoffs['turn-' + (index - 1)].two_third }}</span></span><br>

                    <span v-for="(value, name) in payoffs['turn-' + (index - 1)]['values']">

                        {{ name }} played <span class="text-gray-600 ">{{ value }}</span> and was <span class="text-gray-600 ">{{(Math.abs(payoffs['turn-' + (index - 1)].two_third - value)).toFixed(2) }}</span> from the answer.<br>

                    </span>

                </div>

            </div>


        <div class="mt-4 bg-gray-100 w-full p-4" v-if="$page.game.number_of_turns != currentTurn" >

            <h3 class="text-xl font-semibold mb-2">This turn</h3>

                <input type="text" placeholder="Type your name" class="form-input flex-1 mb-2 w-full" v-model="name"><br>

            <input type="number" placeholder="Type your guess" class="form-input w-full" v-model="value">
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
                name: '',
                value: '',
                currentTurn: this.$page.game.plays.current_turn,
                plays: this.$page.game.plays,
                payoffs: this.$page.payoffs
            }
        },

        methods: {

            submit() {

                if (!this.value || this.value.length === 0 || !this.name || this.name.length === 0) return;

                // Redirect
                window.axios.post('/play/two-third', {
                    game_id: this.$page.game.id,
                    name: this.name,
                    value: this.value,
                    url: document.location.href
                }).then( response => {
                    this.$inertia.visit(response.data)
                } )
            },

        },


    }
</script>




