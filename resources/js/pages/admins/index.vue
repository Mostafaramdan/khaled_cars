<template >
    <div>
        <div class="input-group mb-3">
            <input type="search" class="form-control" v-model.trim="search" list="wizards-list" placeholder=" ابحث من هنا " aria-label="Example text with button addon" aria-describedby="button-addon1">
            <button v-b-modal.new-swap-shift-modal class="btn  btn-outline-primary" type="button" id="button-addon1"><i class='fas fa-filter'></i> فلترة </button>
        </div>

        <b-modal id="new-swap-shift-modal" @ok="$router.push({  query: { ...$route.query,...features(),page:1 }})" hide-header-close title="فلترة النتائج" ok-hide='true' ok-title = "فلترة"  cancel-title = "إلفاء">
            <div class="d-block text-center">
                <div class="form-group" >
                    <label   >ترتيب علي حسب</label>
                    <select class="custom-select" v-model="filterBy">
                        <option value="name">الاسم </option>
                        <option value="id">التاريخ</option>
                    </select>
                </div>
                <div class="form-group" >
                    <label   >نوع الترتيب  </label>
                    <select class="custom-select" v-model="filterType">
                        <option value="ASC">تصاعدي </option>
                        <option value="DESC">تنازلي</option>
                    </select>
                </div>
            </div>
        </b-modal>
        <button class="btn btn-primary m-2 " @click="create">
             إضافة
            <i class="fas fa-plus"></i>
        </button>
        <div class="table-responsive">
            <table class="table table-striped table-dark table-bordered table-hover  mb-2"  >
                <thead >
                    <tr >
                        <th >#</th>
                        <th >الاسم</th>
                        <th >الايميل </th>
                        <th > تليفون </th>
                        <th>التفعيل</th>
                        <th >#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-show="false">
                        <div class="text-center mb-3 d-flex justify-content-between">
                            <b-spinner
                                style="width: 6rem; height: 6rem;"
                                variant="light"
                                key="light">
                            </b-spinner>
                        </div>
                    </tr>
                    <tr v-for="(record,index) in records" :key="index">
                        <td>{{record.id}}</td>
                        <td>{{record.name}}</td>
                        <td>{{record.email}}</td>
                        <td>{{record.phone}}</td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" @click="toggle('is_active',record.id)"  v-model="record.is_active" >
                                <span class="slider round"></span>
                            </label>
                        </td>

                        <td>
                            <button class="btn btn-danger" @click="deleteRecord(index)"><i class="fas fa-trash "></i></button>
                            <button class="btn btn-info" @click="update(index)"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-secondary" @click="show(index)"><i class="fas fa-eye"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <pagination :currentPage="parseInt($route.query.page?$route.query.page:1)"  :totalPages="totalPages" @paginate="paginate($event)"></pagination>
        </div>
    </div>
</template>
<script>
import Pagination from '../../components/layouts/pagination.vue';

export default {
    components:{
        Pagination
    },
    data(){
        return {
            records:[],
            currentPage: this.$route.query.page?? 1,
            totalPages:0,
            search:'',
            filterBy:'id',
            filterType:'DESC',
            timeOut :false,
            visible:false
        }
    },
    methods:{
        show() {
            this.visible = true
        },
        create(){
             this.$router.push( {name:'adminsCreate',});
        },
        update(index){
             this.$router.push( {name:'adminsUpdate', params: { id: this.records[index].id }});
        },
        show(index){
             this.$router.push( {name:'adminsShow' , params: { id: this.records[index].id }});
        },
        async paginate(currentPage){
            this.$router.push({  query: { ...this.$route.query,'page': currentPage }});
        },
        async getRecords(){

            let response = await this.Api('GET','admins',this.features());
            this.records=response.data.records ;
            this.totalPages=response.data.totalPages ;
        },
         async deleteRecord(index){

            if(confirm('هل انت متأكد من مسح هذا العنصر')){
                await this.Api('DELETE',`admins/${this.records[index].id}`);
                this.records.splice(index,1);
            }
        },
        features:function(){
            return {
                'page':this.currentPage,
                'search':this.search,
                'filterBy':this.filterBy,
                'filterType':this.filterType,
            };
        }
    },
    async mounted(){

        await this.getRecords();
    },
    metaInfo() {
        return {
            title: `حبابكم -  المسؤولين `,
        }
    },
    watch :{
        search:function(val){
            clearTimeout(this.timeOut);
            this.timeOut=
            setTimeout(()=>{
                this.$store.state.isLoading = false;
                this.$router.push({  query: { ...this.$route.query,...this.features(),page:1 }});
            },1000)
        },
        $route:function(){
            this.currentPage= this.$route.query.page;
            this.getRecords();
        }
    }

}
</script>
