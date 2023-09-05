<script setup>
import Footer from "../admin/Footer.vue";
</script>

<template>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div
                                    class="card shadow-lg border-0 rounded-lg mt-5"
                                >
                                    <router-view></router-view>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <Footer />
        </div>
    </body>
</template>
