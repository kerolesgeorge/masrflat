<template>
    <div><!-- Page Loader -->
        <div class="loader-wrapper">
            <div class="loader"></div>
        </div>

        <!-- Cities list card -->
        <div v-if="!finishes.length">
            <h3>لا يوجد انواع تشطيبات</h3>
            <p>برجاء ادخال انواع جديده</p>
        </div>

        <div class="card" v-if="finishes.length">
            <div class="d-flex justify-content-between">
                <h3 class="m-1">التشطيبات</h3>

                <!-- Add new city section -->
                <button class="btn btn-success m-2" data-toggle="modal" data-target="#createFinish" @click="clearErrors">اضافة</button>
            </div>

            <table class="table p-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نوع العقد</th>
                        <th scope="col">تعاملات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="finish in finishes" :key="finish.id">
                        <th scope="row">{{ finish.id }}</th>
                        <td>{{ finish.name }}</td>
                        <td>

                            <!-- Update button -->
                            <a href="#" title="تعديل" @click="editFinish(finish);clearErrors()" data-toggle="modal" data-target="#editFinish"><i class="fas fa-edit"></i></a>

                            <!-- Delete Button -->
                            <button class="btn btn-delete" data-toggle="modal" data-target="#deleteFinish" @click="getFinishToDelete(finish.id)">
                                <i class="fas fa-trash" style="color: red;"></i>
                            </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create finish type modal -->
        <div class="modal fade" id="createFinish" tabindex="-1" role="dialog" aria-labelledby="createFinishLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createFinishLabel">اضافة نوع تشطيبات جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Create city form component -->
                        <finish-create
                        :submitErrors="errors"
                        @finish-submitted="createFinish"></finish-create>

                    </div>
                </div>
            </div>
        </div>

        <!-- Edit finish type modal -->
        <div class="modal fade" id="editFinish" tabindex="-1" role="dialog" aria-labelledby="editFinishLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFinishLabel">تعديل نوع تشطيب</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Edit finish type form component -->
                        <finish-edit
                        :finish="finish"
                        :submitErrors="errors"
                        @finish-update="updateFinish"></finish-edit>

                    </div>
                </div>
            </div>
        </div>

        <!-- Delete contract modal -->
        <div class="modal fade" id="deleteFinish" tabindex="-1" role="dialog" aria-labelledby="deleteFinishLabel" aria-hidden="true" dir="ltr">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="flex-direction:row-reverse!important">
                        <h5 class="modal-title" id="deleteFinishLabel">حذف نوع تشطيب</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="deleteFinish">احذف</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
// Import finish components
import FinishCreate from './FinishCreate';
import FinishEdit from './FinishEdit';

export default {
    data() {
        return {
            finishes: [],
            errors: [],
            finish: {},
            finishDeleteId: '',
        }
    },

    components: {
        FinishCreate,
        FinishEdit
    },

    mounted() {
        this.fetchFinishes();

        // Hide loader
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut();
        });
    },

    methods: {
        // Fetch all finish types
        fetchFinishes() {
            axios.get('/api/finishtypes').then(response => {
                this.finishes = response.data;
            }).catch(error => {
                console.log(error.response.data.message);
            });
        },

        // Create new finish type
        createFinish(finish) {
            axios.post('/api/finishtypes/', finish).then(response => {
                this.fetchFinishes();
                $('#createFinish').modal('hide');
            }).catch(error => {
                // Get laravel validation error
                this.errors = error.response.data.errors;
            });
        },

        // Fetch finish type to edit
        editFinish(finish) {
            this.finish.id = finish.id;
            this.finish.name = finish.name;
        },

        // Update finish type
        updateFinish(finish) {
            axios.patch(`/api/finishtypes/${finish.id}`, finish).then(response => {
                this.fetchFinishes();
                $('#editFinish').modal('hide');
            }).catch(error => {
                // Get laravel validation error
                this.errors = error.response.data.errors;
            });
        },

        // Fetch finish type to delete
        getFinishToDelete(id) {
            this.finishDeleteId = id;
        },

        // Delete finish
        deleteFinish() {
            axios.delete(`/api/finishtypes/${this.finishDeleteId}`).then(response => {
                this.fetchFinishes();
                $('#deleteFinish').modal('hide');
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
