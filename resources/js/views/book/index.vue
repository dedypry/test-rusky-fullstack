<script setup>
import { onMounted, reactive } from "vue";
import { useBookStore } from "../../store/book";
import Paginate from "../../components/Paginate.vue";
const store = useBookStore();
const form = reactive({
    q: "",
});

onMounted(() => {
    store.getBook();
});
</script>

<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <p>List Book</p>
                    <router-link
                        class="btn btn-primary btn-sm"
                        to="/book/create"
                        >Add Book</router-link
                    >
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 my-2">
                    <form class="d-flex flex-row mb-3">
                        <input class="form-control mx-2" v-model="form.q" />
                        <button
                            class="btn btn-primary btn-sm me-2"
                            type="button"
                            @click="store.getBook({ q: form.q })"
                        >
                            Search
                        </button>
                    </form>
                </div>
            </div>
            <div class="mb-10"></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Authors</th>
                                <th>Published Year</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, i) in store.book.data" :key="i">
                                <td class="text-center">
                                    <img
                                        :src="item.image"
                                        class="rounded"
                                        :alt="item.title"
                                        width="150"
                                    />
                                </td>
                                <td>{{ item.title }}</td>
                                <td>{{ item.authors }}</td>
                                <td>{{ item.published }}</td>
                                <td>
                                    {{ item.ready ? "Ready" : "Not Ready" }}
                                </td>
                                <td>
                                    <router-link
                                        type="button"
                                        class="btn btn-success btn-sm"
                                        :to="{
                                            name: 'book-detail',
                                            params: { id: item.id },
                                        }"
                                    >
                                        Detail
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Paginate :data="store.book" :store="store" />
                </div>
            </div>
        </div>
    </div>
</template>
