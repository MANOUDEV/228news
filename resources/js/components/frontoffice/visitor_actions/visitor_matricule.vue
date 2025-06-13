<template>
   <div></div>
</template>
<script>
import {mapActions, mapGetters} from 'vuex';
export default {

    data(){
        return {
            loading: true
        }
    },

    computed:{
        ...mapGetters('visitorsActions',{
            getterInfosCreateVisitorStatus:'getInfosCreateVisitorStatus',
            getterInfosCreateVisitorMessage:'getInfosCreateVisitorMessage',
            getterInfosCreateVisitorData:'getInfosCreateVisitorData',
            getterInfosCheckVisitorStatus:'getInfosCheckVisitorStatus',
            getterInfosCheckVisitorMessage:'getInfosCheckVisitorMessage',
            getterInfosCheckVisitorData:'getInfosCheckVisitorData',
        }),
    },
    methods:{

        ...mapActions('visitorsActions',{
            actionCreateVisitorDataRequest:'createVisitorDataRequest',
            actionCheckVisitorDataRequest:'checkVisitorDataRequest'
        }),

        async getResults(){

            if(localStorage.getItem('mtr') == null){

                this.createVisitorMatricule()

            }else{

                await this.actionCheckVisitorDataRequest({});

                if(this.getterInfosCheckVisitorStatus ==="empty"){

                    this.createVisitorMatricule()

                }
                

            }

        },

        async createVisitorMatricule(){

            this.loading = true

            await this.actionCreateVisitorDataRequest({});

            if( this.getterInfosCreateVisitorStatus ==="success"){

                this.createVisitorData = this.getterInfosCreateVisitorData

                localStorage.setItem('mtr', this.getterInfosCreateVisitorData.visitor_matricule_create.matricule_reference)

                this.empty = 0

                this.loading = false

            }else if( this.getterInfosCreateVisitorStatus ==="empty"){

                this.createVisitorMessage = this.getterInfosCreateVisitorMessage

                this.empty = 1

                const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', this.$swal.stopTimer)
                        toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: this.getterInfosCreateVisitorMessage
                })

                this.loading = false

            }else{

                this.createVisitorMessage = this.getterInfosCreateVisitorMessage

                this.empty = 3

                const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', this.$swal.stopTimer)
                        toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: this.getterInfosCreateVisitorMessage
                })

                this.loading = false

            }

        }

    },

    mounted(){
        this.getResults();
    }
}

</script>
