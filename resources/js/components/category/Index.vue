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
                        <button class="btn btn-danger btn-sm" @click="confirmDeleteCategory(category.id)">Borrar</button>
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
                                <input type="file" class="form-control" @change="onFileChange($event, 'image')" :required="modalType === 'create'">
                            </div>
                            <div class="mb-3">
                                <label for="home_image" class="form-label">Imagen de la home</label>
                                <input type="file" class="form-control" @change="onFileChange($event, 'home_image')" :required="modalType === 'create'">
                            </div>
                            <button type="submit" class="btn btn-primary">{{ modalType === 'create' ? 'Crear' : 'Actualizar' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" ref="deleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmar Borrado</h5>
                        <button type="button" class="btn-close" @click="closeDeleteModal"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas borrar esta categoría?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeDeleteModal">Cancelar</button>
                        <button type="button" class="btn btn-danger" @click="deleteCategory">Borrar</button>
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
                image: null,
                home_image: null
            },
            modalType: 'create',
            message: '',
            categoryIdToDelete: null
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
                    image: null,
                    home_image: null
                };
            }
            new bootstrap.Modal(this.$refs.categoryModal).show();
        },
        closeModal() {
            bootstrap.Modal.getInstance(this.$refs.categoryModal).hide();
        },
        onFileChange(event, field) {
            const file = event.target.files[0];
            this.category[field] = file;
        },
        createCategory() {
            const formData = new FormData();
            for (const key in this.category) {
                formData.append(key, this.category[key]);
            }
            axios.post('/category/save', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(() => {
                this.message = 'Categoria creada con exito';
                this.fetchCategories();
                this.closeModal();
            });
        },
        updateCategory() {
            const formData = new FormData();
            for (const key in this.category) {
                if (this.category[key] !== null) {
                    formData.append(key, this.category[key]);
                }
            }
            axios.put(`/category/update/${this.category.id}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(() => {
                this.message = 'Categoria actualizada con exito';
                this.fetchCategories();
                this.closeModal();
            });
        },
        confirmDeleteCategory(id) {
            this.categoryIdToDelete = id;
            new bootstrap.Modal(this.$refs.deleteModal).show();
        },
        closeDeleteModal() {
            bootstrap.Modal.getInstance(this.$refs.deleteModal).hide();
        },
        deleteCategory() {
            axios.delete(`/category/delete/${this.categoryIdToDelete}`)
                .then(() => {
                    this.message = 'Categoria borrada con exito';
                    this.fetchCategories();
                    this.closeDeleteModal();
                });
        }
    }
};
</script>