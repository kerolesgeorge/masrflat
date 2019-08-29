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
                <button class="btn btn-success m-2" data-toggle="modal" data-target="#createEstate" @click="createMode=true; clearErrors">اضافة</button>
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
                            <a href="#" title="تعديل" @click="editEstate(estate);clearErrors()" data-toggle="modal" data-target="#editEstate"><i class="fas fa-edit"></i></a>

                            <!-- Delete Button -->
                            <button class="btn btn-delete" data-toggle="modal" data-target="#deleteEstate" @click="getEstateToDelete(estate.id)">
                                <i class="fas fa-trash" style="color: red;"></i>
                            </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create city modal -->
        <div class="modal fade" id="createEstate" tabindex="-1" role="dialog" aria-labelledby="createEstateLabel" aria-hidden="true" v-if="createMode">
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
            axios.post('/api/estates', estate, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                this.fetchEstates();
                //$('#createEstate').modal('hide');
                location.reload();
            }).catch(error => {
                // Get laravel validation error
                this.errors = error.response.data.errors;
            });
        },

        editEstate() {

        },

        updateEstate() {

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
    }
}
</script>

<style lang="scss" scoped>
    //
</style>
