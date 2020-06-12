<!-- 
	___________________________________________________________________________________________________________
	
															        DONER MAIN COMPONENT
	___________________________________________________________________________________________________________
	|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                        ___________________________________________________________
                                                                                   
                          This is the main component of the Department             
                              Vue Router is directly call This Component,          
                              This imported Department Dialog                      
                                                  & Department Table Components    
                        ___________________________________________________________
		
-->

<template>
  <v-container>
     <doner-table/> 
     <doner-dialog/>
  </v-container>
</template>

<script>
import DonerTable from './DonerTable'
import DonerDialog from './DonerDialog'

export default {

  components:{
    DonerTable,
    DonerDialog
  }
}
</script>

<style>

</style>