<template>
    <div class="m-3" >
    <form  @submit.prevent="onSubmit" class="border border-5 border-primary rounded form">
        <h3>
         تعديل مسؤول
        </h3>
        <hr>
        <div class="form-check ">
            <label  > ادخل الاسم  </label>
            <input type="text" v-model="record.name" :class="['form-control' ,{'is-valid':validateName },{'is-invalid':!validateName}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الاسم بشكل صحيح</span>
            </div>
        </div>
         <div class="form-check ">
            <label  > ادخل الايميل  </label>
            <input type="text" v-model="record.email" :class="['form-control' ,{'is-valid':validateEmail },{'is-invalid':!validateEmail}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الايميل بشكل صحيح</span>
            </div>
        </div>
        <div class="form-check ">
            <label  > ادخل التليفون  </label>
            <input type="number" v-model="record.phone" :class="['form-control' ,{'is-valid':validatePhone },{'is-invalid':!validatePhone}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال التليفون  بشكل صحيح</span>
            </div>
        </div>
        <div class="form-check ">
            <label  > ادخال الرقم السري  </label>
            <input type="password" v-model="record.password" :class="['form-control' ,{'is-valid':validatePassword },{'is-invalid':!validatePassword}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span>يجب إدخال الرقم السري بشكل صحيح</span>
            </div>
        </div>
        <div class="form-check ">
            <label  > اعد ادخال الرقم السري  </label>
            <input type="password" v-model="passwordConfirmed" :class="['form-control' ,{'is-valid':validatePassword && passwordConfirmed == record.password },{'is-invalid':!validatePassword || passwordConfirmed !== record.password}]"  >
            <div class="valid-feedback" v-if="passwordConfirmed == record.password">
                     صحيح
            </div>
            <div class="invalid-feedback" v-if="passwordConfirmed !== record.password">
                <span>الرقم السري غير متطابق</span>
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
            passwordConfirmed:'',
            record:{
                name:'',
                email:'',
                phone:123,
                password:'',
            },
        }
    },
    methods: {
        async onSubmit() {
            this.loading=true;
            let response = await this.Api('PUT',`admins/${this.record.id}`,this.record);
            if(response.status== 200){
                this.$swal("تم التعديل بنجاح", "", "success")
                this.loading=false;
            }

        },
    },
    computed: {
        validateName(){
            return this.record.name.length > 3 > 0
        },
        validateEmail(){
            return this.record.email.length > 3 && this.record.email.includes('@')
        },
        validatePhone(){
            return this.record.phone.length > 3

        },
        validatePassword(){
            return this.record.password.length > 3
        },
        allValidation(){
            return this.validateName && this.validateEmail  && this.validatePhone && this.validatePassword  &&  !this.loading
        }
    },
    async mounted(){
        this.$store.state.isLoading = false;
        let response = await this.Api('GET',`admins/${this.$route.params.id}`);
        this.record = response.data.record;

    },
        metaInfo() {
        return {
            title: `حبابكم -   تعديل مسؤول  `,
        }
    }

  }
</script>
