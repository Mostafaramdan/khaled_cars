<template>
    <div class="m-3" >
    <form @submit.prevent="onSubmit" class="border border-5 border-primary rounded ">
        <h3>
           تعديل وحدة سكنية جديدة
        </h3>
        <hr>
        <div class="form-check ">
            <label  > ادخل السعر  </label>
            <input type="number" v-model="record.price" :class="['form-control' ,{'is-valid':validatePrice },{'is-invalid':!validatePrice}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال السعر بشكل صحيح</span>
            </div>
        </div>
         <div class="form-check ">
            <label  > ادخل عدد البالغين  </label>
            <input type="number" v-model="record.adult_nums" :class="['form-control' ,{'is-valid':validateAdult_nums },{'is-invalid':!validateAdult_nums}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال عدد البالغين بشكل صحيح</span>
            </div>
        </div>
         <div class="form-check ">
            <label  > ادخل عدد الاطفال  </label>
            <input type="number" v-model="record.children_nums" :class="['form-control' ,{'is-valid':validateChildren_nums },{'is-invalid':!validateChildren_nums}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال عدد الاطفال بشكل صحيح</span>
            </div>
        </div>

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
        <button type="submit" class="btn btn-primary btn-lg mt-2" :disabled="allValidation == false ">
            <span v-if="loading">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                جاري التحميل ...
            </span>
            <span v-else>
                 حفظ
            </span>
        </button>
    </form>
  </div>
</template>

<script>
import VueUploadMultipleImage from 'vue-upload-multiple-image'

  export default {
    components: {
        VueUploadMultipleImage,
    },
    data() {
        return {
            loading : false,
            images:[],
            record:{
                price:0,
                adult_nums:0,
                children_nums:0,
                estates_id:this.$store.state.user.estates_id,
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
        async onSubmit() {
            this.loading=true;
            this.record.images= JSON.stringify( this.images.map(a => a.id));
            delete this.record.has_offer;
            let response = await this.Api('PUT',`housing_units/${this.record.id}`,this.record);
            if(response.status== 200){
                this.$swal("تم التعديل بنجاح", "", "success")
                this.loading=false;
            }
        }
    },
    computed: {
        validatePrice(){
            return this.record.price > 0
        },
        validateAdult_nums(){
            return this.record.adult_nums > 0
        },
        validateChildren_nums(){
            return this.record.children_nums > 0
        },
        allValidation(){
            return this.validatePrice && this.validateAdult_nums && this.validateChildren_nums &&  !this.loading
        }
    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`housing_units/${this.$route.params.id}`);
        this.record = response.data.record;
        this.images = response.data.record.images;

    },
        metaInfo() {
        return {
            title: `حبابكم -  تعديل الوحدة سكنية  `,
        }
    }
}
</script>
