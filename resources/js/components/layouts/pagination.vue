<template>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" aria-label="Previous" @click="paginate(parseInt(currentPage)-1)">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <template v-for="i in totalPages"    :class="'page-'+i">
            <template  v-if="totalPages>5">
                <li :key="i" v-if="i == 1" :class="['page-item', {'active' : i == currentPage}]"  @click="paginate(1)"><a class="page-link">الاول</a></li>
                <li :key="i" v-if="i != 1 &&  i != totalPages && (i == parseInt(currentPage) ||i == parseInt(currentPage)+1 ||  i == parseInt(currentPage)-1)"
                    :class="['page-item','points', {'active' : i == currentPage}]"  @click="paginate(i)">
                    <a class="page-link">{{i}}</a>
                </li>
                <li :key="i"  v-if="i == totalPages && currentPage!= totalPages" @click="paginate(totalPages)"
                    :class="['page-item', {'active': i == currentPage}]">
                    <a class="page-link">الأخير</a>
                </li>
                <li :key="i"  v-if=" i == totalPages && currentPage == totalPages" @click="paginate(totalPages)"
                    :class="['page-item', {'active': i == currentPage}]">
                    <a class="page-link">{{i}}</a>
                </li>
            </template>
            <template v-else>
                <li :key="i" :class="['page-item',{'active':i == currentPage}]"  @click="paginate(i)">
                    <a class="page-link">{{i}}</a>
                </li>
            </template>
        </template>
        <li class="page-item">
            <a class="page-link"  aria-label="Next" @click="paginate(parseInt(currentPage)+1)">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>

</template>
<script>
export default {
    props:['currentPage' ,'totalPages'],
    methods:{
        paginate(page){
            if( page > 0 && page <= this.totalPages)
            this.$emit('paginate',page)
        }
    },
    data(){
        return {
        }
    }
}
</script>
<style scoped>
    .page-link{
        cursor: pointer;
    }
</style>
