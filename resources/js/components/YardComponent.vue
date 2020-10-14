<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Формачка для овечек
                <p class="float-right">
                    День {{ days }} <br>
                    Убито {{ killed }} <br>
                    Добавлено {{ added }} <br>
                    Перемещено {{ moved }}
                </p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="card offset-2 col-md-3">
                        <div class="card-header">
                            Загон 1
                        </div>
                        <div class="card-body">
                            <p v-for="sheep, index in sheeps[1]"> {{ sheep }}</p><br>
                        </div>
                    </div>
                    <div class="card offset-1  col-md-3">
                        <div class="card-header">
                            Загон 2
                        </div>
                        <div class="card-body">
                            <p v-for="sheep, index in sheeps[2]"> {{ sheep }}</p><br>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="card offset-2 col-md-3">
                        <div class="card-header">
                            Загон 3
                        </div>
                        <div class="card-body">
                            <p v-for="sheep, index in sheeps[3]"> {{ sheep }}</p><br>
                        </div>
                    </div>
                    <div class="card offset-1  col-md-3">
                        <div class="card-header">
                            Загон 4
                        </div>
                        <div class="card-body">
                            <p v-for="sheep, index in sheeps[4]"> {{ sheep }}</p><br>
                        </div>
                    </div>
                </div>
            </div>
            <div>

            </div>
            <div class="card-footer">
                <button v-on:click="get_sheeps" class="btn btn-success">Начать зарубу)</button>
                <button v-on:click="refresh_yards" class="btn btn-danger">Обнавить</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            sheeps: [],
            days: 0,
        }
    },
    mounted() {
        console.log('Component mounted.');
        this.refresh_yards();
    },
    methods: {
        get_sheeps() {
            var app = this;
            axios.get('/api/v1/fill/yards')
                .then(function (resp) {
                    app.sheeps = resp.data.yards;
                    app.days = resp.data.days;
                    app.killed = resp.data.killed;
                    app.added = resp.data.added;
                    app.moved = resp.data.moved;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Не удалось загрузить загоны");
                });
        },
        refresh_yards() {
            var app = this;
            axios.get('/api/v1/refresh/yards')
                .then(function (resp) {
                    app.sheeps = resp.data.yards;
                    app.days = resp.data.days;
                    app.killed = resp.data.killed;
                    app.added = resp.data.added;
                    app.moved = resp.data.moved;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Не удалось загрузить загоны");
                });
        }
    }
}
</script>

<style scoped>

</style>
