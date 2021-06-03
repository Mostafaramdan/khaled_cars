<template >
    <div class="table-responsive">
        <table class="table table-striped table-dark table-bordered table-hover  mb-2"  >
            <thead >
                <tr >
                    <th >#</th>
                    <th >الاسم</th>
                    <th >تليفون</th>
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
                    <td>{{index+1}}</td>
                    <td>{{record.name}}</td>
                    <td>{{record.phone}}</td>
                </tr>
            </tbody>
        </table>
        <pagination :currentPage="$route.query.page?$route.query.page:1"  :totalPages="totalPages" @paginate="paginate($event)"></pagination>
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
            currentPage: 1,
            totalPages:0
        }
    },
    methods:{
        paginate(currentPage){
            this.currentPage= currentPage;
            this.$router.push({  query: { ...this.$route.query,'page': currentPage }});
        },
        getAllResults(index){
            let record = this.records[index];
            this.$router.push({name: 'results',params:{id:record.id, name:record.name.replaceAll(' ','-')}})
            // this.$router.push({name:'results',  params: {id:record.id, name:record.name}});
        }
    },
    async mounted(){
        let data = {
            page : this.currentPage
        }
        let response = await this.getApi('users',data);
        this.records=response.data.records ;
    },
    metaInfo() {
        return {
            title: `شركتي - المستخدمين`,
        }
    }

}
</script>
