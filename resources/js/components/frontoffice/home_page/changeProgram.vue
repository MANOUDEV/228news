<template> 

</template>

<script>
import {mapActions, mapGetters} from 'vuex';

export default {
    data(){
        return{
            
        }
    },
    computed:{
 
        ...mapGetters('changeProgram',{
            getterChangeStatus:'getChangeStatus',
            getterChangeMessage:'getChangeMessage', 
        }),

    },
    methods:{
        ...mapActions('changeProgram',{
            actionChangeProgramm:'change'
        }),
 
        async submitSubject(){
 
            await this.actionChangeProgramm({ });

            if(this.getterChangeStatus === 'success'){

            }

        }
    },
    mounted(){
         this.submitSubject()
    }
}

</script>
