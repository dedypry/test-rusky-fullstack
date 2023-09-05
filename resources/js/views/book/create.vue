<script setup>
import { Form, Field, ErrorMessage } from "vee-validate";
import { reactive, ref } from "vue";
import { useBookStore } from "../../store/book";

const store = useBookStore();
const refInputEl = ref();
const form = reactive({
    image: "/images/nophoto.png",
    title: "",
    authors: "",
    description: "",
    published: "",
    file: null,
});

const changeAvatar = (file) => {
    const fileReader = new FileReader();
    const { files } = file.target;

    form.file = files[0];

    if (files && files.length) {
        fileReader.readAsDataURL(files[0]);
        fileReader.onload = () => {
            if (typeof fileReader.result === "string") {
                form.image = fileReader.result;
            }
        };
    }
};
</script>

<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center flex-column">
                    <img :src="form.image" class="img-thumbnail" />
                    <input
                        ref="refInputEl"
                        type="file"
                        name="file"
                        accept=".jpeg,.png,.jpg,GIF"
                        hidden
                        @input="changeAvatar"
                    />
                    <div
                        class="btn btn-warning btn-sm my-3"
                        :class="store.loading ? 'disabled' : ''"
                        @click="refInputEl?.click()"
                    >
                        {{ store.loading ? "On Process" : "UPLOAD" }}
                    </div>
                </div>
                <div class="col-md-6">
                    <Form @submit="store.storeBook(form)">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >Title</label
                            >
                            <Field
                                name="title"
                                v-model="form.title"
                                class="form-control"
                                rules="required"
                            />
                            <ErrorMessage
                                name="title"
                                class="form-text text-danger"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >Authors</label
                            >
                            <Field
                                name="authors"
                                v-model="form.authors"
                                class="form-control"
                                rules="required"
                            />
                            <ErrorMessage
                                name="authors"
                                class="form-text text-danger"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >Published</label
                            >
                            <Field
                                name="published"
                                v-model="form.published"
                                class="form-control"
                                type="date"
                                rules="required"
                            />
                            <ErrorMessage
                                name="published"
                                class="form-text text-danger"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >Desription</label
                            >
                            <textarea
                                name="description"
                                v-model="form.description"
                                class="form-control"
                                rules="required"
                            />
                            <ErrorMessage
                                name="description"
                                class="form-text text-danger"
                            />
                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary"
                            :class="store.loading ? 'disabled' : ''"
                        >
                            {{ store.loading ? "ON PROCESS ..." : "SUBMIT" }}
                        </button>
                    </Form>
                </div>
            </div>
        </div>
    </div>
</template>
