<template>
    <div>
        <form id="estateForm">

            <!-- Estate title -->
            <div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">عنوان الاعلان</label>
                <div class="col-sm-9">
                    <input type="text" :class="[{'is-invalid' : checkError('title')}, 'form-control']" id="title" name="title" v-model="title">
                    <div class="invalid-feedback">{{ getError('title') }}</div>
                </div>
            </div>

            <hr>

            <!-- City and neighbourhood select -->
            <div class="form-group row">
                <label for="city" class="col-sm-2 col-form-label">المدينة</label>
                <div class="col-sm-4">
                    <select id="city" class="form-control p-1" v-model="selectedCity" @change="fetchNeighbourhoods">
                        <option v-for="city in cities" :key="city.id" :value="city.id">
                            {{ city.name }}
                        </option>
                    </select>
                </div>

                <label for="neighbourhood" class="col-sm-2 col-form-label">الحي</label>
                <div class="col-sm-4">
                    <select id="neighbourhood" name="neighbourhood_id" :class="[{'is-invalid' : checkError('neighbourhood_id')}, 'form-control p-1']" v-model="selectedNeighbourhood">
                        <option v-for="neighbourhood in neighbourhoods" :key="neighbourhood.id" :value="neighbourhood.id">
                            {{ neighbourhood.name }}
                        </option>
                    </select>
                    <div class="invalid-feedback">{{ getError('neighbourhood_id') }}</div>
                </div>
            </div>

            <!-- Estate type and contract type select -->
            <div class="form-group row">
                <label for="type" class="col-sm-2 col-form-label">العقار</label>
                <div class="col-sm-4">
                    <select id="type" name="type_id" :class="[{'is-invalid' : checkError('type_id')}, 'form-control p-1']" v-model="selectedType">
                        <option v-for="etype in types" :key="etype.id" :value="etype.id">
                            {{ etype.name }}
                        </option>
                    </select>
                    <div class="invalid-feedback">{{ getError('type_id') }}</div>
                </div>

                <label for="contract" class="col-sm-2 col-form-label">العقد</label>
                <div class="col-sm-4">
                    <select id="contract" name="contract_id" :class="[{'is-invalid' : checkError('contract_id')}, 'form-control p-1']" v-model="selectedContract">
                        <option v-for="contract in contracts" :key="contract.id" :value="contract.id">
                            {{ contract.name }}
                        </option>
                    </select>
                    <div class="invalid-feedback">{{ getError('contract_id') }}</div>
                </div>
            </div>

            <!-- Finish types and views select -->
            <div class="form-group row">
                <label for="finish" class="col-sm-2 col-form-label">التشطيب</label>
                <div class="col-sm-4">
                    <select id="finish" name="finish_type_id" :class="[{'is-invalid' : checkError('finish_type_id')}, 'form-control p-1']" v-model="selectedFinish">
                        <option v-for="finish in finishes" :key="finish.id" :value="finish.id">
                            {{ finish.name }}
                        </option>
                    </select>
                    <div class="invalid-feedback">{{ getError('finish_type_id') }}</div>
                </div>

                <label for="view" class="col-sm-2 col-form-label">الواجهات</label>
                <div class="col-sm-4">
                    <select id="view" name="view_id" :class="[{'is-invalid' : checkError('view_id')}, 'form-control p-1']" v-model="selectedView">
                        <option v-for="view in views" :key="view.id" :value="view.id">
                            {{ view.name }}
                        </option>
                    </select>
                    <div class="invalid-feedback">{{ getError('view_id') }}</div>
                </div>
            </div>

            <hr>

            <!-- Area and floor inputs -->
            <div class="form-group row">
                <label for="area" class="col-form-label col-sm-3">المساحة م<span><sup>2</sup></span></label>
                <div class="col-sm-3">
                    <input type="text" id="area" name="area" :class="[{'is-invalid' : checkError('area')}, 'form-control']" v-model="area">
                    <div class="invalid-feedback">{{ getError('area') }}</div>
                </div>

                <label for="floor" class="col-form-label col-sm-3">الدور</label>
                <div class="col-sm-3">
                    <input type="text" id="floor" name="floor_number" :class="[{'is-invalid' : checkError('floor_number')}, 'form-control']" v-model="floor">
                    <div class="invalid-feedback">{{ getError('floor_number') }}</div>
                </div>
            </div>

            <!-- Rooms and bathrooms inputs -->
            <div class="form-group row">
                <label for="rooms" class="col-form-label col-sm-3">عدد الغرف</label>
                <div class="col-sm-3">
                    <input type="text" id="rooms" name="number_of_rooms" :class="[{'is-invalid' : checkError('number_of_rooms')}, 'form-control']" v-model="rooms">
                    <div class="invalid-feedback">{{ getError('number_of_rooms') }}</div>
                </div>

                <label for="bathrooms" class="col-form-label col-sm-3">عدد الحمامات</label>
                <div class="col-sm-3">
                    <input type="text" id="bathrooms" name="number_of_bathrooms" :class="[{'is-invalid' : checkError('number_of_bathrooms')}, 'form-control']" v-model="bathrooms">
                    <div class="invalid-feedback">{{ getError('number_of_bathrooms') }}</div>
                </div>
            </div>

            <!-- Living spaces and balconies inputs -->
            <div class="form-group row">
                <label for="living" class="col-form-label col-sm-3">عدد المعيشة</label>
                <div class="col-sm-3">
                    <input type="text" id="living" name="number_of_living_spaces" :class="[{'is-invalid' : checkError('number_of_living_spaces')}, 'form-control']" v-model="living">
                    <div class="invalid-feedback">{{ getError('number_of_living_spaces') }}</div>
                </div>

                <label for="balconies" class="col-form-label col-sm-3">عدد البلكونات</label>
                <div class="col-sm-3">
                    <input type="text" id="balconies" name="number_of_balconies" :class="[{'is-invalid' : checkError('number_of_balconies')}, 'form-control']" v-model="balconies">
                    <div class="invalid-feedback">{{ getError('number_of_balconies') }}</div>
                </div>
            </div>

            <!-- Build year -->
            <div class="form-group row">
                <label for="buildYear" class="col-form-label col-sm-3">سنة البناء</label>
                <div class="col-sm-3">
                    <input type="text" id="buildYear" name="build_year" :class="[{'is-invalid' : checkError('build_year')}, 'form-control']" v-model="buildYear">
                    <div class="invalid-feedback">{{ getError('build_year') }}</div>
                </div>
            </div>

            <hr>

            <!-- Garage and elevator inputs -->
            <div class="form-group row">
                <label for="garage" class="col-form-label col-sm-3">جراج</label>
                <div class="col-sm-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="has_garage" id="garage" v-model="garage">
                        <label class="form-check-label mr-1" for="garage1">يوجد </label>
                    </div>
                    <!-- <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="has_garage" id="garage0" value="0" v-model="garage">
                        <label class="form-check-label mr-1" for="garage0">لا يوجد</label>
                    </div> -->
                </div>
            </div>

            <div class="form-group row">
                <label for="elevator" class="col-form-label col-sm-3">اسانسير</label>
                <div class="col-sm-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="has_elevator" id="elevator" v-model="elevator">
                        <label class="form-check-label mr-1" for="elevator1">يوجد </label>
                    </div>
                    <!-- <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="has_elevator" id="elevator0" value="0" v-model="elevator">
                        <label class="form-check-label mr-1" for="elevator0">لا يوجد</label>
                    </div> -->
                </div>
            </div>

            <hr>

            <!-- Notes input -->
            <div class="form-group row">
                <label for="notes" class="col-form-label col-sm-3">ملاحظات</label>
                <div class="col-sm-9">
                     <textarea class="form-control" id="notes" name="notes" rows="3" v-model="notes"></textarea>
                </div>
            </div>

            <hr>

            <!-- Image upload -->
            <div class="row my-2">
                <label for="attachments" class="col-form-label col-sm-9" style="cursor: pointer">
                    ضيف صور <i class="fas fa-cloud-upload-alt fa-2x mr-2"></i>
                </label>
                <div class="col-sm-3 px-5">
                    <input type="file" id="attachments" ref="images" :class="[{'is-invalid' : checkError('images')}, 'form-control-file']" multiple @change="imagesUpload" style="display: none;">
                    <div class="invalid-feedback">{{ getError('images') }}</div>
                </div>
            </div>

            <!-- Attachments Loader -->
            <div style="position: relative;">
                <div class="attachment-loader-wrapper">
                    <div class="loader"></div>
                </div>
            </div>

            <!-- Images show area -->
            <div class="card-columns" v-if="attachedImages">
                <div class="card" v-for="(image, index) in images" :key="index">
                    <img :src="'/storage/' + image.url" class="card-img-top" alt="Attached Image">
                    <div class="card-body p-1">
                    <button class="btn btn-outline-danger" @click.prevent="deleteAttached(index)">Delete</button>
                    </div>
                </div>
            </div>

            <!-- Submit button -->
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary pr-4 pl-4" @click.prevent="onSubmit">اضافة</button>
                </div>
            </div>

        </form>
    </div>
</template>

<script>

export default {
    props: ['submitErrors'],

    data() {
        return {
            cities: [],
            neighbourhoods: [],
            contracts: [],
            types: [],
            finishes: [],
            views: [],
            title: '',
            area: '',
            floor: '',
            rooms: '',
            bathrooms: '',
            living: '',
            balconies: '',
            buildYear: '',
            garage: '',
            elevator: '',
            notes: '',
            images: [],

            selectedCity: '',
            selectedNeighbourhood: '',
            selectedContract: '',
            selectedType: '',
            selectedFinish: '',
            selectedView: '',
        }
    },

    mounted() {
        this.fetchCities();
        this.fetchContracts();
        this.fetchTypes();
        this.fetchFinishes();
        this.fetchViews();
    },

    methods: {
        fetchCities() {
            axios.get('/api/cities').then(response => {
                this.cities = response.data;
            }).catch(error => {
                alert('Something went wrong: \n' + error.message);
            });
        },

        fetchNeighbourhoods() {
            axios.get(`/api/cities/${this.selectedCity}/neighbourhoods`).then(response => {
                this.neighbourhoods = response.data;
            }).catch(error => {
                alert('Something went wrong \n' + error.message);
            });
        },

        fetchTypes() {
            axios.get('/api/types').then(response => {
                this.types = response.data;
            }).catch(error => {
                alert('Something went wrong \n' + error.message);
            });
        },

        fetchContracts() {
            axios.get('/api/contracts').then(response => {
                this.contracts = response.data;
            }).catch(error => {
                alert('Something went wrong \n' + error.message);
            });
        },

        fetchFinishes() {
            axios.get('/api/finishtypes').then(response => {
                this.finishes = response.data;
            }).catch(error => {
                alert('Something went wrong \n' + error.message);
            });
        },

        fetchViews() {
            axios.get('/api/views').then(response => {
                this.views = response.data;
            }).catch(error => {
                alert('Something went wrong \n' + error.message);
            });
        },

        // Handle attachments upload
        imagesUpload() {
            //alert('Estate Create File input changed');
            $(".attachment-loader-wrapper").show();

            let attachments = this.$refs.images.files;
            let imagesData = new FormData();

            for (let i = 0; i < attachments.length; i++) {
                let image = attachments[i];
                imagesData.append(`images[${i}]`, image);
            }

            axios.post('/api/attachments', imagesData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                this.images = response.data;
                $(".attachment-loader-wrapper").fadeOut();
            }).catch(error => {
                alert('Something went wrong \n' + error.message);
            });
        },

        /**
         * Delete attached photo
         */
        deleteAttached(index) {
            $(".attachment-loader-wrapper").show();
            axios.delete(`/api/attachments/${index}`).then(response => {
                this.images.splice(index, 1);
                $(".attachment-loader-wrapper").fadeOut();
            }).catch(error => {
                alert('Something went wrong, ' + error.response.data.message);
                $(".attachment-loader-wrapper").fadeOut();
            });
        },

        onSubmit() {

            // Append mandatory data
            this.estate = {
                'title': this.title,
                'neighbourhood_id': this.selectedNeighbourhood,
                'type_id': this.selectedType,
                'contract_id': this.selectedContract,
                'finish_type_id': this.selectedFinish,
                'view_id': this.selectedView,
                'area': this.area,
            }

            // Append optional data
            if (this.floor) this.estate.floor_number = this.floor;
            if (this.rooms) this.estate.number_of_rooms = this.rooms;
            if (this.bathrooms) this.estate.number_of_bathrooms = this.bathrooms;
            if (this.living) this.estate.number_of_living_spaces = this.living;
            if (this.balconies) this.estate.number_of_balconies = this.balconies;
            if (this.buildYear) this.estate.build_year = this.buildYear;
            if (this.garage) this.estate.has_garage = this.garage;
            if (this.elevator) this.estate.has_elevator = this.elevator;
            if (this.notes) this.estate.notes= this.notes;

            // Append images array
            /* if (this.images) {
                for (let i = 0; i < this.images.length; i++) {
                    let image = this.images[i];
                    estate[`images${i}`] = image;
                }
            }; */

            this.$emit('estate-submitted', this.estate);
            //console.log(estate);
        },

        checkError(prop) {
            return this.submitErrors.hasOwnProperty(prop);
        },

        getError(prop) {
            return this.checkError(prop) ? this.submitErrors[prop][0] : '';
        }
    },

    computed: {
        errors() {
            return this.submitErrors;
        },

        attachedImages() {
            return this.images.length;
        }
    }
}
</script>

<style lang="scss" scoped>
    .images {
        border: 2px dashed #c1c1c1;
        border-radius: 0.25rem;
        text-align: center;
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 1rem;

        &::after {
            content: '\002B';
        }
    }
</style>
