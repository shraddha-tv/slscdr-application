<!-- 
	___________________________________________________________________________________________________________
	
															        DONER MAIN COMPONENT
	___________________________________________________________________________________________________________
	|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                       
		
	___________________________________________________________________________________________________________
-->

<template>
  <v-card>
    <!--=============================================================================================->
        				    				 	Table Header with Custom Component
      <--=============================================================================================-->
      <table-toolbar title="Doners Data Table" :total="noData" :add="setToggleDialog">
        <v-flex xs4>
          <v-text-field
            v-model="search"
            append-icon="search"
            label="Search"
            single-line
            hide-details
            @keyup="searchItem"
            class="pb-2 px-4"
          ></v-text-field>
        </v-flex>
      </table-toolbar>
        <!--===============================================================================================->
                                       Table Column Visibility Toggle
                      Get Header Array and toggle it 'show' value, without "id" & "action" Column 
      <--===============================================================================================-->
      <tableheader-selector :headers="headers" />
    <v-card-text>
      <v-data-table :headers="selectHeaders" :items="donerList.data" hide-default-footer>

        <!------------------------------------------------------------------------------------------- >
               		 	                  Actions
          <--------------------------------------------------------------------------------------------->
          <template v-slot:item.actions="{ item }">
            <div class="justify-space-around layout">
              <v-tooltip bottom v-for="action in actions" :key="action.text">
                <template v-slot:activator="{ on }">
                  <v-hover>
                    <v-icon
                      @click="actionFunc(item,`${action.text}`)"
                      slot-scope="{hover}"
                      v-on="on"
                      :color="`${ hover ? action.color : themeData.defaltButton }`"
                    >{{ action.icon }}</v-icon>
                  </v-hover>
                </template>
                <span>{{ action.text}}</span>
              </v-tooltip>
            </div>
          </template>

      </v-data-table>
      <table-pagination :meta="donerList.meta">
        <v-pagination v-model="page" :length="pages" :total-visible="7" color="grey darken-2"></v-pagination>
      </table-pagination>
    </v-card-text>
  </v-card>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data: () => ({
    page: 1,
    search: "",
    headers: [
      { text: "ID", value: "id", show: true },
      { text: "name", value: "name", show: true },
      { text: "mobile", value: "mobile", show: true },
      { text: "gender", value: "gender", show: true },
      { text: "birth_day", value: "birth_day", show: true },
      { text: "nic", value: "nic", show: true },
      { text: "register_date", value: "register_date", show: true },
      { text: "state", value: "state", show: true },
      { text: "email", value: "email", show: true },
      { text: "ACTIONS", value: "actions", show: true },
    ],
    data: []
  }),
  created() {
    this.getDonerList(1);
  },
  watch: {
    /*
     *  Watch the Table Page number and Get Related Data
     */
    page(val) {
      this.getDonerList(val);
      //   this.getDonerList({ page: val, query: this.search });
    }
  },
  computed: {
    ...mapGetters({
      donerList: "doner/getItemList",
      themeData: "getTheme"
    }),
    actions() {
      return this.themeData
        ? [
            {
              text: "View",
              icon: "remove_red_eye",
              color: this.themeData.color.viewButton,
              dusk: "view-"
            },
            {
              text: "Edit",
              icon: "edit",
              color: this.themeData.color.editButton,
              dusk: "edit-"
            },
            {
              text: "Delete",
              icon: "delete",
              color: this.themeData.color.deleteButton,
              dusk: "delete-"
            }
          ]
        : [];
    },
    /*
     *    Check Data is Empty and Return Total Number of Data
     */
    noData() {
      if (this.donerList.meta) {
        if (this.donerList.meta.total < 10)
          return "0" + this.donerList.meta.total;
        else return this.donerList.meta.total;
      } else {
        return "00";
      }
    },

    /*
        Customized Table Column Visibility
      */
    selectHeaders() {
      var tempHeaders = [];
      this.headers.forEach(col => {
        if (col.show) {
          tempHeaders.push(col);
        }
      });
      return tempHeaders;
    },

    /**
     * Set Pagination Page list
     */
    pages() {
      if (this.donerList.meta)
        return Math.ceil(
          this.donerList.meta.total / this.donerList.meta.per_page
        );
    }
  },
  methods: {
    ...mapActions({
      getDonerList: "doner/get_item_list",
      setToggleDialog: "doner/set_toggle_form",
      setEditItem: "doner/set_edit_item",
      deleteDoner: "doner/delete_given_item",
    }),
    actionFunc(item, action) {
      switch (action) {
        case "View":
          this.viewItem(item.id);
          break;
        case "Edit":
          this.editItem(item);
          break;
        case "Delete":
          this.deleteItem(item);
          break;
      }
    },
    viewItem(id){

    },
    editItem(item){
      this.setEditItem(item)
      this.setToggleDialog()
    },
    deleteItem(item){
      this.deleteDoner(item.id)
    },
    searchItem(){}
  }
};
</script>