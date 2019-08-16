<template>
    <div>
        <!-- Add new city section -->
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#createView" @click="clearErrors">اضافة واجهات</button>

        <!-- Page Loader -->
        <div class="loader-wrapper">
            <div class="loader"></div>
        </div>

        <!-- Cities list card -->
        <div v-if="!views.length">
            <h3>لا يوجد واجهات</h3>
            <p>برجاء ادخال واجهات جديده</p>
        </div>

        <div class="card" v-if="views.length">
            <h3 class="m-3">الواجهات</h3>
            <table class="table p-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الواجهه</th>
                        <th scope="col">تعاملات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="view in views" :key="view.id">
                        <th scope="row">{{ view.id }}</th>
                        <td>{{ view.name }}</td>
                        <td>

                            <!-- Update button -->
                            <a href="#" title="تعديل" @click="editView(view);clearErrors()" data-toggle="modal" data-target="#editView"><i class="fas fa-edit"></i></a>

                            <!-- Delete Button -->
                            <button class="btn btn-delete" data-toggle="modal" data-target="#deleteView" @click="getViewToDelete(view.id)">
                                <i class="fas fa-trash" style="color: red;"></i>
                            </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create view modal -->
        <div class="modal fade" id="createView" tabindex="-1" role="dialog" aria-labelledby="createViewLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createViewLabel">اضافة واجهه جديده</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Create city form component -->
                        <view-create
                        :submitErrors="errors"
                        @view-submitted="createView"></view-create>

                    </div>
                </div>
            </div>
        </div>

        <!-- Edit view modal -->
        <div class="modal fade" id="editView" tabindex="-1" role="dialog" aria-labelledby="editViewLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editViewLabel">تعديل واجهه</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Edit view form component -->
                        <view-edit
                        :id="view.id"
                        :name="view.name"
                        :submitErrors="errors"
                        @view-update="updateView"></view-edit>

                    </div>
                </div>
            </div>
        </div>

        <!-- Delete view modal -->
        <div class="modal fade" id="deleteView" tabindex="-1" role="dialog" aria-labelledby="deleteViewLabel" aria-hidden="true" dir="ltr">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="flex-direction:row-reverse!important">
                        <h5 class="modal-title" id="deleteViewLabel">حذف واجهه</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="deleteView">احذف</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            views: [],
            errors: [],
            view: {},
            viewDeleteId: '',
        }
    },

    mounted() {
        this.fetchViews();

        // Hide loader
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut();
        });
    },

    methods: {
        // Fetch all views
        fetchViews() {
            axios.get('/api/views').then(response => {
                this.views = response.data;
            }).catch(error => {
                console.log(error.response.data.message);
            });
        },

        // Create new contract
        createView(view) {
            axios.post('/api/views', view).then(response => {
                this.fetchViews();
                $('#createView').modal('hide');
            }).catch(error => {
                // Get laravel validation error
                this.errors = error.response.data.errors;
            });
        },

        // Fetch contract to edit
        editView(view) {
            this.view.id = view.id;
            this.view.name = view.name;
        },

        // Update view
        updateView(view) {
            axios.patch(`/api/views/${view.id}`, view).then(response => {
                this.fetchViews();
                $('#editView').modal('hide');
            }).catch(error => {
                // Get laravel validation error
                this.errors = error.response.data.errors;
            });
        },

        // Fetch view to delete
        getViewToDelete(id) {
            this.viewDeleteId = id;
        },

        // Delete view
        deleteView() {
            axios.delete(`/api/views/${this.viewDeleteId}`).then(response => {
                this.fetchViews();
                $('#deleteView').modal('hide');
            });
        },

        clearErrors() {
            this.errors = [];
        }
    },
}
</script>

<style lang="scss" scoped>
    //
</style>
