import AppStorage from "./AppStorage";
import Token from "./Token";

class User{

	responseAfterLogin(res){
        const access_token = res.data.access_token;
        const user_name = res.data.user_name;
        if(Token.isValid(access_token)){
            AppStorage.store(access_token,user_name);

        }
    }

    hasToken(){

        const storeToken=localStorage.getItem('token');
        if(storeToken){
            return Token.isValid(storeToken) ?true : false
        }return false;
    }

    loggedIn(){

        return this.hasToken();
    }

    userName(){
        if(this.loggedIn()){

            return localStorage.getItem('user');
        }
    }

    userid(){
        const payload =Token.payload(localStorage.getItem('token'));
        if(payload){
            return payload.sub;
        }return false;
    }

}

export default User= new User();