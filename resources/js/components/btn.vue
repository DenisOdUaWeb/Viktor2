<template>
    <div>
        <button :type="mtype2" class="vue-btn-gray" v-text="test.name"></button>
    </div>
</template>

<script>
import axios from 'axios';

    export default{
        mounted(){
            console.log('Component BTN mounted');

            axios.post('api/vue', {})
            .then(response => {
                this.test = response.data;
            });
        },
        data: function (){
            return {
                test: null,
            }
        },

        props: [
        'text',
        'mtype2',
        ]
    }
</script>

<style>
    .vue-btn-gray{
        background-color: rgb(40, 40, 40);
        color: white;
        margin: 15px;
        padding: 10px 15px;
        border-radius: 5px;
    }
</style>