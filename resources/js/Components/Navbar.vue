<template>

    <div class="font-sans antialiased">
        <nav class="flex items-center justify-between flex-wrap bg-red-500 p-6">
            <div class="flex items-center flex-no-shrink text-white mr-6">

                <span class="font-semibold text-xl tracking-tight">Strats</span>
            </div>
            <div class="block sm:hidden">
                <button @click="toggle"
                        class="flex items-center px-3 py-2 border rounded text-red-200 border-teal-light hover:text-white hover:border-white">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>
                        Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
            </div>
            <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
                <div class="text-sm sm:flex-grow">
                    <inertia-link
                        class="no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4"
                        href="/">Home
                    </inertia-link>
                    <inertia-link
                        class="no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4"
                        href="/about">About
                    </inertia-link>
                    <inertia-link
                        class="no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4"
                        href="/contact">Contact
                    </inertia-link>
                    <inertia-link
                        class="no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white"
                        href="/tests">Tests
                    </inertia-link>
                </div>
            </div>
        </nav>

    </div>

</template>

<script>

    export default {

        data() {
            return {
                open: false,
            }
        },

        methods: {
            toggle() {
                this.open = !this.open
            }
        }

    }

</script>
