<template>

    <div class="max-w-lg xl:w-1/3 md:w-1/2 p-4">

        <div class="bg-white rounded shadow p-6 ">

            <h4 class="text-xl font-bold">Game title</h4>

            <hr class="mt-4 mb-8">

            <div class="flex items-center mb-4">
                <input class="w-full form-input appearance-none" v-model="name" type="text" placeholder="Game name">
            </div>

            <div class="flex items-center mb-4">
                <input class="w-1/5 form-input appearance-none" v-model="turnNumber" type="number">
                <p class="flex-1 ml-8">Number of turns</p>
            </div>


            <div class="flex items-center mb-4">
                <input class="w-1/5 form-input appearance-none" v-model="playerNumber" type="number">
                <p class="flex-1 ml-8">Number of players</p>
            </div>

            <div class="flex justify-end">
                <button
                    @click="submit"
                    class="bg-green-500 px-4 py-2 text-white text-sm uppercase rounded-sm hover:bg-green-600"
                    :class="{'hover:bg-green-500 opacity-50 cursor-not-allowed': disabled}"
                    :disabled="disabled"
                >Start
                </button>
            </div>

        </div>

    </div>

</template>

<script>

    export default {

        data() {
            return {
                turnNumber: null,
                playerNumber: null,
                name: null,
            }
        },

        computed: {

            disabled() {
                return this.turnNumber == null || this.turnNumber === 0 || this.playerNumber == null || this.playerNumber < 2
            }

        },

        methods: {

            submit() {

                // Redirect
                this.$inertia.post('/launch', {
                    name: this.name,
                    turnNumber: this.turnNumber,
                    playerNumber: this.playerNumber,
                })
            },


        }
    }
</script>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }
</style>
