<template>
  <div class="container">
    <h1>Productos</h1>
    <div class="mb-3">
      <button class="btn btn-primary mb-2 me-2" @click="openCreateModal">Crear Producto</button>
      <button class="btn btn-success mb-2 me-2" @click="triggerFileUpload">Importar CSV</button>
      <a href="/products/export-template" class="btn btn-info mb-2">Descargar Plantilla CSV</a>
      <input 
        type="file" 
        ref="fileInput" 
        @change="handleFileUpload" 
        accept=".csv,.txt" 
        style="display: none"
      />
    </div>

    <ProductList
      :products="products"
      @edit-product="openEditModal"
      @delete-product="eliminarProducto"
      @toggle-product="activarDesactivarProducto"
      @apply-filters="applyFilters"
      @change-page="fetchProducts"
      :categories="categories"
    />

    <ProductModal
      :isEditMode="isEditMode"
      :form="form"
      ref="productModal"
      @submit-form="submitForm"
      @close-modal="closeModal"
      @update-form="updateForm"
      :categories="categories"
      :departureDates="departureDates"
      @add-departure-date="addDepartureDate"
      @remove-departure-date="removeDepartureDate"
    />
  </div>
</template>

<script>
import axios from 'axios';
import ProductList from './ProductList.vue';
import ProductModal from './ProductModal.vue';

export default {
  components: {
    ProductList,
    ProductModal
  },
  data() {
    return {
      products: {
        data: [],
        current_page: 1,
        last_page: 1,
        prev_page_url: null,
        next_page_url: null
      },
      form: {
        product_name: '',
        product_price: '',
        product_description: '',
        product_image: null,
        product_slider: null,
        days: '',
        nights: '',
        product_type: ''
      },
      departureDates: [],
      isEditMode: false,
      currentProductId: null,
      categories: [],
      currentFilters: {}
    };
  },
  created() {
    this.fetchProducts();
    this.getCategories();
  },
  methods: {
    getCategories() {
      // Replace with your actual API call
      axios.get('/api/categories')
        .then(response => {
          this.categories = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    fetchProducts(page = 1, filters = {}) {
      // Merge filters with page parameter
      const params = {
        page: page,
        ...filters
      };
      
      axios.get('/products/get', { params }).then(response => {
        // Asegúrate de que las URLs de imágenes sean correctas
        response.data.data.forEach(product => {
          product.product_image_url = product.product_image_url;
          product.product_slider_url = product.product_slider_url;
        });
        this.products = response.data;
      });
    },
    applyFilters(filters) {
      this.currentFilters = filters;
      this.fetchProducts(1, filters);
    },
    triggerFileUpload() {
      this.$refs.fileInput.click();
    },
    handleFileUpload(event) {
      const file = event.target.files[0];
      if (!file) return;

      const formData = new FormData();
      formData.append('file', file);

      axios.post('/products/import', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then(response => {
        if (response.data.success) {
          alert(response.data.message);
          if (response.data.errors && response.data.errors.length > 0) {
            console.log('Errores durante la importación:', response.data.errors);
          }
          this.fetchProducts();
        }
      })
      .catch(error => {
        alert('Error al importar el archivo');
        console.error(error);
      })
      .finally(() => {
        // Reset file input
        this.$refs.fileInput.value = '';
      });
    },
    openCreateModal() {
      this.isEditMode = false;
      this.resetForm();
      new bootstrap.Modal(this.$refs.productModal.$el).show();
    },
      openEditModal(productId) {
      this.isEditMode = true;
      this.currentProductId = productId;
    
      // Hacer una solicitud para obtener la información del producto
      axios.get(`/products/obtenerProducto/` + productId)
        .then(response => {
          const product = response.data;
    
          // Asignar los valores del producto al formulario
          this.form = {
            product_name: product.product_name,
            product_price: product.product_price,
            product_description: product.product_description,
            product_image: product.product_image, // URL de la imagen actual desde la base de datos
            product_slider: product.product_slider, // URL del slider actual desde la base de datos
            days: product.days,
            nights: product.nights,
            product_type: product.product_type
          };
          
          // Cargar fechas de salida
          if (product.departure_dates && product.departure_dates.length > 0) {
            this.departureDates = product.departure_dates.map(d => d.date);
          } else {
            this.departureDates = [];
          }
    
          new bootstrap.Modal(this.$refs.productModal.$el).show();
        })
        .catch(error => {
          console.error('Error obteniendo informacion del producto:', error);
        });
    },
    submitForm() {
      const formData = new FormData();
      for (const key in this.form) {
        formData.append(key, this.form[key]);
      }
      
      // Agregar fechas de salida como array
      if (this.departureDates.length > 0) {
        this.departureDates.forEach((date, index) => {
          formData.append(`departure_dates[${index}]`, date);
        });
      }

      const config = {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      };

      if (this.isEditMode) {
        axios
          .post(`/modificarProducto/${this.currentProductId}`, formData, config)
          .then(() => {
            alert('Producto actualizado correctamente');
            this.closeModal();
            this.fetchProducts();
          })
          .catch(error => {
            alert('Error al actualizar el producto');
            console.error(error);
          });
      } else {
        axios
          .post('/products/save', formData, config)
          .then(() => {
            alert('Producto creado correctamente');
            this.closeModal();
            this.fetchProducts();
          })
          .catch(error => {
            alert('Error al crear el producto');
            console.error(error);
          });
      }
    },
    closeModal() {
      bootstrap.Modal.getInstance(this.$refs.productModal.$el).hide();
    },
    resetForm() {
      this.form = {
        product_name: '',
        product_price: '',
        product_description: '',
        product_image: null,
        product_slider: null,
        days: '',
        nights: '',
        product_type: ''
      };
      this.departureDates = [];
      this.currentProductId = null;
    },
    updateForm(field, value) {
      this.form[field] = value;
    },
    addDepartureDate(date) {
      if (date && !this.departureDates.includes(date)) {
        this.departureDates.push(date);
        // Ordenar las fechas
        this.departureDates.sort();
      }
    },
    removeDepartureDate(index) {
      this.departureDates.splice(index, 1);
    },
    eliminarProducto(id) {
      if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        axios
          .delete(`/products/delete/${id}`)
          .then(() => {
            alert('Producto eliminado correctamente');
            this.fetchProducts();
          })
          .catch(error => {
            alert('Error al eliminar el producto');
            console.error(error);
          });
      }
    },
    activarDesactivarProducto(id) {
      axios
        .post(`/products/toggle/${id}`)
        .then(() => {
          alert('Estado del producto actualizado');
          this.fetchProducts();
        })
        .catch(error => {
          alert('Error al actualizar el estado del producto');
          console.error(error);
        });
    }
  }
};
</script>