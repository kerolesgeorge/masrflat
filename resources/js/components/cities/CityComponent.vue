<template>
    <div>
        <!-- Add new city section -->
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#createCity" @click="clearErrors">اضفة مدينة جديده</button>

        <!-- Cities list card -->
        <div class="card">
            <h3 class="m-3">المدن</h3>
            <table class="table p-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم المدينه</th>
                        <th scope="col">تعاملات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="city in cities" :key="city.id">
                        <th scope="row">{{ city.id }}</th>
                        <td>{{ city.name }}</td>
                        <td>

                            <!-- Update button -->
                            <a href="#" title="تعديل" @click="editCity(city);clearErrors()" data-toggle="modal" data-target="#editCity"><i class="fas fa-edit"></i></a>

                            <!-- Delete Button -->
                            <button class="btn btn-delete" data-toggle="modal" data-target="#deleteCity" @click="getCityToDelete(city.id)">
                                <i class="fas fa-trash" style="color: red;"></i>
                            </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create city modal -->
        <div class="modal fade" id="createCity" tabindex="-1" role="dialog" aria-labelledby="createCityLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCityLabel">اضافة مدينه جديده</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Create city form component -->
                        <city-create
                        :submitErrors="errors"
                        @city-submitted="createCity"></city-create>

                    </div>
                </div>
            </div>
        </div>

        <!-- Edit city modal -->
        <div class="modal fade" id="editCity" tabindex="-1" role="dialog" aria-labelledby="editCityLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCityLabel">تعديل مدينه</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Create city form component -->
                        <city-edit
                        :id="city.id"
                        :name="city.name"
                        :submitErrors="errors"
                        @city-update="updateCity"></city-edit>

                    </div>
                </div>
            </div>
        </div>

        <!-- Delete city modal -->
        <div class="modal fade" id="deleteCity" tabindex="-1" role="dialog" aria-labelledby="deleteCityLabel" aria-hidden="true" dir="ltr">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="flex-direction:row-reverse!important">
                        <h5 class="modal-title" id="deleteCityLabel">حذف مدينه</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="deleteCity">احذف</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    props: [],

    data() {
        return {
            cities: [],
            errors: [],
            city: {
                id: '',
                name: '',
            },
            cityDeleteId: '',
        }
    },

    mounted() {
        this.fetchCities();
    },

    methods: {
        // Fetch all cities to display
        fetchCities() {
            axios.get('/api/admin/cities').then(response => {
                this.cities = response.data;
            });
        },

        // Create new city
        createCity(city) {
            axios.post('/api/cities/', city).then(response => {
                this.fetchCities();
                $('#createCity').modal('hide');
            }).catch(error => {
                // Send the errors back to create component
                this.errors = error.response.data.errors;
            });
        },

        // Get city data to update
        editCity(city) {
            this.city.id = city.id;
            this.city.name = city.name;
        },

        // Update city
        updateCity(city) {
            axios.patch(`/api/cities/${city.id}`, city).then(response => {
                this.fetchCities();
                $('#editCity').modal('hide');
            }).catch(error => {
                // Send the errors back to create component
                this.errors = error.response.data.errors;
            });
        },

        getCityToDelete(id) {
            this.cityDeleteId = id;
        },

        deleteCity() {
            axios.delete(`/api/cities/${this.cityDeleteId}`).then(response => {
                this.fetchCities();
                $('#deleteCity').modal('hide');
            });
        },

        clearErrors() {
            this.errors = [];
        }

    }
}
</script>

<style lang="scss" scoped>
    //
</style>
