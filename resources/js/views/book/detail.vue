<script setup>
import { useRoute } from "vue-router";
import { useBookStore } from "../../store/book";
import ModalUser from "./modalUser.vue";
import { formatDate } from "../../libs/mixin";
const route = useRoute();
const store = useBookStore();

store.getDetailBook(route.params.id);
</script>
<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <ModalUser />
                <router-link
                    class="btn btn-warning btn-sm ms-2"
                    :to="{
                        name: 'book-edit',
                        params: { id: $route.params.id },
                    }"
                    >Edit</router-link
                >
                <button
                    class="btn btn-danger btn-sm ms-2"
                    @click="store.deleteProduct($route.params.id)"
                >
                    Delete
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img :src="store.detail.image" class="img-thumbnail" />
                    </div>
                    <div class="col-md-6 table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Title</th>
                                    <th>:</th>
                                    <th>{{ store.detail.title }}</th>
                                </tr>
                                <tr>
                                    <th>Author</th>
                                    <th>:</th>
                                    <th>{{ store.detail.authors }}</th>
                                </tr>
                                <tr>
                                    <th>Published</th>
                                    <th>:</th>
                                    <th>{{ store.detail.published }}</th>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <th>:</th>
                                    <th>{{ store.detail.description }}</th>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <th>:</th>
                                    <th>
                                        <div
                                            class="alert"
                                            :class="
                                                store.detail.ready
                                                    ? 'alert-success'
                                                    : 'alert-danger'
                                            "
                                            role="alert"
                                        >
                                            {{
                                                store.detail.ready
                                                    ? "Ready"
                                                    : "Not Ready"
                                            }}
                                        </div>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="card mt-10">
            <div class="card-header">
                <h3>History</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>email</th>
                                <th>Return At</th>
                                <th>Received At</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, i) in store.detail.user" :key="i">
                                <td>{{ i + 1 }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.email }}</td>
                                <td>{{ formatDate(item.pivot.return_at) }}</td>
                                <td>
                                    {{ formatDate(item.pivot.received_at) }}
                                </td>
                                <td>{{ item.pivot.note }}</td>
                                <td>
                                    <div
                                        class="btn btn-danger btn-sm"
                                        v-if="!item.pivot.return_at"
                                        @click="
                                            store.addUserBook({
                                                id: item.pivot.id,
                                                type: 'return',
                                            })
                                        "
                                    >
                                        Return
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
    </div>
</template>
