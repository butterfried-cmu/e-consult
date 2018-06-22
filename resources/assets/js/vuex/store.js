import Vue from 'vue';
import Vuex from 'vuex';

import axios from 'axios';

Vue.use(Vuex);

const LOGIN = "LOGIN";
const LOGIN_SUCCESS = "LOGIN_SUCCESS";
const LOGOUT = "LOGOUT";

export const store = new Vuex.Store({
    state: {
        isLoggedIn: null,
        currentUser: null,

    },
    getters: {
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        }
    },
    mutations: {
        initialiseStore(state) {
            state.isLoggedIn = false;
            state.currentUser = {};
            console.log("initialiseStore");
            if (!localStorage.getItem('token') || localStorage.getItem('token') == "") {
                console.log("No Token in localStorage");
            } else {
                console.log("Token in localStorage");
                return new Promise(resolve => {
                    setTimeout(() => {
                        axios.get("/auth/user?token=" + localStorage.getItem('token'))
                            .then((response) => {
                                    // console.log(response)
                                    this.dispatch('setUser', response.data.user);
                                    this.dispatch('updateIsLoggedIn');
                                    console.log("Token verified");
                                }
                            ).catch(
                            (error) => console.log(error)
                        );
                        resolve();
                    }, 1000);
                });
            }
        },
        setUser(state, user) {
            state.currentUser = user;
        },
        updateIsLoggedIn(state) {
            state.isLoggedIn = !!localStorage.getItem('token');
        }
    },
    actions: {
        updateIsLoggedIn({commit}) {
            commit('updateIsLoggedIn')
        },

        setUser({commit}, user) {
            commit('setUser', user)
        },

        login({commit}, {username, password}) {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    axios.post("/auth/login",
                        {
                            username: username,
                            password: password
                        },
                        {
                            headers: {'Content-Type': 'application/json'}
                        }
                    ).then(response => {
                            // console.log(response)
                            localStorage.setItem("token", response.data.token);
                            this.dispatch('setUser', response.data.user);
                            this.dispatch('updateIsLoggedIn');
                            console.log(response);
                            resolve(response);
                        }
                    ).catch(error => {
                            console.log(error);
                            reject(error);
                        }
                    );
                }, 1000)
            });
        },

        logout({commit}) {
            localStorage.removeItem("token");
            commit('updateIsLoggedIn');
        },

        init({commit}) {
            commit('initialiseStore');
        }
    }
});

