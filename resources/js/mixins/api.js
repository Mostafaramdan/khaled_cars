export default {
    data(){
        return {
            baseUrlDashboard: window.location.origin+ '/apiDashboard/',
            response: null
        }
    },
    methods:{
        async Api(method,url,data){
            let response=  await this.axios({
                method: method,
                url: this.baseUrlDashboard+url,data,
                headers: {
                    'Authorization': `${this.$store.getters.getUser.apiToken}`,
                    "Content-Type": "application/json",
                    "Access-Control-Allow-Origin": "*"
                },
                params: data,
                data
            })
            .catch(function (error) {
                 console.log(error);
            });
            this.$store.state.isLoading = false;
            return response;
        },
        async generalApi(method,url,data){
            let response=  await this.axios({
                method: method,
                url: `${window.location.origin+url}`,
                headers: {
                    'Authorization': `${this.$store.getters.getUser.apiToken}`,
                    "Content-Type": "application/json",
                    "Access-Control-Allow-Origin": "*"
                },
                params: data,
                data
            })
            .catch(function (error) {
                 console.log(error);
            });
            this.$store.state.isLoading = false;
            return response;
        },
        toggle(column,id){
            let model = window.location.pathname.split('/')[2];
            this.Api('GET',`toggle/${model}/${column}/${id}`)
        }

    }
}
