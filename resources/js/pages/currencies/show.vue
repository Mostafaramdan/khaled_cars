<template >
    <div>

        <div class="row row-cols-1 row-cols-md-1 ">
            <div class="col">
                <div class="card " >
                    <div class="card-body">
                        <h5 class="card-title">الذهاب الي الوحدة السكنية :
                        <button class="btn btn-primary " @click="goToHousing(record.currencies_id)"><i class="fas  fa-eye"></i></button>                        </h5>
                        <h5 class="card-title">الاسم بالعربي : {{ record.name_ar }}</h5>
                        <h5 class="card-title">الاسم بالانجليزي : {{ record.name_en }}</h5>
                        <h5 class="card-title">الوصف بالعربي : {{ record.description_ar }}</h5>
                        <h5 class="card-title">الوصف بالانجليزي : {{ record.description_en }}</h5>
                        <h5 class="card-title">الخصم : {{ record.discount }}</h5>
                        <h5 class="card-title">تاريخ البداية : {{ record.start_at }}</h5>
                        <h5 class="card-title">تاريخ النهاية : {{ record.end_at }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    components:{
    },
    data(){
        return {
            record:{},
            slide: 0,
            sliding: null,
        }
    },
    methods:{
        onSlideStart(slide) {
            this.sliding = true
        },
        onSlideEnd(slide) {
            this.sliding = false
        },
        goToHousing(id){
             this.$router.push( {name:'currenciesShow' , params: { id: id }});
        },

    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`currencies/${this.$route.params.id}`);
        this.record = response.data.record;
    },
    metaInfo() {
        return {
            title: `حبابكم -  عرض`,
        }
    }
}
</script>
<style scoped>
    .example-slide {
        align-items: center;
        background-color: #666;
        color: #999;
        display: flex;
        font-size: 1.5rem;
        justify-content: center;
        min-height: 10rem;
    }
</style>
