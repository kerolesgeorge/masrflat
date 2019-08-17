<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">اسم النوع</label>
                <input type="text" :class="[{'is-invalid' : submitErrors.hasOwnProperty('name')}, 'form-control']" id="name" name="name" v-model="type.name">
                <div class="invalid-feedback">{{ nameError }}</div>
            </div>
            <button class="btn btn-primary" @click.prevent="onSubmit">حفظ</button>
        </form>
    </div>
</template>

<script>
export default {
    props: ['type', 'submitErrors'],

    data() {
        return {
            typeUpdate: {},
        }
    },

    methods: {
        onSubmit() {
            this.typeUpdate = {
                id: this.type.id,
                name: this.type.name
            }
            this.$emit('type-update', this.typeUpdate);
        }
    },

    /* watch: {
        name(val) {
            this.typeName = val;
        }
    }, */

    computed: {
        nameError() {
            let error = this.submitErrors;
            return error.hasOwnProperty('name') ? error.name[0] : '';
        }
    },
}
</script>

<style lang="scss" scoped>
    //
</style>
