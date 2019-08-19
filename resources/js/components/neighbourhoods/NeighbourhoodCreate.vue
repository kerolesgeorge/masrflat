<template>
    <div>
        <form>
            <div class="form-row mb-3">
                <label for="name" class="col-md-3 col-form-label">اسم الحي</label>
                <input type="text" :class="[{'is-invalid' : submitErrors.hasOwnProperty('name')}, 'form-control col-md-9']" id="name" name="name" v-model="name">
                <div class="invalid-feedback">{{ nameError }}</div>
            </div>
            <div class="form-row">
                <div class="col-md-3"></div>
                <button class="btn btn-primary col-md-3" @click.prevent="onSubmit">اضافة</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ['submitErrors'],

    data() {
        return {
            name: '',
            errors: [],
            neighbourhood: {},
        }
    },

    methods: {
        onSubmit() {
            this.neighbourhood = {
                name: this.name
            }
            this.$emit('neighbourhood-submitted', this.neighbourhood);
        },
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
