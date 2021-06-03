<template >
    <div class="row" >
        <div class="col-3 card text-white bg-primary m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">الطلبات في وضع الانتظار</div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.waiting}}</h5>
            </div>
        </div>

        <div class="col-3 card text-white bg-secondary m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">الطلبات في وضع القادم</div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.coming}}</h5>
            </div>
        </div>

        <div class="col-3 card text-white bg-success m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">الطلبات مقيمة الان</div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.resident}}</h5>
            </div>
        </div>

        <div class="col-3 card text-white bg-info m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">الطلبات المنتهية</div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.finished}}</h5>
            </div>
        </div>

        <div class="col-3 card text-white bg-warning  m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">الطلبات الملغية</div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.cancelled}}</h5>
            </div>
        </div>

        <div class="col-3 card text-white bg-danger  m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">الطلبات المرفوضة</div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.refused}}</h5>
            </div>
        </div>
        <hr>
        <div class="col-3 card text-white bg-primary  m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">اجمالي الطلبات </div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.orders}}</h5>
            </div>
        </div>

        <div class="col-3 card text-white bg-dark  m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">اجمالي المبيعات </div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.total}}</h5>
            </div>
        </div>

        <div class="col-3 card text-white bg-dark  m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">اجمالي فوائد التطبيق </div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.fees}}</h5>
            </div>
        </div>
        <hr>
        <div class="col-3 card text-white bg-info m-3" style="max-width: 18rem;">
            <div class="card-text m-2 text-wrap">اجمالي عدد الوحدات السكنية </div>
            <hr><div class="card-body">
                <h5 class="card-title">{{record.housing_units}}</h5>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    data(){
        return {
            record:{},
            visible:false
        }
    },
    methods:{
        show() {
            this.visible = true
        },
        update(index){
             this.$router.push( {name:'statisticsUpdate', params: { id: this.record.id }});
        },
        async getRecords(){
            let response = await this.Api('GET','statistics');
            this.record=response.data.record ;
        },

    },
    async mounted(){
        await this.getRecords();
    },
    metaInfo() {
        return {
            title: `حبابكم -   الاحصائيات `,
        }
    },
}
</script>
