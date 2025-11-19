<template>
  <div>
    <!-- Filter and Search Controls -->
    <div class="row mb-3">
      <div class="col-md-3">
        <label for="categoryFilter" class="form-label">Filtrar por categoría</label>
        <select id="categoryFilter" class="form-select" v-model="filters.category" @change="applyFilters">
          <option value="">Todas las categorías</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="searchInput" class="form-label">Buscar por nombre</label>
        <input type="text" id="searchInput" class="form-control" v-model="filters.search" @input="applyFilters" placeholder="Buscar producto...">
      </div>
      <div class="col-md-3">
        <label for="sortBy" class="form-label">Ordenar por</label>
        <select id="sortBy" class="form-select" v-model="filters.sortBy" @change="applyFilters">
          <option value="created_at">Fecha de creación</option>
          <option value="product_name">Nombre</option>
          <option value="product_category">Categoría</option>
          <option value="product_price">Precio</option>
        </select>
      </div>
      <div class="col-md-3">
        <label for="sortOrder" class="form-label">Orden</label>
        <select id="sortOrder" class="form-select" v-model="filters.sortOrder" @change="applyFilters">
          <option value="asc">Ascendente</option>
          <option value="desc">Descendente</option>
        </select>
      </div>
    </div>

    <!-- Column Selection -->
    <div class="row mb-3">
      <div class="col-md-12">
        <label class="form-label">Columnas a mostrar:</label>
        <div class="btn-group" role="group">
          <input type="checkbox" class="btn-check" id="col-id" v-model="visibleColumns.id" autocomplete="off">
          <label class="btn btn-outline-primary btn-sm" for="col-id">ID</label>

          <input type="checkbox" class="btn-check" id="col-title" v-model="visibleColumns.title" autocomplete="off">
          <label class="btn btn-outline-primary btn-sm" for="col-title">Título</label>

          <input type="checkbox" class="btn-check" id="col-description" v-model="visibleColumns.description" autocomplete="off">
          <label class="btn btn-outline-primary btn-sm" for="col-description">Descripción</label>

          <input type="checkbox" class="btn-check" id="col-price" v-model="visibleColumns.price" autocomplete="off">
          <label class="btn btn-outline-primary btn-sm" for="col-price">Precio</label>

          <input type="checkbox" class="btn-check" id="col-type" v-model="visibleColumns.type" autocomplete="off">
          <label class="btn btn-outline-primary btn-sm" for="col-type">Tipo</label>

          <input type="checkbox" class="btn-check" id="col-days" v-model="visibleColumns.days" autocomplete="off">
          <label class="btn btn-outline-primary btn-sm" for="col-days">Días/Noches</label>

          <input type="checkbox" class="btn-check" id="col-status" v-model="visibleColumns.status" autocomplete="off">
          <label class="btn btn-outline-primary btn-sm" for="col-status">Estado</label>
        </div>
      </div>
    </div>

    <table class="table table-responsive">
      <thead>
        <tr>
          <th v-if="visibleColumns.id">ID</th>
          <th v-if="visibleColumns.title">Título</th>
          <th v-if="visibleColumns.description">Descripción</th>
          <th v-if="visibleColumns.price">Precio</th>
          <th v-if="visibleColumns.type">Tipo</th>
          <th v-if="visibleColumns.days">Días/Noches</th>
          <th v-if="visibleColumns.status">Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products.data" :key="product.id">
          <td v-if="visibleColumns.id">{{ product.id }}</td>
          <td v-if="visibleColumns.title">{{ product.product_name }}</td>
          <td v-if="visibleColumns.description">{{ product.product_description }}</td>
          <td v-if="visibleColumns.price">{{ product.product_price }}</td>
          <td v-if="visibleColumns.type">{{ getCategoryName(product.product_type) }}</td>
          <td v-if="visibleColumns.days">{{ product.days }}/{{ product.nights }}</td>
          <td v-if="visibleColumns.status">
            <span :class="['badge', product.product_activate ? 'bg-success' : 'bg-secondary']">
              {{ product.product_activate ? 'Activo' : 'Inactivo' }}
            </span>
          </td>
          <td>
            <button class="btn btn-warning btn-sm" @click="$emit('edit-product', product.id)">Editar</button>
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
          <a class="page-link" href="#" @click.prevent="changePage(products.current_page - 1)">Anterior</a>
        </li>
        <li
          class="page-item"
          v-for="page in totalPages"
          :key="page"
          :class="{ active: page === products.current_page }"
        >
          <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
        </li>
        <li class="page-item" :class="{ disabled: !products.next_page_url }">
          <a class="page-link" href="#" @click.prevent="changePage(products.current_page + 1)">Siguiente</a>
        </li>
      </ul>
    </nav>    
  </div>
</template>

<script>
export default {
  props: ['products', "categories"],
  data() {
    return {
      filters: {
        category: '',
        search: '',
        sortBy: 'created_at',
        sortOrder: 'desc'
      },
      visibleColumns: {
        id: true,
        title: true,
        description: true,
        price: true,
        type: true,
        days: false,
        status: false
      }
    };
  },
  computed: {
    totalPages() {
      return Array.from({ length: this.products.last_page }, (_, index) => index + 1);
    }
  },
  methods: {
    getCategoryName(id) {
      const category = this.categories.find(cat => cat.id === id);
      return category ? category.name : '';
    },
    applyFilters() {
      this.$emit('apply-filters', this.filters);
    },
    changePage(page) {
      this.$emit('change-page', page, this.filters);
    }
  }
};
</script>