# Google Analytics 4 (GA4) Implementation Guide

## Overview
This guide explains how to configure and use Google Analytics 4 tracking for your Turismo website. The implementation includes both general traffic tracking and detailed e-commerce events for the checkout process.

## Configuration

### 1. Obtain Your GA4 Measurement ID

1. Go to [Google Analytics](https://analytics.google.com/)
2. Create a new GA4 property or use an existing one
3. Navigate to: Admin → Data Streams → Select your web stream
4. Copy your **Measurement ID** (format: `G-XXXXXXXXXX`)

### 2. Configure Your Environment

Add your GA4 Measurement ID to your `.env` file:

```env
GOOGLE_ANALYTICS_ID=G-XXXXXXXXXX
```

Replace `G-XXXXXXXXXX` with your actual Measurement ID.

**Note:** If the `GOOGLE_ANALYTICS_ID` variable is not set or is empty, GA4 tracking will be disabled automatically.

## What's Being Tracked

### 1. Page Views (Automatic)
All pages automatically track:
- Page views
- User sessions
- Traffic sources
- Device information
- Geographic location

### 2. E-commerce Events (Checkout Flow)

The following events are tracked during the checkout process:

#### `begin_checkout`
- **Triggers:** When user lands on the checkout page
- **Data Tracked:**
  - Product ID
  - Product name
  - Price
  - Quantity
  - Total value (in ARS)

#### `add_shipping_info`
- **Triggers:** When user completes passenger information (Step 1 → Step 2)
- **Data Tracked:**
  - Product details
  - Quantity
  - Total value (in ARS)

#### `add_payment_info`
- **Triggers:** When user completes billing information (Step 2 → Step 3)
- **Data Tracked:**
  - Product details
  - Payment type
  - Quantity
  - Total value (in ARS)

#### `purchase`
- **Triggers:** When user confirms reservation successfully
- **Data Tracked:**
  - Transaction ID (reservation number)
  - Product details
  - Quantity
  - Total value (in ARS)

## Technical Implementation

### Files Modified/Created

1. **`.env.example`** - Added `GOOGLE_ANALYTICS_ID` configuration variable
2. **`resources/views/partials/google-analytics.blade.php`** - Reusable GA4 tracking script
3. **`resources/js/utils/ga4.js`** - JavaScript utility for tracking e-commerce events
4. **`resources/js/components/Checkout/Index.vue`** - Integrated GA4 event tracking
5. **All main view templates** - Added GA4 tracking include

### GA4 Utility Methods

The `ga4.js` utility provides the following methods:

```javascript
// Track custom events
ga4.trackEvent('event_name', { param1: 'value1', param2: 'value2' });

// Track begin checkout
ga4.trackBeginCheckout(product, quantity, value);

// Track shipping info added
ga4.trackAddShippingInfo(product, quantity, value);

// Track payment info added
ga4.trackAddPaymentInfo(product, quantity, value, paymentType);

// Track purchase
ga4.trackPurchase(product, quantity, value, transactionId);
```

## Viewing Data in Google Analytics

### Real-Time Reports
1. Go to Google Analytics
2. Navigate to: Reports → Realtime
3. Test by visiting your website and performing actions
4. You should see events appearing in real-time

### E-commerce Reports
1. Navigate to: Reports → Monetization → E-commerce purchases
2. View detailed conversion funnels
3. Analyze checkout behavior and drop-off rates

### Custom Reports
You can create custom reports based on:
- Event names: `begin_checkout`, `add_shipping_info`, `add_payment_info`, `purchase`
- Event parameters: `currency`, `value`, `payment_type`, `transaction_id`, `items`

## Debugging

### Check if GA4 is Loading
Open browser console and type:
```javascript
typeof gtag
```
Should return `"function"` if GA4 is loaded correctly.

### View Events Being Sent
In Chrome DevTools:
1. Open DevTools (F12)
2. Go to Network tab
3. Filter by: `google-analytics.com` or `analytics`
4. Perform actions on your site
5. Check for requests being sent

### Enable Debug Mode
In browser console:
```javascript
gtag('config', 'G-XXXXXXXXXX', {
  'debug_mode': true
});
```

## Privacy Considerations

- GA4 automatically anonymizes IP addresses
- No personally identifiable information (PII) is sent in events
- Users can opt-out using browser extensions or cookie consent
- Comply with local data protection regulations (GDPR, CCPA, etc.)

## Troubleshooting

### Events Not Appearing in GA4
1. Verify `GOOGLE_ANALYTICS_ID` is set in `.env`
2. Clear browser cache and reload
3. Check browser console for JavaScript errors
4. Verify GA4 Measurement ID is correct
5. Wait 24-48 hours for data to appear in standard reports (use Realtime for immediate feedback)

### Build Issues
If you encounter build errors after implementation:
```bash
npm run production
```

## Support

For questions or issues with this implementation, please contact the development team or create an issue in the repository.

## Additional Resources

- [GA4 Documentation](https://support.google.com/analytics/answer/10089681)
- [GA4 E-commerce Events](https://developers.google.com/analytics/devguides/collection/ga4/ecommerce)
- [GA4 Event Reference](https://developers.google.com/analytics/devguides/collection/ga4/reference/events)
