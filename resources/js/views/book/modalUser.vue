<script setup>
import { Form, Field, ErrorMessage } from "vee-validate";
import { reactive } from "vue";
import { useBookStore } from "../../store/book";
import { useRoute } from "vue-router";

const store = useBookStore();
const route = useRoute();
const form = reactive({
    id: route.params.id,
    name: "",
    email: "",
    note: "",
    type: "add",
});

function storeUser() {
    store.addUserBook(form);
}
</script>
<template>
    <div>
        <button
            type="button"
            class="btn btn-primary btn-sm me-2"
            data-bs-toggle="modal"
            data-bs-target="#modalUser"
        >
            Added User the book
        </button>
        <!-- Modal -->
        <div
            class="modal fade btn-sm"
            id="modalUser"
            tabindex="-1"
            aria-labelledby="userModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="userModalLabel">
                            Add User
                        </h1>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <Form>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <Field
                                    name="name"
                                    class="form-control"
                                    v-model="form.name"
                                />
                                <ErrorMessage
                                    name="name"
                                    class="form-text text-danger"
                                />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <Field
                                    name="email"
                                    type="email"
                                    class="form-control"
                                    rules="required|email"
                                    v-model="form.email"
                                />
                                <ErrorMessage
                                    name="email"
                                    class="form-text text-danger"
                                />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea
                                    class="form-control"
                                    v-model="form.note"
                                />
                            </div>
                        </Form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="storeUser"
                        >
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
