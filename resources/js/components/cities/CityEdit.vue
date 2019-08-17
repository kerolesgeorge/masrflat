<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">اسم المدينه</label>
                <input type="text" :class="[{'is-invalid' : submitErrors.hasOwnProperty('name')}, 'form-control']" id="name" name="name" v-model="city.name">
                <div class="invalid-feedback">{{ nameError }}</div>
            </div>
            <button class="btn btn-primary" @click.prevent="onSubmit">حفظ</button>
        </form>
    </div>
</template>

<script>
export default {
    props: ['city', 'submitErrors'],

    data() {
        return {
            //cityName: '',
            cityUpdate: {},
        }
    },

    methods: {
        onSubmit() {
            this.cityUpdate = {
                id: this.city.id,
                name: this.city.name,
            }
            this.$emit('city-update', this.cityUpdate);
        }
    },

    watch: {
        /* name(val) {
            this.cityName = val;
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
