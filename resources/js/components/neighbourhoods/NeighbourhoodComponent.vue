<template>
    <div>
        <!-- Page Loader -->
        <div class="loader-wrapper">
            <div class="loader"></div>
        </div>

        <!-- Select city list -->
        <form>
            <div class="form-group row mt-3">
                <label for="cities" class="col-sm-2">اختار مدينة</label>
                <div class="col-sm-4">
                    <select id="cities" class="form-control p-1" v-model="selected" @change="changeCity()">
                        <option v-for="city in cities" :key="city.id" :value="city.id">
                            {{ city.name }}
                        </option>
                    </select>
                </div>
            </div>
        </form>

        <!-- Cities list card -->
        <div v-if="!neighbourhoods.length">
            <h3>لا يوجد احياء</h3>
            <p>برجاء اختيار مدينة او ادخال حي جديد</p>
        </div>

        <div class="card" v-if="selected">
            <div class="d-flex justify-content-between">
                <h3 class="m-1">الاحياء</h3>

                <!-- Add new city section -->
                <button class="btn btn-success m-2" data-toggle="modal" data-target="#createNeighbourhood" @click="clearErrors">اضافة</button>
            </div>

            <table class="table p-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم الحي</th>
                        <th scope="col">تعاملات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="neighbourhood in neighbourhoods" :key="neighbourhood.id">
                        <th scope="row">{{ neighbourhood.id }}</th>
                        <td>{{ neighbourhood.name }}</td>
                        <td>

                            <!-- Update button -->
                            <a href="#" title="تعديل" @click="editNeighbourhood(neighbourhood); clearErrors()" data-toggle="modal" data-target="#editNeighbourhood">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Delete Button -->
                            <button class="btn btn-delete" data-toggle="modal" data-target="#deleteNeighbourhood" @click="getNeighbourhoodToDelete(neighbourhood.id)">
                                <i class="fas fa-trash" style="color: red;"></i>
                            </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create neighbourhood modal -->
        <div class="modal fade" id="createNeighbourhood" tabindex="-1" role="dialog" aria-labelledby="createNeighbourhoodLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createNeighbourhoodLabel">اضافة حي جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Create neighbourhood form component -->
                        <neighbourhood-create
                        :submitErrors="errors"
                        @neighbourhood-submitted="createNeighbourhood"></neighbourhood-create>

                    </div>
                </div>
            </div>
        </div>

        <!-- Edit neighbourhood modal -->
        <div class="modal fade" id="editNeighbourhood" tabindex="-1" role="dialog" aria-labelledby="editNeighbourhoodLabel" aria-hidden="true" v-if="editMode">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNeighbourhoodLabel">تعديل حي</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Edit neighbourhood form component -->
                        <neighbourhood-edit
                        :neighbourhood="neighbourhood"
                        :citiesOptions="cities"
                        :submitErrors="errors"
                        @neighbourhood-update="updateNeighbourhood"></neighbourhood-edit>

                    </div>
                </div>
            </div>
        </div>

        <!-- Delete neighbourhood modal -->
        <div class="modal fade" id="deleteNeighbourhood" tabindex="-1" role="dialog" aria-labelledby="deleteNeighbourhoodLabel" aria-hidden="true" dir="ltr">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="flex-direction:row-reverse!important">
                        <h5 class="modal-title" id="deleteNeighbourhoodLabel">حذف حي</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="deleteNeighbourhood">احذف</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
// Import neighbourhood components
import NeighbourhoodCreate from './NeighbourhoodCreate';
import NeighbourhoodEdit from './NeighbourhoodEdit';

export default {
    data() {
        return {
            cities: [],
            neighbourhoods: [],
            neighbourhood: {},
            selected: '',
            neighbourhoodDeleteId: '',
            errors: {},
            isInvisible: true,
            editMode: false,
        }
    },

    components: {
        NeighbourhoodCreate,
        NeighbourhoodEdit
    },

    mounted() {
        this.fetchCitites();

        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut();
        });
    },

    methods: {
        // Fetch citites to show in list
        fetchCitites() {
            axios.get('/api/cities').then(response => {
                this.cities = response.data;
            });
        },

        // Get neighbourhood by city id
        fetchNeighbourhoods(id) {
            axios.get(`/api/cities/${id}/neighbourhoods`).then(response => {
                this.neighbourhoods = response.data;
            }).catch(error => {
                console.log(error);
            });
        },

        // Get neighbourhoods when city select changes
        changeCity() {
            this.fetchNeighbourhoods(this.selected);
            this.isInvisible = false;
        },

        // Create new neighbourhood function
        createNeighbourhood(neighbourhood) {
            // Add selected city_id to neighbourhood object
            neighbourhood.city_id = this.selected;

            axios.post('/api/neighbourhoods', neighbourhood).then(response => {
                this.changeCity();
                $('#createNeighbourhood').modal('hide');
            }).catch(error => {
                // Get laravel validation error
                this.errors = error.response.data.errors;
                console.log(error.response.data.message);
            });
        },

        // Get neighbourhood data to update
        editNeighbourhood(neighbourhood) {
            this.neighbourhood = neighbourhood;
            this.editMode = true;
        },

        // Update neighbourhood
        updateNeighbourhood(id, neighbourhood) {
            axios.patch(`/api/neighbourhoods/${id}`, neighbourhood).then(response => {
                this.changeCity();
                $('#editNeighbourhood').modal('hide');
                this.editMode = false;
            }).catch(error => {
                this.errors = error.response.data.errors;
                console.log(error.response.data.message);
            });
        },

        // Get neighbourhood to delete
        getNeighbourhoodToDelete(id) {
            this.neighbourhoodDeleteId = id;
        },

        // Delete neighbourhood
        deleteNeighbourhood() {
            axios.delete(`/api/neighbourhoods/${this.neighbourhoodDeleteId}`).then(response => {
                this.changeCity();
                $('#deleteNeighbourhood').modal('hide');
            })
        },

        clearErrors() {
            this.errors = [];
        }
    }
}
</script>

<style lang="scss" scoped>
    label {
        font-size: 1.25rem;
        font-weight: 400;
    }
</style>
