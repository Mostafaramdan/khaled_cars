<template>
    <div class="m-3" >
    <div  @submit.prevent="onSubmit" class="border border-5 border-primary rounded form">
        <h3>
             تعديل الفندق
        </h3>
        <hr>

         <div class="form-check ">
            <label  > ادخل الاسم بالعربي  </label>
            <input type="text" v-model="record.name_ar" :class="['form-control' ,{'is-valid':validateName_ar },{'is-invalid':!validateName_ar}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الاسم بالعربي بشكل صحيح</span>
            </div>
        </div>
         <div class="form-check ">
            <label  > ادخل  الاسم بالانجليزي  </label>
            <input type="text" v-model="record.name_en" :class="['form-control' ,{'is-valid':validateName_en },{'is-invalid':!validateName_en}]"  >
            <div class="valid-feedback">
                صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الاسم بالانجليزي بشكل صحيح</span>
            </div>
        </div>
         <div class="form-check ">
            <label  > ادخل الوصف بالعربي  </label>
            <input type="text" v-model="record.description_ar" :class="['form-control' ,{'is-valid':validateDescription_ar },{'is-invalid':!validateDescription_ar}]"  >
            <div class="valid-feedback">
                صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الوصف بالعربي بشكل صحيح</span>
            </div>
        </div>
         <div class="form-check ">
            <label  > ادخل الوصف بالانجليزي  </label>
            <input type="text" v-model="record.description_en" :class="['form-control' ,{'is-valid':validateDescription_en },{'is-invalid':!validateDescription_en}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الوصف بالانجليزي بشكل صحيح</span>
            </div>
        </div>
        <div class="form-check ">
            <label  > ادخل الملاحظات  </label>
            <textarea type="text"  v-model="record.notes" :class="['form-control' ]"  ></textarea>

        </div>
        <div class="form-check ">
            <label  > ادخل طريقة الدفع  </label>
            <select type="text"  v-model="record.payment" :class="['form-select' ,{'is-valid':validatePayment },{'is-invalid':!validatePayment}]"  >
                <option value="" disabled>اختر</option>
                <option value="cash">كاش</option>
                <option value="visa">الدفع اونلاين</option>
            </select>
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال نوع الدفع بشكل صحيح</span>
            </div>
        </div>
         <div class="form-check ">
            <label  > ادخل النوع  </label>
            <select type="text"  v-model="record.categories_id" :class="['form-control' ,{'is-valid':validateCategories_id },{'is-invalid':!validateCategories_id}]"  >
                <option value=""></option>
                <option  v-for="(category,index ) in categories" :key="index" :value="category.id" >{{category.name}} </option>
            </select>

            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال النوع بشكل صحيح</span>
            </div>
        </div>
        <div class="btn-group mb-4 mt-4">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                 اختر المدينة : {{city}}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <input type="search" class="form-control" @input="searchForCity">
                <li v-for="(city, index) in cities" :key="index" >
                    <a :class="['dropdown-item',{'active':record.regions_id==city.id} ]" @click="chooseCity(index)" >{{city.name_ar}}</a>
                </li>
            </ul>
        </div>
        <div class="form-check ">
            <label  > ادخل المميزات  </label>
            <treeselect v-model="record.attachments" :multiple="true" :options="attachments" ></treeselect>
        </div>
        <hr>
        <br>
        <google-map ></google-map>
        <hr>
        <div id="my-strictly-unique-vue-upload-multiple-image" style="display: flex; justify-content: center;">
            <vue-upload-multiple-image
            @upload-success="uploadImageSuccess"
            @before-remove="beforeRemove"
            @edit-image="editImage"
            :data-images="images"
            idUpload="myIdUpload"
            editUpload="myIdEdit"
            dragText='قم بوضع الصور هنا'
            dropText='اترك الصور هنا'
            :showPrimary='false'
            browseText=' '
            :maxImage='50'
            :maxSizeImage="10"
            ></vue-upload-multiple-image>
        </div>
        <hr>
        <button @click="onSubmit" type="submit" class="btn btn-primary btn-lg mt-2" :disabled="allValidation == false ">
            <span v-if="loading">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                جاري التحميل ...
            </span>
            <span v-else>
                 حفظ
            </span>
        </button>
    </div>
  </div>
</template>

<script>
import googleMap from '@/pages/estates/googleMap';
import Treeselect from '@riophae/vue-treeselect'
import '@riophae/vue-treeselect/dist/vue-treeselect.css'
import VueUploadMultipleImage from 'vue-upload-multiple-image'

export default {
    components: {
        googleMap,Treeselect,VueUploadMultipleImage
    },
    data() {
        return {
            // google: gmapApi,
            loading : false,
            categories:[],
            attachments:[],
            countries:[],
            cities:[],
            districts:[],
            countries:[],
            images:[],
            city: '',
            passwordConfirmed:'',
            record:{
                name:'',
                email:'',
                phone:123,
                password:'',
                notes:'',
                payment:'',
                categories_id:'',
                name_ar:'',
                name_en:'',
                description_ar:'',
                location:
                {lat: 30.0526633, lng: 31.3738656},
                description_en:'',
                housing_units_id: this.$route.query.housing_units_id
            },
        }
    },
    methods: {
        async uploadImageSuccess(formData, index, fileList) {
            let response=  await this.axios({
                method: 'POST',
                url: '/api/image',
                data:{image:fileList[index].path},
            })
            this.images.push(response.data.image)
        },
        async beforeRemove (index, done, fileList) {
            if (confirm("هل تريد مسح الصورة")) {
                let response=  await this.axios({
                method: 'DELETE',
                url: `/api/image/${this.images[index].id}`,
            })
            this.images.splice(index,1)
            }
        },
        async editImage (formData, index, fileList) {

            let image = fileList[index];
            await setTimeout(function () {
                let response=     this.axios({
                    method: 'POST',
                    url: `/api/image/${fileList[index].id}`,
                    data:{image:fileList[index].path,_method:'PUT'},
                }).then((response)=>{
                    this.images[index]= response.data.image
                })
             }.bind(this), 1000)
        },
        searchForCity($event){
            var  filter, ul, li, a, i, txtValue;
            filter = $event.target.value.toUpperCase();
            ul = document.getElementsByClassName("dropdown-menu")[1];
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        },
        chooseCity(index){
            this.city= this.cities[index].name_ar
            this.record.regions_id= this.cities[index].id
        },
        async onSubmit() {
            this.loading=true;
            this.record.images= JSON.stringify( this.images.map(a => a.id));
            this.record.attachments= JSON.stringify( this.record.attachments);

            delete  this.record.category ;
            delete  this.record.admin ;
            delete  this.record.city;
            delete  this.record.attachs;

            let response = await this.Api('PUT',`estates/${this.record.id}`,this.record);

            this.loading=false;
            if(response.data.status==200)
                this.$swal("تم الاضافة بنجاح", "", "success")
            if(response.data.status==403)
                this.$swal("هذا الايميل موجود مسبقا ", "", "error")
            if(response.data.status==404)
                this.$swal("هذا التليفون موجود مسبقا ", "", "error")

        },

    },
    computed: {

        validateCategories_id(){
            return this.record.categories_id >0
        },
        validateName_ar(){
            return this.record.name_ar.length > 3
        },
        validateName_en(){
            return this.record.name_en.length > 3
        },
         validateDescription_ar(){
            return this.record.description_ar.length > 3
        },
         validatePayment(){
            return this.record.payment.length > 3
        },
        validateDescription_en(){
            return this.record.description_en.length > 3
        },
        allValidation(){
            return this.validateCategories_id  && this.validatePayment &&
            this.validateDescription_ar  && this.validateDescription_en  &&  !this.loading
            && this.validatePassword  &&  !this.loading

        }
    },
    async mounted(){
        let res = await this.Api('GET',`estates/${this.$route.params.id}`);
        this.record = res.data.record;
        this.record.attachments = JSON.parse(this.record.attachments);
        this.images = res.data.record.images;
        this.city= this.record.city.name_ar;

        // download dependancies
        let response =await  this.generalApi('POST','/api/getCategories',{})
        let response1 =await  this.generalApi('POST','/api/getCountries',{})
        let response2 =await  this.generalApi('POST','/api/getRegions',{dashboard:true})
        let response3 =await  this.Api('GET','getAllAttachments',{})
        this.countries = response1.data.countries;
        this.cities = response2.data.records;
        this.attachments = response3.data.records;

        this.attachments.map((element) => {
            return element.label = element.name_ar;
        });

        this.categories=response.data.categories;

    },
    metaInfo() {
        return {
            title: `حبابكم -  أنشأ عرض جديد `,
        }
    }

  }
</script>
<style >
.vue-map-container{
    margin-top : 10px
}
</style>
