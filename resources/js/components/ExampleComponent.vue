<template>
    <div class="container">
        <div style="overflow: hidden;">
            <div style="width: 1000%;">
                <div style="float: left; width: 50%;">
                    <div class="prod" v-for="el of products" :key="el.id">

                        <h3>{{el.name}}</h3>
                        <p>{{el.price}}</p>
                        <button @click="addProduct(el)">купить</button>
                    </div>
                </div>
                <div style="float: left; width: 50%; height: 200px;">
                    <div class="bask" v-for="el of basket" :key="el.id">

                        <div>
                            <h3>{{el.name}}</h3>

                            <button @click="addProduct(el)">удалить</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>


    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                count: 0,
                products: [],
                basket: []

            }
        },

        mounted() {
            console.log('Component mounted.!!!');
            this.getJson();
            console.log(this.products);

        },

        methods: {
            increase() {
                this.count++;
            },

            getJson() {
                axios.get('start/data-ajax').then((response) => {
                    for(let elem of response.data) {
                        this.products.push(elem);
                    }

                });
            },

            addProduct(el) {
                this.basket.push(el);
            }
        },

    }
</script>
