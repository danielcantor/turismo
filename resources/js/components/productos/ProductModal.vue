<template>
  <div
    class="modal fade"
    id="productModal"
    tabindex="-1"
    aria-labelledby="productModalLabel"
    aria-hidden="true"
    ref="productModal"
  >
    <div class="modal-dialog">
      <div class="modal-content" style="color: #2e005d;">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel">{{ isEditMode ? 'Modificar Producto' : 'Crear Producto' }}</h5>
          <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="submitForm">
            <!-- Campos del formulario -->
            <!-- Título del producto -->
            <div class="mb-3">
              <label for="product_name" class="form-label">Título del producto:</label>
              <input
                type="text"
                class="form-control"
                id="product_name"
                v-model="form.product_name"
                required
              />
            </div>

            <!-- Precio del producto -->
            <div class="mb-3">
              <label for="product_price" class="form-label">Precio del producto:</label>
              <input
                type="number"
                class="form-control"
                id="product_price"
                v-model="form.product_price"
                required
                min="0"
              />
            </div>

            <!-- Descripción del producto -->
            <div class="mb-3">
              <label for="product_description" class="form-label">Descripción del producto:</label>
              <textarea
                class="form-control"
                id="product_description"
                v-model="form.product_description"
                rows="4"
                required
              ></textarea>
            </div>
            <!-- Imagen del producto -->
            <div class="mb-3">
              <label for="product_image" class="form-label">Imagen del producto:</label>
              <input
                type="file"
                class="form-control"
                id="product_image"
                @change="handleFileUpload('product_image', $event)"
                :required="!isEditMode"
              />
              <!-- Mostrar imagen actual si está en modo edición -->
              <div v-if="isEditMode && form.product_image">
                <img :src="form.product_image" alt="Imagen actual" width="150" class="mt-2" />
              </div>
            </div>

            <!-- Slider del producto -->
            <div class="mb-3">
              <label for="product_slider" class="form-label">Slider del producto:</label>
              <input
                type="file"
                class="form-control"
                id="product_slider"
                @change="handleFileUpload('product_slider', $event)"
              />
              <!-- Mostrar slider actual si está en modo edición -->
              <div v-if="isEditMode && form.product_slider">
                <img :src="form.product_slider" alt="Slider actual" width="150" class="mt-2" />
              </div>
            </div>

            <!-- Días del producto -->
            <div class="mb-3">
              <label for="product_days" class="form-label">Cantidad de días:</label>
              <input
                type="number"
                class="form-control"
                id="product_days"
                v-model="form.days"
                required
                min="0"
              />
            </div>

            <!-- Noches del producto -->
            <div class="mb-3">
              <label for="product_nights" class="form-label">Cantidad de noches:</label>
              <input
                type="number"
                class="form-control"
                id="product_nights"
                v-model="form.nights"
                required
                min="0"
              />
            </div>

            <!-- Fechas de salida del producto -->
            <div class="mb-3">
              <label class="form-label">Fechas de salida:</label>
              <div class="mb-2">
                <input
                  type="date"
                  class="form-control"
                  id="new_departure_date"
                  v-model="newDepartureDate"
                  @keyup.enter="addDepartureDate"
                />
                <small class="form-text text-muted">Selecciona una fecha y presiona el botón "Agregar" para añadir múltiples fechas</small>
              </div>
              <button 
                type="button" 
                class="btn btn-sm btn-success mb-2" 
                @click="addDepartureDate"
                :disabled="!newDepartureDate"
              >
                <i class="fas fa-plus"></i> Agregar Fecha
              </button>
              
              <!-- Lista de fechas agregadas -->
              <div v-if="departureDates.length > 0" class="mt-2">
                <div class="d-flex flex-wrap gap-2">
                  <span 
                    v-for="(date, index) in departureDates" 
                    :key="index"
                    class="badge bg-primary d-flex align-items-center"
                    style="font-size: 0.9rem; padding: 0.5rem;"
                  >
                    {{ formatDate(date) }}
                    <button 
                      type="button" 
                      class="btn-close btn-close-white ms-2" 
                      style="font-size: 0.6rem;"
                      @click="removeDepartureDate(index)"
                      aria-label="Eliminar"
                    ></button>
                  </span>
                </div>
              </div>
              <div v-else class="text-muted">
                <small>No hay fechas de salida agregadas</small>
              </div>
            </div>
            <!-- Tipo del producto -->
            <div class="mb-3">
              <label for="product_category" class="form-label">Categoría del producto:</label>
              <select
                class="form-control"
                id="product_type"
                v-model="form.product_type"
                required
              >
                <option value="" selected>Seleccione la categoria</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                  {{ category.name }}
                </option>
              </select>
            </div>

            <!-- Botones de acción -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="closeModal">Cancelar</button>
              <button type="submit" class="btn btn-primary">{{ isEditMode ? 'Guardar Cambios' : 'Crear Producto' }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['isEditMode', 'form', 'categories', 'departureDates'],
  data() {
    return {
      newDepartureDate: ''
    };
  },
  methods: {
    submitForm() {
      this.$emit('submit-form');
    },
    closeModal() {
      this.$emit('close-modal');
    },
    handleFileUpload(field, event) {
      const file = event.target.files[0];
      this.$emit('update-form', field, file);
    },
    addDepartureDate() {
      if (this.newDepartureDate && !this.departureDates.includes(this.newDepartureDate)) {
        this.$emit('add-departure-date', this.newDepartureDate);
        this.newDepartureDate = '';
      }
    },
    removeDepartureDate(index) {
      this.$emit('remove-departure-date', index);
    },
    formatDate(dateString) {
      if (!dateString) return '';
      const [year, month, day] = dateString.split('-');
      const date = new Date(year, month - 1, day);
      return new Intl.DateTimeFormat('es-AR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        timeZone: 'America/Argentina/Buenos_Aires'
      }).format(date);
    }
  }
};
</script>

<style scoped>
/* Estilos específicos del componente */
</style>