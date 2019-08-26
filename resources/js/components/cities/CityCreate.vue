<template>
    <div>
        <form id="city-form">
            <div class="form-group">
                <label for="name">اسم المدينه</label>
                <input type="text" :class="[{'is-invalid' : checkError('name')}, 'form-control']" id="name" name="name">
                <div class="invalid-feedback">{{ getError('name') }}</div>
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
            city: null,
        }
    },

    methods: {
        onSubmit() {
            let form = document.getElementById('city-form');
            this.city = new FormData(form);
            this.$emit('city-submitted', this.city);
            this.name = '';
        },

        checkError(prop) {
            return this.submitErrors.hasOwnProperty(prop);
        },

        getError(prop) {
            return this.checkError(prop) ? this.submitErrors[prop][0] : '';
        }
    },
}
</script>

<style lang="scss" scoped>
    //
</style>
