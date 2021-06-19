<template >
    <div>

        <div class="row row-cols-1 row-cols-md-1 ">
            <div class="col">
                <div class="card " >
                    <div class="card-body">
                        <h5 class="card-title"> الحالة : {{ record.status }}</h5>
                        <h5 class="card-title">الاجمالي : {{ record.price }}</h5>
                        <h5 class="card-title">الاجمالي بعد الخصم  : {{ record.priceAfterDiscount }}</h5>
                        <h5 class="card-title" v-if='record.voucher'>الخصم :
                            <button class="btn btn-secondary" @click="goToVoucher(record.vouchers_id)"> <i class="fas fa-eye "></i> {{record.voucher.discount}} % </button>
                        </h5>
                        <h5 class="card-title">تاريخ البداية : {{ record.start_at }}</h5>
                        <h5 class="card-title">تاريخ النهاية : {{ record.end_at }}</h5>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-dark table-bordered table-hover  mb-2"  >
                    <thead >
                        <tr >
                            <th >#</th>
                            <th >عدد البالغين </th>
                            <th >عدد الاطفال </th>
                            <th >السعر</th>
                            <th >#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(record,index) in record.carts" :key="index">
                            <td>{{record.housing_unit.id}}</td>
                            <td>{{record.housing_unit.adult_nums}}</td>
                            <td>{{record.housing_unit.children_nums}}</td>
                            <td>{{record.price}}</td>
                            <td>
                                <button class="btn btn-secondary" @click="goToHousing(record.housing_unit.id)"><i class="fas fa-eye "></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
             this.$router.push( {name:'housing_unitsShow' , params: { id: id }});
        },
        goToVoucher(id){
             this.$router.push( {name:'vouchersShow' , params: { id: id }});
        },

    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`orders/${this.$route.params.id}`);
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
