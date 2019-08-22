<template>
    <div>
        <form>

            <!-- Estate title -->
            <div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">عنوان الاعلان</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="title">
                </div>
            </div>

            <!-- City and neighbourhood select -->
            <div class="form-group row">
                <label for="city" class="col-sm-2 col-form-label">المدينة</label>
                <div class="col-sm-4">
                    <select id="city" class="form-control p-1" v-model="selectedCity" @change="fetchNeighbourhoods">
                        <option v-for="city in cities" :key="city.id" :value="city.id">
                            {{ city.name }}
                        </option>
                    </select>
                </div>

                <label for="neighbourhood" class="col-sm-2 col-form-label">الحي</label>
                <div class="col-sm-4">
                    <select id="neighbourhood" class="form-control p-1" v-model="selectedNeighbourhood">
                        <option v-for="neighbourhood in neighbourhoods" :key="neighbourhood.id" :value="neighbourhood.id">
                            {{ neighbourhood.name }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Estate type and contract type select -->
            <div class="form-group row">
                <label for="type" class="col-sm-2 col-form-label">العقار</label>
                <div class="col-sm-4">
                    <select id="type" class="form-control p-1" v-model="selectedType">
                        <option v-for="etype in types" :key="etype.id" :value="etype.id">
                            {{ etype.name }}
                        </option>
                    </select>
                </div>

                <label for="contract" class="col-sm-2 col-form-label">العقد</label>
                <div class="col-sm-4">
                    <select id="contract" class="form-control p-1" v-model="selectedContract">
                        <option v-for="contract in contracts" :key="contract.id" :value="contract.id">
                            {{ contract.name }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Finish types and views select -->
            <div class="form-group row">
                <label for="finish" class="col-sm-2 col-form-label">التشطيب</label>
                <div class="col-sm-4">
                    <select id="finish" class="form-control p-1" v-model="selectedFinish">
                        <option v-for="finish in finishes" :key="finish.id" :value="finish.id">
                            {{ finish.name }}
                        </option>
                    </select>
                </div>

                <label for="view" class="col-sm-2 col-form-label">الواجهات</label>
                <div class="col-sm-4">
                    <select id="view" class="form-control p-1" v-model="selectedView">
                        <option v-for="view in views" :key="view.id" :value="view.id">
                            {{ view.name }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Area and floor inputs -->
            <div class="form-group row">
                <label for="area" class="col-form-label col-sm-3">المساحة م<span><sup>2</sup></span></label>
                <div class="col-sm-3">
                    <input type="text" id="area" class="form-control" v-model="area">
                </div>
                <label for="floor" class="col-form-label col-sm-3">الدور</label>
                <div class="col-sm-3">
                    <input type="text" id="floor" class="form-control" v-model="floor">
                </div>
            </div>

            <!-- Rooms and bathrooms inputs -->
            <div class="form-group row">
                <label for="rooms" class="col-form-label col-sm-3">عدد الغرف</label>
                <div class="col-sm-3">
                    <input type="text" id="rooms" class="form-control" v-model="rooms">
                </div>
                <label for="bathrooms" class="col-form-label col-sm-3">عدد الحمامات</label>
                <div class="col-sm-3">
                    <input type="text" id="bathrooms" class="form-control" v-model="bathrooms">
                </div>
            </div>

            <!-- Living spaces and balconies inputs -->
            <div class="form-group row">
                <label for="living" class="col-form-label col-sm-3">عدد المعيشة</label>
                <div class="col-sm-3">
                    <input type="text" id="living" class="form-control" v-model="living">
                </div>
                <label for="balconies" class="col-form-label col-sm-3">عدد البلكونات</label>
                <div class="col-sm-3">
                    <input type="text" id="balconies" class="form-control" v-model="balconies">
                </div>
            </div>

            <!-- Build year -->
            <div class="form-group row">
                <label for="buildYear" class="col-form-label col-sm-3">سنة البناء</label>
                <div class="col-sm-3">
                    <input type="text" id="buildYear" class="form-control" v-model="buildYear">
                </div>
            </div>

            <!-- Garage and elevator inputs -->
            <div class="form-group row">
                <label for="garage" class="col-form-label col-sm-3">جراج</label>
                <div class="col-sm-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="garage" id="garage1" value="1" v-model="garage">
                        <label class="form-check-label mr-1" for="garage1">يوجد </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="garage" id="garage0" value="0" v-model="garage">
                        <label class="form-check-label mr-1" for="garage0">لا يوجد</label>
                    </div>
                </div>

                <label for="elevator" class="col-form-label col-sm-3">اسانسير</label>
                <div class="col-sm-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="elevator" id="elevator1" value="1" v-model="elevator">
                        <label class="form-check-label mr-1" for="elevator1">يوجد </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="elevator" id="elevator0" value="0" v-model="elevator">
                        <label class="form-check-label mr-1" for="elevator0">لا يوجد</label>
                    </div>
                </div>
            </div>

            <!-- Notes input -->
            <div class="form-group row">
                <label for="notes" class="col-form-label col-sm-3">ملاحظات</label>
                <div class="col-sm-9">
                     <textarea class="form-control" id="notes" rows="3" v-model="notes"></textarea>
                </div>
            </div>

            <!-- Submit button -->
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary pr-4 pl-4">اضافة</button>
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
            neighbourhoods: [],
            contracts: [],
            types: [],
            finishes: [],
            views: [],
            area: '',
            floor: '',
            rooms: '',
            bathrooms: '',
            living: '',
            balconies: '',
            buildYear: '',
            garage: '',
            elevator: '',
            notes: '',

            selectedCity: '',
            selectedNeighbourhood: '',
            selectedContract: '',
            selectedType: '',
            selectedFinish: '',
            selectedView: '',
        }
    },

    mounted() {
        this.fetchCities();
        this.fetchContracts();
        this.fetchTypes();
        this.fetchFinishes();
        this.fetchViews();
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

        fetchTypes() {
            axios.get('/api/types').then(response => {
                this.types = response.data;
            }).catch(error => {
                alert('Something went wrong \n' + error.message);
            });
        },

        fetchContracts() {
            axios.get('/api/contracts').then(response => {
                this.contracts = response.data;
            }).catch(error => {
                alert('Something went wrong \n' + error.message);
            });
        },

        fetchFinishes() {
            axios.get('/api/finishtypes').then(response => {
                this.finishes = response.data;
            }).catch(error => {
                alert('Something went wrong \n' + error.message);
            });
        },

        fetchViews() {
            axios.get('/api/views').then(response => {
                this.views = response.data;
            }).catch(error => {
                alert('Something went wrong \n' + error.message);
            });
        }

    }
}
</script>

<style lang="scss" scoped>

</style>
