<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">نوع الواجهه</label>
                <input type="text" :class="[{'is-invalid' : submitErrors.hasOwnProperty('name')}, 'form-control']" id="name" name="name" v-model="viewName">
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
            viewName: '',
            view: {},
        }
    },

    methods: {
        onSubmit() {
            this.view = {
                id: this.id,
                name: this.viewName
            }
            this.$emit('view-update', this.view);
        }
    },

    watch: {
        name(val) {
            this.viewName = val;
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
