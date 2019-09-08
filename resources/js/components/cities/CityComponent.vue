<template>
    <div>
        <!-- Page Loader -->
        <div class="loader-wrapper">
            <div class="loader"></div>
        </div>

        <!-- Cities list card -->
        <div v-if="!cities.length">
            <h3>لا يوجد مدن</h3>
            <p>برجاء ادخال مدن</p>
        </div>

        <div class="card">
            <div class="d-flex justify-content-between">
                <h3 class="m-1">المدن</h3>

                 <!-- Add new city section -->
                <button class="btn btn-success m-2" data-toggle="modal" data-target="#createCity" @click="clearErrors">اضافة</button>
            </div>

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
// Import city components
import CityCreate from './CityCreate';
import CityEdit from './CityEdit';

export default {
    data() {
        return {
            cities: [],
            errors: {},
            city: {},
            cityDeleteId: '',
        }
    },

    components: {
        CityCreate,
        CityEdit
    },

    mounted() {
        this.fetchCities();

        // Hide loader
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut();
        });
    },

    methods: {
        // Fetch all cities to display
        fetchCities() {
            axios.get('/api/cities').then(response => {
                this.cities = response.data;
            }).catch(error => {
                console.log(error.response.data.message);
            });
        },

        // Create new city
        createCity(city) {
            axios.post('/api/cities/', city).then(response => {
                this.fetchCities();
                $('#createCity').modal('hide');
            }).catch(error => {
                // Get laravel validation error
                this.errors = error.response.data.errors;
            });
        },

        // Get city data to update
        editCity(city) {
            this.city = city;
        },

        // Update city
        updateCity(id, city) {
            axios.patch(`/api/cities/${id}`, city).then(response => {
                this.fetchCities();
                $('#editCity').modal('hide');
            }).catch(error => {
                // Get laravel validation error
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
