<script setup>
import { defineProps } from "vue";
defineProps(["items"]);
</script>

<template>
    <div
        class="collapse"
        id="collapseLayouts"
        aria-labelledby="headingOne"
        data-bs-parent="#sidenavAccordion"
    >
        <nav
            class="sb-sidenav-menu-nested nav"
            class-active="active"
            v-for="(child, i) in items"
            :key="i"
        >
            <router-link class="nav-link" :to="{ name: child.url }">
                {{ child.title }}
            </router-link>
        </nav>
    </div>
</template>
