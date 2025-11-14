// Google Analytics 4 Event Helper
export default {
  /**
   * Send a GA4 event
   * @param {string} eventName - The name of the event
   * @param {object} eventParams - Parameters to send with the event
   */
  trackEvent(eventName, eventParams = {}) {
    if (typeof window !== 'undefined' && window.gtag) {
      window.gtag('event', eventName, eventParams);
    }
  },

  /**
   * Track begin_checkout event
   * @param {object} product - Product information
   * @param {number} quantity - Quantity of items
   * @param {number} value - Total value
   */
  trackBeginCheckout(product, quantity, value) {
    this.trackEvent('begin_checkout', {
      currency: 'ARS',
      value: value,
      items: [{
        item_id: product.id,
        item_name: product.product_name,
        price: product.product_price,
        quantity: quantity
      }]
    });
  },

  /**
   * Track add_shipping_info event
   * @param {object} product - Product information
   * @param {number} quantity - Quantity of items
   * @param {number} value - Total value
   */
  trackAddShippingInfo(product, quantity, value) {
    this.trackEvent('add_shipping_info', {
      currency: 'ARS',
      value: value,
      items: [{
        item_id: product.id,
        item_name: product.product_name,
        price: product.product_price,
        quantity: quantity
      }]
    });
  },

  /**
   * Track add_payment_info event
   * @param {object} product - Product information
   * @param {number} quantity - Quantity of items
   * @param {number} value - Total value
   * @param {string} paymentType - Payment type
   */
  trackAddPaymentInfo(product, quantity, value, paymentType) {
    this.trackEvent('add_payment_info', {
      currency: 'ARS',
      value: value,
      payment_type: paymentType,
      items: [{
        item_id: product.id,
        item_name: product.product_name,
        price: product.product_price,
        quantity: quantity
      }]
    });
  },

  /**
   * Track purchase event
   * @param {object} product - Product information
   * @param {number} quantity - Quantity of items
   * @param {number} value - Total value
   * @param {string} transactionId - Transaction ID
   */
  trackPurchase(product, quantity, value, transactionId) {
    this.trackEvent('purchase', {
      transaction_id: transactionId,
      currency: 'ARS',
      value: value,
      items: [{
        item_id: product.id,
        item_name: product.product_name,
        price: product.product_price,
        quantity: quantity
      }]
    });
  }
};
