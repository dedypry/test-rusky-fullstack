<script setup>
import Footer from "./Footer.vue";
import Navbar from "./Navbar.vue";
import Sidebar from "./Sidebar.vue";
</script>

<template>
    <body class="sb-nav-fixed">
        <Navbar />
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <Sidebar />
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">{{ $route.name }}</h1>
                        <router-view></router-view>
                    </div>
                </main>
                <Footer />
            </div>
        </div>
    </body>
</template>
