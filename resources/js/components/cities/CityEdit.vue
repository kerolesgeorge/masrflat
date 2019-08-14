<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">اسم المدينه</label>
                <input type="text" :class="[{'is-invalid' : isError}, 'form-control']" id="name" name="name" v-model="cityName">
                <div class="invalid-feedback">{{ errorMsg }}</div>
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
            cityName: '',
        }
    },

    methods: {
        onSubmit() {
            let city = {
                id: this.id,
                name: this.cityName
            };
            this.$emit('city-update', city);
        }
    },

    watch: {
        name(val) {
            this.cityName = val;
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
