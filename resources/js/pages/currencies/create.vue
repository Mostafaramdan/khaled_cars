<template>
    <div class="m-3" >
    <form  @submit.prevent="onSubmit" class="border border-5 border-primary rounded form">
        <h3>
           أنشأ عملة جديدة
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
            <label  > ادخل عدد الاسم بالانجليزي  </label>
            <input type="text" v-model="record.name_en" :class="['form-control' ,{'is-valid':validateName_en },{'is-invalid':!validateName_en}]"  >
            <div class="valid-feedback">
                صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الاسم بالانجليزي بشكل صحيح</span>
            </div>
        </div>
        <div class="form-check ">
            <label  > ادخل الكود  </label>
            <input type="text"  v-model="record.code" :class="['form-control' ,{'is-valid':validateCode },{'is-invalid':!validateCode}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الكود بشكل صحيح</span>
            </div>
        </div>
        <div class="form-check ">
            <label  > ادخل القيمة مقابل 1 دولار  </label>
            <input type="text"  v-model="record.value_in_dollar" :class="['form-control' ,{'is-valid':validateValue_in_dollar },{'is-invalid':!validateValue_in_dollar}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الكود بشكل صحيح</span>
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
                value_in_dollar:0,
                name_ar:'',
                name_en:'',
                code:'',
            },
        }
    },
    methods: {
        async onSubmit() {
            this.loading=true;
            let response = await this.Api('POST','currencies',this.record);
            this.loading=false;
            if(response.status==200)
             this.$swal("تم الاضافة بنجاح", "", "success")

        },
    },
    computed: {
        validateCode(){
            return this.record.code.length > 2
        },
        validateName_ar(){
            return this.record.name_ar.length > 3
        },
        validateName_en(){
            return this.record.name_en.length > 3
        },
        validateValue_in_dollar(){
            return this.record.value_in_dollar > 0
        },
        allValidation(){
            return this.validateCode && this.validateValue_in_dollar  &&
            this.validateName_en  && this.validateName_ar  &&  !this.loading
        }
    },
    mounted(){
        this.$store.state.isLoading = false;
    },
        metaInfo() {
        return {
            title: `حبابكم -  أنشأ عملة جديدة `,
        }
    }

  }
</script>
