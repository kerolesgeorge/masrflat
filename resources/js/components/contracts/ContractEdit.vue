<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">اسم العقد</label>
                <input type="text" :class="[{'is-invalid' : submitErrors.hasOwnProperty('name')}, 'form-control']" id="name" name="name" v-model="contract.name">
                <div class="invalid-feedback">{{ nameError }}</div>
            </div>
            <button class="btn btn-primary" @click.prevent="onSubmit">حفظ</button>
        </form>
    </div>
</template>

<script>
export default {
    props: ['contract', 'submitErrors'],

    data() {
        return {
            //contractName: '',
            contractUpdate: {},
        }
    },

    methods: {
        onSubmit() {
            this.contractUpdate = {
                id: this.contract.id,
                name: this.contract.name
            }
            this.$emit('contract-update', this.contractUpdate);
        }
    },

    watch: {
        /* name(val) {
            this.contractName = val;
        } */
    },

    computed: {
        nameError() {
            let error = this.submitErrors;
            return error.hasOwnProperty('name') ? error.name[0] : '';
        }
    }
}
</script>

<style lang="scss" scoped>
    //
</style>
