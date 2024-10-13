
<template>
    <div> <!-- mytype is not working  mtype IS WORKING //????-->
        <h1 :type="type" text="text"  class="vue-h1-gray">Example Component vue js</h1>
    </div>

</template>

<script>
    export default{
        mounted(){
            console.log('Component Example mounted');
        }
    }
</script>

<style>
    .vue-h1-gray{
        background-color: rgb(77, 71, 71);
        color: rgb(95, 105, 226);
        padding: 10px 15px;
    }
</style>