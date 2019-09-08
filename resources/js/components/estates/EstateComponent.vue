<template>
    <div>
        <!-- Page Loader -->
        <div class="loader-wrapper">
            <div class="loader"></div>
        </div>

        <!-- Estates list card -->
        <div v-if="!estates.length">
            <h3>لا يوجد عقارات</h3>
            <p>برجاء ادخال عقارات</p>
        </div>

         <div class="card">
            <div class="d-flex justify-content-between">
                <h3 class="m-1">العقارات</h3>

                 <!-- Add new estate section -->
                <button class="btn btn-success m-2" data-toggle="modal" data-target="#createEstate" @click="clearErrors">اضافة</button>
            </div>

            <table class="table p-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">العنوان</th>
                        <th scope="col">تعاملات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="estate in estates" :key="estate.id">
                        <th scope="row">{{ estate.id }}</th>
                        <td>{{ estate.title }}</td>
                        <td>

                            <!-- Update button -->
                            <a href="#" title="تعديل" @click="editEstate(estate); clearErrors()" data-toggle="modal" data-target="#editEstate"><i class="fas fa-edit"></i></a>

                            <!-- Delete Button -->
                            <button class="btn btn-delete" data-toggle="modal" data-target="#deleteEstate" @click="getEstateToDelete(estate.id)">
                                <i class="fas fa-trash" style="color: red;"></i>
                            </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create estate modal -->
        <div class="modal fade" id="createEstate" tabindex="-1" role="dialog" aria-labelledby="createEstateLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createEstateLabel">اضافة عقار جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Create city form component -->
                        <estate-create
                        :submitErrors="errors"
                        @estate-submitted="createEstate"></estate-create>

                    </div>
                </div>
            </div>
        </div>

        <!-- Edit estate modal -->
        <div class="modal fade" id="editEstate" tabindex="-1" role="dialog" aria-labelledby="editEstateLabel" aria-hidden="true" v-if="estate">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEstateLabel">تعديل عقار</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Edit Estate form component -->
                        <estate-edit
                        :id="estate.id"
                        :title="estate.title"
                        :neighbourhoodId="estate.neighbourhood_id"
                        :typeId="estate.type_id"
                        :contractId="estate.contract_id"
                        :finishTypeId="estate.finish_type_id"
                        :viewId="estate.view_id"
                        :area="estate.area"
                        :floorNumber="estate.floor_number"
                        :numberOfRooms="estate.number_of_rooms"
                        :numberOfBathrooms="estate.number_of_bathrooms"
                        :numberOfLivingSpaces="estate.number_of_living_spaces"
                        :numberOfBalconies="estate.number_of_balconies"
                        :buildYear="estate.build_year"
                        :hasGarage="estate.has_garage"
                        :hasElevator="estate.has_elevator"
                        :notes="estate.notes"
                        :images="estate.images"
                        :submitErrors="errors"
                        @estate-update="updateEstate"></estate-edit>

                    </div>
                </div>
            </div>
        </div>

        <!-- Delete estate modal -->
        <div class="modal fade" id="deleteEstate" tabindex="-1" role="dialog" aria-labelledby="deleteEstateLabel" aria-hidden="true" dir="ltr">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="flex-direction:row-reverse!important">
                        <h5 class="modal-title" id="deleteEstateLabel">حذف عقار</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="deleteEstate">احذف</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
// Import estate components
import EstateCreate from './EstateCreate';
import EstateEdit from './EstateEdit';

export default {
    data() {
        return {
            estates: [],
            errors: {},
            estateDeleteId: null,
            createMode: false,
            editMode: false,
            estate: {},
        }
    },

    components: {
        EstateCreate,
        EstateEdit
    },

    mounted() {
        this.fetchEstates();

        // Hide loader
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut();
        });
    },

    methods: {
        fetchEstates() {
            axios.get('/api/estates').then(response => {
                this.estates = response.data;
            }).catch(error => {
                console.log(error.response.data.message);
            });
        },

        createEstate(estate) {
            axios.post('/api/estates', estate).then(response => {
                this.fetchEstates();
                //$('#createEstate').modal('hide');
                location.reload();
            }).catch(error => {
                // Get laravel validation error
                this.errors = error.response.data.errors;
            });
        },

        editEstate(estate) {
            this.estate = estate;
        },

        updateEstate(id, estate) {
            //console.log(estate.id);
            axios.patch(`/api/estates/${id}`, estate).then(response => {
                this.fetchEstates();
                $('#editEstate').modal('hide');
            }).catch(error => {
                // Get laravel validation error
                this.errors = error.response.data.errors;
            });
        },

        getEstateToDelete(id) {
            this.estateDeleteId = id;
        },

        deleteEstate() {
            axios.delete(`/api/estates/${this.estateDeleteId}`).then(response => {
                this.fetchEstates();
                $('#deleteEstate').modal('hide');
            });
        },

        clearErrors() {
            this.errors = [];
        },
    },
}
</script>

<style lang="scss" scoped>
    //
</style>
