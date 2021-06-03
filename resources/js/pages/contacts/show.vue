<template>
    <div>
        <div class="row row-cols-1 row-cols-md-1 ">
            <div class="col">
                <div class="card ">
                    <div class="card-body">
                        <h5 class="card-title">
                            الاسم  :
                            <router-link :to="{name: 'usersShow',params:{id:record.users_id}}">
                                {{record.name}}
                            </router-link>
                        </h5>
                        <h5 class="card-title">
                            الرسالة
                            : <span class="d-block">{{ record.message }} </span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components: {},
    data() {
        return {
            record: {},
            slide: 0,
            sliding: null,
            visible: false
        };
    },
    async mounted() {
        this.$store.state.isLoading = false;
        let response = await this.Api(
            "GET",
            `contacts/${this.$route.params.id}`
        );
        this.record = response.data.record;
    },
    metaInfo() {
        return {
            title: `حبابكم -  ${this.record.message}`
        };
    }
};
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
