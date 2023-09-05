<script setup>
import navigation from "../../../navigation/vertical";
import SidebarChild from "./SidebarChild.vue";
</script>

<template>
    <div>
        <div v-for="(item, i) in navigation" :key="i">
            <div v-if="item.header" class="sb-sidenav-menu-heading">
                {{ item.header }}
            </div>
            <router-link
                v-if="!item.header"
                class="nav-link"
                :class="$route.name === item.url ? 'active' : ''"
                :to="{ name: item.url }"
            >
                <div class="sb-nav-link-icon">
                    <i :class="'fas ' + item.icon"></i>
                </div>
                {{ item.title }}
                <div
                    v-if="item.children && item.children.length > 0"
                    class="sb-sidenav-collapse-arrow"
                >
                    <i class="fas fa-angle-down"></i>
                </div>
            </router-link>
            <SidebarChild
                v-if="item.children && item.children.length > 0"
                :items="item.children"
            />
        </div>
    </div>
</template>
