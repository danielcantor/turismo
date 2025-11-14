# Google Analytics 4 Testing Guide

## Manual Testing Checklist

### Prerequisites
1. Set `GOOGLE_ANALYTICS_ID=G-XXXXXXXXXX` in `.env` file with a valid GA4 Measurement ID
2. Build frontend assets: `npm run production`
3. Start the application: `php artisan serve`

### Test 1: Verify GA4 Script Loading
**Objective**: Confirm GA4 tracking script is loaded on all pages

**Steps**:
1. Open any page on the website
2. Open browser DevTools (F12)
3. Go to Console tab
4. Type: `typeof gtag`
5. Press Enter

**Expected Result**: Should return `"function"`

**Pages to Test**:
- [ ] Home page (/)
- [ ] Products/Categories page
- [ ] Product detail page
- [ ] Checkout page
- [ ] Payment confirmation page
- [ ] Shopping cart page
- [ ] Contact page
- [ ] About us page
- [ ] Login page
- [ ] Register page

### Test 2: Verify Network Requests
**Objective**: Confirm GA4 is sending data to Google

**Steps**:
1. Open browser DevTools (F12)
2. Go to Network tab
3. Filter by: `google-analytics.com` or just `analytics`
4. Navigate to home page
5. Observe network requests

**Expected Result**: Should see requests to `https://www.google-analytics.com/g/collect` or similar

### Test 3: Test Checkout Event Tracking
**Objective**: Verify all e-commerce events fire correctly

#### 3.1 Begin Checkout Event
**Steps**:
1. Open browser DevTools → Console
2. Type: `window.dataLayer` to monitor events
3. Navigate to a product page
4. Click "Buy" or "Checkout" button
5. Check DevTools Console

**Expected Result**: Should see `begin_checkout` event in dataLayer with:
- `currency: "ARS"`
- `value: <product_price>`
- `items: [{ item_id, item_name, price, quantity }]`

#### 3.2 Add Shipping Info Event
**Steps**:
1. On checkout page, fill in passenger information
2. Select quantity
3. Fill all required passenger fields
4. Click "Continuar" (Continue) button
5. Check DevTools Console

**Expected Result**: Should see `add_shipping_info` event in dataLayer

#### 3.3 Add Payment Info Event
**Steps**:
1. On billing information step (Step 2)
2. Fill in all billing fields (name, email, address, etc.)
3. Click "Continuar" (Continue) button
4. Check DevTools Console

**Expected Result**: Should see `add_payment_info` event in dataLayer with payment_type

#### 3.4 Purchase Event
**Steps**:
1. On confirmation step (Step 3)
2. Review all information
3. Click "Confirmar Reserva" (Confirm Reservation)
4. Wait for success response
5. Check DevTools Console

**Expected Result**: Should see `purchase` event in dataLayer with:
- `transaction_id: <reservation_number>`
- `currency: "ARS"`
- `value: <total_amount>`
- `items: [...]`

### Test 4: Google Analytics Real-Time Verification
**Objective**: Verify events appear in Google Analytics dashboard

**Steps**:
1. Log in to Google Analytics (https://analytics.google.com)
2. Select your property
3. Go to: Reports → Realtime
4. In another browser tab, navigate through the checkout flow
5. Complete a test purchase

**Expected Results**:
- Real-time users count increases
- Page views appear in real-time report
- Events appear in real-time events list:
  - `begin_checkout`
  - `add_shipping_info`
  - `add_payment_info`
  - `purchase`

### Test 5: Verify Tracking Disabled When Not Configured
**Objective**: Ensure GA4 doesn't load when GOOGLE_ANALYTICS_ID is not set

**Steps**:
1. Remove or comment out `GOOGLE_ANALYTICS_ID` from `.env`
2. Clear application cache: `php artisan cache:clear`
3. Reload any page
4. View page source (Ctrl+U)
5. Search for "gtag" or "google-analytics"

**Expected Result**: No Google Analytics script should be present

### Test 6: Browser Console Verification
**Objective**: Ensure no JavaScript errors

**Steps**:
1. Open browser DevTools → Console
2. Navigate through entire site including checkout
3. Complete a test purchase
4. Monitor console for errors

**Expected Result**: No JavaScript errors related to GA4 tracking

### Test 7: Test Event Parameters
**Objective**: Verify correct data is sent with events

**Steps**:
1. Install "Google Analytics Debugger" Chrome extension (optional)
2. Or use: `gtag('config', 'G-XXXXXXXXXX', {'debug_mode': true});` in console
3. Complete checkout flow
4. Check debug output

**Expected Data for Each Event**:
- **begin_checkout**: product_id, product_name, price, quantity, total
- **add_shipping_info**: same as above
- **add_payment_info**: same as above + payment_type
- **purchase**: same as above + transaction_id

## Troubleshooting

### Issue: `gtag is not defined`
**Solution**: 
- Check GOOGLE_ANALYTICS_ID is set in .env
- Clear cache: `php artisan cache:clear`
- Verify GA4 script is in page source

### Issue: Events not appearing in GA4
**Solution**:
- Check Real-time reports (standard reports have 24-48h delay)
- Verify Measurement ID is correct
- Check browser console for errors
- Disable ad blockers for testing

### Issue: Events firing multiple times
**Solution**:
- Check for duplicate includes of google-analytics partial
- Verify component isn't being mounted multiple times

## Automated Testing

For automated testing, consider:
1. Using Cypress or Playwright for E2E testing
2. Mocking gtag function in unit tests
3. Using GA4's Measurement Protocol for server-side testing

## Production Checklist

Before deploying to production:
- [ ] GA4 Measurement ID is set in production .env
- [ ] Tested all event tracking in staging environment
- [ ] Verified events appear in GA4 Real-time reports
- [ ] Confirmed no JavaScript errors
- [ ] Documented GA4 property for team
- [ ] Set up GA4 alerts and goals
- [ ] Configure e-commerce settings in GA4

## Additional Resources

- [GA4 DebugView](https://support.google.com/analytics/answer/7201382)
- [Google Tag Assistant](https://tagassistant.google.com/)
- [GA4 Event Builder](https://ga-dev-tools.google/ga4/event-builder/)
