<template>
  <v-app id="inspire">
    <navigation-bar></navigation-bar>
    <app-bar></app-bar>

    <v-content>
        <router-view />
    </v-content>
  </v-app>
</template>

<script>
import AppBar from "./_Sub/AppBar";
import NavigationBar from "./_Sub/NavigationBar";

export default {
  components: {
    AppBar,
    NavigationBar
  },
};
</script>