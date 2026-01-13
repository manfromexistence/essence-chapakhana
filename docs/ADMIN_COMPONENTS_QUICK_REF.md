# Admin Form Components - Quick Reference

## Quick Import

```jsx
import { AdminTextInput } from '@/components/AdminTextInput';
import { AdminImageInput } from '@/components/AdminImageInput';

// Or use the index file
import { AdminTextInput, AdminImageInput } from '@/components';
```

---

## AdminTextInput - Quick Examples

### Basic Text Input
```jsx
<AdminTextInput
    label="Title"
    id="title"
    value={data.title}
    onChange={(e) => setData('title', e.target.value)}
    required
/>
```

### With Character Limits
```jsx
<AdminTextInput
    label="Title"
    id="title"
    value={data.title}
    onChange={(e) => setData('title', e.target.value)}
    minLength={3}
    maxLength={100}
    required
/>
```

### With Seeded Data
```jsx
<AdminTextInput
    label="Title"
    id="title"
    value={data.title}
    onChange={(e) => setData('title', e.target.value)}
    defaultValue={product?.title}  // Shows "seeded" badge
    maxLength={100}
    required
/>
```

### Email Validation
```jsx
<AdminTextInput
    label="Email"
    id="email"
    type="email"  // Auto validates email format
    value={data.email}
    onChange={(e) => setData('email', e.target.value)}
    required
/>
```

### URL Validation
```jsx
<AdminTextInput
    label="Website"
    id="url"
    type="url"  // Auto validates URL format
    value={data.url}
    onChange={(e) => setData('url', e.target.value)}
/>
```

### Custom Validation
```jsx
<AdminTextInput
    label="Phone"
    id="phone"
    value={data.phone}
    onChange={(e) => setData('phone', e.target.value)}
    maxLength={10}
    validation={{
        pattern: '^[0-9]{10}$',
        patternMessage: 'Must be 10 digits',
        custom: (value) => {
            if (value && !value.startsWith('9')) {
                return 'Must start with 9';
            }
            return null;
        },
    }}
/>
```

### With Server Errors
```jsx
<AdminTextInput
    label="Title"
    id="title"
    value={data.title}
    onChange={(e) => setData('title', e.target.value)}
    error={errors.title}  // From Inertia useForm
    required
/>
```

---

## AdminImageInput - Quick Examples

### Basic Image Upload
```jsx
<AdminImageInput
    label="Product Image"
    id="image"
    value={data.image}
    onChange={(file) => setData('image', file)}
    required
/>
```

### With Default/Seeded Image
```jsx
<AdminImageInput
    label="Product Image"
    id="image"
    value={data.image}
    onChange={(file) => setData('image', file)}
    defaultImage={product?.image}  // Shows existing image
    required={!product}  // Not required when editing
/>
```

### Square Profile Picture
```jsx
<AdminImageInput
    label="Profile Picture"
    id="profile"
    value={data.profile}
    onChange={(file) => setData('profile', file)}
    defaultImage={user?.profile_image}
    aspectRatio="1/1"  // Square aspect ratio
    maxSizeMB={2}
/>
```

### Custom File Restrictions
```jsx
<AdminImageInput
    label="Banner Image"
    id="banner"
    value={data.banner}
    onChange={(file) => setData('banner', file)}
    maxSizeMB={10}
    acceptedFormats={['jpg', 'jpeg', 'png']}  // No GIF/WebP
    aspectRatio="21/9"  // Wide banner
/>
```

### With Helper Text & Errors
```jsx
<AdminImageInput
    label="Product Image"
    id="image"
    value={data.image}
    onChange={(file) => setData('image', file)}
    error={errors.image}  // From Inertia useForm
    helperText="Upload high-quality product image (max 5MB)"
/>
```

---

## Complete Form Template

```jsx
import { useForm } from '@inertiajs/react';
import { AdminTextInput, AdminImageInput } from '@/components';
import { Button } from '@/components/ui/button';

export default function MyForm({ data: seedData }) {
    const { data, setData, post, processing, errors } = useForm({
        title: seedData?.title || '',
        description: seedData?.description || '',
        email: seedData?.email || '',
        image: null,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/admin/endpoint', {
            forceFormData: true,  // Required for file uploads!
        });
    };

    return (
        <form onSubmit={handleSubmit} className="space-y-6">
            <AdminTextInput
                label="Title"
                id="title"
                value={data.title}
                onChange={(e) => setData('title', e.target.value)}
                defaultValue={seedData?.title}
                minLength={3}
                maxLength={100}
                required
                error={errors.title}
            />

            <AdminTextInput
                label="Description"
                id="description"
                value={data.description}
                onChange={(e) => setData('description', e.target.value)}
                defaultValue={seedData?.description}
                minLength={10}
                maxLength={500}
                required
                error={errors.description}
            />

            <AdminTextInput
                label="Email"
                id="email"
                type="email"
                value={data.email}
                onChange={(e) => setData('email', e.target.value)}
                defaultValue={seedData?.email}
                required
                error={errors.email}
            />

            <AdminImageInput
                label="Featured Image"
                id="image"
                value={data.image}
                onChange={(file) => setData('image', file)}
                defaultImage={seedData?.image}
                required={!seedData}
                error={errors.image}
            />

            <Button type="submit" disabled={processing}>
                {processing ? 'Saving...' : 'Save'}
            </Button>
        </form>
    );
}
```

---

## Props Cheatsheet

### AdminTextInput
| Prop | Type | Required | Default |
|------|------|----------|---------|
| `id` | string | ✅ | - |
| `value` | string | ✅ | - |
| `onChange` | function | ✅ | - |
| `label` | string | ❌ | - |
| `defaultValue` | string | ❌ | `''` |
| `minLength` | number | ❌ | - |
| `maxLength` | number | ❌ | - |
| `required` | boolean | ❌ | `false` |
| `error` | string | ❌ | - |
| `type` | string | ❌ | `'text'` |
| `placeholder` | string | ❌ | `''` |
| `helperText` | string | ❌ | - |
| `showCharCount` | boolean | ❌ | `true` |

### AdminImageInput
| Prop | Type | Required | Default |
|------|------|----------|---------|
| `id` | string | ✅ | - |
| `value` | string\|File | ✅ | - |
| `onChange` | function | ✅ | - |
| `label` | string | ❌ | - |
| `defaultImage` | string | ❌ | `''` |
| `required` | boolean | ❌ | `false` |
| `error` | string | ❌ | - |
| `helperText` | string | ❌ | - |
| `maxSizeMB` | number | ❌ | `5` |
| `acceptedFormats` | array | ❌ | `['jpg', 'jpeg', 'png', 'webp', 'gif']` |
| `aspectRatio` | string | ❌ | `'16/9'` |
| `showPreview` | boolean | ❌ | `true` |

---

## Common Aspect Ratios

```jsx
aspectRatio="16/9"   // Widescreen (videos, banners)
aspectRatio="4/3"    // Standard photo
aspectRatio="1/1"    // Square (profile pics, Instagram)
aspectRatio="21/9"   // Ultra-wide banner
aspectRatio="3/2"    // Classic photography
```

---

## Important Notes

1. **File Uploads**: Always use `forceFormData: true` with Inertia.js
2. **Validation**: Client-side validation is instant, but always validate server-side too
3. **Seeded Data**: Use `defaultValue`/`defaultImage` props to show existing data
4. **Required Fields**: Use `required` prop for both client and server validation
5. **Errors**: Pass Inertia errors directly via `error` prop

---

## Need Help?

See full documentation: [ADMIN_FORM_COMPONENTS.md](./ADMIN_FORM_COMPONENTS.md)
