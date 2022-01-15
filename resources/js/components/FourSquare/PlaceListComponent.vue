<template>
    <div class="card form-rounded">
        <div class="card-header"> Nearby Places</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for='(data, index) in placesData.results' :key='data.id'>
                        <td>{{ data.name }}</td>
                        <td>
                            <span  v-for='categories in data.categories' :key='categories.id'> 
                                {{ categories.name }} 
                                <span v-if="categories.length > 1">, </span>
                            </span>
                        </td>
                        <td>{{ data.location.address }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
  
</template>

<script>
    export default {
        props: ['placesData'],
    }
</script>

<style>
@import '../../../css/app.css';

</style>
