<template>
    <div class="m-3" >
    <form @submit.prevent="onSubmit" class="border border-5 border-primary rounded ">
        <h3>
           أنشأ  دولة جديدة
        </h3>
        <hr>
        <div class="form-check ">
            <label  > ادخل المحتوي بالعربي  </label>
            <input type="text" v-model="record.content_ar" :class="['form-control' ,{'is-valid':validateContent_ar },{'is-invalid':!validateContent_ar}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال المحتوي بالعربي بشكل صحيح</span>
            </div>
        </div>
         <div class="form-check ">
            <label  > ادخل عدد المحتوي بالانجليزي  </label>
            <input type="text" v-model="record.content_en" :class="['form-control' ,{'is-valid':validateContent_en },{'is-invalid':!validateContent_en}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال عدد المحتوي بالانجليزي بشكل صحيح</span>
            </div>
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

  export default {
    components: {
    },
    data() {
        return {
            loading : false,
            record:{
                content_ar:'',
                content_en:'',
            },
        }
    },
    methods: {

        async onSubmit() {
            this.loading=true;
            let response = await this.Api('PUT',`notifications/${this.record.id}`,this.record);
            this.loading=false;
                this.$swal("تم التعديل بنجاح", "", "success")
        }
    },
    computed: {
        validateContent_ar(){
            return this.record.content_ar.length > 3
        },
        validateContent_en(){
            return this.record.content_en.length > 3
        },
        allValidation(){
            return this.validateContent_ar && this.validateContent_en  &&  !this.loading
        }
    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`notifications/${this.$route.params.id}`);
        this.record = response.data.record;


    },
        metaInfo() {
        return {
            title: `حبابكم - إرسال إشعار جديد `,
        }
    }

  }
</script>
