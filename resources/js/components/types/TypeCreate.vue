<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">اسم النوع</label>
                <input type="text" :class="[{'is-invalid' : isError}, 'form-control']" id="name" name="name" v-model="name">
                <div class="invalid-feedback">{{ errorMsg }}</div>
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
        }
    },

    computed: {
        isError() {
             return this.submitErrors.name;
        },

        errorMsg() {
            return this.submitErrors.name ? this.submitErrors.name[0] : '';
        }
    }
}
</script>

<style lang="scss" scoped>
    //
</style>
