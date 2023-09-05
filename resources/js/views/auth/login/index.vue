<script setup>
import { reactive } from "vue";
import { useAuthUserStore } from "../../../store/auth";

const auth = useAuthUserStore();

const form = reactive({
    email: "",
    password: "",
});
</script>

<template>
    <div>
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4">
                Welcome Back to Perpustakaan
            </h3>
            <h5 class="text-center font-weight-light my-4">Please Login</h5>
        </div>
        <div class="card-body">
            <form action="#">
                <div class="form-floating mb-3">
                    <input
                        class="form-control"
                        id="inputEmail"
                        type="email"
                        placeholder="name@example.com"
                        v-model="form.email"
                    />
                    <label for="inputEmail">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        class="form-control"
                        id="inputPassword"
                        type="password"
                        placeholder="Password"
                        v-model="form.password"
                    />
                    <label for="inputPassword">Password</label>
                </div>
                <div class="d-grid gap-2">
                    <button
                        type="button"
                        class="btn btn-primary"
                        :class="auth.loading ? 'disabled' : ''"
                        @click="auth.login(form)"
                    >
                        {{ auth.loading ? "On Proses ..." : "LOGIN" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
