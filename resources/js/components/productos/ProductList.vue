<template>
  <div>
  <table class="table table-responsive">
    <thead>
      <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Tipo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="product in products.data" :key="product.id">
        <td>{{ product.id }}</td>
        <td>{{ product.product_name }}</td>
        <td>{{ product.product_description }}</td>
        <td>{{ product.product_price }}</td>
        <td>{{ getCategoryName(product.product_type) }}</td>
        <td>
          <button class="btn btn-warning btn-sm" @click="$emit('edit-product', product)">Editar</button>
          <button class="btn btn-danger btn-sm" @click="$emit('delete-product', product.id)">Eliminar</button>
          <button 
            :class="['btn', 'btn-sm', product.product_activate ? 'btn-secondary' : 'btn-primary']" 
            @click="$emit('toggle-product', product.id)"
          >
            {{ product.product_activate ? 'Desactivar' : 'Activar' }}
          </button>
        </td>
      </tr>
    </tbody>
  </table>
  <!-- Paginación -->
  <nav>
    <ul class="pagination">
      <li class="page-item" :class="{ disabled: !products.prev_page_url }">
        <a class="page-link" href="#" @click.prevent="$emit('fetch-products', products.current_page - 1)">Anterior</a>
      </li>
      <li
        class="page-item"
        v-for="page in totalPages"
        :key="page"
        :class="{ active: page === products.current_page }"
      >
        <a class="page-link" href="#" @click.prevent="$emit('fetch-products', page)">{{ page }}</a>
      </li>
      <li class="page-item" :class="{ disabled: !products.next_page_url }">
        <a class="page-link" href="#" @click.prevent="$emit('fetch-products', products.current_page + 1)">Siguiente</a>
      </li>
    </ul>
  </nav>    
  </div>
</template>

<script>
export default {
  props: ['products', "categories"],
  computed: {
    totalPages() {
      return Array.from({ length: this.products.last_page }, (_, index) => index + 1);
    }
  },
  methods: {
    getCategoryName(id) {
      const category = this.categories.find(cat => cat.id === id);
      return category ? category.name : '';
    }
  }
};
</script>