<template>

  <v-dialog
    :value="value"
    @input="valueChanged($evt)"
    content-class="testing"
  >
    <v-card>
      <v-card-row>
        <v-card-title>Check Out</v-card-title>
      </v-card-row>
      <v-card-row>
        <v-card-text>
          This is a test checkout dialog box
        </v-card-text>
      </v-card-row>
      <v-card-row actions>
        <v-btn
          class="green--text darken-1"
          @click.native="valueChanged(false)"
          flat="flat"
        >
          Purchase
        </v-btn>
        <v-btn
          class="green--text darken-1"
          @click.native="valueChanged(false)"
          flat="flat"
        >
          Cancel
        </v-btn>
      </v-card-row>
    </v-card>
  </v-dialog>

</template>


<script>
export default {

  props: {
    value: {
      accept: Boolean,
      default: false,
    },
  },

  methods: {
    valueChanged(val) {
      this.value = val
      this.$emit("input", val)
    },
  },

}
</script>
