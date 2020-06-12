<!-- 
	___________________________________________________________________________________________________________
	
															      DONER DIALOG FORM COMPONENT
	___________________________________________________________________________________________________________
	|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                       
		
	___________________________________________________________________________________________________________
-->

<template>
  <v-dialog v-model="dialog" persistent scrollable :width="width">
    <v-card>
      <!--=============================================================================================->
        				    				 	Dialog Form Title
      <--=============================================================================================-->
      <v-card-title class="primary white--text">
        Add New Item
        <v-spacer />
        <!--=============================================================================================->
        				    				 	Form Close Button
        <--=============================================================================================-->
        <v-btn @click="toggleDialog" icon>
          <v-icon color="white">close</v-icon>
        </v-btn>
      </v-card-title>
      <v-card-text>
        <!--=============================================================================================->
        				    				 	Dialog Form Fields
        <--=============================================================================================-->
        <v-form ref="form" lazy-validation>
          <v-layout wrap mt-3>
            <v-flex xs12>
              <v-text-field v-model="item.name" label="Name" :rules="[rules.required]"></v-text-field>
            </v-flex>
            <v-flex xs12 md6>
              <v-text-field v-model="item.birth_day" label="DOB" :rules="[rules.required]"></v-text-field>
            </v-flex>
            <v-flex xs12 md6>
              <v-text-field v-model="item.gender" label="Gender" :rules="[rules.required]"></v-text-field>
            </v-flex>
            <v-flex xs12 md6>
              <v-text-field v-model="item.nic" label="NIC" :rules="[rules.required]"></v-text-field>
            </v-flex>
            <v-flex xs12 md6>
              <v-text-field v-model="item.mobile" label="Mobile" :rules="[rules.required]"></v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field v-model="item.address" label="Address" :rules="[rules.required]"></v-text-field>
            </v-flex>
            <v-flex xs12 md6>
              <v-text-field v-model="item.email" label="Email" :rules="[rules.required]"></v-text-field>
            </v-flex>
            <v-flex xs12 md6>
              <v-text-field v-model="item.register_date" label="Register Date" :rules="[rules.required]"></v-text-field>
            </v-flex>
          </v-layout>
        </v-form>
      </v-card-text>
      <!--=============================================================================================->
        				    				 	Form Action Buttons
      <--=============================================================================================-->
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn text color="warning">cancel</v-btn>
        <v-btn text color="success" @click="save">save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data: () => ({
    width: 900,
    rules: {
      required: value => !!value || "This field is Required.",
      min: v => (v && v.length >= 6) || "This must be greater than 6 characters"
    }
  }),
  computed: {
    ...mapGetters({
      dialog: "doner/getDialog",
      item: "doner/getItem"
    })
  },
  methods: {
    ...mapActions({
      setToggleDialog: "doner/set_toggle_form",
      addNewDoner: "doner/add_new_item"
    }),
    save(){
      if (this.$refs.form.validate()) {
        this.addNewDoner(this.item);
      }
    },
    toggleDialog() {
      this.setToggleDialog();
    }
  }
};
</script>