<template>
  <div class="row">
    <div v-if="errored" class="alert alert-danger" role="alert">
      Please contact the developer!
    </div>
    <input type="hidden" name="partner_id" :value="selected">
    <div id="selector" class="col-xs-12 col-sm-12 col-md-9">
      <v-select
          :options="options"
          @input="setSelected"
      ></v-select>
    </div>
    <div id="button" class="col-xs-12 col-sm-12 col-md-3">
      <input style="margin-right: 1rem" type="submit" class="btn btn-primary" value="Mentés">
    </div>
  </div>
</template>

<script>
export default {
  name: "PartnerSelector",
  props: {
    autoscroll: {
      type: Boolean,
      default: true
    },
    url: {}
  },
  data() {
    return {
      options: [],
      selected: null,
      errored: false,
    }
  },
  methods: {
    /*
    * Setting option selected element id to selected variable
    */
    setSelected(value) {
      this.selected = value.code;
    },
    /*
    * Call axiox and returned data use in select
    */
    async loadData(){
      try {
        await axios.get(this.url).then(response => {
          this.options = this.options.concat(response.data.data);
        })
      }catch (err){
        this.errored = true;
        console.log('Error: ' + err);
      }
    }
  },
  beforeMount() {
    this.loadData();
  }
}
</script>

<style scoped>
#selector {
  padding-left: 1rem;
  padding-right: 1rem;
}
</style>
