import { defineStore } from "pinia"
import http from '../libs/axios'
import router from '../router/router'
import { notify, confirm } from '../libs/mixin'

export const useAuthUserStore = defineStore('authUser', {
    state: () => ({
        token: '',
        user: {},
        loading: false,
    }),
    actions: {
        async login (form) {
            this.loading = true
            await http.post('login', form)
                .then(({ data }) => {
                    this.setUser(data.data)
                    router.push({ path: 'dashboard' })
                    this.loading = false
                    notify(data.message)
                })
                .catch(err => {
                    this.loading = false
                    notify(err.response.data.message, 'error')
                })
        },

        async logout () {
            confirm(async () => {
                await http.post('logout')
                    .then(({ data }) => {
                        this.setUser()
                        router.push({ name: 'login' })
                        notify(data.message)
                    })
                    .catch(err => {
                        notify(err.response.data.message, 'error')
                    })
            },
                'Are you Sure!!',
                'Yes, Sure'
            )
        },

        setUser (data = {}) {
            this.token = data.token
            this.user = data.user
        },
    },
    persist: true,
})
