<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">نوع الواجهه</label>
                <input type="text" :class="[{'is-invalid' : submitErrors.hasOwnProperty('name')}, 'form-control']" id="name" name="name" v-model="view.name">
                <div class="invalid-feedback">{{ nameError }}</div>
            </div>
            <button class="btn btn-primary" @click.prevent="onSubmit">حفظ</button>
        </form>
    </div>
</template>

<script>
export default {
    props: ['view', 'submitErrors'],

    data() {
        return {
            viewUpdate: {},
        }
    },

    methods: {
        onSubmit() {
            this.viewUpdate = {
                id: this.view.id,
                name: this.view.name,
            }
            this.$emit('view-update', this.viewUpdate);
        }
    },

    /* watch: {
        name(val) {
            this.viewName = val;
        }
    }, */

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
