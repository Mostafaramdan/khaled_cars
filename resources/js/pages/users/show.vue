<template >
    <div>

        <div class="row row-cols-1 row-cols-md-1 ">
            <div class="col">
                <div class="card " >
                    <div class="card-body">
                        <h5 class="card-title">الاسم  : {{ record.name }}</h5>
                        <h5 class="card-title">الايميل  : {{ record.email }}</h5>
                        <h5 class="card-title">التليفون  : {{ record.phone }}</h5>
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


    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`users/${this.$route.params.id}`);
        this.record = response.data.record;
    },
    metaInfo() {
        return {
            title: `حبابكم -  ${this.record.name}`,
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
