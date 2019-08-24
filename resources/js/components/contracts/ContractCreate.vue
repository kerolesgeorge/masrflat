<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">اسم العقد</label>
                <input type="text" :class="[{'is-invalid' : checkError('name')}, 'form-control']" id="name" name="name" v-model="name">
                <div class="invalid-feedback">{{ nameError }}</div>
            </div>
            <button class="btn btn-primary" @click.prevent="onSubmit">اضافة</button>
        </form>
    </div>
</template>

<script>
export default {
    props: ['submitErrors'],

    data() {
        return {
            name: '',
            contract: {},
        }
    },

    methods: {
        onSubmit() {
            this.contract = {
                name: this.name
            }
            this.$emit('contract-submitted', this.contract);
            this.name = '';
        },

        checkError(prop) {
            return this.submitErrors.hasOwnProperty(prop);
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
