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
        currentViewUser: null,
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
        currentViewUser(state) {
            return state.currentViewUser.user;
        },
        currentViewRole(state) {
            return state.currentViewUser.role;
        }
    },
    mutations: {
        initialiseStore(state) {
            state.isLoggedIn = false;
            state.user = {};
            state.account = {};
            state.allUsers = {};
            state.currentViewUser = {};
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
        },
        setCurrentViewUser(state, user) {
            state.currentViewUser = user;
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
                    axios.post("/users/add?token=" + localStorage.getItem('token'), user,
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

        updateUser({commit}, user) {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    axios.post("/users/update?token=" + localStorage.getItem('token'), user,
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

        getSearch({commit}, keyword) {
            if (!localStorage.getItem('token') || localStorage.getItem('token') == "") {
                console.log("No Token in localStorage");
            } else {
                console.log("Token in localStorage");
                return new Promise(resolve => {
                    setTimeout(() => {
                        axios.post("/users/search?token=" + localStorage.getItem('token'), {
                            'keyword': keyword
                        })
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

        getUser({commit}, user_id) {
            if (!localStorage.getItem('token') || localStorage.getItem('token') == "") {
                console.log("No Token in localStorage");
            } else {
                console.log("Token in localStorage");
                return new Promise(resolve => {
                    setTimeout(() => {
                        axios.get("/users/" + user_id + "?token=" + localStorage.getItem('token'))
                            .then(
                                response => {
                                    console.log(response);
                                    commit('setCurrentViewUser', response.data.user);
                                    console.log("GET user by id");
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

        getDelete({commit}, user_id) {
            if (!localStorage.getItem('token') || localStorage.getItem('token') == "") {
                console.log("No Token in localStorage");
            } else {
                console.log("Token in localStorage");
                return new Promise(resolve => {
                    setTimeout(() => {
                        axios.get("/users/delete/" + user_id + "?token=" + localStorage.getItem('token'))
                            .then(
                                response => {
                                    console.log(response);
                                    commit('setCurrentViewUser', response.data.user);
                                    alert('Succeeded')
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

        sendRequest({commit}, email) {
            console.log(email);
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    axios.post("/auth/password/request", {'email': email})
                        .then(
                            response => {
                                console.log(response);
                                // commit('setCurrentViewUser', response.data.user);
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
        },

        updatePassword({commit}, payload) {
            // console.log(email);
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    axios.post("/auth/password/update", payload)
                        .then(
                            response => {
                                console.log(response);
                                // commit('setCurrentViewUser', response.data.user);
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
        },



    },
});