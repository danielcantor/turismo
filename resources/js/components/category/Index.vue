<!-- filepath: /c:/laragon/www/turismo/resources/js/components/category/Index.vue -->
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
        <tr v-for="categoryItem in categories" :key="categoryItem.id">
          <td>{{ categoryItem.name }}</td>
          <td>{{ categoryItem.slug }}</td>
          <td>{{ categoryItem.description }}</td>
          <td>
            <img :src="categoryItem.image" :alt="categoryItem.name" width="50" />
          </td>
          <td>
            <img :src="categoryItem.home_image" :alt="categoryItem.name" width="50" />
          </td>
          <td>
            <button class="btn btn-warning btn-sm" @click="openModal('edit', categoryItem)">
              Editar
            </button>
            <button class="btn btn-danger btn-sm" @click="confirmDeleteCategory(categoryItem.id)">
              Borrar
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modal Crear/Editar -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true" ref="categoryModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="categoryModalLabel">
              {{ modalType === 'create' ? 'Crear Categoría' : 'Editar Categoría' }}
            </h5>
            <button type="button" class="btn-close" @click="closeModal"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="modalType === 'create' ? createCategory() : updateCategory()">
              <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" v-model="category.name" required />
              </div>
              <div class="mb-3">
                <label for="slug" class="form-label">URL</label>
                <input type="text" class="form-control" v-model="category.slug" required />
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" v-model="category.description" required></textarea>
              </div>
              <!-- Agregar campo "subtitle" -->
              <div class="mb-3">
                <label for="subtitle" class="form-label">Subtítulo</label>
                <input type="text" class="form-control" v-model="category.subtitle" />
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input
                  type="file"
                  class="form-control"
                  @change="onFileChange($event, 'image')"
                  :required="modalType === 'create'"
                />
              </div>
              <div class="mb-3">
                <label for="home_image" class="form-label">Imagen de la home</label>
                <input
                  type="file"
                  class="form-control"
                  @change="onFileChange($event, 'home_image')"
                  :required="modalType === 'create'"
                />
              </div>
              <button type="submit" class="btn btn-primary">
                {{ modalType === 'create' ? 'Crear' : 'Actualizar' }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Borrar -->
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
            <button type="button" class="btn btn-secondary" @click="closeDeleteModal">
              Cancelar
            </button>
            <button type="button" class="btn btn-danger" @click="deleteCategory">
              Borrar
            </button>
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
        id: null,
        name: '',
        slug: '',
        description: '',
        subtitle: '', // Agregado
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
      axios.get('/category/get').then(response => {
        this.categories = response.data;
      });
    },
    openModal(type, categoryData = null) {
      this.modalType = type;
      if (type === 'edit' && categoryData) {
        this.category = { ...categoryData };
      } else {
        this.category = {
          id: null,
          name: '',
          slug: '',
          description: '',
          subtitle: '',
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
      axios
        .post('/category/save', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        })
        .then(() => {
          this.message = 'Categoria creada con exito';
          this.fetchCategories();
          this.closeModal();
        })
        .catch(error => {
          alert('Error al crear categoría:', error);
        });
    },
    updateCategory() {
      const formData = new FormData();
      for (const key in this.category) {
        if (this.category[key] !== null) {
          formData.append(key, this.category[key]);
        }
      }
      console.log(formData);
      axios
        .put(`/category/update/${this.category.id}`, formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        })
        .then(() => {
          this.message = 'Categoria actualizada con exito';
          this.fetchCategories();
          this.closeModal();
        })
        .catch(error => {
            alert('Error al actualizar categoría:', error);
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
      axios
        .delete(`/category/delete/${this.categoryIdToDelete}`)
        .then(() => {
          this.message = 'Categoria borrada con exito';
          this.fetchCategories();
          this.closeDeleteModal();
        })
        .catch(error => {
          console.error('Error al borrar categoría:', error);
        });
    }
  }
};
</script>