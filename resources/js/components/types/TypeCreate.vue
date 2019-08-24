<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">اسم النوع</label>
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
            type: {},
        }
    },

    methods: {
        onSubmit() {
            this.type = {
                name: this.name
            }
            this.$emit('type-submitted', this.type);
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
