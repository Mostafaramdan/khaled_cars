<template >
    <div>

        <div class="row row-cols-1 row-cols-md-1 ">
            <div class="col">
                <div class="card " >
                    <div class="card-body">
                        <vue-easy-lightbox
                                :imgs="record.images"
                                scDisabled
                                moveDisabled
                                :visible="visible"
                                :index="0"
                                @hide='visible=false'
                            ></vue-easy-lightbox>
                        <h5 class="card-title">الصور :
                            <button class="btn btn-info w-25"  @click="visible=true">
                                <i class="fas fa-image" ></i>
                            </button>
                        </h5>

                        <h5 class="card-title">الاسم بالعربي  : {{ record.name_ar }}</h5>
                        <h5 class="card-title">الاسم بالانجليزي  : {{ record.name_en }}</h5>
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
            visible:false
        }
    },
    methods:{
        onSlideStart(slide) {
            this.sliding = true
        },
        onSlideEnd(slide) {
            this.sliding = false
        }

    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`attachments/${this.$route.params.id}`);
        this.record = response.data.record;
    },
    metaInfo() {
        return {
            title: `حبابكم - وحدة سكنية`,
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
