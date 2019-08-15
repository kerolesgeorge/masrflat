<template>
    <div>
        <!-- Add new city section -->
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#createType" @click="clearErrors">
            اضافة نوع جديد
        </button>

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
            <h3 class="m-3">الأنواع</h3>
            <table class="table p-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم النوع</th>
                        <th scope="col">تعاملات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="etype in types" :key="etype.id">
                        <th scope="row">{{ etype.id }}</th>
                        <td>{{ etype.name }}</td>
                        <td>

                            <!-- Update button -->
                            <a href="#" title="تعديل" @click="editType(etype);clearErrors()" data-toggle="modal" data-target="#editType"><i class="fas fa-edit"></i></a>

                            <!-- Delete Button -->
                            <button class="btn btn-delete" data-toggle="modal" data-target="#deleteType" @click="getTypeToDelete(etype.id)">
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

    </div>
</template>

<script>
export default {
    data() {
        return {
            types: [],
            errors: [],
        }
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

        clearErrors() {
            this.errors = [];
        },
    }
}
</script>

<style lang="scss" scoped>

</style>
