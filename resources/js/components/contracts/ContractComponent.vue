<template>
    <div>
        <!-- Add new city section -->
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#createContract" @click="clearErrors">اضافة نوع جديد</button>

        <!-- Page Loader -->
        <div class="loader-wrapper">
            <div class="loader"></div>
        </div>

        <!-- Cities list card -->
        <div v-if="!contracts.length">
            <h3>لا يوجد عقود</h3>
            <p>برجاء ادخال انواع جديده</p>
        </div>

        <div class="card" v-if="contracts.length">
            <h3 class="m-3">العقود</h3>
            <table class="table p-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نوع العقد</th>
                        <th scope="col">تعاملات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="contract in contracts" :key="contract.id">
                        <th scope="row">{{ contract.id }}</th>
                        <td>{{ contract.name }}</td>
                        <td>

                            <!-- Update button -->
                            <a href="#" title="تعديل" @click="editContract(contract);clearErrors()" data-toggle="modal" data-target="#editContract"><i class="fas fa-edit"></i></a>

                            <!-- Delete Button -->
                            <button class="btn btn-delete" data-toggle="modal" data-target="#deleteContract" @click="getContractToDelete(contract.id)">
                                <i class="fas fa-trash" style="color: red;"></i>
                            </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create Contract modal -->
        <div class="modal fade" id="createContract" tabindex="-1" role="dialog" aria-labelledby="createContractLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createContractLabel">اضافة عقد جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Create city form component -->
                        <contract-create
                        :submitErrors="errors"
                        @contract-submitted="createContract"></contract-create>

                    </div>
                </div>
            </div>
        </div>

        <!-- Edit contract modal -->
        <div class="modal fade" id="editContract" tabindex="-1" role="dialog" aria-labelledby="editContractLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editContractLabel">تعديل نوع عقد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Edit contract form component -->
                        <contract-edit
                        :id="contract.id"
                        :name="contract.name"
                        :submitErrors="errors"
                        @contract-update="updateContract"></contract-edit>

                    </div>
                </div>
            </div>
        </div>

        <!-- Delete contract modal -->
        <div class="modal fade" id="deleteContract" tabindex="-1" role="dialog" aria-labelledby="deleteContractLabel" aria-hidden="true" dir="ltr">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="flex-direction:row-reverse!important">
                        <h5 class="modal-title" id="deleteContractLabel">حذف نوع عقد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem auto -1rem -1rem">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="deleteContract">احذف</button>
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
            contracts: [],
            errors: [],
            contract: {},
            contractDeleteId: '',
        }
    },

    mounted() {
        this.fetchContracts();

        // Hide loader
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut();
        });
    },

    methods: {
        // Fetch all contracts
        fetchContracts() {
            axios.get('/api/contracts').then(response => {
                this.contracts = response.data;
            }).catch(error => {
                console.log(error.response.data.message);
            });
        },

        // Create new contract
        createContract(contract) {
            axios.post('/api/contracts/', contract).then(response => {
                this.fetchContracts();
                $('#createContract').modal('hide');
            }).catch(error => {
                // Get laravel validation error
                this.errors = error.response.data.errors;
            });
        },

        // Fetch contract to edit
        editContract(contract) {
            this.contract.id = contract.id;
            this.contract.name = contract.name;
        },

        // Update contract
        updateContract(contract) {
            axios.patch(`/api/contracts/${contract.id}`, contract).then(response => {
                this.fetchContracts();
                $('#editContract').modal('hide');
            }).catch(error => {
                // Get laravel validation error
                this.errors = error.response.data.errors;
            });
        },

        // Fetch contract to delete
        getContractToDelete(id) {
            this.contractDeleteId = id;
        },

        // Delete contract
        deleteContract() {
            axios.delete(`/api/contracts/${this.contractDeleteId}`).then(response => {
                this.fetchContracts();
                $('#deleteContract').modal('hide');
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
