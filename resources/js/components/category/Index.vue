<template>
    <div class="container mt-5">
        <h1>Categorias de Productos</h1>
        <button class="btn btn-primary mb-3" @click="openModal('create')">Crear categoria</button>
        <div v-if="message" class="alert alert-success">{{ message }}</div>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>URL</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Imagen de la home</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <td>{{ category.name }}</td>
                    <td>{{ category.slug }}</td>
                    <td>{{ category.description }}</td>
                    <td><img :src="category.image" :alt="category.name" width="50"></td>
                    <td><img :src="category.home_image" :alt="category.name" width="50"></td>
                    <td>
                        <button class="btn btn-warning btn-sm" @click="openModal('edit', category)">Editar</button>
                        <button class="btn btn-danger btn-sm" @click="deleteCategory(category.id)">Borrar</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true" ref="categoryModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryModalLabel">{{ modalType === 'create' ? 'Create Category' : 'Edit Category' }}</h5>
                        <button type="button" class="btn-close" @click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="modalType === 'create' ? createCategory() : updateCategory()">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" v-model="category.name" required>
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Url</label>
                                <input type="text" class="form-control" v-model="category.slug" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripcion</label>
                                <textarea class="form-control" v-model="category.description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Imagen</label>
                                <input type="text" class="form-control" v-model="category.image" required>
                            </div>
                            <div class="mb-3">
                                <label for="home_image" class="form-label">Imagen de la home</label>
                                <input type="text" class="form-control" v-model="category.home_image" required>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ modalType === 'create' ? 'Crear' : 'Actualizar' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            categories: [],
            category: {
                name: '',
                slug: '',
                description: '',
                image: '',
                home_image: ''
            },
            modalType: 'create',
            message: ''
        };
    },
    created() {
        this.fetchCategories();
    },
    methods: {
        fetchCategories() {
            axios.get('/category/get')
                .then(response => {
                    this.categories = response.data;
                });
        },
        openModal(type, category = null) {
            this.modalType = type;
            if (type === 'edit' && category) {
                this.category = { ...category };
            } else {
                this.category = {
                    name: '',
                    slug: '',
                    description: '',
                    image: '',
                    home_image: ''
                };
            }
            new bootstrap.Modal(this.$refs.categoryModal).show();
        },
        closeModal() {
            bootstrap.Modal.getInstance(this.$refs.categoryModal).hide();
        },
        createCategory() {
            axios.post('/category/save', this.category)
                .then(() => {
                    this.message = 'Categoria creada con exito';
                    this.fetchCategories();
                    this.closeModal();
                });
        },
        updateCategory() {
            axios.put(`/category/update/${this.category.id}`, this.category)
                .then(() => {
                    this.message = 'Categoria actualizada con exito';
                    this.fetchCategories();
                    this.closeModal();
                });
        },
        deleteCategory(id) {
            axios.delete(`/category/delete/${id}`)
                .then(() => {
                    this.message = 'Categoria borrada con exito';
                    this.fetchCategories();
                });
        }
    }
};
</script>