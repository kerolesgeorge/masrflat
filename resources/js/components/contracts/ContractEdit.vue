<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">اسم العقد</label>
                <input type="text" :class="[{'is-invalid' : submitErrors.hasOwnProperty('name')}, 'form-control']" id="name" name="name" v-model="contractName">
                <div class="invalid-feedback">{{ nameError }}</div>
            </div>
            <button class="btn btn-primary" @click.prevent="onSubmit">حفظ</button>
        </form>
    </div>
</template>

<script>
export default {
    props: ['id', 'name', 'submitErrors'],

    data() {
        return {
            contractName: '',
            contract: {},
        }
    },

    methods: {
        onSubmit() {
            this.contract = {
                id: this.id,
                name: this.contractName
            }
            this.$emit('contract-update', this.contract);
        }
    },

    watch: {
        name(val) {
            this.contractName = val;
        }
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
