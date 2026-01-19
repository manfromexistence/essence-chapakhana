# Shop Admin Panel - Image Preview Fix

## Issue
The shop admin panel at `/admin/shop` was not showing the default/existing shop cover image as a preview.

## Root Cause
The `AdminImageInput` component was receiving `currentImage` prop but only using `defaultImage` prop internally.

## Solution

### 1. Updated Shop.jsx
Changed from `currentImage` to `defaultImage` prop:
```jsx
<AdminImageInput
    label="Cover Background Image"
    id="cover_image"
    value={data.cover_image}
    defaultImage={hero.cover_image}  // Changed from currentImage
    onChange={(file) => setData('cover_image', file)}
    helperText="Upload a background image for the hero section"
    accept="image/*"
/>
```

### 2. Enhanced AdminImageInput.jsx
Added support for both `currentImage` and `defaultImage` props for better compatibility:
- Now accepts both props
- Uses `currentImage` if provided, falls back to `defaultImage`
- Updated useEffect dependencies to watch both props

## Files Modified
- `resources/js/Pages/Admin/Shop.jsx`
- `resources/js/components/AdminImageInput.jsx`

## Testing
1. Visit `/admin/shop`
2. Verify existing cover image shows in preview
3. Test uploading new image
4. Test removing image (should revert to default)

## Status
✅ Fixed and deployed (npm run build completed successfully)
