<template>
    <div>
        <form>
            <!-- Estate title -->
            <div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">عنوان الاعلان</label>
                <div class="col-sm-9">
                    <input type="text" :class="[{'is-invalid' : checkError('title')}, 'form-control']" id="title" v-model="estateTitle">
                    <div class="invalid-feedback">{{ getError('title') }}</div>
                </div>
            </div>

            <hr>

            <!-- City and neighbourhood select -->
            <div class="form-group row">
                <!-- <label for="city" class="col-sm-2 col-form-label">المدينة</label>
                <div class="col-sm-4">
                    <select id="city" class="form-control p-1" v-model="selectedCity" @change="fetchNeighbourhoods">
                        <option v-for="city in cities" :key="city.id" :value="city.id">
                            {{ city.name }}
                        </option>
                    </select>
                </div> -->

                <label for="neighbourhood" class="col-sm-2 col-form-label">الحي</label>
                <div class="col-sm-4">
                    <select id="neighbourhood" :class="[{'is-invalid' : checkError('neighbourhood_id')}, 'form-control p-1']" v-model="estateNeighbourhood">
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
                    <select id="type" :class="[{'is-invalid' : checkError('type_id')}, 'form-control p-1']" v-model="estateType">
                        <option v-for="etype in types" :key="etype.id" :value="etype.id">
                            {{ etype.name }}
                        </option>
                    </select>
                    <div class="invalid-feedback">{{ getError('type_id') }}</div>
                </div>

                <label for="contract" class="col-sm-2 col-form-label">العقد</label>
                <div class="col-sm-4">
                    <select id="contract" :class="[{'is-invalid' : checkError('contract_id')}, 'form-control p-1']" v-model="estateContract">
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
                    <select id="finish" :class="[{'is-invalid' : checkError('finish_type_id')}, 'form-control p-1']" v-model="estateFinish">
                        <option v-for="finish in finishes" :key="finish.id" :value="finish.id">
                            {{ finish.name }}
                        </option>
                    </select>
                    <div class="invalid-feedback">{{ getError('finish_type_id') }}</div>
                </div>

                <label for="view" class="col-sm-2 col-form-label">الواجهات</label>
                <div class="col-sm-4">
                    <select id="view" :class="[{'is-invalid' : checkError('view_id')}, 'form-control p-1']" v-model="estateView">
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
                    <input type="text" id="area" :class="[{'is-invalid' : checkError('area')}, 'form-control']" v-model="estateArea">
                    <div class="invalid-feedback">{{ getError('area') }}</div>
                </div>

                <label for="floor" class="col-form-label col-sm-3">الدور</label>
                <div class="col-sm-3">
                    <input type="text" id="floor" :class="[{'is-invalid' : checkError('floor_number')}, 'form-control']" v-model="estateFloor">
                    <div class="invalid-feedback">{{ getError('floor_number') }}</div>
                </div>
            </div>

            <!-- Rooms and bathrooms inputs -->
            <div class="form-group row">
                <label for="rooms" class="col-form-label col-sm-3">عدد الغرف</label>
                <div class="col-sm-3">
                    <input type="text" id="rooms" :class="[{'is-invalid' : checkError('number_of_rooms')}, 'form-control']" v-model="estateRooms">
                    <div class="invalid-feedback">{{ getError('number_of_rooms') }}</div>
                </div>

                <label for="bathrooms" class="col-form-label col-sm-3">عدد الحمامات</label>
                <div class="col-sm-3">
                    <input type="text" id="bathrooms" :class="[{'is-invalid' : checkError('number_of_bathrooms')}, 'form-control']" v-model="estateBathrooms">
                    <div class="invalid-feedback">{{ getError('number_of_bathrooms') }}</div>
                </div>
            </div>

            <!-- Living spaces and balconies inputs -->
            <div class="form-group row">
                <label for="living" class="col-form-label col-sm-3">عدد المعيشة</label>
                <div class="col-sm-3">
                    <input type="text" id="living" :class="[{'is-invalid' : checkError('number_of_living_spaces')}, 'form-control']" v-model="estateLiving">
                    <div class="invalid-feedback">{{ getError('number_of_living_spaces') }}</div>
                </div>

                <label for="balconies" class="col-form-label col-sm-3">عدد البلكونات</label>
                <div class="col-sm-3">
                    <input type="text" id="balconies" :class="[{'is-invalid' : checkError('number_of_balconies')}, 'form-control']" v-model="estateBalconies">
                    <div class="invalid-feedback">{{ getError('number_of_balconies') }}</div>
                </div>
            </div>

            <!-- Build year -->
            <div class="form-group row">
                <label for="buildYear" class="col-form-label col-sm-3">سنة البناء</label>
                <div class="col-sm-3">
                    <input type="text" id="buildYear" :class="[{'is-invalid' : checkError('build_year')}, 'form-control']" v-model="estateBuild">
                    <div class="invalid-feedback">{{ getError('build_year') }}</div>
                </div>
            </div>

            <hr>

            <!-- Garage and elevator inputs -->
            <div class="form-group row">
                <label for="garage" class="col-form-label col-sm-3">جراج</label>
                <div class="col-sm-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="has_garage" id="garage" v-model="estateGarage">
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
                        <input class="form-check-input" type="checkbox" name="has_elevator" id="elevator" v-model="estateElevator">
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
                     <textarea class="form-control" id="notes" rows="3" v-model="notes"></textarea>
                </div>
            </div>

            <hr>

             <!-- Image upload -->
            <div class="row my-2">
                <label for="image" class="col-form-label col-sm-9" style="cursor: pointer">
                    ضيف صور <i class="fas fa-cloud-upload-alt fa-2x mr-2"></i>
                </label>
                <div class="col-sm-3 px-5">
                    <input type="file" id="image" ref="images" :class="[{'is-invalid' : checkError('images')}, 'form-control-file']" multiple @change="imagesUpload" style="display: none;">
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
            <div class="card-columns">
                <div class="card" v-for="image in images" :key="image.id">
                    <img :src="'/storage/' + image.url" class="card-img-top" alt="Attached Image">
                    <div class="card-body p-1">
                    <button class="btn btn-outline-danger" @click.prevent="deleteImage(image.id)">Delete</button>
                    </div>
                </div>
            </div>

            <!-- Submit button -->
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary pr-4 pl-4" @click.prevent="onSubmit">حفظ</button>
                </div>
            </div>

        </form>
    </div>
</template>

<script>
export default {
    props: [
        'id',
        'title',
        'neighbourhoodId',
        'typeId',
        'contractId',
        'finishTypeId',
        'viewId',
        'area',
        'floorNumber',
        'numberOfRooms',
        'numberOfBathrooms',
        'numberOfLivingSpaces',
        'numberOfBalconies',
        'buildYear',
        'hasGarage',
        'hasElevator',
        'notes',
        'images',
        'submitErrors'
        ],

    data() {
        return {
            cities: [],
            neighbourhoods: [],
            contracts: [],
            types: [],
            finishes: [],
            views: [],

            cityId: '',
            estateTitle: '',
            estateNeighbourhood: '',
            estateType: '',
            estateContract: '',
            estateView: '',
            estateFinish: '',
            estateArea: '',
            estateFloor: '',
            estateRooms: '',
            estateBathrooms: '',
            estateLiving: '',
            estateBalconies: '',
            estateBuild: '',
            estateGarage: '',
            estateElevator: '',
            estateNotes: '',
        }
    },

    mounted() {
        //this.fetchCities();
        this.fetchNeighbourhoods();
        this.fetchTypes();
        this.fetchContracts();
        this.fetchFinishes();
        this.fetchViews();
    },

    watch: {
        title(val) { this.estateTitle = val; },
        neighbourhoodId(val) { this.estateNeighbourhood = val; this.fetchNeighbourhoods() },
        typeId(val) { this.estateType = val; },
        contractId(val) { this.estateContract = val; },
        viewId(val) { this.estateView = val; },
        finishTypeId(val) { this.estateFinish = val; },
        area(val) { this.estateArea = val; },
        floorNumber(val) { this.estateFloor = val; },
        numberOfRooms(val) { this.estateRooms = val; },
        numberOfBathrooms(val) { this.estateBathrooms = val; },
        numberOfLivingSpaces(val) { this.estateLiving = val; },
        numberOfBalconies(val) { this.estateBalconies = val; },
        buildYear(val) { this.estateBuild = val; },
        hasGarage(val) { this.estateGarage = val; },
        hasElevator(val) { this.estateElevator = val; },
        notes(val) { this.estateNotes = val; },
    },

    methods: {
        /* fetchCities() {
            axios.get('/api/cities').then(response => {
                this.cities = response.data;
            }).catch(error => {
                alert('Something went wrong: \n' + error.message);
            });
        }, */

        fetchNeighbourhoods() {
            // Don't call the method if neighbourhoodId is undefined
            if (this.neighbourhoodId) {
                axios.get(`/api/neighbourhoods/${this.neighbourhoodId}/city`).then(response => {
                    this.neighbourhoods = response.data;
                }).catch(error => {
                    alert('Something went wrong \n' + error.message);
                });
            }
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

        imagesUpload() {

        },

        deleteImage(id) {
            // Delete image from server
            axios.delete(`/images/${id}`).then(response => {
                for (let i = 0; i < this.images.length; i++) {
                    if(this.images[i]['id'] == id) {
                        this.images.splice(i, 1);
                    }
                }
            }).catch(error => {
                alert('Something went wrong \n' + error.message);
            });
        },

        onSubmit() {
            // Append mandatory data
            let estateUpdate = {
                'title': this.estateTitle,
                'neighbourhood_id': this.estateNeighbourhood,
                'type_id': this.estateType,
                'contract_id': this.estateContract,
                'finish_type_id': this.estateFinish,
                'view_id': this.estateView,
                'area': this.estateArea,
            }

            // Append optional data
            estateUpdate.floor_number = this.estateFloor ? this.estateFloor : null;
            estateUpdate.number_of_rooms = this.estateRooms ? this.estateRooms : null;
            estateUpdate.number_of_bathrooms = this.estateBathrooms ? this.estateBathrooms : null;
            estateUpdate.number_of_living_spaces = this.estateLiving ? this.estateLiving : null;
            estateUpdate.number_of_balconies = this.estateBalconies ? this.estateBalconies : null;
            estateUpdate.build_year = this.estateBuild ? this.estateBuild : null;
            estateUpdate.has_garage = this.estateGarage ? this.estateGarage : null;
            estateUpdate.has_elevator = this.estateElevator ? this.estateElevator : null;
            estateUpdate.notes = this.estateNotes ? this.estateNotes : '';

            this.$emit('estate-update', this.id, estateUpdate);
        },

        checkError(prop) {
            return this.submitErrors.hasOwnProperty(prop);
        },

        getError(prop) {
            return this.checkError(prop) ? this.submitErrors[prop][0] : '';
        }
    },

    computed: {
        neighbourhoodCityId() {
            if (this.neighbourhoodId) {
                return this.neighbourhoodId;
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
