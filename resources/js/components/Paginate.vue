<script setup>
import { defineProps } from "vue";
defineProps(["data", "store"]);
</script>
<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li
                class="page-item"
                :class="!data.prev_page_url ? 'disabled' : ''"
            >
                <button
                    class="page-link"
                    aria-label="Previous"
                    @click="
                        store.getBook({
                            page: data.current_page - 1,
                        })
                    "
                >
                    <span aria-hidden="true">&laquo;</span>
                </button>
            </li>
            <li class="page-item">
                <button class="page-link" @click="store.getBook({ page: 1 })">
                    1
                </button>
            </li>
            <li class="page-item" v-if="data.last_page > 2">
                <button
                    class="page-link"
                    @click="
                        store.getBook({
                            page: data.current_page,
                        })
                    "
                >
                    {{ data.current_page }}
                </button>
            </li>
            <li class="page-item" v-if="data.last_page != 1">
                <button
                    class="page-link"
                    @click="
                        store.getBook({
                            page: data.last_page,
                        })
                    "
                >
                    {{ data.last_page }}
                </button>
            </li>
            <li
                class="page-item"
                :class="!data.next_page_url ? 'disabled' : ''"
            >
                <button
                    class="page-link"
                    @click="
                        store.getBook({
                            page: data.current_page + 1,
                        })
                    "
                    aria-label="Next"
                >
                    <span aria-hidden="true">&raquo;</span>
                </button>
            </li>
        </ul>
    </nav>
</template>
