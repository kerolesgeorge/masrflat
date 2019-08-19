<template>
    <div>


        <!-- Page Loader -->
        <div class="loader-wrapper">
            <div class="loader"></div>
        </div>

        <!-- Types list card -->
        <div v-if="!types.length">
            <h3>لا يوجد انواع</h3>
            <p>برجاء ادخال انواع</p>
        </div>

        <div class="card" v-if="types.length">
            <div class="d-flex justify-content-between">
                <h3 class="m-1">الأنواع</h3>

                 <!-- Add new city section -->
                <button class="btn btn-success m-2" data-toggle="modal" data-target="#createType" @click="clearErrors">اضافة</button>
            </div>

            <table class="table p-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم النوع</th>
                        <th scope="col">تعاملات</th>
                    </tr>
                </thead>
                <tbody>
                <!-- using etype coz type seems to be a javascript keyword -->
                    <tr v-for="etype in types" :key="etype.id">
                        <th scope="row">{{ etype.id }}</th>
                        <td>{{ etype.name }}</td>
                        <td>

                            <!-- Update button -->
                            <a href="#" title="تعديل" @click="editType(etype);clearErrors()" data-toggle="modal" data-target="#editType"><i class="fas fa-edit"></i></a>

                            <!-- Delete Button -->
                            <button class="btn btn-delete mr-2" data-toggle="modal" data-target="#deleteType" @click="getTypeToDelete(etype.id)">
                                <i class="fas fa-trash" style="color: red;"></i>
                            </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create type modal -->
        <div class="modal fade" id="createType" tabindex="-1" role="dialog" aria-labelledby="createCityLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCityLabel">اضافة نوع جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Create city form component -->
                        <type-create
                        :submitErrors="errors"
                        @type-submitted="createType"></type-create>

                    </div>
                </div>
            </div>
        </div>

        <!-- Edit type modal -->
        <div class="modal fade" id="editType" tabindex="-1" role="dialog" aria-labelledby="editCityLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCityLabel">تعديل نوع</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Edit city form component -->
                        <type-edit
                        :type="type"
                        :submitErrors="errors"
                        @type-update="updateType"></type-edit>

                    </div>
                </div>
            </div>
        </div>

        <!-- Delete type modal -->
        <div class="modal fade" id="deleteType" tabindex="-1" role="dialog" aria-labelledby="deleteTypeLabel" aria-hidden="true" dir="ltr">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="flex-direction:row-reverse!important">
                        <h5 class="modal-title" id="deleteTypeLabel">حذف نوع</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="deleteType">احذف</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
// Import type components
import TypeCreate from './TypeCreate';
import TypeEdit from './TypeEdit';

export default {
    data() {
        return {
            types: [],
            errors: [],
            type: {},
            typeToDelete: '',
        }
    },

    components: {
        TypeCreate,
        TypeEdit
    },

    mounted() {
        this.fetchTypes();

        // Hide loader
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut();
        });
    },

    methods: {
        // Fetch all types
        fetchTypes() {
            axios.get('/api/types').then(response => {
                this.types = response.data;
            }).catch(error => {
                console.log(error.response.data.message);
            });
        },

        // Create new type
        createType(type) {
            axios.post('/api/types', type).then(response => {
                this.fetchTypes();
                $('#createType').modal('hide');
            }).catch(error => {
                // Get laravel validation error
                this.errors = error.response.data.errors;
            })
        },

        // Get type data to update
        editType(type) {
            this.type.id = type.id;
            this.type.name = type.name;
        },

        // Edit type
        updateType(type) {
            axios.patch(`/api/types/${type.id}`, type).then(response => {
                this.fetchTypes();
                $('#editType').modal('hide');
            }).catch(error => {
                this.typeToDelete = error.response.data.errors;
                console.log(error.response.data.message);
            });
        },

        // Get type to delete
        getTypeToDelete(id) {
            this.typeToDelete = id;
        },

        deleteType() {
            axios.delete(`/api/types/${this.typeToDelete}`).then(response => {
                this.fetchTypes();
                $('#deleteType').modal('hide');
            });
        },

        clearErrors() {
            this.errors = [];
        },
    }
}
</script>

<style lang="scss" scoped>
    /* .card {
        max-width: 450px;
    } */
</style>
