<template>
    <div>
        <form>
            <div class="form-row m-1 mb-3" dir="rtl">
                <label for="cities" class="col-md-3 col-form-label">اختار مدينة</label>
                <select id="cities" :class="[{'is-invalid' : submitErrors.hasOwnProperty('city_id')}, 'form-control col-md-9 p-1']" v-model="selected">
                    <option v-for="city in citiesOptions" :key="city.id" :value="city.id">
                        {{ city.name }}
                    </option>
                </select>
                <div class="invalid-feedback">{{ cityIdError }}</div>
            </div>
            <div class="form-row m-1 mb-3">
                <label for="name" class="col-md-3 col-form-label">اسم الحي</label>
                <input type="text" :class="[{'is-invalid' : submitErrors.hasOwnProperty('name')}, 'form-control col-md-9']" id="name" name="name" v-model="name">
                <div class="invalid-feedback">{{ nameError }}</div>
            </div>
            <div class="form-row">
                <div class="col-md-3"></div>
                <button class="btn btn-primary col-md-3" @click.prevent="onSubmit">اضافة</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ['citiesOptions', 'submitErrors'],

    data() {
        return {
            name: '',
            selected: '',
            errors: [],
        }
    },

    methods: {
        onSubmit() {
            let neighbourhood = {name: this.name, city_id: this.selected};
            this.$emit('neighbourhood-submitted', neighbourhood);
        },
    },

    computed: {
        cityIdError() {
            let error = this.submitErrors;
            return error.hasOwnProperty('city_id') ? error.city_id[0] : '';
        },

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
