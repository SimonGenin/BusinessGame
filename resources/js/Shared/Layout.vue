<template>

    <div id="app" >
        <navbar></navbar>

        <div class="container">
            <slot></slot>
        </div>

    </div>


</template>

<script>

    import Navbar from "../Components/Navbar";

    export default {

        components: {
            Navbar
        }

    }

</script>
