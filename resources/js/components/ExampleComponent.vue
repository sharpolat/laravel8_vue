<template>
    <div class="container">
        <div class="row justify-content-center">
            <div id="app-5">
                <p>{{ message }}</p>
                <button v-on:click="reverseMessage">Перевернуть сообщение</button>
            </div>
        </div>
    </div>
</template>

<script>
    var app5 = new Vue({
    el: '#app-5',
    data: {
        message: 'Привет, Vue.js!'
    },
    methods: {
        reverseMessage: function () {
        this.message = this.message.split('').reverse().join('')
        }
    }
    })
</script>
