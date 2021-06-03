<template>
    <div class="m-3" >
    <form @submit.prevent="onSubmit" class="border border-5 border-primary rounded ">
        <h3>
           تسجيل الدخول
        </h3>
        <hr>
        <div class="form-check ">
            <label  > ادخل الايميل او التليفون</label>
            <input type="text" v-model="account.username" :class="['form-control' ,{'is-valid':validationUsername && !inValidUsername},{'is-invalid':!validationUsername || inValidUsername}]"  >
            <div class="valid-feedback">
                     صحيح
            </div>
            <div class="invalid-feedback">
                <span v-if="inValidUsername">الايميل غير موجود</span>
                <span v-else>يجب إدخال الايميل بشكل صحيح</span>
            </div>
        </div>
        <div class="form-check ">
            <label  >الرقم السري</label>
            <input type="password" v-model="account.password" :class="['form-control' ,{'is-valid':validationPassword && !inValidPassword},{'is-invalid':!validationPassword || inValidPassword}]"  >
            <div class="valid-feedback">
                    الرقم السري صحيح
            </div>
            <div class="invalid-feedback">
                <span v-if="inValidPassword">الرقم السري غير صحيح</span>
                <span v-else> يجب إدخال الرقم السري بشكل صحيح</span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg mt-2" :disabled="allValidation == false ">
            <span v-if="loading">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                جاري التحميل ...
            </span>
            <span v-else>
                تسجيل دخول
            </span>
        </button>
    </form>
  </div>
</template>

<script>
import { mapActions, mapGetters  } from 'vuex'

  export default {

    data() {
        return {
            inValidUsername:false,
            inValidPassword:false,
            account:{
                username: '',
                password: '',
                type : 'dashboard'
            },
            loading: false,
        }
    },
    methods: {
        ...mapActions([
            'updateUserAction'
        ]),
        async onSubmit() {
            this.loading=true;
            let response  =await this.Api('POST','login',this.account)
            if(response.data.status == 200){
                this.updateUserAction(response.data.account)
                this.$router.push({ name: "statistics"})
                this.inValidPassword=false;
                this.inValidUsername=false;
            }
            if(response.data.status == 232){
                this.inValidUsername=true;
                this.loading=false;
            }
            if(response.data.status == 233){
                this.inValidPassword=true;
                this.inValidUsername=false;
                this.loading=false;
            }
        }
    },
    computed: {
        ...mapGetters([
            'getUser'
        ]),
        validationUsername() {
            let result = false
            if(isNaN(this.account.username)){
                if(  this.account.username.length > 12 &&  this.account.username.length < 30
                && this.account.username.includes('@')
                )
                    result =  true
            }else {
                if(  this.account.username.length == 11)
                    result =  true
            }
            return result;
        },
        validationPassword() {
            return this.account.password.length > 5 &&  this.account.password.length < 30
        },
        allValidation(){
            return this.validationUsername && this.validationPassword && !this.loading
        }
        ,gettypeof(){
            return isNaN(this.account.username)
        }
    },
    mounted(){
        this.$store.state.isLoading = false;
    },
        metaInfo() {
        return {
            title: `حبابكم - تسجيل الدخول`,
            meta: [
                // { name: 'description', content: 'Connect and follow ' + this.userData.name + ' on Epiloge - ' + this.userData.tagline},
                // { property: 'og:title', content: this.userData.name + ' - Epiloge'},
                { property: 'og:site_name', content: 'Epiloge'},
                // { property: 'og:description', content: 'Connect and follow ' + this.userData.name + ' on Epiloge - ' + this.userData.tagline},
                {property: 'og:type', content: 'profile'},
                // {property: 'og:url', content: 'https://epiloge.com/@' + this.userData.username},
                // {property: 'og:image', content: this.aws_url + '/users/' + this.userData.profileurl + '-main.jpg' }
            ]
        }
    }

}
</script>
<style scoped>
    @media only screen and (min-width: 768px) {
        form {
            padding: 40px;
        }
    }
    form {
        padding: 40px;
        background-color: #fff;
    }

</style>
