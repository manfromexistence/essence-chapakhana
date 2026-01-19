# Testing Checklist - Chapakhana Updates

## 1. Registration Process ✓
- [ ] Visit `/register`
- [ ] Try submitting without filling fields (should show validation errors)
- [ ] Try registering with existing email (should show "email already registered")
- [ ] Try password mismatch (should show "password confirmation does not match")
- [ ] Try without accepting terms (should show "must agree to terms")
- [ ] Register successfully with valid data
- [ ] Verify redirect to homepage with success message
- [ ] Verify user is logged in
- [ ] Verify user is NOT admin (check database: `is_admin = 0`)

## 2. User Orders ✓
- [ ] Login as regular user
- [ ] Visit `/orders` or click "My Orders" from profile menu
- [ ] If no orders: verify empty state shows
- [ ] If has orders: verify order list displays correctly
- [ ] Click "View Details" on an order
- [ ] Verify order details page shows:
  - Order number and status
  - Status timeline
  - Product images and details
  - Customer information
  - Total amount
- [ ] Try accessing another user's order (should get 403 error)
- [ ] Verify "Back to Orders" link works

## 3. Admin Panel Separation ✓
- [ ] Login as regular user (non-admin)
- [ ] Try accessing `/admin` (should redirect to login or show 403)
- [ ] Try accessing `/admin/dashboard` (should show 403)
- [ ] Logout and login as admin user
- [ ] Access `/admin/dashboard` (should work)
- [ ] Verify admin can see all orders at `/admin/orders`
- [ ] Verify admin orders are separate from user orders

## 4. Shop Admin Panel Image Preview ✓
- [ ] Login as admin
- [ ] Visit `/admin/shop`
- [ ] Go to "Hero" tab
- [ ] Verify existing cover image shows in preview
- [ ] Hover over image (should show "Click to replace" overlay)
- [ ] Click to upload new image
- [ ] Verify upload works and preview updates
- [ ] Click X button to remove image
- [ ] Verify image reverts to default
- [ ] Test drag & drop image upload
- [ ] Test entering image URL manually
- [ ] Click "Load" button to load URL image
- [ ] Save changes and verify image persists

## 5. Design Request Feature (Database) ✓
- [ ] Check database `orders` table has new columns:
  - `has_design_request` (boolean)
  - `design_request_notes` (text)
  - `design_file_path` (string)
- [ ] Verify migration ran successfully

## 6. Pricing Component ✓
- [ ] Check `resources/views/components/pricing-table.blade.php` exists
- [ ] Component is ready for integration (not yet displayed on pages)

## 7. General Functionality
- [ ] Test login/logout
- [ ] Test profile page
- [ ] Test cart functionality
- [ ] Test checkout process
- [ ] Test product browsing
- [ ] Test category pages
- [ ] Verify all images load correctly
- [ ] Test responsive design on mobile
- [ ] Check browser console for errors

## 8. Performance
- [ ] Page load times are acceptable
- [ ] Images load properly
- [ ] No JavaScript errors in console
- [ ] Forms submit without issues

## Issues Found
(Document any issues discovered during testing)

---

## Test Environment
- URL: http://127.0.0.1:8000
- Browser: _____________
- Date: _____________
- Tester: _____________

## Notes
- All database migrations have been run
- Frontend assets have been built (npm run build)
- Cache has been cleared
