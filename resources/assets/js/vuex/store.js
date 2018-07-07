import Vue from 'vue';
import Vuex from 'vuex';

import axios from 'axios';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        isLoggedIn: null,
        user: null,
        account: null,
        allUsers: null,
    },
    getters: {
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.user;
        },
        userRole(state) {
            return state.account.role;
        },
        allUsers(state) {
            return state.allUsers;
        },
    },
    mutations: {
        initialiseStore(state) {
            state.isLoggedIn = false;
            state.user = {};
            state.account = {};
            state.allUsers = {};
            console.log("initialiseStore");
        },
        setUser(state, user) {
            state.user = user;
        },
        setAccount(state, account) {
            state.account = account;
        },
        updateIsLoggedIn(state) {
            state.isLoggedIn = !!localStorage.getItem('token');
        },
        clearUser(state) {
            state.user = {};
        },
        setAllUsers(state, users) {
            state.allUsers = users;
        }
    },
    actions: {
        init({commit}) {
            commit('initialiseStore');
        },

        onRefresh({commit}) {
            if (!localStorage.getItem('token') || localStorage.getItem('token') == "") {
                console.log("No Token in localStorage");
            } else {
                console.log("Token in localStorage");
                return new Promise((resolve, reject) => {
                    setTimeout(() => {
                        axios.get("/auth/refresh?token=" + localStorage.getItem('token'))
                            .then(
                                response => {
                                    // console.log(response)
                                    this.dispatch('setUser', response.data.user);
                                    this.dispatch('setAccount', response.data.account);
                                    this.dispatch('updateIsLoggedIn');
                                    console.log("Token verified");
                                    resolve(response);
                                }
                            ).catch(
                            error => {
                                console.log(error);
                                reject(error);
                            }
                        );
                    }, 1000);
                });
            }
        },

        updateIsLoggedIn({commit}) {
            commit('updateIsLoggedIn')
        },

        setUser({commit}, user) {
            commit('setUser', user)
        },

        setAccount({commit}, account) {
            commit('setAccount', account)
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
                            this.dispatch('setAccount', response.data.account);
                            this.dispatch('updateIsLoggedIn');
                            console.log(response);
                            resolve(response);
                        }
                    ).catch(error => {
                            console.log(error);
                            reject(error);
                        }
                    );
                }, 1000);
            });
        },

        logout({commit}) {
            localStorage.removeItem("token");
            commit('updateIsLoggedIn');
            commit('clearUser');
        },

        addUser({commit}, user) {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    axios.post("/user/add?token=" + localStorage.getItem('token'), user,
                        {
                            headers: {'Content-Type': 'application/json'}
                        }
                    ).then(response => {
                            // console.log(response)
                            // alert("Create success VUEX");
                            console.log(response);
                            resolve(response);
                        }
                    ).catch(error => {
                            // alert("Create success VUEX");
                            console.log(error);
                            reject(error);
                        }
                    );
                }, 1000)
            });
        },

        getAllUsers({commit}) {
            if (!localStorage.getItem('token') || localStorage.getItem('token') == "") {
                console.log("No Token in localStorage");
            } else {
                console.log("Token in localStorage");
                return new Promise(resolve => {
                    setTimeout(() => {
                        axios.get("/users?token=" + localStorage.getItem('token'))
                            .then(
                                response => {
                                    console.log(response);
                                    commit('setAllUsers', response.data.users);
                                    console.log("All users GET");
                                }
                            ).catch(
                            error => {
                                console.log(error);
                                resolve(error);
                            }
                        );
                    }, 1000);
                });
            }
        },
    }
});
