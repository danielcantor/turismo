<!-- filepath: /c:/laragon/www/turismo/resources/js/components/category/Index.vue -->
<template>
    <div class="container mt-5">
      <h1>Categorías de Productos</h1>
      <button class="btn btn-primary mb-3" @click="openModal('create')">Crear categoría</button>
      <div v-if="message" class="alert alert-success">{{ message }}</div>
      <table class="table table-responsive">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>URL</th>
            <th>Descripción</th>
            <th>Imagen</th>
            <th>Imagen de la Home</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="cat in categories" :key="cat.id">
            <td>{{ cat.name }}</td>
            <td>{{ cat.slug }}</td>
            <td>{{ cat.description }}</td>
            <td>
              <a :href="cat.image" target="_blank">
                <img :src="cat.image" :alt="cat.name" width="50" />
              </a>
            </td>
            <td>
              <a :href="cat.home_image" target="_blank">
                <img :src="cat.home_image" :alt="cat.name" width="50" />
              </a>
            </td>
            <td>
              <button class="btn btn-warning btn-sm" @click="openModal('edit', cat)">Editar</button>
              <button class="btn btn-danger btn-sm" @click="confirmDeleteCategory(cat.id)">Borrar</button>
            </td>
          </tr>
        </tbody>
      </table>
  
      <!-- Modal Crear/Editar -->
      <div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true" ref="categoryModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ modalType === 'create' ? 'Crear Categoría' : 'Editar Categoría' }}</h5>
              <button type="button" class="btn-close" @click="closeModal"></button>
            </div>
            <div class="modal-body">
              <form @submit.prevent="modalType === 'create' ? createCategory() : updateCategory()">
                <div class="mb-3">
                  <label class="form-label">Nombre</label>
                  <input type="text" class="form-control" v-model="category.name" />
                  <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
                </div>
                <div class="mb-3">
                  <label class="form-label">URL</label>
                  <input type="text" class="form-control" v-model="category.slug" />
                  <div v-if="errors.slug" class="text-danger">{{ errors.slug[0] }}</div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Descripción</label>
                  <textarea class="form-control" v-model="category.description"></textarea>
                  <div v-if="errors.description" class="text-danger">{{ errors.description[0] }}</div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Imagen</label>
                  <input type="file" class="form-control" @change="onFileChange($event, 'image')" />
                  <div v-if="errors.image" class="text-danger">{{ errors.image[0] }}</div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Imagen de la Home</label>
                  <input type="file" class="form-control" @change="onFileChange($event, 'home_image')" />
                  <div v-if="errors.home_image" class="text-danger">{{ errors.home_image[0] }}</div>
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
      <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true" ref="deleteModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirmar Borrado</h5>
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
  import axios from 'axios'
  
  export default {
    data() {
      return {
        categories: [],
        category: {
          id: null,
          name: '',
          slug: '',
          description: '',
          image: null,
          home_image: null
        },
        modalType: 'create',
        message: '',
        categoryIdToDelete: null,
        errors: {}
      }
    },
    created() {
      this.fetchCategories()
    },
    methods: {
      fetchCategories() {
        axios.get('/category/get').then(response => {
          this.categories = response.data
        })
      },
      openModal(type, category = null) {
        this.modalType = type
        this.errors = {}
        if (type === 'edit' && category) {
          this.category = { ...category }
        } else {
          this.category = {
            id: null,
            name: '',
            slug: '',
            description: '',
            image: null,
            home_image: null
          }
        }
        new bootstrap.Modal(this.$refs.categoryModal).show()
      },
      closeModal() {
        bootstrap.Modal.getInstance(this.$refs.categoryModal).hide()
      },
      onFileChange(event, field) {
        const file = event.target.files[0]
        this.category[field] = file
      },
      createCategory() {
        const formData = new FormData()
        for (const key in this.category) {
          formData.append(key, this.category[key])
        }
        axios
          .post('/category/save', formData, { headers: { 'Content-Type': 'multipart/form-data' } })
          .then(() => {
            this.message = 'Categoría creada con éxito'
            this.fetchCategories()
            this.closeModal()
          })
          .catch(error => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors || {}
            }
          })
      },
      updateCategory() {
        const formData = new FormData()
        for (const key in this.category) {
          if (this.category[key] !== null) {
            formData.append(key, this.category[key])
          }
        }
        axios
          .post(`/category/update/${this.category.id}`, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
          .then(() => {
            this.message = 'Categoría actualizada con éxito'
            this.fetchCategories()
            this.closeModal()
          })
          .catch(error => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors || {}
            }
          })
      },
      confirmDeleteCategory(id) {
        this.categoryIdToDelete = id
        new bootstrap.Modal(this.$refs.deleteModal).show()
      },
      closeDeleteModal() {
        bootstrap.Modal.getInstance(this.$refs.deleteModal).hide()
      },
      deleteCategory() {
        axios.delete(`/category/delete/${this.categoryIdToDelete}`).then(() => {
          this.message = 'Categoría borrada con éxito'
          this.fetchCategories()
          this.closeDeleteModal()
        })
      }
    }
  }
  </script>