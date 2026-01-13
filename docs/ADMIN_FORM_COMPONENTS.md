# Admin Form Components Documentation

This documentation covers the usage of two reusable admin form components: **AdminTextInput** and **AdminImageInput**.

## Table of Contents
- [AdminTextInput](#admintextinput)
- [AdminImageInput](#adminimageinput)
- [Installation](#installation)
- [Examples](#examples)

---

## AdminTextInput

A feature-rich text input component with validation, character limits, and support for seeded/default values.

### Features
- ✅ Character min/max length validation
- ✅ Built-in validation for email, URL types
- ✅ Custom validation patterns and functions
- ✅ Real-time character counter
- ✅ Visual feedback (success/error states)
- ✅ Support for seeded/default values
- ✅ Helper text and error messages
- ✅ Required field indicators

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | string | - | Label text for the input field |
| `id` | string | - | Unique ID for the input element |
| `value` | string | - | Current input value (controlled) |
| `onChange` | function | - | Callback when value changes: `(event) => void` |
| `defaultValue` | string | `''` | Default/seeded value to display initially |
| `minLength` | number | - | Minimum character length |
| `maxLength` | number | - | Maximum character length (enforced) |
| `required` | boolean | `false` | Whether field is required |
| `error` | string | - | Error message from server/parent |
| `placeholder` | string | `''` | Placeholder text |
| `type` | string | `'text'` | Input type: text, email, url, etc. |
| `helperText` | string | - | Helper text shown below input |
| `showCharCount` | boolean | `true` | Show character counter |
| `className` | string | - | Additional CSS classes |
| `disabled` | boolean | `false` | Disable the input |
| `validation` | object | `{}` | Custom validation rules (see below) |

### Validation Object

```javascript
{
    pattern: string,           // Regex pattern to match
    patternMessage: string,    // Error message for pattern mismatch
    custom: (value) => string  // Custom validation function, return error or null
}
```

### Basic Usage

```jsx
import { AdminTextInput } from '@/components/AdminTextInput';

<AdminTextInput
    label="Product Title"
    id="title"
    value={data.title}
    onChange={(e) => setData('title', e.target.value)}
    defaultValue={product?.title}
    minLength={3}
    maxLength={100}
    required
    error={errors.title}
    placeholder="Enter product title"
    helperText="This will be displayed as the product name"
/>
```

### Email Validation

```jsx
<AdminTextInput
    label="Email Address"
    id="email"
    type="email"
    value={data.email}
    onChange={(e) => setData('email', e.target.value)}
    required
    error={errors.email}
    placeholder="user@example.com"
/>
```

### Custom Validation

```jsx
<AdminTextInput
    label="Phone Number"
    id="phone"
    value={data.phone}
    onChange={(e) => setData('phone', e.target.value)}
    maxLength={10}
    validation={{
        pattern: '^[0-9]{10}$',
        patternMessage: 'Phone number must be 10 digits',
        custom: (value) => {
            if (value && !value.startsWith('9')) {
                return 'Phone number must start with 9';
            }
            return null;
        },
    }}
    error={errors.phone}
/>
```

---

## AdminImageInput

A comprehensive image input component supporting file uploads, URL input, drag-and-drop, and image previews.

### Features
- ✅ File upload with drag-and-drop
- ✅ URL-based image loading
- ✅ Image preview with aspect ratio control
- ✅ File type and size validation
- ✅ Support for seeded/default images
- ✅ Visual feedback for default images
- ✅ Remove and change image functionality
- ✅ Multiple file format support

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | string | - | Label text for the input field |
| `id` | string | - | Unique ID for the input element |
| `value` | string\|File | - | Current value (URL string or File object) |
| `onChange` | function | - | Callback when value changes: `(fileOrUrl) => void` |
| `defaultImage` | string | `''` | Default/seeded image URL |
| `required` | boolean | `false` | Whether field is required |
| `error` | string | - | Error message from server/parent |
| `helperText` | string | - | Helper text shown below input |
| `className` | string | - | Additional CSS classes |
| `maxSizeMB` | number | `5` | Maximum file size in MB |
| `acceptedFormats` | array | `['jpg', 'jpeg', 'png', 'webp', 'gif']` | Accepted file formats |
| `aspectRatio` | string | `'16/9'` | CSS aspect ratio for preview |
| `showPreview` | boolean | `true` | Whether to show image preview |
| `disabled` | boolean | `false` | Disable the input |

### Basic Usage

```jsx
import { AdminImageInput } from '@/components/AdminImageInput';

<AdminImageInput
    label="Product Image"
    id="image"
    value={data.image}
    onChange={(file) => setData('image', file)}
    defaultImage={product?.image}
    required
    error={errors.image}
    helperText="Upload product image (max 5MB)"
    maxSizeMB={5}
    acceptedFormats={['jpg', 'jpeg', 'png', 'webp']}
    aspectRatio="16/9"
/>
```

### Square/Profile Image

```jsx
<AdminImageInput
    label="Profile Picture"
    id="profile_image"
    value={data.profile_image}
    onChange={(file) => setData('profile_image', file)}
    defaultImage={user?.profile_image}
    maxSizeMB={2}
    acceptedFormats={['jpg', 'jpeg', 'png']}
    aspectRatio="1/1"
    helperText="Upload a square profile picture"
/>
```

### With URL Support

The component automatically supports both file upload and URL input through tabs. Users can:
1. Upload files via drag-and-drop or file browser
2. Paste an image URL directly

No additional configuration needed!

---

## Installation

These components depend on shadcn-ui components. Ensure you have the following installed:

```bash
npx shadcn-ui@latest add input label button tabs
```

### Component Imports

The components are located at:
- `@/components/AdminTextInput`
- `@/components/AdminImageInput`

---

## Complete Form Example

```jsx
import { useForm } from '@inertiajs/react';
import { AdminTextInput } from '@/components/AdminTextInput';
import { AdminImageInput } from '@/components/AdminImageInput';
import { Button } from '@/components/ui/button';

export default function ProductForm({ product, categories }) {
    const { data, setData, post, processing, errors } = useForm({
        title: product?.title || '',
        description: product?.description || '',
        price: product?.price || '',
        image: null,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/admin/products', {
            forceFormData: true,
        });
    };

    return (
        <form onSubmit={handleSubmit} className="space-y-6">
            {/* Text Input */}
            <AdminTextInput
                label="Product Title"
                id="title"
                value={data.title}
                onChange={(e) => setData('title', e.target.value)}
                defaultValue={product?.title}
                minLength={3}
                maxLength={100}
                required
                error={errors.title}
                placeholder="Enter product title"
            />

            {/* Text Area with Character Limit */}
            <AdminTextInput
                label="Description"
                id="description"
                value={data.description}
                onChange={(e) => setData('description', e.target.value)}
                defaultValue={product?.description}
                minLength={10}
                maxLength={500}
                required
                error={errors.description}
                placeholder="Enter description"
                helperText="Provide a detailed description"
            />

            {/* Price Input */}
            <AdminTextInput
                label="Price (Rs.)"
                id="price"
                type="number"
                value={data.price}
                onChange={(e) => setData('price', e.target.value)}
                defaultValue={product?.price}
                required
                error={errors.price}
                validation={{
                    custom: (value) => {
                        if (value && parseFloat(value) <= 0) {
                            return 'Price must be greater than 0';
                        }
                        return null;
                    },
                }}
            />

            {/* Image Upload */}
            <AdminImageInput
                label="Product Image"
                id="image"
                value={data.image}
                onChange={(file) => setData('image', file)}
                defaultImage={product?.image}
                required={!product}
                error={errors.image}
                helperText="Upload product image or provide URL"
            />

            {/* Submit Button */}
            <Button type="submit" disabled={processing}>
                {processing ? 'Saving...' : 'Save Product'}
            </Button>
        </form>
    );
}
```

---

## Best Practices

### 1. Use with Inertia.js Forms

Both components work seamlessly with Inertia.js `useForm` hook:

```jsx
const { data, setData, post, errors } = useForm({
    title: product?.title || '',
    image: null,
});
```

### 2. Handle File Uploads

When using AdminImageInput with forms, ensure you use `forceFormData`:

```jsx
post('/admin/products', {
    forceFormData: true,
});
```

### 3. Server-Side Validation

Pass Laravel validation errors directly to the components:

```jsx
<AdminTextInput
    error={errors.title}
    // ... other props
/>
```

### 4. Default Values from Database

Display seeded/existing data as defaults:

```jsx
<AdminTextInput
    defaultValue={product?.title}
    value={data.title}
    // ... other props
/>
```

### 5. Custom Validation

Combine built-in and custom validation:

```jsx
<AdminTextInput
    minLength={3}
    maxLength={50}
    validation={{
        custom: (value) => {
            if (value && value.includes('badword')) {
                return 'Title contains inappropriate content';
            }
            return null;
        },
    }}
/>
```

---

## Styling

Both components use Tailwind CSS and shadcn-ui's design system. They automatically adapt to your theme configuration.

### Customizing Appearance

Add custom classes:

```jsx
<AdminTextInput
    className="max-w-md"
    // ... other props
/>
```

---

## Accessibility

Both components follow accessibility best practices:
- ✅ Proper label associations
- ✅ ARIA attributes
- ✅ Keyboard navigation support
- ✅ Screen reader friendly
- ✅ Focus management
- ✅ Error announcements

---

## Browser Support

- ✅ Chrome/Edge (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Mobile browsers

---

## Troubleshooting

### Issue: Character counter not showing
**Solution**: Ensure `showCharCount` is true and either `minLength` or `maxLength` is set.

### Issue: Image preview not loading
**Solution**: Check that the image URL is accessible and CORS is properly configured.

### Issue: File upload not working
**Solution**: Ensure `forceFormData: true` is set in Inertia.js post/put requests.

### Issue: Validation not triggering
**Solution**: Make sure the field is touched (user has interacted with it) or pass errors from server.

---

## License

These components are part of the Chapakhana project.
