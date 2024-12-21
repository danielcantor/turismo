<template>
  <div class="container">
    <h1>Productos</h1>
    <button class="btn btn-primary mb-2" @click="openCreateModal">Crear Producto</button>

    <ProductList
      :products="products"
      @edit-product="openEditModal"
      @delete-product="eliminarProducto"
      @toggle-product="activarDesactivarProducto"
      @fetch-products="fetchProducts"
      :categories="categories"
    />

    <ProductModal
      :isEditMode="isEditMode"
      :form="form"
      ref="productModal"
      @submit-form="submitForm"
      @close-modal="closeModal"
      :categories="categories"
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
        product_image_url: '',
        product_slider: null,
        product_slider_url: '',
        product_days: '',
        product_nights: '',
        product_type: ''
      },
      isEditMode: false,
      currentProductId: null,
      categories: []
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
    fetchProducts(page = 1) {
      axios.get(`/products/get?page=${page}`).then(response => {
        // Asegúrate de que las URLs de imágenes sean correctas
        response.data.data.forEach(product => {
          product.product_image_url = product.product_image_url;
          product.product_slider_url = product.product_slider_url;
        });
        this.products = response.data;
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
            product_image: null,
            product_image_url: product.product_image_url, // URL de la imagen actual
            product_slider: null,
            product_slider_url: product.product_slider_url, // URL del slider actual
            product_days: product.days,
            product_nights: product.nights,
            product_type: product.product_type
          };
    
          new bootstrap.Modal(this.$refs.productModal.$el).show();
        })
        .catch(error => {
          console.error('Error obteniendo informacion del producto:', error);
        });
    },
    submitForm() {
      const formData = new FormData();
      formData.append('product_name', this.form.product_name);
      formData.append('product_price', this.form.product_price);
      formData.append('product_description', this.form.product_description);
      formData.append('product_type', this.form.product_type);
      formData.append('product_days', this.form.product_days);
      formData.append('product_nights', this.form.product_nights);

      if (this.form.product_image) {
        formData.append('product_image', this.form.product_image);
      }

      if (this.form.product_slider) {
        formData.append('product_slider', this.form.product_slider);
      }

      if (this.isEditMode) {
        axios
          .post(`/modificarProducto/${this.currentProductId}`, formData)
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
          .post('/products/save', formData)
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
        product_image_url: '',
        product_slider: null,
        product_slider_url: '',
        product_days: '',
        product_nights: '',
        product_type: ''
      };
      this.currentProductId = null;
    },
    updateForm(field, value) {
      this.form[field] = value;
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