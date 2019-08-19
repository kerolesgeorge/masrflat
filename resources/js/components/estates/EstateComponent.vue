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
                        <td>{{ estate.name }}</td>
                        <td>

                            <!-- Update button -->
                            <a href="#" title="تعديل" @click="editEstate(estate);clearErrors()" data-toggle="modal" data-target="#editEstate"><i class="fas fa-edit"></i></a>

                            <!-- Delete Button -->
                            <button class="btn btn-delete" data-toggle="modal" data-target="#deleteEstate" @click="geteEstateToDelete(estate.id)">
                                <i class="fas fa-trash" style="color: red;"></i>
                            </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create city modal -->
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
            errors: []
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

        createEstate() {

        },

        editEstate() {

        },

        updateEstate() {

        },

        getEstateToDelete() {

        },

        clearErrors() {

        },
    }
}
</script>

<style lang="scss" scoped>
    //
</style>
