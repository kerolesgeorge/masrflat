<template>
    <div>
        <form>

            <div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">عنوان الاعلان</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="title" name="title">
                </div>
            </div>

            <div class="form-group row">
                <label for="city" class="col-sm-3 col-form-label">المدينة</label>
                <div class="col-sm-9">
                    <select name="city" id="city" class="form-control" v-model="selectedCity" @change="fetchNeighbourhoods">
                        <option v-for="city in cities" :key="city.id" :value="city.id">
                            {{ city.name }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="neighbourhood" class="col-sm-3 col-form-label">الحي</label>
                <div class="col-sm-9">
                    <select name="neighbourhood" id="neighbourhood" class="form-control" v-model="selectedNeighbourhood">
                        <option v-for="neighbourhood in neighbourhoods" :key="neighbourhood.id" :value="neighbourhood.id">
                            {{ neighbourhood.name }}
                        </option>
                    </select>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cities: [],
            selectedCity: '',
            neighbourhoods: [],
            selectedNeighbourhood: ''
        }
    },

    mounted() {
        this.fetchCities();
    },

    methods: {
        fetchCities() {
            axios.get('/api/cities').then(response => {
                this.cities = response.data;
            }).catch(error => {
                alert('Something went wrong: \n' + error.message);
                //console.log(error.message);
            });
        },

        fetchNeighbourhoods() {
            axios.get(`/api/cities/${this.selectedCity}/neighbourhoods`).then(response => {
                this.neighbourhoods = response.data;
            }).catch(error => {
                alert('Something went wrong \n' + error.message);
            });
        },
    }
}
</script>

<style lang="scss" scoped>

</style>
