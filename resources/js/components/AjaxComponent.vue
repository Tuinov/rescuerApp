<template>
    <div class="container">
        <div class="row">
            <button @click="update" class="btn btn-defalt text mb-1" v-if="!is_fresh">
                Обновить {{id}} ..
            </button>
            <span class="badge badge-primery mb-1" v-if="is_fresh">Обновление...</span>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Наименование</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="url in urldata">
                            <td>{{ url.title}}</td>
                            <td>{{ url.url}}</td>
                        </tr>
                    </tbody>
                </table>

        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
           return {
               urldata: [],
               is_fresh: false,
               id: 0
            }
        },
        mounted() {
            this.update()
        },
        methods: {
            update: function () {
                this.is_fresh = false

                axios.get('/start/get-json').then((response) => {
                    console.log(response)
                    this.urldata = response.data
                    this.is_fresh = false
                    this.id++

                });

            }
        }
    }
</script>
