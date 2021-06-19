<template >
    <div>
        <div class="row row-cols-1 row-cols-md-1 ">
            <div class="col">
                <div class="card " >
                    <div class="card-body">
                        <h5 class="card-title"> تعديل :
                            <button class="btn btn-info" @click="update(record.id)"><i class="fas fa-edit"></i></button> </h5>
                        <h5 class="card-title">عنا بالعربي : <span class="text-primary"> {{ record.aboutUs_ar }}  </span> </h5>
                        <h5 class="card-title">عنا بالانجليزي :  <span class="text-primary"> {{ record.aboutUs_en }}  </span></h5>
                        <h5 class="card-title">سياسة الاستخدام بالعربي :  <span class="text-primary"> {{ record.policyTerms_ar }}  </span></h5>
                        <h5 class="card-title">سياسة الاستخدام بالانجليزي :  <span class="text-primary"> {{ record.policyTerms_en }}  </span></h5>
                        <h5 class="card-title"> الامان بالعربي :  <span class="text-primary"> {{ record.privacy_ar }}  </span></h5>
                        <h5 class="card-title"> الامان بالانجليزي :  <span class="text-primary"> {{ record.privacy_en }}  </span></h5>
                        <h5 class="card-title">  الرسوم :  <span class="text-primary"> {{ record.fees }}  </span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    data(){
        return {
            record:{},
            totalPages:0,
            visible:false
        }
    },
    methods:{
        show() {
            this.visible = true
        },
        update(index){
             this.$router.push( {name:'app_settingsUpdate', params: { id: this.record.id }});
        },
        async getRecords(){
            let response = await this.Api('GET','app_settings');
            this.record=response.data.record ;
        },

    },
    async mounted(){
        await this.getRecords();
    },
    metaInfo() {
        return {
            title: `حبابكم -  اعدادات التطبيق `,
        }
    },
}
</script>
