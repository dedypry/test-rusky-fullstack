<script setup>
import { useBookStore } from "../../store/book";
import Paginate from "../../components/Paginate.vue";
const store = useBookStore();
store.getBook();
</script>
<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div
                        class="col-md-4"
                        v-for="(item, i) in store.book.data"
                        :key="i"
                    >
                        <div class="card my-2 mx-2" style="width: 18rem">
                            <img
                                :src="item.image"
                                class="card-img-top"
                                alt="..."
                            />
                            <div class="card-body">
                                <h5 class="card-title">{{ item.title }}</h5>
                                <p class="card-text">
                                    {{ item.description }}
                                </p>
                                <p class="card-text">
                                    {{ item.authors }}
                                </p>
                                <div class="d-grid grap-2">
                                    <router-link
                                        class="btn btn-primary"
                                        :to="{
                                            name: 'book-detail',
                                            params: { id: item.id },
                                        }"
                                    >
                                        Detail
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <Paginate :data="store.book" />
            </div>
        </div>
    </div>
</template>
