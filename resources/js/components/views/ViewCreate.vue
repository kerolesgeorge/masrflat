<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">اسم الواجهه</label>
                <input type="text" :class="[{'is-invalid' : submitErrors.hasOwnProperty('name')}, 'form-control']" id="name" name="name" v-model="name">
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
            view: {},
        }
    },

    methods: {
        onSubmit() {
            this.view = {
                name: this.name
            }
            this.$emit('view-submitted', this.view);
            this.name = '';
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
