<template>
    <layout>

        <div class="my-8">


            <div class=" bg-white rounded shadow p-8 text-base">


            <div class="" v-for="index in $page.game.number_of_turns" >

                <div class="my-2" v-if="index - 1 < currentTurn">
                    <span>Two third of the mean were <span class="text-gray-600 font-semibold">{{ payoffs['turn-' + (index - 1)].two_third }}</span></span><br>

                    <span v-for="(value, name) in payoffs['turn-' + (index - 1)]['values']">

                        {{ name }} played {{ value }} <br>
                    </span>

                </div>

            </div>


        <div class="mt-4">
            Name: <input type="text" placeholder="name" class="form-input" v-model="name"><br>
            Value: <input type="number" placeholder="value" class="form-input" v-model="value">
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




