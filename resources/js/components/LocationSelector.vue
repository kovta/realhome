<template>
  <div :class="rowClass">
    <div :class="columnClass">
      <div class="form-group">
        <vue-select
            multiple
            v-model="selectedArea"
            label="name"
            placeholder="Nincs megadva"
            :options="this.areas"
            @input="setSelectedArea(selectedArea); getTownDistricts(selectedArea)"
        ></vue-select>
        <input type="hidden" v-bind:class="this.dataTableClass" name="location_area_id" :value="settingArea">
      </div>
    </div>
    <div :class="columnClass">
      <div class="form-group">
        <vue-select
            :loading="townDistrictsLoading"
            multiple
            v-model="selectedTownDistrict"
            label="name"
            :disabled="this.townDistrictsDisables"
            placeholder="Nincs megadva"
            :options="this.townDistricts"
            @input="setSelectedTownDistrict(selectedTownDistrict); getNeighborhoods(selectedTownDistrict)"
        >
          <template #spinner="{ loading }">
            <div v-if="loading" style="border-left-color: rgba(88,151,251,0.71)" class="vs__spinner"></div>
          </template>
        </vue-select>
        <input type="hidden" v-bind:class="this.dataTableClass" name="location_town_district_id" :value="settingTownDistricts">
      </div>
    </div>
    <div :class="columnClass">
      <div class="form-group">
        <vue-select
            :loading="neighborhoodsLoading"
            multiple
            v-model="selectedNeighborhood"
            label="name"
            :disabled="this.neighborhoodsDisables"
            placeholder="Nincs megadva"
            :options="this.neighborhoods"
            @input="setSelectedNeighborhoods(selectedNeighborhood)"
        >
          <template #spinner="{ loading }">
            <div v-if="loading" style="border-left-color: rgba(88,151,251,0.71)" class="vs__spinner"></div>
          </template>
        </vue-select>
        <input type="hidden" v-bind:class="this.dataTableClass" name="location_neighborhood_id" :value="settingNeighborhoods">
      </div>
    </div>
  </div>
</template>


<script>
import vSelect from 'vue-select';

export default {
  components: {
    'vue-select': vSelect,
  },
  props: {
    dataSelectedArea: Array,
    dataSelectedTownDistrict: Array,
    dataSelectedNeighborhood: Array,
    dataRowClass: String,
    dataColumnClass: String,
    dataAreaClass: String,
    dataTownDistrictClass: String,
    dataTownNeighborhoodClass: String,
    dataTableClass: String,
  },
  name: "LocationSelector",
  data() {
    return {
      ajaxLocationAreasURL: '/location-areas',
      ajaxTownDistrictsURL: '/location-town-districts',
      ajaxNeighborhoodsURL: '/location-neighborhood',

      areas: [],
      settingArea: [],
      townDistricts: [],
      settingTownDistricts: [],
      townDistrictsDisables: false,
      townDistrictsLoading: false,
      neighborhoods: [],
      settingNeighborhoods: [],
      neighborhoodsDisables: false,
      neighborhoodsLoading: false,
      selectedArea: '',
      selectedTownDistrict: '',
      selectedNeighborhood: '',
      //  showEmptyValueInSelectOptions: false,

      rowClass: "row",
      columnClass: "col-sm-4",
      areaClass: 'form-control',
      townDistrictClass: 'form-control',
      neighborhoodClass: 'form-control',

    }
  },
  mounted() {
    /*
    Getting default Areas
    */
    this.getAreas();
    /*
    Setting v-model value if exists (Area)
     */
    this.selectedArea =  this.dataSelectedArea ? this.dataSelectedArea : null;
    /*
    Setting settingArea default value
    */
    this.settingAreaDefault(this.selectedArea);
    /*
    If has selected area getting town district
    */
    if (this.selectedArea !== null || this.selectedArea !== '') {
      this.getTownDistricts(this.selectedArea);
    }
    /*
    Setting v-model value if exists TownDistrict
     */
    this.selectedTownDistrict = this.dataSelectedTownDistrict ? this.dataSelectedTownDistrict : this.selectedTownDistrict;
    /*
    Setting selectedTownDistrict default value
    */
    this.settingTownDistrictDefault(this.selectedTownDistrict);
    /*
    Setting v-model value if exists Neighborhood
     */
    this.selectedNeighborhood = this.dataSelectedNeighborhood ? this.dataSelectedNeighborhood : this.selectedNeighborhood;
    /*
    Setting selectedNeighborhood default value
    */
    this.settingNeighborhoodDefault(this.selectedNeighborhood);
    /*
    Setting classes parameters
     */
    this.rowClass = this.dataRowClass ? this.dataRowClass : this.rowClass;
    this.columnClass = this.dataColumnClass ? this.dataColumnClass : this.columnClass;
    this.areaClass = this.dataAreaClass ? this.dataAreaClass : this.areaClass;
    this.townDistrictClass = this.dataTownDistrictClass ? this.dataTownDistrictClass : this.townDistrictClass;
    this.neighborhoodClass = this.dataTownNeighborhoodClass ? this.dataTownNeighborhoodClass : this.townDistrictClass;
    /*
    If has selected district getting neighborhood
    */
    if (this.selectedTownDistrict !== null && this.selectedTownDistrict !== '') {
      this.getNeighborhoods(this.selectedTownDistrict);
    }
  },
  methods: {
    /*
    Setting hidden area input value
     */
    setSelectedArea: function (value) {
      let areaArray = [];
      value.forEach(function (area) {
        areaArray.push(area.id);
      });
      this.settingArea = areaArray;
    },
    /*
    Setting hidden area input default value
    */
    settingAreaDefault: function (areasIdArray) {
      let areaArray = [];
      if(areasIdArray && Array.isArray(areasIdArray)) {
        areasIdArray.forEach(function (area) {
          areaArray.push(area.id);
        });
      }
      this.settingArea = areaArray;
    },
    /*
    Setting hidden town district input value
     */
    setSelectedTownDistrict: function (value) {
      let townDistrictArray = [];
      value.forEach(function (district) {
        townDistrictArray.push(district.id);
      });
      this.settingTownDistricts = townDistrictArray;
    },
    /*
    Setting hidden town district input default value
    */
    settingTownDistrictDefault: function (townDistrictIdArray) {
      let townDistrictArray = [];
      if(townDistrictIdArray && Array.isArray(townDistrictIdArray)) {
        townDistrictIdArray.forEach(function (district) {
          townDistrictArray.push(district.id);
        });
      }
      this.settingTownDistricts = townDistrictArray;
    },
    /*
    Setting hidden neighborhoods input value
     */
    setSelectedNeighborhoods: function (value) {
      let neighborhoodsArray = [];
      if(value && Array.isArray(value)) {
        value.forEach(function (neighborhoods) {
          neighborhoodsArray.push(neighborhoods.id);
        });
      }
      this.settingNeighborhoods = neighborhoodsArray;
    },
    /*
    Setting hidden town district input default value
    */
    settingNeighborhoodDefault: function (neighborhoodIdArray) {
      let neighborhoodArray = [];
      if(neighborhoodIdArray && Array.isArray(neighborhoodIdArray)) {
        neighborhoodIdArray.forEach(function (neighborhood) {
          neighborhoodArray.push(neighborhood.id);
        });
      }
      this.settingNeighborhoods = neighborhoodArray;
    },
    /*
    Getting Areas and bind the variable
    */
    getAreas: async function () {
      if (typeof this.selectedArea === 'undefined') {
        /*
        Clear all parameters, if isn't selected area, and disable TownDistrict and Neighborhood
        */
        this.townDistricts = [];
        this.neighborhoods = [];
        this.townDistrictsDisables = true;
        this.neighborhoodsDisables = true;
      }
      console.log('getAreas');
      await this.axios.get(this.ajaxLocationAreasURL)
          .then((response) => {
            this.areas = response.data.data;
            console.log('This Area: ' + this.areas);
          })
          .catch(function (error) {
            console.log('Error:' + error);
          });
    },
    /*
    Getting TownDistricts and bind the variable
    */
    getTownDistricts: async function (areasIdArray) {
      let areasArray = [];
      // console.log('getTownDistricts', areasIdArray);
      if (typeof this.selectedArea !== 'undefined' && areasIdArray && Array.isArray(areasIdArray) && areasIdArray.length > 0) {
        this.townDistrictsLoading = true;
        /*
        Reset array, because we will update
        */
        this.townDistricts = [];
        this.neighborhoods = [];
        // console.log('selectedArea:' + this.selectedArea);
        if(areasIdArray && Array.isArray(areasIdArray)) {
          areasIdArray.forEach(function (area) {
            areasArray.push(area.id);
          });
        } else {
          areasArray.push(areasIdArray);
        }
        await this.axios.get(this.ajaxTownDistrictsURL + '?arrayOfAreaId=' + areasArray.toString())
            .then((response) => {
              this.townDistricts = response.data.data;
              this.townDistrictsLoading = false;
              this.neighborhoods = [];
              this.townDistrictsDisables = false;
              this.neighborhoodsDisables = true;
              // console.log('This District: ' + this.townDistricts);
            })
            .catch(function (error) {
              console.log('Error:' + error);
            });
      } else {
        /*
        Clear all parameters, if isn't selected area, and disable TownDistrict and Neighborhood
        */
        this.selectedTownDistrict = null;
        this.selectedNeighborhood = null;
        this.townDistricts = [];
        this.neighborhoods = [];
        this.townDistrictsDisables = true;
        this.neighborhoodsDisables = true;
      }
    },
    /*
    Getting Neighborhoods and bind the variable
    */
    getNeighborhoods: async function (townDistrictIdArray) {
      let districtArray = [];
      // console.log('getNeighborhoods', townDistrictIdArray);
      if (typeof this.selectedTownDistrict !== 'undefined' && townDistrictIdArray && Array.isArray(townDistrictIdArray) && townDistrictIdArray.length > 0) {
        this.neighborhoodsLoading = true;
        // console.log('selectedDistrict:' + this.selectedTownDistrict);
        if (Array.isArray(townDistrictIdArray)) {
          townDistrictIdArray.forEach(function (district) {
            districtArray.push(district.id);
          });
        } else {
          districtArray.push(townDistrictIdArray);
        }
        await this.axios.get(this.ajaxNeighborhoodsURL + '?arrayOfDistrictId=' + districtArray.toString())
            .then((response) => {
              this.neighborhoods = response.data.data;
              this.neighborhoodsLoading = false;
              this.neighborhoodsDisables = false;
            })
            .catch(function (error) {
              console.log('Error:' + error);
            });
      } else {
        this.neighborhoods = [];
        this.neighborhoodsDisables = true;
      }
    }
  }
}
</script>

<style scoped>
.inline {
  display: flex;
}
</style>
