export default {
    state : {
        user: {
            name:'',
            email:'',
            apiToken:''
        },
        isLoading:true

    },
    getters: {
        getUser(state){
            if(state.user.apiToken.length > 0){
                return state.user;
            }

            if (localStorage.getItem("account") && /^[\],:{}\s]*$/.test(localStorage.getItem("account").replace(/\\["\\\/bfnrtu]/g, '@').
            replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
            replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
                state.user= JSON.parse(localStorage.getItem("account"));
                if(state.user &&  state.user.apiToken.length > 0){
                    return state.user;
                }

            }else{
                return state.user;
            }
            if(user &&  user.apiToken.length > 0){
                state.user= user;
            }

            return state.user;
        },
        checkAuth(state){
            if(state.user.apiToken.length > 0){
                return true;
            }else{
                if (localStorage.getItem("account") && /^[\],:{}\s]*$/.test(localStorage.getItem("account").replace(/\\["\\\/bfnrtu]/g, '@').
                replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
                replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

                    state.user= JSON.parse(localStorage.getItem("account"));

                }else{
                    return false;
                }
                    if(user &&  user.apiToken.length > 0){
                    state.user= user;
                    return true;
                }else{
                    return false;
                }
            }

        },
    },
    mutations: {
        updateUser(state, account){
            state.user = account;
            localStorage.setItem("account", JSON.stringify(account));
        },
        logout(state){
            state.user = {name:'',email:'',apiToken:''};
            localStorage.removeItem("account");
        },
    },
    actions :{
        updateUserAction({commit}, data){
            commit('updateUser', data)
        },
        logoutAction({commit} ){
            commit('logout')
        }
    }
}
