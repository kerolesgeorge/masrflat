<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">نوع التشطيب</label>
                <input type="text" :class="[{'is-invalid' : submitErrors.hasOwnProperty('name')}, 'form-control']" id="name" name="name" v-model="finish.name">
                <div class="invalid-feedback">{{ nameError }}</div>
            </div>
            <button class="btn btn-primary" @click.prevent="onSubmit">حفظ</button>
        </form>
    </div>
</template>

<script>
export default {
    props: ['finish', 'submitErrors'],

    data() {
        return {
            //finishName: '',
            finishUpdate: {},
        }
    },

    methods: {
        onSubmit() {
            this.finishUpdate = {
                id: this.finish.id,
                name: this.finish.name,
            }
            this.$emit('finish-update', this.finishUpdate);
        }
    },

    watch: {
        /* name(val) {
            this.finishName = val;
        } */
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
