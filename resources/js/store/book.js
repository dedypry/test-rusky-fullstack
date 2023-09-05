import { defineStore } from "pinia";
import http from "../libs/axios";
import { notify, confirm } from "../libs/mixin";
import router from "../router/router";

export const useBookStore = defineStore('book', {
    state: () => ({
        book: {
            data: []
        },
        detail: {},
        loading: false

    }),
    actions: {
        async getBook (data = {}) {
            let query = '';

            if (data.q) {
                query = `q=${data.q}`
            }
            if (data.page) {
                query += `&page=${data.page}`
            }

            http.get(`book?${query}`).then(({ data }) => {
                this.book = data.data
                this.detail = {}
            })
        },
        async getDetailBook (id) {
            http.get(`book/${id}`).then(({ data }) => {
                console.log(data);
                this.detail = data.data
            })
        },

        async storeBook (form) {
            this.loading = true
            const formData = new FormData()

            for (const [key, value] of Object.entries(form)) {
                if (!['image', 'user'].includes(key)) {
                    formData.append(key, value)
                }
            }

            await http.post('book', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                }
            }).then(({ data }) => {
                notify(data.message)
                router.push({ name: "book" })
            })
                .catch((err) => notify(err.response.data.message, 'error'))
            this.getBook()
            this.loading = false
        },
        deleteProduct (id) {
            confirm(async () => {
                await http.delete(`book/${id}`)
                    .then(({ data }) => {
                        router.push({ name: "book" })
                        notify(data.message)
                    })
                    .catch((err) => notify(err.response.data.message, 'error'))
            })
        },

        async addUserBook (form) {
            await http.post(`book/user`, form)
                .then(({ data }) => {
                    this.getDetailBook(form.id)
                    notify(data.message)
                })
                .catch((err) => notify(err.response.data.message, 'error'))
        }
    }
})
