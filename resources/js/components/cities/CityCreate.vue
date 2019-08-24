<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">اسم المدينه</label>
                <input type="text" :class="[{'is-invalid' : checkError('name')}, 'form-control']" id="name" name="name" v-model="name">
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
            city: {},
        }
    },

    methods: {
        onSubmit() {
            this.city = {
                name: this.name
            }
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
