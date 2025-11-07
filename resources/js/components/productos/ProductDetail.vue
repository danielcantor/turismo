<template>
  <section class="product-detail-page">
    <!-- Hero Image/Slider -->
    <div v-if="product.product_slider" class="hero-slider">
      <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img :src="getImageUrl(product.product_slider)" class="d-block w-100" :alt="product.product_name">
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="container mt-5">
      <div class="row">
        <!-- Left Column - Product Details -->
        <div class="col-md-6">
          <div class="product-info">
            <!-- Title -->
            <h1 class="product-title fw-bold">{{ product.product_name }}</h1>

            <!-- Share & Conditions -->
            <div class="product-actions d-flex flex-wrap justify-content-start gap-3 my-3">
              <a 
                :href="shareWhatsAppLink" 
                target="_blank" 
                class="btn-share d-flex align-items-center"
              >
                <i class="fas fa-share-alt me-2"></i> Compartir
              </a>
              <button 
                class="btn-conditions" 
                @click="showConditionsModal = true"
              >
                CONDICIONES GENERALES
              </button>
            </div>

            <!-- Description -->
            <hr>
            <div class="product-description">
              <p v-html="formattedDescription"></p>
            </div>

            <!-- Trip Details (if available) -->
            <div v-if="product.days || product.nights" class="trip-details mt-4">
              <h4 class="mb-3">Detalles del viaje</h4>
              <div class="details-list">
                <div class="detail-item">
                  <i class="fas fa-calendar-alt me-2"></i>
                  <span v-if="isFullDay">Full day</span>
                  <span v-else>{{ product.days }} {{ daysText }}, {{ product.nights }} {{ nightsText }}</span>
                </div>
                <div v-if="product.departure_date" class="detail-item">
                  <i class="fas fa-plane-departure me-2"></i>
                  <span>Fecha de salida: {{ formatDate(product.departure_date) }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column - Booking Card -->
        <div class="col-md-6">
          <div class="booking-card">
            <!-- Product Image -->
            <img 
              v-if="product.product_image" 
              :src="getImageUrl(product.product_image)" 
              :alt="product.product_name" 
              class="product-image"
            >

            <hr>

            <!-- Price -->
            <div class="price-section text-center">
              <p class="price-label mb-1">Precio por persona</p>
              <p class="price-amount">$ {{ formatPrice(product.product_price) }}</p>
            </div>

            <!-- Booking Button -->
            <div class="text-center mb-3">
              <a 
                :href="checkoutUrl" 
                class="btn-booking"
              >
                RESERVAR AHORA
              </a>
            </div>

            <hr>

            <!-- Contact Section -->
            <div class="contact-section text-center">
              <p class="contact-title">¿Tenés alguna consulta?</p>
              <a 
                href="https://wa.me/message/SCBMQYYYMSHRM1" 
                target="_blank" 
                class="contact-link d-block mb-2"
              >
                <i class="fab fa-whatsapp me-2"></i>Contactar por WhatsApp
              </a>
              <a 
                href="mailto:cynthiaedithgarske@gmail.com" 
                target="_blank" 
                class="contact-link d-block"
              >
                <i class="fas fa-envelope me-2"></i>Enviar un Email
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Instagram CTA Section -->
    <section class="instagram-cta py-4 my-5">
      <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
          <div class="cta-text mb-3 mb-md-0">
            <h3 class="m-0 cta-title">¿Querés seguir viendo nuestros viajes?</h3>
            <h3 class="m-0 cta-subtitle">¡Ingresá a nuestro Instagram para mantenerte actualizado con las últimas novedades!</h3>
          </div>
          <div class="cta-button d-flex align-items-center">
            <i class="fa-brands fa-instagram me-2"></i>
            <a 
              href="https://www.instagram.com/salidasgrupalescyn/" 
              target="_blank" 
              class="btn-instagram"
            >
              Instagram
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Conditions Modal -->
    <div 
      v-if="showConditionsModal" 
      class="modal fade show d-block" 
      tabindex="-1" 
      role="dialog"
      @click.self="showConditionsModal = false"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Condiciones Generales</h5>
            <button type="button" class="btn-close" @click="showConditionsModal = false"></button>
          </div>
          <div class="modal-body">
            <img src="/img/home/condicionesgenerales.jpeg" class="w-100" alt="Condiciones Generales">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showConditionsModal = false">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="showConditionsModal" class="modal-backdrop fade show"></div>
  </section>
</template>

<script>
export default {
  name: 'ProductDetail',
  props: {
    productId: {
      type: [String, Number],
      required: true
    },
    initialProduct: {
      type: Object,
      default: null
    }
  },
  data() {
    return {
      product: this.initialProduct || {},
      loading: true,
      showConditionsModal: false
    };
  },
  computed: {
    formattedDescription() {
      if (!this.product.product_description) return '';
      return this.product.product_description.replace(/\n/g, '<br>');
    },
    shareWhatsAppLink() {
      const url = window.location.href;
      const text = `Te comparto la información sobre este viaje! ${url}`;
      return `whatsapp://send?text=${encodeURIComponent(text)}`;
    },
    checkoutUrl() {
      return `/checkout/${this.product.id}`;
    },
    isFullDay() {
      return this.product.days === 1 && this.product.nights === 0;
    },
    daysText() {
      return this.product.days === 1 ? 'día' : 'días';
    },
    nightsText() {
      return this.product.nights === 1 ? 'noche' : 'noches';
    }
  },
  mounted() {
    if (!this.initialProduct) {
      this.fetchProduct();
    } else {
      this.loading = false;
    }
  },
  methods: {
    async fetchProduct() {
      try {
        const response = await axios.get(`/obtenerProducto/${this.productId}`);
        this.product = response.data;
        this.loading = false;
      } catch (error) {
        console.error('Error fetching product:', error);
        this.loading = false;
      }
    },
    getImageUrl(imagePath) {
      if (!imagePath) return '';
      // If it already has the full URL, return it
      if (imagePath.startsWith('http') || imagePath.startsWith('/storage/')) {
        return imagePath;
      }
      return `/storage/${imagePath}`;
    },
    formatPrice(price) {
      return new Intl.NumberFormat('es-AR').format(price);
    },
    formatDate(date) {
      if (!date) return '';
      return new Date(date).toLocaleDateString('es-AR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
    }
  }
};
</script>

<style scoped>
.product-detail-page {
  background-color: #2e005d;
  color: white;
  min-height: 100vh;
}

.hero-slider img {
  max-height: 500px;
  object-fit: cover;
}

.product-info {
  padding: 20px;
}

.product-title {
  font-family: 'Rift Soft', sans-serif;
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.product-actions {
  font-family: 'Rift Soft', sans-serif;
}

.btn-share,
.btn-conditions {
  background: transparent;
  border: 2px solid #f18701;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 5px;
  transition: all 0.3s ease;
  font-weight: 600;
  cursor: pointer;
}

.btn-share:hover,
.btn-conditions:hover {
  background-color: #f18701;
  color: white;
}

.product-description {
  font-family: 'Poppins', sans-serif;
  line-height: 1.6;
}

.trip-details h4 {
  color: #f18701;
  font-family: 'Poppins', sans-serif;
}

.details-list {
  background: rgba(255, 255, 255, 0.1);
  padding: 15px;
  border-radius: 8px;
}

.detail-item {
  padding: 8px 0;
  font-family: 'Raleway', sans-serif;
  font-size: 1rem;
}

.booking-card {
  background: white;
  color: #2e005d;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  position: sticky;
  top: 20px;
}

.product-image {
  width: 100%;
  border-radius: 10px;
  margin-bottom: 10px;
}

.price-section {
  margin: 20px 0;
}

.price-label {
  font-family: 'Poppins', sans-serif;
  font-size: 0.9rem;
  color: #666;
}

.price-amount {
  font-family: 'Poppins', sans-serif;
  font-size: 2rem;
  font-weight: bold;
  color: #f18701;
  margin: 0;
}

.btn-booking {
  display: inline-block;
  background-color: #2e005d;
  color: white;
  padding: 15px 40px;
  border-radius: 5px;
  text-decoration: none;
  font-family: 'Arial', sans-serif;
  font-size: 1.1rem;
  font-weight: bold;
  transition: all 0.3s ease;
  border: 2px solid #2e005d;
}

.btn-booking:hover {
  background-color: #1a0036;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  color: white;
}

.contact-section {
  padding-top: 15px;
}

.contact-title {
  font-weight: bold;
  font-size: 1.1rem;
  margin-bottom: 15px;
}

.contact-link {
  color: #2e005d;
  text-decoration: none;
  font-size: 1rem;
  transition: color 0.3s ease;
}

.contact-link:hover {
  color: #f18701;
}

.instagram-cta {
  background-color: #f6f6f6;
}

.cta-title,
.cta-subtitle {
  font-family: 'Rift Soft', sans-serif;
}

.cta-title {
  color: #2e005d;
  font-size: 1.5rem;
}

.cta-subtitle {
  color: #f18701;
  font-size: 1.3rem;
}

.cta-button .fa-instagram {
  font-size: 2rem;
  color: black;
}

.btn-instagram {
  background: transparent;
  border: 2px solid black;
  color: black;
  padding: 10px 30px;
  text-decoration: none;
  border-radius: 5px;
  font-size: 1.2rem;
  font-weight: bold;
  transition: all 0.3s ease;
}

.btn-instagram:hover {
  background-color: black;
  color: white;
}

/* Modal Styles */
.modal.show {
  display: block;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1040;
}

/* Responsive */
@media (max-width: 768px) {
  .product-title {
    font-size: 1.8rem;
  }

  .booking-card {
    position: relative;
    margin-top: 20px;
  }

  .cta-text {
    text-align: center;
  }

  .cta-title,
  .cta-subtitle {
    font-size: 1.1rem;
  }
}
</style>
